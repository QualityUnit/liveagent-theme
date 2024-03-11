<?php
namespace QualityUnit;

class Trial_Signup {
	private static $crm_api_base            = 'https://crm.qualityunit.com/api/v3/';
	private static $form_identifier         = 'signup-trial-form';
	private static $current_lang            = 'en-US';
	private static $lazy_loaded_scripts     = array( 'qu-crm-script-lazy' );
	private static $localized_text          = array();
	private static $form_data               = array();
	private static $error_state             = array();
	private static $trial_signup_reponse    = array();
	private static $crm_script_loaded       = false;
	private static $form_type_free          = false;
	private static $is_thank_you_page       = false;
	private static $thank_you_template_name = 'template-thank-you';
	private static $grecaptcha              = array(
		'site_key' => '6LddyswZAAAAAJrOnNWj_jKRHEs_O_I312KKoMDJ',
		'version'  => 'v3',
	);
	//v2 public: 6LdGaIEpAAAAAEAWYSh83TuTzlttqSVgdEZPNfrV
	
	public static $regions = array();
	public static $slugs   = array();

	public static function run() {
		add_action( 'init', array( __CLASS__, 'init' ) );
		add_action( 'template_redirect', array( __CLASS__, 'thank_you_template_actions' ) );
	
		add_filter( 'script_loader_tag', array( __CLASS__, 'lazy_load_script' ), 10, 3 );
	}

	public static function init() {
		self::open_session();
		self::init_defaults();
		
		if ( ! self::is_error_state() ) {
			// if error state, do not handle signup, prefilled form with error is displayed
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
			$target           = ! isset( $form_data['redeem_code'] ) ? self::$slugs['trial'] : self::$slugs['redeem-code'];
			$validation_error = self::validate_form_data();
			
			if ( ! empty( $validation_error ) ) {
				self::set_session_data( 'trial_signup_error', $validation_error );
				self::redirect( $target );
			}

			$submit_response = self::process_crm_api_request();
			if ( is_array( $submit_response ) ) {

				// account installation starts
				if ( isset( $submit_response['account_id'] ) ) {
					// push form data we need on thank-you page 
					$submit_response['form_data'] = array(
						'subdomain' => $form_data['subdomain'],
						'language'  => $form_data['language'],
					);
					
					if ( isset( $form_data['redeem_code'] ) ) {
						$submit_response['form_data']['is_redeem'] = true;
					}

					if ( isset( $form_data['plan_type'] ) ) {
						$submit_response['form_data']['plan_type'] = $form_data['plan_type'];
					}

					self::set_session_data( 'trial_signup_reponse', $submit_response );
					self::clean_session( 'trial_signup_form_data' );
					
					self::redirect( self::$slugs['thank-you'] );
				}

				// account installation failed
				if ( isset( $submit_response['message'] ) ) {
					$error_state = array(
						'failure' => 'signup',
						'message' => $submit_response['message'],
					);
					self::set_session_data( 'trial_signup_error', $error_state );
					self::redirect( $target );
				}
			}
		}

		// no form submission, direct visit of page
		return;
	}

