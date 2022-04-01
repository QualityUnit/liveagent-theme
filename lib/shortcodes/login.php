<?php

function ms_login() {
	ob_start();
	?>

	<div class="Login">
		<div id="signup">
			<div id="domainFieldmain" class="Signup__form__item has-svg">
				<svg width="22" height="20" viewBox="0 0 22 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M19 4H3a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h16a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm0 2a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h16Z"/><path d="M16 19V3c0-.796-.316-1.559-.879-2.121A2.996 2.996 0 0 0 13 0H9c-.796 0-1.559.316-2.121.879A2.996 2.996 0 0 0 6 3v16a1 1 0 0 0 2 0V3a.997.997 0 0 1 1-1h4a.997.997 0 0 1 1 1v16a1 1 0 0 0 2 0Z"/></svg>
				<input type="url" name="Domain" placeholder="<?php _e( 'Company name', 'ms' ); ?>" value="" required="required"  autocomplete="off" maxlength="30">
				<div class="Signup__form__item__domain"><?php _e( '.ladesk.com', 'ms' ); ?></div>
				<div class="ErrorMessage"></div>
			</div>

			<div class="Signup__form__submit">
				<div id="createButtonmain" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Login', 'Login'])">
					<span><?php _e( 'Login', 'ms' ); ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="Login__overlay"></div>

	<div class="Login__popup">
		<span class="Login__popup__close"></span>
		<div class="h3"><?php _e( 'Hoops!', 'ms' ); ?></div>
		<p><?php _e( "Looks like we couldn't find your LiveAgent account. No worries, we can help you.", 'ms' ); ?></p>

		<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Login', 'Create new account'])">
			<span><?php _e( 'Create new account', 'ms' ); ?></span>
		</a>
	</div>

	<?php // @codingStandardsIgnoreStart ?>
	<?php
		add_action( 'wp_footer', function() {
	?>
	<script data-src="https://www.google.com/recaptcha/api.js?render=6LddyswZAAAAAJrOnNWj_jKRHEs_O_I312KKoMDJ"></script>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/jquery.alphanum.js' ?>"></script>
	<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_en.js' ?>"></script>
		<?php } elseif ( ICL_LANGUAGE_CODE === 'de' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_de.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'es' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_es.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fr' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_fr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pt-br' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_br.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sk' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_sk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hu' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_hu.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'nl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_nl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_pl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'it' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_it.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ru' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_ru.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'zh-hans' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_cn.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ar' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_ae.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'bg' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_bg.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hr' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_cr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'cs' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_cz.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'da' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_dk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'et' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_ee.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fi' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_fi.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'el' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_gr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ja' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_jp.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lt' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_lt.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lv' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_lv.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'no' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_no.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'tl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_ph.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ro' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_ro.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sv' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_se.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_si.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'vi' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_vn.js' ?>"></script>
	<?php } else { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login_en.js' ?>"></script>
	<?php } ?>
	<?php $login_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/login.js' ) ); ?>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/login.js?ver=' . $login_ver_app ?>"></script>
	<?php }, 999 ); ?>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	set_custom_source( 'components/Signup' );
	return ob_get_clean();
}
add_shortcode( 'login', 'ms_login' );
