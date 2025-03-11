<?php
/**
 * Template Name: Redeem Code
 */
set_source( 'redeem-code', 'pages/TrialRedesign', 'css' );
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
			<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Trial__awards">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/trial_badges.svg" alt="<?php _e( 'Awards', 'ms' ); ?>" class="urlslab-skip-lazy">
			</a>
			<div class="Trial__main__inner">
				<h1 class="Trial__main__title"><?php _e( 'LiveAgent registration <br />with <span class="highlight-gradient">a redeem code</span>', 'ms' ); ?></h1>
				<p class="Trial__main__text"><?php _e( 'Finish your LiveAgent registration with your redeem code in the form below and get access to our extensive set of tools and features. Start providing superb customer service with LiveAgent today!', 'ms' ); ?></p>
				<div class="Signup__form__labels Trial__labels">
					<div class="Signup__form__labels__label"><?php _e( 'No Credit Card required', 'ms' ); ?></div>
				</div>

				<?= do_shortcode( '[signupform-redeemcode]' ); ?>
			</div>
		</div>
	</div>
</div>
