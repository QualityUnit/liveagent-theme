<?php

function ms_signup_form() {
	ob_start();
	?>

	<div class="Signup__form">
		<div class="Signup__form__title h3"><?php _e( 'Start Free Trial', 'ms' ); ?></div>

		<div class="Signup__form__labels">
			<span class="Signup__form__labels__label"><?php _e( '14 Day Trial', 'ms' ); ?></span>
			<span class="Signup__form__labels__label"><?php _e( 'No Credit Card required', 'ms' ); ?></span>
		</div>

		<div id="signup">
			<input id="plan" type="hidden" value="Trial" autocomplete="off">
			<input id="variation" type="hidden" value="3513230f" autocomplete="off">

			<div id="nameFieldmain" class="Signup__form__item has-svg">
				<svg width="18" height="20" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M18 19v-2c0-2.743-2.257-5-5-5H5c-2.743 0-5 2.257-5 5v2a1 1 0 0 0 2 0v-2c0-1.646 1.354-3 3-3h8c1.646 0 3 1.354 3 3v2a1 1 0 0 0 2 0Zm-9-9c2.743 0 5-2.257 5-5s-2.257-5-5-5-5 2.257-5 5 2.257 5 5 5Zm0-2C7.354 8 6 6.646 6 5s1.354-3 3-3 3 1.354 3 3-1.354 3-3 3Z"/></svg>

				<input type="text" name="Full name" placeholder="<?php _e( 'Full name', 'ms' ); ?>" value="" required="required" autocomplete="off">
				<div class="ErrorMessage"></div>
			</div>

			<div id="mailFieldmain" class="Signup__form__item fontello-mail">
				<input type="email" name="Email" placeholder="<?php _e( 'Enter your e-mail', 'ms' ); ?>" value="" required="required" autocomplete="off">
				<div class="ErrorMessage"></div>
			</div>

			<div id="domainFieldmain" class="Signup__form__item has-svg">
				<svg width="22" height="20" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M19 4H3a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h16a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm0 2a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h16Z"/><path d="M16 19V3c0-.796-.316-1.559-.879-2.121A2.996 2.996 0 0 0 13 0H9c-.796 0-1.559.316-2.121.879A2.996 2.996 0 0 0 6 3v16a1 1 0 0 0 2 0V3a.997.997 0 0 1 1-1h4a.997.997 0 0 1 1 1v16a1 1 0 0 0 2 0Z"/></svg>
				<input type="url" name="Domain" placeholder="<?php _e( 'Company name', 'ms' ); ?>" required="required"  autocomplete="off" maxlength="30">
				<div class="Signup__form__item__domain"><?php _e( '.ladesk.com', 'ms' ); ?></div>
				<div class="ErrorMessage"></div>

				<div class="Signup__form__item__info ComparePlans__tooltip">
					<div class="Signup__form__item__info__icon ComparePlans__info-icon fontello-info">
						<div class="ComparePlans__tooltip__text ComparePlans__tooltip__text--left"><?php _e( 'Choose a name for your LiveAgent subdomain. Most people use their company or team name.', 'ms' ); ?></div>
					</div>
				</div>
			</div>

			<div id="promoFieldmain" class="Signup__form__item">
				<input type="checkbox" name="Promo" id="sendOffers">
				<label for="sendOffers"><p><?php _e( 'Send me product updates and other promotional offers.', 'ms' ); ?></p></label>
			</div>

			<div id="signUpError"></div>

			<div class="Signup__form__submit">
				<div id="createButtonmain" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Signup Form', 'Signup']); ga('send', 'event', 'SignUp', 'Trial', 'Trial Signup');">
					<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
				</div>

				<div class="WorkingPanel" style="display: none;">
					<div class="animation">
						<div class="one spin-one"></div>
						<div class="two spin-two"></div>
						<div class="three spin-one"></div>
					</div>
					<p><?php _e( 'Passing data through the machine...', 'ms' ); ?></p>
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
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/jquery.cookie.js' ?>"></script>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/jquery.alphanum.js' ?>"></script>
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
		<?php $crm_cz_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crm_cz.js' ) ); ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm_cz.js?ver=' . $crm_cz_ver_app ?>"></script>
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
	<?php if ( ICL_LANGUAGE_CODE !== 'cs' ) { ?>
		<?php $crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crm.js' ) ); ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm.js?ver=' . $crm_ver_app ?>"></script>
	<?php } ?>
	<?php }, 999 ); ?>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	set_custom_source( 'components/Signup' );
	return ob_get_clean();
}
add_shortcode( 'signupform', 'ms_signup_form' );
