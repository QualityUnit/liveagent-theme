<?php
	/**
	 * Template Name: Trial Redesign
	 */
	set_source( 'trial', 'pages/TrialRedesign', 'css' );
?>

<div class="Trial FullScreen">
	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Trial__logo__top">
		<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>" class="urlslab-skip-lazy">
	</a>

	<div class="Trial__container">
		<div class="Trial__sidebar urlslab-min-width-1024">
			<div class="Trial__sidebar__inner">
				<div class="Trial__sidebar__content checklist">
					<h3 class="Trial__sidebar__title"><?php _e( 'Handle all support channels in one solution', 'ms' ); ?></h3>
					<ul>
						<li><?php _e( 'Spend 85% less time on issues', 'ms' ); ?></li>
						<li><?php _e( 'Save 95% more money on support', 'ms' ); ?></li>
						<li><?php _e( 'Gain 56% more returning customers', 'ms' ); ?></li>
						<li><?php _e( 'Get 73% higher satisfaction rates', 'ms' ); ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="Trial__main">
			<div class="heroBanner__awards">
				<?php echo do_shortcode( '[hero-banner-awards title="false" bg="hero-banner-awards_small.jpg"]' ); ?>
			</div>

			<div class="Trial__main__inner">
				<h1 class="Trial__main__title"><?php _e( 'Start your <span class="highlight-gradient">free trial</span> today', 'ms' ); ?></h1>
				<p class="Trial__main__text"><?php _e( 'Experience working with LiveAgent for free with our 30 days free trial. You can enjoy every feature available in the Large plan for free without any strings attached, and select your new LiveAgent plan at the end of your trial.', 'ms' ); ?></p>
				<div class="Signup__form__labels Trial__labels">
					<div class="Signup__form__labels__label">
						<?php _e( '30 days free trial', 'ms' ); ?>&nbsp;
						<div class="ComparePlans__tooltip">
							<div class="fontello-info"></div>
							<div class="ComparePlans__tooltip__text ComparePlans__tooltip__text--top"><?php _e( 'Free trial for 30 days with a company email', 'ms' ); ?></div>
						</div>
					</div>
					<div class="Signup__form__labels__label"><?php _e( 'No Credit Card required', 'ms' ); ?></div>
				</div>

				<?= do_shortcode( '[signupform]' ); ?>
			</div>
		</div>
	</div>
</div>
