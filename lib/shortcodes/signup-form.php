<?php

function ms_signup_form( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'  => __( 'Start Free Trial', 'ms' ),
			'label1' => __( '7 or 30 days free trial', 'ms' ),
			'tooltip1' => __( 'Free trial for 7 days with a free email, or 30 days with a company email', 'ms' ),
			'label2' => __( 'No Credit Card required', 'ms' ),
			'button' => __( 'Create account for FREE', 'ms' ),
		),
		$atts,
		'people'
	);

	ob_start();
	?>

	<div class="Signup__form">
		<div class="Signup__form__title h3"><?= esc_html( $atts['title'] ); ?></div>

		<div class="Signup__form__labels">
			<span class="Signup__form__labels__label">
				<?= esc_html( $atts['label1'] ); ?>&nbsp;
				<span class="ComparePlans__tooltip">
					<span class="fontello-info"></span>
					<span class="ComparePlans__tooltip__text ComparePlans__tooltip__text--top"><?= esc_html( $atts['tooltip1'] ); ?></span>
				</span>
			</span>
			<span class="Signup__form__labels__label"><?= esc_html( $atts['label2'] ); ?></span>
		</div>

		<div data-id="signup">
			<input data-id="plan" type="hidden" value="Trial" autocomplete="off">
			<input data-id="variation" type="hidden" value="3513230f" autocomplete="off">

			<div data-id="nameFieldmain" class="Signup__form__item has-svg">
				<svg width="18" height="20" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M18 19v-2c0-2.743-2.257-5-5-5H5c-2.743 0-5 2.257-5 5v2a1 1 0 0 0 2 0v-2c0-1.646 1.354-3 3-3h8c1.646 0 3 1.354 3 3v2a1 1 0 0 0 2 0Zm-9-9c2.743 0 5-2.257 5-5s-2.257-5-5-5-5 2.257-5 5 2.257 5 5 5Zm0-2C7.354 8 6 6.646 6 5s1.354-3 3-3 3 1.354 3 3-1.354 3-3 3Z"/></svg>

				<input type="text" name="Full name" placeholder="<?php _e( 'Full name', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="100">
				<div class="ErrorMessage"></div>
			</div>

			<div data-id="mailFieldmain" class="Signup__form__item fontello-mail">
				<input type="email" name="Email" placeholder="<?php _e( 'Enter your e-mail', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="255" onKeyUp="checkCompanyMail()">
				<div data-id="messageTrial" class="InfoMessage hidden">
					<svg class="InfoMessage__icon">
						<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#info-solid' ) ?>"></use>
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

			<div data-id="promoFieldmain" class="Signup__form__item">
				<input type="checkbox" name="Promo" id="sendOffersSignup" data-id="sendOffers">
				<label for="sendOffersSignup"><p><?php _e( 'Send me product updates and other promotional offers.', 'ms' ); ?></p></label>
			</div>

			<div data-id="signUpError"></div>

			<div class="Signup__form__submit">
				<div data-id="createButtonmain" class="Button Button--full createTrialButton" onclick="handleSend();">
					<div class="WorkingPanel" style="display: none;">
						<div class="animation">
							<div class="one spin-one"></div>
							<div class="two spin-one"></div>
						</div>
					</div>
					<span><?= esc_html( $atts['button'] ); ?></span>
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
	<script>
            const mailRegex = '@(gmail.com|outlook.com|yahoo.com|zoho.com|aol.com|icloud.com|yandex' + '.com|gmx.us|@gmx.com)$';
            const mailInput = document.querySelector('input[type="email"]');
            const mailMessage = document.querySelector('[data-id="messageTrial"]');
            const classMessageToggle = "hidden";
            function checkCompanyMail() {
                const mailValue = mailInput.value;
                if (mailValue) {
                    const mailSecondary = new RegExp(mailRegex).test(mailValue);
                    if(mailSecondary) {
                        mailMessage.classList.remove(classMessageToggle);
                    }else{
                        mailMessage.classList.add(classMessageToggle);
                    }
                }
            }
			function handleSend() {
				const mailValue = mailInput.value;
				const buttonText = document.querySelector('.createTrialButton span');

				buttonText.textContent = `${ textButtonSubmit }`;

				if (mailValue) {
					const mailSecondary = new RegExp(mailRegex).test(mailValue);

					gtag('event', 'conversion', {'send_to': 'AW-966671101/wm4uCIGl0eQDEP31-MwD'});

					if(mailSecondary) {
						gtag( 'event', 'Trial Signup', {
							'event_category': 'SignUp',
							'event_action': 'Trial',
							'event_label': 'all',
							'value': 1
						} );

						_paq.push(['trackEvent', 'Activity', 'Signup Form', 'Signup']);
					}
					if(!mailSecondary) {
						gtag( 'event', 'Trial Signup', {
							'event_category': 'SignUp',
							'event_action': 'Trial',
							'event_label': 'workmail',
							'value': 10
						} );

						window.dataLayer = window.dataLayer || [];
						window.dataLayer.push({
							'event': 'sign_up',
							'emailType': 'Company Email'
						});

						_paq.push(['trackEvent', 'Activity', 'Signup Form', 'Signup']);
					}
				}
			}
	</script>
	<script data-src="https://www.google.com/recaptcha/api.js?render=6LddyswZAAAAAJrOnNWj_jKRHEs_O_I312KKoMDJ"></script>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/source.js' ?>"></script>
	<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_en.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'de' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_de.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'es' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_es.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fr' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_fr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pt-br' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_br.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sk' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_sk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hu' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_hu.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'nl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_nl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_pl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'it' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_it.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ru' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ru.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'zh-hans' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_cn.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ar' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ae.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'bg' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_bg.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hr' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_cr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'cs' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_cz.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'da' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_dk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'et' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ee.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fi' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_fi.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'el' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_gr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ja' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_jp.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lt' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_lt.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lv' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_lv.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'no' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_no.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'tl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ph.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ro' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_ro.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sv' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_se.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_si.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'vi' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_vn.js' ?>"></script>
	<?php } else { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_en.js' ?>"></script>
	<?php } ?>
	<?php $crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crm.js' ) ); ?>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm.js?ver=' . $crm_ver_app ?>"></script>
	<?php }, 999 ); ?>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	wp_enqueue_script( 'jquerycookie', get_template_directory_uri() . '/assets/scripts/static/jquery.cookie.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_script( 'jqueryalphanum', get_template_directory_uri() . '/assets/scripts/static/jquery.alphanum.js', array( 'jquery' ), THEME_VERSION, true );
	set_custom_source( 'components/Signup' );
	return ob_get_clean();
}
add_shortcode( 'signupform', 'ms_signup_form' );
