<?php
namespace QualityUnit;

class Trial_Signup {
	private static $crm_api_base            = 'https://crm.qualityunit.com/api/v3/';
	private static $form_identifier         = 'signup-trial-form';
	private static $current_lang            = 'en-US';
	private static $lazy_loaded_scripts     = array( 'qu-crm-script', 'qu-crm-captcha' );
	private static $localized_text          = array();
	private static $crm_script_loaded       = false;
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

		if ( is_user_logged_in() ) {
			self::create_thank_you_page();
		}
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
				'thankYouUrl'  => home_url( add_query_arg( 'ver', 'installation', self::$slugs['thank-you'] ) ),

				'crmLangCode'  => self::get_language_code(),
				'currentLang'  => self::$current_lang,
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
			'invalid'                       => array(
				'name'    => __( 'Field invalid', 'qu_signup' ),
				'email'   => __( 'Email invalid', 'qu_signup' ),
				'domain'  => __( 'Domain can not contain http, www or capital letters (A-Z)', 'qu_signup' ),
				'code'    => __( 'Invalid code.', 'qu_signup' ),
				'region'  => __( 'Select datacenter region.', 'qu_signup' ),
				'captcha' => __( 'Verify captcha.', 'qu_signup' ),
			), 
			'textEmpty'                     => __( "Field can't be empty", 'qu_signup' ),
			'textTooShort'                  => __( 'The input must be at least 3 characters long.', 'qu_signup' ),
			'textFailedDomain'              => __( 'Failed to validate domain', 'qu_signup' ),
			'textValidating'                => __( 'Validating...', 'qu_signup' ),
			'textFailedRetrieve'            => __( 'Failed to retrieve valid progress info.', 'qu_signup' ),
			'textGoToApp'                   => __( 'Go to your App', 'qu_signup' ),
			'textGoToLiveAgent'             => __( 'Go to LiveAgent', 'qu_signup' ),
			'textLogInEmail'                => __( 'Log in via email', 'qu_signup' ),
			'textProgressInstalling'        => __( 'Building Your LiveAgent', 'qu_signup' ),
			'textProgressLaunching'         => __( 'Halfway there', 'qu_signup' ),
			'textProgressRedirecting'       => __( 'Almost done, just a moment', 'qu_signup' ),
			'textProgressFinalizing'        => __( 'Your LiveAgent is ready to use', 'qu_signup' ),
			'textProgressLoginViaEmail'     => __( 'To log in, use the link we sent to your email', 'qu_signup' ),
			'textProgressAsyncInstallation' => __( "Setup is in progress, you'll get an email after completion...", 'qu_signup' ),
			'textError'                     => __( 'Something went wrong.', 'qu_signup' ),
			'textErrorCaptcha'              => __( 'Cannot load captcha', 'qu_signup' ),
		);
		
		if ( has_filter( 'wpml_current_language' ) ) {
			$current_lang = apply_filters( 'wpml_current_language', null );
			if ( $current_lang ) {  
				self::$current_lang = $current_lang;
			}
		}
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
}

Trial_Signup::run();
