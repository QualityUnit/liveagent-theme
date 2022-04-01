<?php
	/**
	 * Template Name: Trial
	 */
?>

<div class="FullScreen">
	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="FullScreen__logo" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Trial Logo'])">
		<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent_black.svg" alt="<?php bloginfo( 'name' ); ?>">
	</a>

	<div class="FullScreen__sidebar">
		<div class="FullScreen__sidebar__item" style="background-image: url(https://cdn.liveagent.com/app/uploads/2020/01/bg_trial.jpg);">
			<div class="FullScreen__sidebar__item__text">
				<?php _e( '<p>"LiveAgent combines excellent live chat, ticketing and automation that allow us to provide exceptional support to our customers."</p><p>Peter Komornik, <strong>CEO</strong></p>', 'ms' ); ?>
				<img src="https://cdn.liveagent.com/app/uploads/2019/11/logo_slido_white.svg" alt="<?php _e( 'Review', 'ms' ); ?>">
			</div>
		</div>
	</div>

	<div class="FullScreen__main">
		<div class="FullScreen__main__container">
			<img class="FullScreen__main__container__image" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>">

			<h1 class="FullScreen__main__container__title"><?php _e( 'Get started absolutely free', 'ms' ); ?></h1>
			<p class="FullScreen__main__container__text"><?php _e( "Sign up for LiveAgent in less than 60 seconds. Enjoy testing every feature from our All-Inclusive plan starting today. Once your trial expires, your account's features will be adjusted according to the plan you've selected.", 'ms' ); ?></p>

			<?= do_shortcode( '[signupform]' ); ?>

			<div class="FullScreen__main__container__logos">
				<div class="FullScreen__main__container__logos__item">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_g2_black.svg" alt="<?php _e( 'G2 Crowd', 'ms' ); ?>">
					</a>
				</div>

				<div class="FullScreen__main__container__logos__item">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_trustpilot_black.svg" alt="<?php _e( 'Trustpilot', 'ms' ); ?>">
					</a>
				</div>

				<div class="FullScreen__main__container__logos__item">
					<a href="<?php _e( '/awards/', 'ms' ); ?>">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_getapp_black.svg" alt="<?php _e( 'GetApp', 'ms' ); ?>">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
