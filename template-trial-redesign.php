<?php
	/**
	 * Template Name: Trial Redesign
	 */
	set_source( 'trial', 'pages/TrialRedesign', 'css' );
?>

<div class="Trial FullScreen">
	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Trial__logo__top" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Trial Logo'])">
		<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>">
	</a>

	<div class="Trial__container">
		<div class="Trial__sidebar" style="background-image: url(<?= esc_url( home_url( '/', 'relative' ) ); ?>app/uploads/2020/01/bg_trial.jpg);">
			<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Trial__logo__top--inn" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Trial Logo'])">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent_black.svg" alt="<?php bloginfo( 'name' ); ?>">
			</a>
			<div class="Trial__sidebar__text">
				<?php _e( '<p><em>"LiveAgent combines excellent live chat, ticketing and automation that allow us to provide exceptional support to our customers."</em></p><p>Peter Komornik, <strong>CEO</strong></p>', 'ms' ); ?>
				<img class="Trial__sidebar__logo" src="<?= esc_url( home_url( '/', 'relative' ) ); ?>app/uploads/2019/11/logo_slido_white.svg" alt="<?php _e( 'Review', 'ms' ); ?>">
			</div>
		</div>
		<div class="Trial__main">
			<h1 class="Trial__main__title"><?php _e( 'Get started <span class="highlight-gradient">absolutely free</span>', 'ms' ); ?></h1>
			<div class="Signup__form__labels Trial__labels">
				<span class="Signup__form__labels__label"><?php _e( '14 Day Trial', 'ms' ); ?></span>
				<span class="Signup__form__labels__label"><?php _e( 'No Credit Card required', 'ms' ); ?></span>
			</div>
			<p class="Trial__main__text"><?php _e( "Sign up for LiveAgent in less than 60 seconds. Enjoy testing every feature from our All-Inclusive plan starting today. Once your trial expires, your account's features will be adjusted according to the plan you've selected.", 'ms' ); ?></p>

			<?= do_shortcode( '[signupform]' ); ?>

			<div class="Trial__main__logos">
				<div class="Trial__main__logo">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_g2_black.svg" alt="<?php _e( 'G2 Crowd', 'ms' ); ?>">
					</a>
				</div>

				<div class="Trial__main__logo">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_trustpilot_black.svg" alt="<?php _e( 'Trustpilot', 'ms' ); ?>">
					</a>
				</div>

				<div class="Trial__main__logo">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_getapp_black.svg" alt="<?php _e( 'GetApp', 'ms' ); ?>">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
