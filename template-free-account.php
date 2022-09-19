<?php
	/**
	 * Template Name: Free Account
	 */
?>

<div class="FullScreen">
	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="FullScreen__logo" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Free Account Logo'])">
		<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent_black.svg" alt="<?php bloginfo( 'name' ); ?>">
	</a>

	<div class="FullScreen__sidebar">
		<div class="FullScreen__sidebar__item" style="background-image: url(https://www.liveagent.com/app/uploads/2020/01/bg_trial.jpg);">
			<div class="FullScreen__sidebar__item__text">
				<?php _e( '<p>"LiveAgent combines excellent live chat, ticketing and automation that allow us to provide exceptional support to our customers."</p><p>Peter Komornik, <strong>CEO</strong></p>', 'ms' ); ?>
				<img src="https://www.liveagent.com/app/uploads/2019/11/logo_slido_white.svg" alt="<?php _e( 'Review', 'ms' ); ?>">
			</div>
		</div>
	</div>

	<div class="FullScreen__main">
		<div class="FullScreen__main__container">
			<img class="FullScreen__main__container__image" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>">

			<h1 class="FullScreen__main__container__title"><?php _e( 'Create Free Account', 'ms' ); ?></h1>
			<p class="FullScreen__main__container__text"><?php _e( 'Sign up for LiveAgent in less than 60 seconds. Enjoy forever free account!', 'ms' ); ?></p>

			<?= do_shortcode( '[signupform-free]' ); ?>

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
