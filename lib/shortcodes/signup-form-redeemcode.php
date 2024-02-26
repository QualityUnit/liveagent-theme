<?php

function ms_signup_form_redeem_code( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'  => __( 'Redeem Code', 'ms' ),
			'button' => __( 'Create account', 'ms' ),
		),
		$atts,
		'people'
	);

	$regions = array(
		'NA' => __( 'Americas (US)', 'ms' ),
		'EU' => __( 'Europe & Africa (EU)', 'ms' ),
		'AS' => __( 'Asia & Pacific (SG)', 'ms' ),
	);

	ob_start();
	?>

	<div class="Signup__form">
		<div class="Signup__form__title h3"><?php echo esc_html( $atts['title'] ); ?></div>

		<div data-id="signup">
			<input data-id="plan" type="hidden" value="Trial" autocomplete="off">
			<input data-id="variation" type="hidden" value="3513230f" autocomplete="off">

			<div data-id="codeFieldmain" class="Signup__form__item has-svg">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none"><path d="M12.7833 11.8083C10.3242 11.1692 9.53335 10.5083 9.53335 9.47917C9.53335 8.29833 10.6275 7.475 12.4583 7.475C14.3867 7.475 15.1017 8.39583 15.1667 9.75H17.5608C17.485 7.88667 16.3475 6.175 14.0833 5.6225V3.25H10.8333V5.59C8.73168 6.045 7.04168 7.41 7.04168 9.50083C7.04168 12.0033 9.11085 13.2492 12.1333 13.975C14.8417 14.625 15.3833 15.5783 15.3833 16.5858C15.3833 17.3333 14.8525 18.525 12.4583 18.525C10.2267 18.525 9.34918 17.5283 9.23001 16.25H6.84668C6.97668 18.6225 8.75335 19.955 10.8333 20.3992V22.75H14.0833V20.4208C16.1958 20.02 17.875 18.7958 17.875 16.575C17.875 13.4983 15.2425 12.4475 12.7833 11.8083Z"></path></svg>

				<input type="text" data-type="text" name="Redeem code" placeholder="<?php _e( 'Redeem code', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="100">
				<div class="ErrorMessage"></div>
			</div>

			<div data-id="nameFieldmain" class="Signup__form__item has-svg">
				<svg width="18" height="20" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M18 19v-2c0-2.743-2.257-5-5-5H5c-2.743 0-5 2.257-5 5v2a1 1 0 0 0 2 0v-2c0-1.646 1.354-3 3-3h8c1.646 0 3 1.354 3 3v2a1 1 0 0 0 2 0Zm-9-9c2.743 0 5-2.257 5-5s-2.257-5-5-5-5 2.257-5 5 2.257 5 5 5Zm0-2C7.354 8 6 6.646 6 5s1.354-3 3-3 3 1.354 3 3-1.354 3-3 3Z"/></svg>

				<input type="text" data-type="text" name="Full name" placeholder="<?php _e( 'Full name', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="100">
				<div class="ErrorMessage"></div>
			</div>

			<div data-id="mailFieldmain" class="Signup__form__item fontello-mail">
				<input type="email" name="Email" placeholder="<?php _e( 'Enter your e-mail', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="255">
				<div data-id="messageTrial" class="InfoMessage hidden">
					<svg class="InfoMessage__icon">
						<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#info-solid' ); ?>"></use>
					</svg>
					<span class="InfoMessage__text"><?php _e( 'Use your company email to get a 30 day trial for free.', 'ms' ); ?></span>
				</div>
				<div class="ErrorMessage"></div>
			</div>

			<div data-id="domainFieldmain" class="Signup__form__item has-svg">
				<svg width="22" height="20" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M19 4H3a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h16a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm0 2a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h16Z"/><path d="M16 19V3c0-.796-.316-1.559-.879-2.121A2.996 2.996 0 0 0 13 0H9c-.796 0-1.559.316-2.121.879A2.996 2.996 0 0 0 6 3v16a1 1 0 0 0 2 0V3a.997.997 0 0 1 1-1h4a.997.997 0 0 1 1 1v16a1 1 0 0 0 2 0Z"/></svg>
				<input type="url" name="Domain" placeholder="<?php _e( 'Company name', 'ms' ); ?>" required="required"  autocomplete="off" maxlength="30">
				<div class="Signup__form__item__domain"><?php _e( '.ladesk.com', 'ms' ); ?></div>
				<div class="ErrorMessage"></div>

				<div class="Signup__form__item__info Tooltip">
					<div class="Signup__form__item__info__icon ComparePlans__info-icon fontello-info">
						<div class="Tooltip__text Tooltip__text--left"><?php _e( 'Choose a name for your LiveAgent subdomain. Most people use their company or team name.', 'ms' ); ?></div>
					</div>
				</div>
			</div>
			
			<div data-id="regionFieldmain" class="Signup__form__item has-svg">
				<div class="FilterMenu isSingleSelect">
					<svg width="23" height="23" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M19.632 3.368A11.5 11.5 0 1 0 23 11.5a11.425 11.425 0 0 0-3.368-8.132zm1.691 7.31h-3.235a17.9 17.9 0 0 0-.781-4.568 12.689 12.689 0 0 0 1.7-1 9.815 9.815 0 0 1 2.316 5.569zm-9-8.87a5.457 5.457 0 0 1 2.471 2.539q.225.406.422.845a11.648 11.648 0 0 1-2.892.563zm3.254.717a9.881 9.881 0 0 1 2.238 1.411 11.028 11.028 0 0 1-1.087.628 11.4 11.4 0 0 0-1.152-2.038zM8.209 4.347a5.457 5.457 0 0 1 2.471-2.539v3.948a11.648 11.648 0 0 1-2.892-.563q.195-.438.42-.845zm-1.935.216a11.034 11.034 0 0 1-1.087-.628 9.881 9.881 0 0 1 2.238-1.411 11.4 11.4 0 0 0-1.152 2.04zM10.679 7.4v3.276H6.556a16.256 16.256 0 0 1 .657-3.944 13.286 13.286 0 0 0 3.466.668zm0 4.919V15.6a13.29 13.29 0 0 0-3.465.668 16.255 16.255 0 0 1-.657-3.944zm0 4.922v3.948a5.457 5.457 0 0 1-2.471-2.539q-.225-.406-.422-.845a11.645 11.645 0 0 1 2.893-.561zm-3.254 3.231a9.879 9.879 0 0 1-2.238-1.411 11.036 11.036 0 0 1 1.087-.628 11.4 11.4 0 0 0 1.15 2.041zm7.368-1.822a5.457 5.457 0 0 1-2.471 2.539v-3.945a11.646 11.646 0 0 1 2.892.563q-.197.438-.422.845zm1.935-.216a11.035 11.035 0 0 1 1.087.628 9.879 9.879 0 0 1-2.238 1.411 11.4 11.4 0 0 0 1.15-2.037zM12.321 15.6v-3.279h4.122a16.254 16.254 0 0 1-.657 3.944 13.287 13.287 0 0 0-3.465-.665zm0-4.919V7.4a13.287 13.287 0 0 0 3.465-.668 16.254 16.254 0 0 1 .657 3.944zM4 5.115a12.7 12.7 0 0 0 1.7 1 17.9 17.9 0 0 0-.781 4.568H1.677A9.815 9.815 0 0 1 4 5.115zm-2.32 7.207h3.235a17.9 17.9 0 0 0 .781 4.568 12.692 12.692 0 0 0-1.7 1 9.814 9.814 0 0 1-2.319-5.569zM19 17.885a12.7 12.7 0 0 0-1.7-1 17.9 17.9 0 0 0 .781-4.568h3.235A9.814 9.814 0 0 1 19 17.885z"/></svg>
					<div class="FilterMenu__title flex flex-align-center">
						<span><?php _e( 'Choose your region (datacenter location)', 'ms' ); ?></span>
					</div>
					<div class="FilterMenu__items">
						<div class="FilterMenu__items--inn">
							<?php foreach ( $regions as $region_code => $region_name ) { ?>
								<div class="checkbox FilterMenu__item">
									<input class="filter-item" type="radio" name="signup_region" id="<?php echo esc_attr( "signup_region_{$region_code}" ); ?>" value="<?php echo esc_attr( $region_code ); ?>" data-title="<?php echo esc_attr( $region_name ); ?>"  />
									<label for="<?php echo esc_attr( "signup_region_{$region_code}" ); ?>" >
										<span><?php echo esc_html( $region_name ); ?></span>
									</label>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="ErrorMessage"></div>
			</div>

			<div data-id="promoFieldmain" class="Signup__form__item">
				<input type="checkbox" name="Promo" id="sendOffersSignup" data-id="sendOffers">
				<label for="sendOffersSignup"><p><?php _e( 'Send me product updates and other promotional offers.', 'ms' ); ?></p></label>
			</div>

			<div data-id="signUpError"></div>

			<div class="Signup__form__submit">
				<div data-id="createButtonmain" class="Button Button--full createTrialButton">
					<div class="WorkingPanel" style="display: none;">
						<img class="gear-wheels" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gear-wheels.gif' ); ?>" alt="gear wheels">
					</div>
					<span><?php echo esc_html( $atts['button'] ); ?></span>
				</div>

				<div class="Signup__form__terms">
					<p><?php _e( 'By signing up, I accept', 'ms' ); ?> <a title="<?php _e( 'T&amp;C', 'ms' ); ?>" href="<?php _e( '/terms-and-conditions/', 'ms' ); ?>"><?php _e( 'T&amp;C', 'ms' ); ?></a> <?php _e( 'and', 'ms' ); ?> <a title="<?php _e( 'Privacy Policy', 'ms' ); ?>" href="<?php _e( '/privacy-policy/', 'ms' ); ?>"><?php _e( 'Privacy Policy', 'ms' ); ?></a><?php _e( '.', 'ms' ); ?></p>
				</div>
			</div>
		</div>
	</div>

	<?php // @codingStandardsIgnoreStart ?>

	<?php
		add_action( 'wp_footer', function() {
	?>
	<script data-src="https://www.google.com/recaptcha/api.js?render=6LddyswZAAAAAJrOnNWj_jKRHEs_O_I312KKoMDJ"></script>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/source.js' ?>"></script>
	<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_en.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'de' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_de.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'es' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_es.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fr' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_fr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pt-br' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_br.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sk' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_sk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hu' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_hu.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'nl' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_nl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pl' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_pl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'it' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_it.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ru' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ru.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'zh-hans' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_cn.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ar' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ae.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'bg' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_bg.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hr' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_cr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'cs' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_cz.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'da' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_dk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'et' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ee.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fi' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_fi.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'el' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_gr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ja' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_jp.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lt' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_lt.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lv' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_lv.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'no' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_no.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'tl' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ph.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ro' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ro.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sv' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_se.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sl' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_si.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'vi' ) { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_vn.js' ?>"></script>
	<?php } else { ?>
		<script src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_en.js' ?>"></script>
	<?php } ?>
	<?php
	global $crm_ver_app;
	if ( ! isset( $crm_ver_app ) ) {
		$crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crm.js' ) );
	?>
	<script id="jquery-js" data-src="<?= esc_url( includes_url() . 'js/jquery/jquery' . wpenv() . '.js?ver=' . THEME_VERSION); ?>"></script>
	<script id="jquery-cookie-js" data-src="<?= esc_url(  get_template_directory_uri() . '/assets/scripts/static/jquery.cookie' . wpenv() . '.js?ver=' . THEME_VERSION); ?>"></script>
	<script id="jquery-alphanum-js" data-src="<?= esc_url(  get_template_directory_uri() . '/assets/scripts/static/jquery.alphanum' . wpenv() . '.js?ver=' . THEME_VERSION); ?>"></script>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-redeemcode.js?ver=' . $crm_ver_app ?>"></script>
	<?php } }, 999 ); ?>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	set_custom_source( 'components/Signup' );
	set_custom_source( 'filterMenu', 'js' );
	return ob_get_clean();
}
add_shortcode( 'signupform-redeemcode', 'ms_signup_form_redeem_code' );
