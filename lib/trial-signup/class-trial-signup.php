<?php
namespace QualityUnit;

class Trial_Signup {
	private static $crm_api_base            = 'https://crm.qualityunit.com/api/v3/';
	private static $form_identifier         = 'signup-trial-form';
	private static $current_lang            = 'en-US';
	private static $lazy_loaded_scripts     = array( 'qu-crm-script', 'qu-crm-captcha' );
	private static $localized_text          = array();
	private static $form_data               = array();
	private static $error_state             = array();
	private static $trial_signup_response   = array();
	private static $crm_script_loaded       = false;
	private static $form_type_free          = false;
	private static $thank_you_template_name = 'template-thank-you';

	public static $regions = array();
	public static $slugs   = array();

	public static function run() {
		add_action( 'init', array( __CLASS__, 'init' ) );
		add_action( 'template_redirect', array( __CLASS__, 'thank_you_template_actions' ) );

		add_filter( 'script_loader_tag', array( __CLASS__, 'lazy_load_script' ), 10, 3 );
	}

	public static function init() {
		self::init_defaults();

		if ( ! self::is_error_state() ) {
			// if error state, do not handle signup, prefilled form with errors displayed
			self::handle_form_submission();
			self::handle_signup();
		}

		if ( is_user_logged_in() ) {
			self::create_thank_you_page();
		}
	}

	private static function handle_signup() {
		
		$form_data = self::$form_data;

		if ( is_array( $form_data ) && ! empty( $form_data ) ) {
			$target = ! isset( $form_data['redeem_code'] ) ? self::$slugs['trial'] : self::$slugs['redeem-code'];

			self::$error_state = self::validate_form_data();

			if ( ! empty( self::$error_state ) ) {
				return;
			}

			$submit_response = self::process_crm_api_request();
			if ( is_array( $submit_response ) ) {

				// account installation starts
				if ( isset( $submit_response['account_id'] ) ) {

					$cookie_data = array(
						'id'             => $submit_response['id'],
						'domain'         => $submit_response['domain'],
						'customer_email' => $submit_response['customer_email'],
						'customer_name'  => $submit_response['customer_name'],
						'account_id'     => $submit_response['account_id'],
						'subdomain'      => $form_data['subdomain'],
						'language'       => $form_data['language'],
					);

					if ( isset( $form_data['redeem_code'] ) ) {
						$cookie_data['is_redeem'] = true;
					}

					if ( isset( $form_data['plan_type'] ) ) {
						$cookie_data['plan_type'] = $form_data['plan_type'];
					}

					self::set_cookie_data( 'trial_signup_response', $cookie_data );
					self::redirect( add_query_arg( 'ver', 'installation', self::$slugs['thank-you'] ) );
				}

				// account installation failed
				if ( isset( $submit_response['message'] ) ) {
					self::$error_state = array(
						'failure' => 'signup',
						'message' => $submit_response['message'],
					);
				}
			}
		}

		// no form submission, direct visit of page
		return;
	}

