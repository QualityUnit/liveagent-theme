<?php
use QualityUnit\Trial_Signup;

function signup_form( $atts ) {

	// include resources
	set_source( false, 'components/SignupFormLanding' );
	set_custom_source( 'filterMenu', 'js' );
	Trial_Signup::include_crm();

	$atts = shortcode_atts(
		array(
			'title'    => __( 'Try it for free', 'ms' ),
			'label1'   => __( 'Start a <strong>30-day trial</strong> with company email or a <strong>7-day trial</strong> with free email, <span class="c-saturated-green">no credit card required</span>', 'ms' ),
			'tooltip1' => __( 'Free trial for 14 days with a free email, or 30 days with a company email', 'ms' ),
			'label2'   => __( 'No Credit Card required', 'ms' ),
			'button'   => __( 'Create account for FREE', 'ms' ),
		),
		$atts,
		'people'
	);

	$regions = Trial_Signup::$regions;

	ob_start();
	?>

	<div class="Signup__form">
		<div class="Signup__form__title"><?php echo esc_html( $atts['title'] ); ?></div>

		<p class="Signup__form__subtitle">
			<?= $atts['label1']; // @codingStandardsIgnoreLine ?>
		</p>

		<form data-form-type="signup-trial-form" data-id="signup" data-plan-type="Trial">
			<input data-id="grecaptcha" name="grecaptcha" type="hidden" value="" autocomplete="off">
			<input data-id="ga_client_id" name="ga_client_id" type="hidden" value="" autocomplete="off">

			<div data-id="nameFieldmain" class="Signup__form__item">
				<div class="InputWrapper">
					<label for="fullname"><strong><?php _e( 'Full name', 'ms' ); ?></strong></label>
					<input type="text" data-type="text" name="fullname" placeholder="<?php _e( 'John Doe', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="100">
				</div>
				<div class="ErrorMessage"></div>
			</div>

			<div data-id="mailFieldmain" class="Signup__form__item">
				<div class="InputWrapper">
					<label for="emailField"><strong><?php _e( 'Email address', 'ms' ); ?></strong></label>
					<input type="email" name="email" id="emailField" placeholder="<?php _e( 'johndoe@email.com', 'ms' ); ?>" value="" required="required" autocomplete="off" maxlength="255">
				</div>
				<div class="ErrorMessage"></div>
				<div data-id="messageTrial" class="InfoMessage hidden">
					<span class="InfoMessage__text"><?php _e( 'We encourage creating trial accounts under the company email addresses.', 'ms' ); ?></span>
				</div>
			</div>

			<div data-id="domainFieldmain" class="Signup__form__item">
				<div class="InputWrapper">
					<label for="subdomain"><strong><?php _e( 'Company name', 'ms' ); ?></strong></label>
					<div class="relative Signup__form__item__domain__wrap">
						<input type="text" data-type="text" id="subdomain" name="subdomain" placeholder="<?php _e( 'Your company name', 'ms' ); ?>" value="" required="required"  autocomplete="off" maxlength="30">
						<div class="Signup__form__item__domain"><?php _e( '.ladesk.com', 'ms' ); ?></div>
						<div class="Signup__form__item__info Tooltip">
						<div class="Signup__form__item__info__icon fontello-info">
							<div class="Tooltip__text Tooltip__text--left"><?php _e( 'Choose a name for your LiveAgent subdomain. Most people use their company or team name.', 'ms' ); ?></div>
						</div>
					</div>
					</div>
				</div>
				<div class="ErrorMessage"></div>
			</div>

			<div data-id="regionFieldmain" class="Signup__form__item">
				<div class="InputWrapper">
					<label><strong><?php _e( 'Region', 'ms' ); ?></strong></label>
					<div class="DropDownMenu isSingleSelect">
						<div class="DropDownMenu__title flex flex-align-center">
							<span><?php _e( 'Your region', 'ms' ); ?></span>
						</div>
						<div class="DropDownMenu__items">
							<div class="DropDownMenu__items--inn">
								<?php foreach ( $regions as $region_code => $region_name ) { ?>
									<div class="checkbox DropDownMenu__item">
										<input
											class="filter-item"
											type="radio"
											name="region"
											id="<?php echo esc_attr( "signup_region_{$region_code}" ); ?>"
											value="<?php echo esc_attr( $region_code ); ?>"
											data-title="<?php echo esc_attr( $region_name ); ?>"
										/>
										<label for="<?php echo esc_attr( "signup_region_{$region_code}" ); ?>" >
											<span><?php echo esc_html( $region_name ); ?></span>
										</label>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="ErrorMessage"></div>
				<div class="DescriptionText"><?php echo esc_html( __( 'Changes are not possible after account creation.', 'ms' ) ); ?></div>
			</div>

			<div data-id="promoFieldmain" class="Signup__form__item">
				<input type="checkbox" name="promo" id="sendOffersSignup" data-id="sendOffers">
				<label for="sendOffersSignup"><?php _e( 'Send me product updates and other promotional offers.', 'ms' ); ?></label>
			</div>

			<?php Trial_Signup::grecaptcha_parts(); ?>

			<div data-id="signUpError" class="hidden"></div>

			<div data-id="submitFieldmain" class="Signup__form__submit">
				<button type="submit" data-id="createButtonmain" class="Button Button--full createTrialButton">
					<div class="WorkingPanel" style="display: none;">
						<img class="gear-wheels" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gear-wheels.gif' ); ?>" alt="gear wheels">
					</div>
					<span><?php echo esc_html( $atts['button'] ); ?></span>
				</button>

				<div class="Signup__form__terms">
					<?php _e( 'By signing up, I accept', 'ms' ); ?> <a title="<?php _e( 'T&amp;C', 'ms' ); ?>" href="<?php _e( '/terms-and-conditions/', 'ms' ); ?>"><?php _e( 'T&amp;C', 'ms' ); ?></a> <?php _e( 'and', 'ms' ); ?> <a title="<?php _e( 'Privacy Policy', 'ms' ); ?>" href="<?php _e( '/privacy-policy/', 'ms' ); ?>"><?php _e( 'Privacy Policy', 'ms' ); ?></a><?php _e( '.', 'ms' ); ?>
				</div>
			</div>
		</form>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'signupform-landingppc', 'signup_form' );
