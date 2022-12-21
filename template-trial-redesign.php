<?php
	/**
	 * Template Name: Trial Redesign
	 */
	set_source( 'trial', 'pages/TrialRedesign', 'css' );
?>

<div class="Trial FullScreen">
	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Trial__logo__top" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Trial Logo'])">
		<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>" class="urlslab-skip-lazy">
	</a>

	<div class="Trial__container">
		<div class="Trial__sidebar urlslab-min-width-1024" style="background-image: url(<?= esc_url( get_template_directory_uri() ); ?>/assets/images/trial_sidebar_bg.png);">
			<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Trial__logo__top--inn" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Trial Logo'])">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>" class="urlslab-skip-lazy">
			</a>
		</div>
		<div class="Trial__main">
			<h1 class="Trial__main__title"><?php _e( 'Start your <span class="highlight-gradient">free trial</span> today', 'ms' ); ?></h1>
			<p class="Trial__main__text"><?php _e( "Enjoy testing every feature from our Proffesional plan starting today. Your account's features will be adjusted according to the plan you've selected, after your trial period expire.", 'ms' ); ?></p>
			<div class="Signup__form__labels Trial__labels">
				<div class="Signup__form__labels__label">
					<?php _e( '7 or 30 days free trial', 'ms' ); ?>&nbsp;
					<div class="ComparePlans__tooltip">
						<div class="fontello-info"></div>
						<div class="ComparePlans__tooltip__text ComparePlans__tooltip__text--top"><?php _e( 'Free trial for 7 days with a free email, or 30 days with a company email', 'ms' ); ?></div>
					</div>
				</div>
				<div class="Signup__form__labels__label"><?php _e( 'No Credit Card required', 'ms' ); ?></div>
			</div>

			<?= do_shortcode( '[signupform]' ); ?>

			<div class="Trial__main__logos">
				<div class="Trial__main__logo">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_g2_black.svg" alt="<?php _e( 'G2 Crowd', 'ms' ); ?>" class="urlslab-skip-lazy">
					</a>
				</div>

				<div class="Trial__main__logo">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_trustpilot_black.svg" alt="<?php _e( 'Trustpilot', 'ms' ); ?>" class="urlslab-skip-lazy">
					</a>
				</div>

				<div class="Trial__main__logo">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_getapp_black.svg" alt="<?php _e( 'GetApp', 'ms' ); ?>" class="urlslab-skip-lazy">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