	private static function handle_form_submission() {

		$request_method = isset( $_SERVER['REQUEST_METHOD'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) : null;

		if ( 'POST' === $request_method && isset( $_POST['fullname'], $_POST['email'], $_POST['subdomain'], $_POST['grecaptcha'] ) ) {

			$nonce = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';

			if ( ! wp_verify_nonce( $nonce, 'trial_signup_nonce' ) ) {
				return;
			}

			self::$form_type_free = isset( $_POST['form_type_free'] ) ? true : false;

			$form_data = array(
				'fullname'     => sanitize_text_field( trim( $_POST['fullname'] ) ),
				'email'        => sanitize_email( trim( $_POST['email'] ) ),
				'subdomain'    => sanitize_text_field( trim( $_POST['subdomain'] ) ),
				'region'       => isset( $_POST['region'] ) ? self::sanitize_region( $_POST['region'] ) : '',
				'grtoken'      => sanitize_text_field( $_POST['grecaptcha'] ),
				'variation_id' => self::get_variation_id(),
				'language'     => self::get_language_code(),
				'promo'        => isset( $_POST['promo'] ) && 'on' === $_POST['promo'],
			);

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

			self::set_session_data( 'trial_signup_form_data', $form_data );
			self::$form_data = $form_data;
		}
	}

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
				'grtoken'   => $form_data['grtoken'],
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
				'grtoken'      => $form_data['grtoken'],
				'region'       => $form_data['region'],
				'language'     => $form_data['language'],
				'promo'        => $form_data['promo'],
			);
		}

		if ( ! empty( $request_data ) ) {

			// tracking data from js
			if ( isset( $form_data['pap_visitor_id'] ) ) {
				$request_data['pap_visitor_id'] = sanitize_text_field( $form_data['pap_visitor_id'] );
			}

			if ( isset( $form_data['source_id'] ) ) {
				$request_data['source_id'] = sanitize_text_field( $form_data['source_id'] );
			}
		
			if ( isset( $form_data['ga_client_id'] ) ) {
				$request_data['ga_client_id'] = sanitize_text_field( $form_data['ga_client_id'] );
			}
		}

		return $request_data;
	}

	private static function get_signup_response_data( $keys = array() ) {
		$trial_signup_reponse = self::$trial_signup_reponse;

		if ( is_array( $trial_signup_reponse ) ) {

			if ( ! empty( $keys ) ) {
				$return_data = array();
				foreach ( $keys as $key ) {
					if ( isset( $trial_signup_reponse[ $key ] ) ) {
						$return_data[ $key ] = $trial_signup_reponse[ $key ];
					}
				}
				return $return_data;
			}

			return $trial_signup_reponse;
		}
		
		return array();
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
			
			if ( ! self::$is_thank_you_page ) {
				self::use_grecaptcha();
			}

			$handle = self::$is_thank_you_page ? 'qu-crm-script' : 'qu-crm-script-lazy';

			// crm script dependency app_js to allow usage of set/getCookies from custom scritps
			$crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crm.js' ) );
			wp_enqueue_script( $handle, esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm.js', array( 'app_js' ), esc_attr( $crm_ver_app ), array( 'in_footer' => true ) );

			wp_localize_script(
				$handle,
				'quCrmData',
				array(
					'localization'   => self::$localized_text,
					'apiBase'        => self::$crm_api_base,
					'nonce'          => wp_create_nonce( 'qu-crm-nonce' ),
					'captchaVersion' => self::$grecaptcha['version'],
					'productId'      => self::get_product_id(),
					'signupData'     => self::get_signup_response_data( 
						array( 'id', 'customer_email', 'form_data' ) 
					),
				)
			);

			self::$crm_script_loaded = true;
		}
	}

	public static function use_grecaptcha() {
		self::$grecaptcha = self::get_grecaptcha_info();
		
		add_action(
			'wp_print_footer_scripts',
			function () {
				?>
				
				<?php if ( 'v2' === self::$grecaptcha['version'] ) : ?>
					<script data-src="https://www.google.com/recaptcha/api.js?onload=handleCaptchaLoad&render=explicit" async defer></script>
				<?php endif; ?>
				
				<?php if ( 'v3' === self::$grecaptcha['version'] ) : ?>
					<script data-src="https://www.google.com/recaptcha/api.js?onload=handleCaptchaLoad&render=<?php echo esc_attr( self::$grecaptcha['site_key'] ); ?>"></script>
				<?php endif; ?>
				
				<script>
					function handleCaptchaLoad(){
						document.querySelectorAll("form[data-form-type=<?php echo esc_attr( self::$form_identifier ); ?>")
						.forEach( (form) => {
							const grecaptchaInput = form.querySelector( 'input[data-id="grecaptcha"]' );
							const gaClientInput = form.querySelector( 'input[data-id="ga_client_id"]' );
							const emailInput = form.querySelector( '[data-id=mailFieldmain] input[name=email]' );
							const submitButton = form.querySelector( '[data-id=submitFieldmain] button[type=submit]' );
							const isRedeemForm = form.querySelector( '[data-id=codeFieldmain] input[name=redeem_code]' ) ? true : false;

							const gaUserId = getCookie( '_ga' ) || '';
							
							function handleFinalActions() {
								if( gaClientInput ) { gaClientInput.value = gaUserId };
								if( ! isRedeemForm && typeof gtag !== 'undefined' ){
									gtag( 'set', 'user_data', { email: emailInput ? emailInput.value : '' } );
									gtag( 'event', 'Trial sign_up', { send_to: 'GTM-MR5X6FD' } );
								}
							}
							
							<?php if ( 'v2' === self::$grecaptcha['version'] ) : ?>
								const captchaWrapper = form.querySelector('[data-id=captchaFieldmain]');
								captchaWrapper.classList.remove( 'hidden' );

								grecaptcha.render( captchaWrapper.querySelector('.grecaptcha-wrapper'), {
									'sitekey' : "<?php echo esc_attr( self::$grecaptcha['site_key'] ); ?>",
									'size': form.closest('.Signup__sidebar') ? 'compact': 'normal',
									'callback' : ( token ) => {
										captchaWrapper.classList.remove( 'Error' );
										captchaWrapper.querySelector('.ErrorMessage').textContent = '';
										if( grecaptchaInput ) { grecaptchaInput.value = token };
									},
									'expired-callback': () => {
										if( grecaptchaInput ) { grecaptchaInput.value = '' };
									},
									'error-callback': () => {
										if( grecaptchaInput ) { grecaptchaInput.value = '' };
									},
								});

								form.addEventListener( 'submit', ( e ) => {
									e.preventDefault();
									try {
										<?php // handle simple check if token is present in case the crm script is not available ?>
										if( grecaptchaInput.value === '' ){
											captchaWrapper.classList.add('Error');
											captchaWrapper.querySelector('.ErrorMessage').textContent = "<?php echo esc_html( self::$localized_text['invalid']['captcha'] ); ?>";
											return;
										}
										submitButton.setAttribute('disabled', '');
										handleFinalActions();
										form.submit();
									} catch (e) {
										submitButton.removeAttribute('disabled');
									}
								});
							<?php endif; ?>
							
							<?php if ( 'v3' === self::$grecaptcha['version'] ) : ?>
								form.addEventListener( 'submit', ( e ) => {
									e.preventDefault();
									try {
										submitButton.setAttribute('disabled', '');
											grecaptcha.ready( () => {
												grecaptcha.execute( 
													"<?php echo esc_attr( self::$grecaptcha['site_key'] ); ?>", 
													{ action: 'login' } 
												).then( ( token ) => {
													if( grecaptchaInput ) { grecaptchaInput.value = token };
													handleFinalActions();
													form.submit();
												} )
											} );
									} catch (e) {
										submitButton.removeAttribute('disabled');
									}

								});
							<?php endif; ?>
						});
					}
				</script>
				<?php
			}
		);
	}

	public static function grecaptcha_parts() {
		if ( 'v2' === self::$grecaptcha['version'] ) {
			ob_start();
			?>
				<div data-id="captchaFieldmain" class="Signup__form__item hidden">
					<div class="grecaptcha-wrapper"></div>
					<div class="ErrorMessage"></div>
				</div>
			<?php
			echo wp_kses_post( ob_get_clean() );
		}
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

		curl_setopt_array(
			$handle,
			array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST           => true,
				CURLOPT_HTTPHEADER     => array( 'Content-Type: application/json' ),
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

	private static function get_grecaptcha_info() {
		$endpoint = 'recaptcha';
		
		$handle = curl_init( self::$crm_api_base . $endpoint );
		
		if ( ! $handle ) {
			// fallback to default v3
			return self::$grecaptcha;
		}

		curl_setopt_array(
			$handle,
			array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST           => false,
			)
		);

		$response = curl_exec( $handle );

		if ( curl_errno( $handle ) ) {
			$result = self::$grecaptcha;
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

		if ( in_array( self::$current_lang, array( 'fi', 'no', 'sv' ) ) ) {
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

		if ( in_array( self::$current_lang, array( 'fi', 'no', 'sv' ) ) ) {
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
			'ar'      => 'ar-SA',
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
		// try to get and clean data from session (possibly to prefill submitted incorrect form without js)
		self::$form_data            = self::get_session_data( 'trial_signup_form_data', true, array() );
		self::$error_state          = self::get_session_data( 'trial_signup_error', true, array() );
		self::$trial_signup_reponse = self::get_session_data( 'trial_signup_reponse', true, array() );
		
		self::$regions = array(
			'NA' => __( 'Americas (US)', 'ms' ),
			'EU' => __( 'Europe & Africa (EU)', 'ms' ),
			'AS' => __( 'Asia & Pacific (SG)', 'ms' ),
		);

		self::$slugs = array(
			'trial'       => __( '/trial/', 'ms' ),
			'redeem-code' => __( '/redeem-code/', 'ms' ),
			'thank-you'   => __( '/thank-you/', 'ms' ),
		);

		self::$localized_text = array(
			'invalid'                 => array(
				'name'    => __( 'Field invalid', 'ms' ),
				'email'   => __( 'Email invalid', 'ms' ),
				'domain'  => __( 'Domain can not contain http, www or capital letters (A-Z)', 'ms' ),
				'code'    => __( 'Invalid code.', 'ms' ),
				'region'  => __( 'Select datacenter region.', 'ms' ),
				'captcha' => __( 'Verify captcha.', 'ms' ),
			),
			'textEmpty'               => __( "Field can't be empty", 'ms' ),
			'textFailedDomain'        => __( 'Failed to validate domain', 'ms' ),
			'textValidating'          => __( 'Validating...', 'ms' ),
			'textFailedRetrieve'      => __( 'Failed to retrieve valid progress info.', 'ms' ),
			'textGoToApp'             => __( 'Go to your App', 'ms' ),
			'textGoToLiveAgent'       => __( 'Go to LiveAgent', 'ms' ),
			'textProgressInstalling'  => __( 'Building Your LiveAgent', 'ms' ),
			'textProgressLaunching'   => __( 'Halfway there', 'ms' ),
			'textProgressRedirecting' => __( 'Almost done, just a moment', 'ms' ),
			'textProgressFinalizing'  => __( 'Your LiveAgent is ready to use', 'ms' ),
			'textError'               => __( 'Something went wrong.', 'ms' ),
		);

		if ( has_filter( 'wpml_current_language' ) ) {
			self::$current_lang = apply_filters( 'wpml_current_language', null );
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

	private static function is_error_state() {
		return is_array( self::$error_state ) && ! empty( self::$error_state );
	}

	private static function redirect( $target ) {
		wp_safe_redirect( $target );
		exit;
	}

	public static function get_submit_slug() {
		global $wp;
		return home_url( $wp->request );
	}

	public static function lazy_load_script( $tag, $handle, $src ) {
		if ( in_array( $handle, self::$lazy_loaded_scripts ) ) {
			$tag = '<script data-src="' . esc_url( $src ) . '"></script>';
		}
		return $tag;
	}

	public static function thank_you_template_actions() {
		self::$is_thank_you_page = self::is_thank_you_template();
		if ( self::$is_thank_you_page && is_array( self::$trial_signup_reponse ) && empty( self::$trial_signup_reponse ) ) {
			self::redirect( get_home_url() );
			exit;
		}
	}

	private static function is_thank_you_template() {
		$template = get_page_template_slug();
		return 'string' === gettype( $template ) && str_replace( '.php', '', $template ) === self::$thank_you_template_name;
	}
	
	// @codingStandardsIgnoreStart
	
	// move crm api response using session between submit form page and target like /trial or /thank-you page
	// data are used to prefill trial form in case of error response, or are used by crm javascript during installation
	
	private static function set_session_data( $key, $value ) {
		$_SESSION[ $key ] = $value;
	}

	private static function get_session_data( $key, $unset = false, $fallback = null ) {
		$value = isset( $_SESSION[ $key ] ) ? $_SESSION[ $key ] : $fallback;

		if ( $unset && isset( $_SESSION[ $key ] ) ) {
			unset( $_SESSION[ $key ] );
		}

		return $value;
	}
	
	private static function clean_session( $key = '' ) {	
		
		if( $key && isset( $_SESSION[ $key ] ) ){
			unset( $_SESSION[ $key ] );
			return;
		}

		foreach ( array( 'trial_signup_form_data', 'trial_signup_error' ) as $session_key ) {
			if ( isset( $_SESSION[ $session_key ] ) ) {
				unset( $_SESSION[ $session_key ] );
			}
		}
	}

	private static function open_session() {
		if ( ! session_id() ) {
			session_start();
		}
	}
	// @codingStandardsIgnoreEnd
}

Trial_Signup::run();
