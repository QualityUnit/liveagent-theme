<?php

function ms_signup_form_simple( $atts ) {

	$atts = shortcode_atts(
		array(
			'title'   => wp_kses(
				__( '<strong>Try LiveAgent,</strong> best rated cloud-based Help Desk Software for free', 'ms' ),
				array( 'strong' => array() )
			),
			'button'  => __( 'Create account for FREE', 'ms' ),
			'trusted' => __( 'Trusted by the best', 'ms' ),
		),
		$atts,
		'signupform-simple'
	);

	$regions = array(
		'NA' => __( 'Americas (US)', 'ms' ),
		'EU' => __( 'Europe & Africa (EU)', 'ms' ),
		'AS' => __( 'Asia & Pacific (SG)', 'ms' ),
	);

	ob_start();
	?>

	<div class="Signup__form Signup__form__simple">
		<div class="Signup__form__simple__wrap" data-id="signup">
				<div class="Signup__form__simple__header">
					<div class="Signup__form__simple__title"><?= wp_kses_post( $atts['title'] ); ?></div>
				</div>

				<div class="Signup__form__simple__fields">
					<div data-id="nameFieldmain" class="Signup__form__item has-svg">
						<svg width="18" height="20" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M18 19v-2c0-2.743-2.257-5-5-5H5c-2.743 0-5 2.257-5 5v2a1 1 0 0 0 2 0v-2c0-1.646 1.354-3 3-3h8c1.646 0 3 1.354 3 3v2a1 1 0 0 0 2 0Zm-9-9c2.743 0 5-2.257 5-5s-2.257-5-5-5-5 2.257-5 5 2.257 5 5 5Zm0-2C7.354 8 6 6.646 6 5s1.354-3 3-3 3 1.354 3 3-1.354 3-3 3Z"/></svg>
						<input type="text" data-type="text" name="Full name" placeholder="<?php _e( 'Full name', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="100">
						<div class="ErrorMessage"></div>
					</div>

					<div data-id="mailFieldmain" class="Signup__form__item fontello-mail">
						<input type="email" name="Email" placeholder="<?php _e( 'Enter your e-mail', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="255">
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
					
					<div data-id="signUpError"></div>

					<div class="Signup__form__submit">
						<div data-id="createButtonmain" class="Button Button--full createTrialButton">
							<div class="WorkingPanel" style="display: none;">
								<img class="gear-wheels" src="<?= esc_url( get_template_directory_uri() . '/assets/images/gear-wheels.gif' ) ?>" alt="gear wheels">
							</div>
							<span><?= esc_html( $atts['button'] ); ?></span>
						</div>
					</div>

					<div class="Signup__form__simple__reviews">
						<div class="Signup__form__simple__reviews--title"><?= esc_html( $atts['trusted'] ); ?></div>
						<div class="Signup__form__simple__reviews--item">
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
						<div class="Signup__form__simple__reviews--item">
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
	<script data-src="<?= esc_url( get_template_directory_uri() ) . '/assets/scripts/static/crm.js?ver=' . $crm_ver_app ?>"></script>
	<?php } }, 999 ); ?>

	<?php // @codingStandardsIgnoreEnd ?>
	<?php
	set_custom_source( 'components/Signup' );
	set_custom_source( 'filterMenu', 'js' );
	return ob_get_clean();
}
add_shortcode( 'signupform-simple', 'ms_signup_form_simple' );
