<?php

function ms_signup_sidebar( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'    => __( 'Try it for free', 'ms' ),
			'subtitle' => __( 'No strings attached', 'ms' ),
			'name'     => __( 'Full name', 'ms' ),
			'email'    => __( 'E-mail', 'ms' ),
			'company'  => __( 'Company name', 'ms' ),
			'button'   => __( 'Start your free account', 'ms' ),
			'trusted'  => __( 'Trusted by the best', 'ms' ),
		),
		$atts,
		'signup-sidebar'
	);
	ob_start();
	?>

	<div class="Signup__sidebar">
		<div class="Signup__sidebar__title"><?= esc_html( $atts['title'] ); ?></div>
		<div class="Signup__sidebar__subtitle"><?= esc_html( $atts['subtitle'] ); ?></div>

		<div id="signup">
			<input id="plan" type="hidden" value="FreeTrial" autocomplete="off">
			<input id="variation" type="hidden" value="freedesk" autocomplete="off">

			<div id="nameFieldmain" class="Signup__sidebar__item">
				<input type="text" name="Full name" placeholder="<?= esc_attr( $atts['name'] ); ?>" value="" required="required" autocomplete="off">
				<div class="ErrorMessage"></div>
			</div>

			<div id="mailFieldmain" class="Signup__sidebar__item">
				<input type="email" name="Email" placeholder="<?= esc_attr( $atts['email'] ); ?>" value="" required="required" autocomplete="off">
				<div class="ErrorMessage"></div>
			</div>

			<div id="domainFieldmain" class="Signup__sidebar__item Signup__sidebar__item domain">
				<input type="url" name="Domain" placeholder="<?= esc_attr( $atts['company'] ); ?>" required="required" autocomplete="off" maxlength="25">
				<div class="Signup__sidebar__item__domain"><?php _e( '.ladesk.com', 'ms' ); ?>
				<div class="Signup__sidebar__item__info ComparePlans__tooltip">
					<div class="Signup__sidebar__item__info__icon ComparePlans__info-icon fontello-info"></div>
					<div class="ComparePlans__tooltip__text ComparePlans__tooltip__text--right"><?php _e( 'Choose a name for your LiveAgent subdomain. Most people use their company or team name.', 'ms' ); ?></div>
				</div>
			</div>
				<div class="ErrorMessage"></div>
			</div>

			<div id="signUpError" class="signUpError"></div>

			<div class="Signup__sidebar__submit">
				<div id="createButtonmain" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Start your free account', 'Sidebar Signup']); dataLayer.push({'Click Id': 'startYourfreeAccountBtn'}); ga('send', 'event', 'SignUp', 'Trial', 'Trial Signup');">
					<span><?= esc_html( $atts['button'] ); ?></span>
				</div>

				<div class="WorkingPanel" style="display: none;">
					<div class="animation">
						<div class="one spin-one"></div>
						<div class="two spin-two"></div>
						<div class="three spin-one"></div>
					</div>
					<p><?php _e( 'Passing data through the machine...', 'ms' ); ?></p>
				</div>
				<div class="Signup__sidebar__terms">
					<p><?php _e( 'By signing up, I accept', 'ms' ); ?> <a title="<?php _e( 'T&amp;C', 'ms' ); ?>" href="<?php _e( '/terms-and-conditions/', 'ms' ); ?>"><?php _e( 'T&amp;C', 'ms' ); ?></a> <?php _e( 'and', 'ms' ); ?> <a title="<?php _e( 'Privacy Policy', 'ms' ); ?>" href="<?php _e( '/privacy-policy/', 'ms' ); ?>"><?php _e( 'Privacy Policy', 'ms' ); ?></a><?php _e( '.', 'ms' ); ?></p>
				</div>
				<div class="Signup__sidebar__reviews__title"><?= esc_html( $atts['trusted'] ); ?></div>
				<div class="Signup__sidebar__reviews">
					<div class="Signup__sidebar__reviews--item">
						<a href="<?php _e( '/awards/', 'ms' ); ?>" title="<?php _e( 'G2 Crowd', 'ms' ); ?>">
							<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="m11.275 11.399 1.801 3.04c-2.647 1.972-6.766 2.21-9.816-.06C-.249 11.764-.825 7.302 1.053 4.09 3.214.396 7.258-.421 9.861.178c-.07.149-1.63 3.296-1.63 3.296s-.123.007-.193.009a4.5 4.5 0 0 0-1.957.515c-1.368.694-2.294 2.004-2.47 3.495-.091.745.015 1.5.307 2.194a4.49 4.49 0 0 0 1.067 1.548 4.607 4.607 0 0 0 2.569 1.233 4.575 4.575 0 0 0 2.692-.413c.318-.155.588-.326.904-.562.041-.025.077-.057.125-.094Z" style="fill:#050505;fill-rule:nonzero"/><path d="m11.281 2.442-.438-.419c-.085-.082-.166-.166-.253-.246-.031-.028-.067-.068-.067-.068l.042-.085c.165-.324.425-.56.734-.749.34-.209.737-.316 1.14-.306.516.01.996.135 1.4.471.299.248.452.564.479.94.045.634-.225 1.12-.761 1.459-.315.2-.654.354-.995.537a2.03 2.03 0 0 0-.532.372c-.161.183-.169.355-.169.355l2.44-.003v1.057h-3.766v-.102c-.015-.519.048-1.008.292-1.48.225-.433.575-.749.995-.993.323-.188.664-.348.988-.535.2-.116.341-.285.34-.53 0-.21-.158-.398-.383-.456a1.201 1.201 0 0 0-1.351.555l-.135.226ZM16 10.276l-2.056-3.454H9.875l-2.07 3.489h4.099l2.023 3.438L16 10.276Z" style="fill:#050505;fill-rule:nonzero"/></svg>
							<span>4.8/5</span>
						</a>
						<div class="Reviews__items__item__stars stars">
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item half stars__item"></span>
						</div>
					</div>
					<div class="Signup__sidebar__reviews--item">
						<a href="<?php _e( '/awards/', 'ms' ); ?>" title="<?php _e( 'Trustpilot', 'ms' ); ?>">
							<svg class="logo-trustpilot" width="60" height="15" viewBox="0 0 60 15" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M15.77 5.132h6.07v1.111h-2.39v6.264h-1.31V6.243h-2.38l.01-1.111Zm5.81 2.036h1.12V8.2h.02c.04-.147.11-.285.21-.423.1-.137.22-.265.37-.373.14-.118.3-.207.48-.276.17-.068.35-.108.53-.108.14 0 .24.01.29.01.05.01.11.02.16.02v1.13c-.08-.019-.17-.029-.26-.039-.09-.01-.17-.02-.26-.02-.2 0-.39.04-.57.118-.18.079-.33.197-.47.345-.13.157-.24.344-.32.57-.08.226-.12.491-.12.786v2.537h-1.2l.02-5.309Zm8.69 5.339h-1.19v-.748h-.02c-.15.276-.37.482-.66.649-.29.167-.59.246-.89.246-.71 0-1.23-.167-1.55-.521-.32-.344-.48-.875-.48-1.573V7.168h1.2v3.274c0 .472.09.806.28.993.18.197.44.295.77.295.25 0 .46-.039.63-.118.17-.079.31-.177.41-.305.11-.128.18-.285.23-.462.05-.177.07-.374.07-.58V7.168h1.2v5.339Zm2.03-1.711c.04.344.17.58.4.727.23.138.51.207.83.207.11 0 .24-.01.38-.03.14-.019.28-.049.4-.098a.704.704 0 0 0 .31-.216.5.5 0 0 0 .11-.364.526.526 0 0 0-.17-.374 1.434 1.434 0 0 0-.4-.236 3.483 3.483 0 0 0-.56-.147c-.21-.039-.42-.089-.64-.138a6.904 6.904 0 0 1-.65-.177 1.874 1.874 0 0 1-.56-.285 1.23 1.23 0 0 1-.39-.452c-.1-.187-.15-.403-.15-.679 0-.295.07-.531.22-.727.14-.197.33-.354.55-.472.22-.118.47-.207.74-.256.27-.049.53-.069.77-.069.28 0 .55.03.8.089s.49.147.69.285c.21.128.38.305.51.511.14.207.22.462.26.757H34.5c-.06-.285-.19-.472-.39-.57a1.638 1.638 0 0 0-.71-.147c-.08 0-.19.009-.3.019-.12.02-.22.04-.33.079a.775.775 0 0 0-.26.167.39.39 0 0 0-.11.285c0 .148.05.256.15.344.1.089.23.158.4.226.16.059.35.109.56.148.21.039.43.088.65.138.22.049.43.108.64.177.21.068.4.157.56.285.16.118.3.265.4.442.1.177.15.403.15.659 0 .315-.07.58-.22.806-.15.217-.34.403-.57.541-.23.138-.5.236-.78.305-.29.059-.57.098-.85.098-.34 0-.66-.039-.95-.118a2.457 2.457 0 0 1-.76-.344 1.655 1.655 0 0 1-.5-.58 1.87 1.87 0 0 1-.2-.826h1.21v.01h.01Zm3.95-3.628h.91V5.555h1.2v1.603h1.08v.875h-1.08v2.851c0 .128.01.226.02.325.01.088.04.167.07.226.04.059.1.108.17.138.08.029.18.049.32.049.08 0 .17 0 .25-.01.08-.01.17-.02.25-.039v.914c-.13.02-.26.029-.39.039-.13.02-.25.02-.39.02-.32 0-.57-.03-.76-.089a1.097 1.097 0 0 1-.45-.255.91.91 0 0 1-.22-.423 3.305 3.305 0 0 1-.07-.59V8.043h-.91v-.895.02Zm4.03 0h1.13v.727h.02c.17-.314.4-.531.7-.668.3-.138.62-.207.98-.207.43 0 .8.069 1.12.226.32.148.58.344.79.61.21.256.37.56.47.905.1.344.16.717.16 1.101 0 .364-.05.708-.14 1.042-.1.334-.24.639-.43.895a2.12 2.12 0 0 1-.73.619c-.3.157-.64.236-1.04.236-.17 0-.35-.02-.52-.049a2.26 2.26 0 0 1-.5-.148 1.777 1.777 0 0 1-.44-.265 1.5 1.5 0 0 1-.34-.374h-.02v2.665h-1.2V7.168h-.01Zm4.19 2.674c0-.236-.03-.472-.1-.698a1.77 1.77 0 0 0-.29-.6 1.602 1.602 0 0 0-.47-.423 1.298 1.298 0 0 0-.65-.157c-.5 0-.88.167-1.14.511-.25.345-.38.807-.38 1.377 0 .275.03.521.1.747.07.226.16.423.3.59.13.167.29.295.48.393.19.099.4.148.65.148.28 0 .5-.059.69-.167.19-.108.34-.256.47-.423.12-.177.21-.374.26-.6.05-.236.08-.462.08-.698Zm2.11-4.71h1.2v1.111h-1.2V5.132Zm0 2.036h1.2v5.339h-1.2V7.168Zm2.27-2.036h1.2v7.375h-1.2V5.132Zm4.86 7.522c-.43 0-.82-.069-1.16-.216a2.655 2.655 0 0 1-.86-.58 2.52 2.52 0 0 1-.53-.895 3.444 3.444 0 0 1-.19-1.131c0-.403.06-.777.19-1.121.12-.344.3-.639.53-.894.23-.246.52-.443.86-.58.34-.138.73-.217 1.16-.217.43 0 .82.069 1.16.217.34.137.62.334.86.58.23.245.41.55.53.894.12.344.19.718.19 1.121 0 .413-.06.787-.19 1.131s-.3.639-.53.895c-.23.245-.52.442-.86.58-.34.137-.72.216-1.16.216Zm0-.934c.26 0 .5-.059.69-.167.2-.108.35-.256.48-.433s.22-.383.28-.599a2.665 2.665 0 0 0 0-1.367 1.752 1.752 0 0 0-.28-.6 1.51 1.51 0 0 0-.48-.423c-.2-.108-.43-.167-.69-.167-.26 0-.5.059-.69.167-.2.108-.35.256-.48.423-.13.177-.22.374-.28.6a2.633 2.633 0 0 0 0 1.367c.06.226.15.422.28.599.13.177.29.325.48.433.2.118.43.167.69.167Zm3.1-4.552h.91V5.555h1.2v1.603H60v.875h-1.08v2.851c0 .128.01.226.02.325.01.088.04.167.07.226.04.059.1.108.17.138.08.029.18.049.32.049.08 0 .17 0 .25-.01.08-.01.17-.02.25-.039v.914c-.13.02-.26.029-.39.039-.13.02-.25.02-.39.02-.32 0-.57-.03-.76-.089a1.097 1.097 0 0 1-.45-.255.91.91 0 0 1-.22-.423 3.305 3.305 0 0 1-.07-.59V8.043h-.91v-.895.02ZM14.37 5.132H8.88L7.19 0l-1.7 5.132L0 5.123l4.44 3.175-1.7 5.133 4.44-3.176 4.44 3.176-1.69-5.133 4.44-3.166Z" style="fill:#050505;fill-rule:nonzero"/><path d="m10.31 9.459-.38-1.161-2.74 1.957 3.12-.796Z" style="fill:#050505;fill-rule:nonzero"/></svg>
							<span>5/5</span>
						</a>
						<div class="Reviews__items__item__stars stars">
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item stars__item"></span>
							<span class="Reviews__items__item__stars__item stars__item"></span>
						</div>
					</div>
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
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_en.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'de' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_de.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'es' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_es.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fr' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_fr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pt-br' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_br.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sk' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_sk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hu' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_hu.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'nl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_nl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'pl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_pl.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'it' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_it.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ru' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_ru.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'zh-hans' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_cn.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ar' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_ae.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'bg' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_bg.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'hr' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_cr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'cs' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_cz.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'da' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_dk.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'et' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_ee.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'fi' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_fi.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'el' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_gr.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ja' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_jp.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lt' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_lt.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'lv' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_lv.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'no' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_no.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'tl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_ph.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'ro' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_ro.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sv' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_se.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'sl' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_si.js' ?>"></script>
	<?php } elseif ( ICL_LANGUAGE_CODE === 'vi' ) { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_vn.js' ?>"></script>
	<?php } else { ?>
		<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm-free_en.js' ?>"></script>
	<?php } ?>
	<?php $crm_ver_app = gmdate( 'ymdGis', filemtime( get_template_directory() . '/assets/scripts/static/crm.js' ) ); ?>
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm.js?ver=' . $crm_ver_app ?>"></script>
	<?php }, 999 ); ?>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	return ob_get_clean();
}
add_shortcode( 'signup-sidebar', 'ms_signup_sidebar' );