	// ignore wp nonce check in linter
	// @codingStandardsIgnoreStart
	private static function handle_form_submission() {
		$request_method = isset( $_SERVER['REQUEST_METHOD'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) : null;

		if ( 'POST' === $request_method && isset( $_POST['fullname'], $_POST['email'], $_POST['subdomain'], $_POST['region'], $_POST['grecaptcha'] ) ) {

			// if grecaptcha field submitted empty, check if it's really submission with 'no recaptcha' response from crm api
			// fake input may be probably filled by robot
			if (
				'' === $_POST['grecaptcha'] &&
				( ! isset( $_POST['fcaptcha'] ) || ( isset( $_POST['fcaptcha'] ) && '' !== $_POST['fcaptcha'] ) )
			) {
				return;
			}

			self::$form_type_free = isset( $_POST['form_type_free'] ) ? true : false;
			
			//make sure to post only valid string data
			$stringified = array(
				'fullname' => 'string' === gettype($_POST['fullname']) ? $_POST['fullname'] : '',
				'email' => 'string' === gettype($_POST['email']) ? $_POST['email'] : '',
				'subdomain' => 'string' === gettype($_POST['subdomain']) ? $_POST['subdomain'] : '',
				'region' => 'string' === gettype($_POST['region']) ? $_POST['region'] : '',
			);
			
			$form_data = array(
				'fullname'     => sanitize_text_field( trim( $stringified['fullname'] ) ),
				'email'        => sanitize_email( trim( $stringified['email'] ) ),
				'subdomain'    => sanitize_text_field( trim(  $stringified['subdomain'] ) ),
				'region'       => self::sanitize_region( $stringified['region'] ),
				'variation_id' => self::get_variation_id(),
				'language'     => self::get_language_code(),
				'promo'        => isset( $_POST['promo'] ) && 'on' === $_POST['promo'],
			);

			// do not pass empty captcha, probably submission with 'no recaptcha' response from crm api
			if ( '' !== $_POST['grecaptcha'] ) {
				$form_data['grtoken'] = sanitize_text_field( $_POST['grecaptcha'] );
			}

			if ( isset( $_POST['redeem_code'] ) ) {
				$form_data['redeem_code'] = sanitize_text_field( $_POST['redeem_code'] );
			}

			if ( isset( $_POST['plan_type'] ) ) {
				$form_data['plan_type'] = sanitize_text_field( $_POST['plan_type'] );
			}

			// tracking data filled before submit from js
			if ( isset( $_POST['pap_visitor_id'] ) ) {
				$form_data['pap_visitor_id'] = sanitize_text_field( $_POST['pap_visitor_id'] );
			}

			if ( isset( $_POST['source_id'] ) ) {
				$form_data['source_id'] = sanitize_text_field( $_POST['source_id'] );
			}

			if ( isset( $_POST['ga_client_id'] ) ) {
				$form_data['ga_client_id'] = sanitize_text_field( $_POST['ga_client_id'] );
			}

			self::$form_data = $form_data;
		}
	}
	// @codingStandardsIgnoreEnd

	private static function get_request_data() {
		$form_data    = self::$form_data;
		$request_data = array();

		if ( isset( $form_data['redeem_code'] ) ) {
			// shape of redeem code form payload
			$request_data = array(
				'code'      => $form_data['redeem_code'],
				'name'      => $form_data['fullname'],
				'email'     => $form_data['email'],
				'subdomain' => $form_data['subdomain'],
				'region'    => $form_data['region'],
				'language'  => $form_data['language'],
				'promo'     => $form_data['promo'],
			);

		} else {
			// shape of standard trial form payload
			$request_data = array(
				'variation_id' => $form_data['variation_id'],
				'customer'     => array(
					'name'  => $form_data['fullname'],
					'email' => $form_data['email'],
				),
				'subdomain'    => $form_data['subdomain'],
				'region'       => $form_data['region'],
				'language'     => $form_data['language'],
				'promo'        => $form_data['promo'],
			);
		}

		if ( ! empty( $request_data ) ) {

			if ( isset( $form_data['grtoken'] ) ) {
				$request_data['grtoken'] = $form_data['grtoken'];
			}

			// tracking data from js
			if ( isset( $form_data['pap_visitor_id'] ) ) {
				$request_data['pap_visitor_id'] = $form_data['pap_visitor_id'];
			}

			if ( isset( $form_data['source_id'] ) ) {
				$request_data['source_id'] = $form_data['source_id'];
			}

			if ( isset( $form_data['ga_client_id'] ) ) {
				$request_data['ga_client_id'] = $form_data['ga_client_id'];
			}
		}

		return $request_data;
	}

	public static function get_form_defaults() {
		$form_data   = self::$form_data;
		$error_state = self::$error_state;

		// prefill with submitted or use empty defaults
		$fullname    = isset( $form_data['fullname'] ) ? $form_data['fullname'] : '';
		$email       = isset( $form_data['email'] ) ? $form_data['email'] : '';
		$subdomain   = isset( $form_data['subdomain'] ) ? $form_data['subdomain'] : '';
		$region      = isset( $form_data['region'] ) ? $form_data['region'] : '';
		$promo       = isset( $form_data['promo'] ) ? $form_data['promo'] : false;
		$redeem_code = isset( $form_data['redeem_code'] ) ? $form_data['redeem_code'] : '';

		return array(
			'fullname'    => array(
				'value' => $fullname,
				'class' => isset( $error_state['messages']['fullname'] ) ? 'Error' : ( $fullname ? 'Valid' : '' ),
				'error' => isset( $error_state['messages']['fullname'] ) ? $error_state['messages']['fullname'] : '',
			),
			'email'       => array(
				'value' => $email,
				'class' => isset( $error_state['messages']['email'] ) ? 'Error' : ( $email ? 'Valid' : '' ),
				'error' => isset( $error_state['messages']['email'] ) ? $error_state['messages']['email'] : '',
			),
			'subdomain'   => array(
				'value' => $subdomain,
				'class' => isset( $error_state['messages']['subdomain'] ) ? 'Error' : ( $subdomain ? 'Valid' : '' ),
				'error' => isset( $error_state['messages']['subdomain'] ) ? $error_state['messages']['subdomain'] : '',
			),
			'region'      => array(
				'value' => $region,
				'class' => isset( $error_state['messages']['region'] ) ? 'Error' : ( $region ? 'Valid' : '' ),
				'error' => isset( $error_state['messages']['region'] ) ? $error_state['messages']['region'] : '',
			),
			'redeem_code' => array(
				'value' => $redeem_code,
				'class' => isset( $error_state['messages']['redeem_code'] ) ? 'Error' : ( $redeem_code ? 'Valid' : '' ),
				'error' => isset( $error_state['messages']['redeem_code'] ) ? $error_state['messages']['redeem_code'] : '',
			),
			'promo'       => array(
				'value' => $promo,
			),

		);
	}

	private static function validate_form_data() {
		self::clear_errors();
		$form_data = self::$form_data;

		$name_pattern        = '/^[\p{L}0-9\s]+$/u'; // allow any unicode letters, numbers, spaces, disallow special characters
		$email_pattern       = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
		$subdomain_pattern   = '/^((?!http|www))[^A-Z][-a-z0-9]*$/';
		$redeem_code_pattern = '/^[A-Za-z0-9\-]+$/';

		$errors = array();

		if ( '' === $form_data['fullname'] ) {
			$errors['fullname'] = self::$localized_text['textEmpty'];
		} elseif ( ! preg_match( $name_pattern, $form_data['fullname'] ) ) {
			$errors['fullname'] = self::$localized_text['invalid']['name'];
		}

		if ( '' === $form_data['email'] ) {
			$errors['email'] = self::$localized_text['textEmpty'];
		} elseif ( ! preg_match( $email_pattern, $form_data['email'] ) ) {
			$errors['email'] = self::$localized_text['invalid']['email'];
		}

		if ( '' === $form_data['subdomain'] ) {
			$errors['subdomain'] = self::$localized_text['textEmpty'];
		} elseif ( ! preg_match( $subdomain_pattern, $form_data['subdomain'] ) ) {
			$errors['subdomain'] = self::$localized_text['invalid']['domain'];
		} else {
			$domain_check_response = self::domain_check( $form_data['subdomain'] );
			if ( is_array( $domain_check_response ) && isset( $domain_check_response['message'] ) ) {
				$errors['subdomain'] = $domain_check_response['message'];
			}
		}

		if ( '' === $form_data['region'] ) {
			$errors['region'] = self::$localized_text['textEmpty'];
		} elseif ( ! array_key_exists( $form_data['region'], self::$regions ) ) {
			$errors['region'] = self::$localized_text['invalid']['region'];
		}

		if ( isset( $form_data['redeem_code'] ) ) {
			if ( '' === $form_data['redeem_code'] ) {
				$errors['redeem_code'] = self::$localized_text['textEmpty'];
			} elseif ( ! preg_match( $redeem_code_pattern, $form_data['redeem_code'] ) ) {
				$errors['redeem_code'] = self::$localized_text['invalid']['code'];
			}
		}

		if ( ! empty( $errors ) ) {
			$error_state = array(
				'failure'  => 'inputs-validation',
				'messages' => $errors,
			);

			return $error_state;
		}

		return array();
	}

	public static function include_crm() {
		if ( ! self::$crm_script_loaded ) {

			self::print_footer_scripts();

			$handle = 'qu-crm-captcha';
			// dependency app_js to allow usage of set/getCookies from custom scritps
			$crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crmCaptcha.js' ) );
			wp_enqueue_script( $handle, esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crmCaptcha.js', array( 'app_js' ), esc_attr( $crm_ver_app ), array( 'in_footer' => true ) );

			self::localize_script( $handle );

			$handle = 'qu-crm-script';
			// dependency app_js to allow usage of set/getCookies from custom scritps
			$crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crmForms.js' ) );
			wp_enqueue_script( $handle, esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crmForms.js', array( 'app_js', 'qu-crm-captcha' ), esc_attr( $crm_ver_app ), array( 'in_footer' => true ) );

			self::$crm_script_loaded = true;
		}
	}

	public static function include_crm_installer() {

			$handle = 'qu-crm-installer-script';

			// crm script dependency app_js to allow usage of set/getCookies from custom scritps
			$crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crmInstaller.js' ) );
			wp_enqueue_script( $handle, esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crmInstaller.js', array( 'app_js' ), esc_attr( $crm_ver_app ), array( 'in_footer' => true ) );

			self::localize_script( $handle );
	}

	private static function localize_script( $handle ) {
		wp_localize_script(
			$handle,
			'quCrmData',
			array(
				'localization' => self::$localized_text,
				'apiBase'      => self::$crm_api_base,
				'nonce'        => wp_create_nonce( 'qu-crm-nonce' ),
				'trialUrl'     => home_url( self::$slugs['trial'] ),
				'productId'    => self::get_product_id(),
			)
		);
	}

	private static function print_footer_scripts() {
		add_action(
			'wp_print_footer_scripts',
			function () {
				?>
				<script>
					<?php // prevent form submission (without crm script) before captcha is lazy loaded ?>
					window.addEventListener( 'load', () => {
						document.querySelectorAll( "form[data-form-type=<?php echo esc_attr( self::$form_identifier ); ?>" )
							.forEach( ( form ) => {
								form.addEventListener( 'submit', ( e ) => {
									if( typeof grecaptcha === 'undefined' ){
										e.preventDefault();
									}
								} );
							} );
					} );
				</script>
				<?php
			}
		);
	}

	public static function grecaptcha_parts( $form_type = null ) {
		// render parts used by v2 captcha, with v3 version will stay hidden
		$class_name = 'sidebar' === $form_type ? 'Signup__sidebar__item' : 'Signup__form__item';
		ob_start();
		?>
			<div data-id="captchaFieldmain" class="<?php echo esc_attr( $class_name ); ?> hidden">
				<div class="grecaptcha-wrapper"></div>
				<div class="ErrorMessage"></div>
			</div>
		<?php
		echo wp_kses_post( ob_get_clean() );
	}

	private static function process_crm_api_request() {
		$request_data = self::get_request_data();
		$endpoint     = ! isset( $request_data['code'] ) ? 'subscriptions/' : 'redeem_code/signup/';

		$handle = curl_init( self::$crm_api_base . $endpoint );

		if ( ! $handle ) {
			return array( 
				'message' => self::$localized_text['textError'],
			);
		}
		
		$header = array( 'Content-Type: application/json' );
		// @codingStandardsIgnoreStart
		if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
			$user_agent = sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] );
			$header[]   = "User-Agent: {$user_agent}"; 
		}
		if ( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ) {
			$accept_language = sanitize_text_field( $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
			$header[]        = "Accept-Language: {$accept_language}";
		}
		// @codingStandardsIgnoreEnd

		curl_setopt_array(
			$handle,
			array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST           => true,
				CURLOPT_HTTPHEADER     => $header,
				CURLOPT_POSTFIELDS     => json_encode( $request_data ),
			)
		);

		$response = curl_exec( $handle );

		if ( curl_errno( $handle ) ) {
			$result = array(
				'message' => self::$localized_text['textError'],
			);
		} else {
			$result = json_decode( $response, true );
		}

		curl_close( $handle );
		return $result;
	}

	private static function domain_check( $domain ) {
		$request_data = array(
			'productId' => self::get_product_id(),
			'subdomain' => $domain,
		);

		$handle = curl_init( self::$crm_api_base . 'subscriptions/_check_domain' );

		if ( ! $handle ) {
			return array(
				'message' => self::$localized_text['textFailedDomain'],
			);
		}

		curl_setopt_array(
			$handle,
			array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST           => true,
				CURLOPT_POSTFIELDS     => $request_data,
			)
		);

		$response = curl_exec( $handle );

		if ( curl_errno( $handle ) ) {
			$result = array(
				'message' => curl_error( $handle ),
			);
		} else {
			$result = json_decode( $response, true );
		}

		curl_close( $handle );
		return $result;
	}

