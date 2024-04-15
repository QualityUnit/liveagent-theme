<?php
use QualityUnit\Trial_Signup;

function ms_signup_sidebar( $atts ) {

	// include resources
	if ( ! is_mobile() ) {
		set_custom_source( 'filterMenu', 'js' );
	}
	Trial_Signup::include_crm();

	$atts = shortcode_atts(
		array(
			'title'     => __( 'Try it for free', 'ms' ),
			'subtitle'  => __( 'No strings attached', 'ms' ),
			'name'      => __( 'Full name', 'ms' ),
			'email'     => __( 'E-mail', 'ms' ),
			'company'   => __( 'Company name', 'ms' ),
			'button'    => __( 'Start your free account', 'ms' ),
			'trusted'   => __( 'Trusted by the best', 'ms' ),
			'js-sticky' => false,
		),
		$atts,
		'signup-sidebar'
	);

	$signup_switcher = get_post_meta( get_the_ID(), 'signup_switch', true );

	$title    = get_post_meta( get_the_ID(), 'signup_title', true );
	$subtitle = get_post_meta( get_the_ID(), 'signup_subtitle', true );
	$button   = get_post_meta( get_the_ID(), 'signup_button', true );

	if ( isset( $title ) && strlen( $title ) > 0 ) {
		$atts['title'] = $title;
	}
	if ( isset( $subtitle ) && strlen( $subtitle ) > 0 ) {
		$atts['subtitle'] = $subtitle;
	}
	if ( isset( $button ) && strlen( $button ) > 0 ) {
		$atts['button'] = $button;
	}

	$sticky_class = $atts['js-sticky'] ? 'js-sidebar-sticky' : '';

	$regions     = Trial_Signup::$regions;
	$submit_slug = Trial_Signup::$slugs['trial'];

	ob_start();
	?>

	<?php if ( 'no' !== $signup_switcher ) { ?>
		<div class="Signup__sidebar urlslab-skip-keywords <?php echo esc_attr( $sticky_class ); ?>" >
			<div class="Signup__sidebar__title"><?php echo esc_html( $atts['title'] ); ?></div>
			<div class="Signup__sidebar__subtitle"><?php echo esc_html( $atts['subtitle'] ); ?></div>

			<form action="<?php echo esc_url( $submit_slug ); ?>" method="post" data-form-type="signup-trial-form" data-id="signup">
				<input data-id="form_type_free" name="form_type_free" type="hidden" value="" autocomplete="off">
				<input data-id="plan" name="plan_type" type="hidden" value="FreeTrial" autocomplete="off">
				<input data-id="grecaptcha" name="grecaptcha" type="hidden" value="" autocomplete="off">
				<input data-id="ga_client_id" name="ga_client_id" type="hidden" value="" autocomplete="off">

				<div data-id="nameFieldmain" class="Signup__sidebar__item">
					<div class="InputWrapper">
						<input type="text" data-type="text" name="fullname" placeholder="<?php echo esc_attr( $atts['name'] ); ?>" value="" required="required" autocomplete="off" maxlength="100">
					</div>
					<div class="ErrorMessage"></div>
				</div>

				<div data-id="mailFieldmain" class="Signup__sidebar__item">
					<div class="InputWrapper">
						<input type="email" name="email" placeholder="<?php echo esc_attr( $atts['email'] ); ?>" value="" required="required" autocomplete="off" maxlength="255">
					</div>
					<div class="ErrorMessage"></div>
				</div>

				<div data-id="domainFieldmain" class="Signup__sidebar__item Signup__sidebar__item domain">
					<div class="InputWrapper">
						<input type="text" data-type="text" name="subdomain" placeholder="<?php echo esc_attr( $atts['company'] ); ?>" required="required" autocomplete="off" maxlength="25">
						<div class="Signup__sidebar__item__domain"><?php _e( '.ladesk.com', 'ms' ); ?></div>
					</div>
					<div class="Signup__sidebar__item__info Tooltip">
						<div class="Signup__sidebar__item__info__icon ComparePlans__info-icon fontello-info"></div>
						<div class="Tooltip__text Tooltip__text--right"><?php _e( 'Choose a name for your LiveAgent subdomain. Most people use their company or team name.', 'ms' ); ?></div>
					</div>
					<div class="ErrorMessage"></div>
				</div>

				<div data-id="regionFieldmain" class="Signup__sidebar__item">
					<div class="InputWrapper">
						<div class="FilterMenu isSingleSelect">
							<div class="FilterMenu__title flex flex-align-center">
								<span><?php _e( 'Choose your region (datacenter location)', 'ms' ); ?></span>
							</div>
							<div class="FilterMenu__items">
								<div class="FilterMenu__items--inn">
									<?php foreach ( $regions as $region_code => $region_name ) { ?>
										<div class="checkbox FilterMenu__item">
											<input
												class="filter-item"
												type="radio"
												name="region"
												id="<?php echo esc_attr( "signup_sidebar_region_{$region_code}" ); ?>"
												value="<?php echo esc_attr( $region_code ); ?>"
												data-title="<?php echo esc_attr( $region_name ); ?>"
											/>
											<label for="<?php echo esc_attr( "signup_sidebar_region_{$region_code}" ); ?>" >
												<span><?php echo esc_html( $region_name ); ?></span>
											</label>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="ErrorMessage"></div>
					<div class="DescriptionText"><?php echo esc_html( __( 'Data centre changes are not possible after account creation.', 'ms' ) ); ?></div>
				</div>

				<?php Trial_Signup::grecaptcha_parts( 'sidebar' ); ?>

				<div data-id="signUpError" class="hidden"></div>

				<div data-id="submitFieldmain" class="Signup__sidebar__submit urlslab-skip-keywords">
					<button type="submit" data-id="createButtonmain" class="Button Button--full createTrialButton" onclick="dataLayer.push({'Click data-id': 'startYourfreeAccountBtn'});">
						<div class="WorkingPanel" style="display: none;">
							<img class="gear-wheels" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gear-wheels.gif' ); ?>" alt="gear wheels">
						</div>
						<span><?php echo esc_html( $atts['button'] ); ?></span>
					</button>

					<div class="Signup__sidebar__terms">
						<p><?php _e( 'By signing up, I accept', 'ms' ); ?> <a title="<?php _e( 'T&amp;C', 'ms' ); ?>" href="<?php _e( '/terms-and-conditions/', 'ms' ); ?>"><?php _e( 'T&amp;C', 'ms' ); ?></a> <?php _e( 'and', 'ms' ); ?> <a title="<?php _e( 'Privacy Policy', 'ms' ); ?>" href="<?php _e( '/privacy-policy/', 'ms' ); ?>"><?php _e( 'Privacy Policy', 'ms' ); ?></a><?php _e( '.', 'ms' ); ?></p>
					</div>
					<div class="Signup__sidebar__reviews__title"><?php echo esc_html( $atts['trusted'] ); ?></div>
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
					</div>
				</div>
			</form>
		</div>
	<?php } ?>

	<?php
	return ob_get_clean();
}
add_shortcode( 'signup-sidebar', 'ms_signup_sidebar' );