	private static function get_variation_id() {
		// variation_ids divided on the base of old crm js
		if ( self::$form_type_free ) {
			return 'freedesk';
		}

		if ( in_array( self::$current_lang, array( 'fi', 'sv' ) ) ) {
			return 'seLaTria';
		}

		if ( 'ja' === self::$current_lang ) {
			return 'iwkTrial';
		}

		return '3513230f';
	}

	private static function get_product_id() {
		// product_ids divided on the base of old crm js
		if ( self::$form_type_free ) {
			return 'b229622b';
		}

		if ( in_array( self::$current_lang, array( 'fi', 'sv' ) ) ) {
			return 'spinla01';
		}

		if ( 'ja' === self::$current_lang ) {
			return 'intwkla1';
		}

		return 'b229622b';
	}

	private static function get_language_code() {
		// codes with region from crm.qualityunit.com, other languages are two-letter codes
		// ar-SA, en-US, he-IL, jp-JP, nl-BE, pt-BR, zh-CN, zh-TW
		// codes taken from crm js files, wpmlCode => crmCode

		$custom_codes = array(
			'ar'      => 'ar-sa',
			'pt-br'   => 'pt-BR', // crm _br
			'zh-hans' => 'zh-CN', // crm _cn
			'en'      => 'en-US',
			'ja'      => 'jp-JP', // crm _jp
			'he'      => 'he-IL',
			'nl'      => 'nl-BE',
		);

		if ( isset( $custom_codes[ self::$current_lang ] ) ) {
			return $custom_codes[ self::$current_lang ];
		}
		return self::$current_lang;
	}

	// visitor ip resolving borrowed from URLsLab plugin
	private static function get_visitor_ip() {
		if ( getenv( 'HTTP_CF_CONNECTING_IP' ) ) {
			return getenv( 'HTTP_CF_CONNECTING_IP' );
		}
		if ( getenv( 'HTTP_CLIENT_IP' ) ) {
			return getenv( 'HTTP_CLIENT_IP' );
		}
		if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			return getenv( 'HTTP_X_FORWARDED_FOR' );
		}
		if ( getenv( 'HTTP_X_FORWARDED' ) ) {
			return getenv( 'HTTP_X_FORWARDED' );
		}
		if ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
			return getenv( 'HTTP_FORWARDED_FOR' );
		}
		if ( getenv( 'HTTP_FORWARDED' ) ) {
			return getenv( 'HTTP_FORWARDED' );
		}
		if ( getenv( 'HTTP_X_REAL_IP' ) ) {
			return getenv( 'HTTP_X_REAL_IP' );
		}
		if ( getenv( 'REMOTE_ADDR' ) ) {
			return getenv( 'REMOTE_ADDR' );
		}
		return '';
	}

	private static function create_thank_you_page() {
		$query = new \WP_Query(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_name'   => 'thank-you',
				'meta_query'  => array(
					array(
						'key'     => '_wp_page_template',
						'value'   => self::$thank_you_template_name . '.php',
						'compare' => '=',
					),
				),
			)
		);

		if ( $query && ! $query->found_posts ) {
			wp_insert_post(
				array(
					'post_title'    => 'Thank you',
					'post_name'     => 'thank-you',
					'post_status'   => 'publish',
					'post_type'     => 'page',
					'page_template' => self::$thank_you_template_name . '.php',
				)
			);
		}
	}

	private static function init_defaults() {
		self::$regions = array(
			'NA' => __( 'Americas (US)', 'qu_signup' ),
			'EU' => __( 'Europe & Africa (EU)', 'qu_signup' ),
			'AS' => __( 'Asia & Pacific (SG)', 'qu_signup' ),
		);

		self::$slugs = array(
			'trial'       => __( '/trial/', 'ms' ),
			'redeem-code' => __( '/redeem-code/', 'ms' ),
			'thank-you'   => __( '/thank-you/', 'ms' ),
		);

		self::$localized_text = array(
			'invalid'                 => array(
				'name'    => __( 'Field invalid', 'qu_signup' ),
				'email'   => __( 'Email invalid', 'qu_signup' ),
				'domain'  => __( 'Domain can not contain http, www or capital letters (A-Z)', 'qu_signup' ),
				'code'    => __( 'Invalid code.', 'qu_signup' ),
				'region'  => __( 'Select datacenter region.', 'qu_signup' ),
				'captcha' => __( 'Verify captcha.', 'qu_signup' ),
			),
			'textEmpty'               => __( "Field can't be empty", 'qu_signup' ),
			'textFailedDomain'        => __( 'Failed to validate domain', 'qu_signup' ),
			'textValidating'          => __( 'Validating...', 'qu_signup' ),
			'textFailedRetrieve'      => __( 'Failed to retrieve valid progress info.', 'qu_signup' ),
			'textGoToApp'             => __( 'Go to your App', 'qu_signup' ),
			'textGoToLiveAgent'       => __( 'Go to LiveAgent', 'qu_signup' ),
			'textProgressInstalling'  => __( 'Building Your LiveAgent', 'qu_signup' ),
			'textProgressLaunching'   => __( 'Halfway there', 'qu_signup' ),
			'textProgressRedirecting' => __( 'Almost done, just a moment', 'qu_signup' ),
			'textProgressFinalizing'  => __( 'Your LiveAgent is ready to use', 'qu_signup' ),
			'textError'               => __( 'Something went wrong.', 'qu_signup' ),
			'textErrorCaptcha'        => __( 'Cannot load captcha', 'qu_signup' ),
		);

		if ( has_filter( 'wpml_current_language' ) ) {
			$current_lang = apply_filters( 'wpml_current_language', null );
			if ( $current_lang ) {
				self::$current_lang = $current_lang;
			}
		}
	}

	public static function get_signup_error_message() {
		$error_state = self::$error_state;
		return isset( $error_state['failure'] ) && 'signup' === $error_state['failure'] ? $error_state['message'] : '';
	}

	private static function clear_errors() {
		self::$error_state = array();
	}

	private static function sanitize_region( $region ) {
		if ( array_key_exists( $region, self::$regions ) ) {
			return sanitize_text_field( $region );
		}
		return '';
	}

	private static function sanitize_cookie_data( $data ) {
		$sanitized = array();
		foreach ( $data as $key => $value ) {
			$sanitized[ $key ] = sanitize_text_field( $value );
		}
		return $sanitized;
	}

	private static function is_error_state() {
		return is_array( self::$error_state ) && ! empty( self::$error_state );
	}

	private static function redirect( $target ) {
		wp_safe_redirect( $target );
		exit;
	}

	public static function lazy_load_script( $tag, $handle, $src ) {
		if ( in_array( $handle, self::$lazy_loaded_scripts ) ) {
			$tag = '<script data-src="' . esc_url( $src ) . '"></script>';
		}
		return $tag;
	}

	public static function thank_you_template_actions() {
		$is_thank_you_page = self::is_thank_you_template();
		if ( $is_thank_you_page && ( ! isset( $_GET['ver'] ) || 'installation' !== $_GET['ver'] ) ) {
			self::redirect( self::$slugs['trial'] );
			exit;
		}
	}

	private static function is_thank_you_template() {
		$template = get_page_template_slug();
		return 'string' === gettype( $template ) && str_replace( '.php', '', $template ) === self::$thank_you_template_name;
	}

	// @codingStandardsIgnoreStart

	private static function set_cookie_data( $key, $value, $expiry = 0, $path = '/' ) {
		if ( is_array( $value ) ) {
			setcookie( $key, json_encode( $value ), $expiry, $path );
			return;
		}
		setcookie( $key, $value, $expiry, $path );
	}

	// @codingStandardsIgnoreEnd
}

Trial_Signup::run();
