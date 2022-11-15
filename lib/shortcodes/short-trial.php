<?php

function ms_short_trial() {
	ob_start();
	?>

	<div class="ShortTrial__form">
		<div class="Newsletter__form">
			<form action="<?php _e( '/trial/', 'ms' ); ?>" method="post">
				<input type="email" value="" placeholder="<?php _e( 'Your work email', 'ms' ); ?>" name="mail" class="Input" required="">
				<button type="submit" name="subscribe" class="Button Button--full">
					<span><?php _e( 'Sign Up', 'ms' ); ?></span>
				</button>
			</form>
		</div>

		<div class="Portals__text__details">
			<div class="Portals__text__details__stars">
				<span class="Portals__text__details__stars__item"></span>
				<span class="Portals__text__details__stars__item"></span>
				<span class="Portals__text__details__stars__item"></span>
				<span class="Portals__text__details__stars__item"></span>
				<span class="Portals__text__details__stars__item"></span>
			</div>

			<p><?php _e( '3,000+ reviews', 'ms' ); ?> <a href="<?php _e( '/awards/', 'ms' ); ?>"><img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_trustpilot_black.svg" alt="<?php _e( 'Trustpilot', 'ms' ); ?>"></a>
				<a href="<?php _e( '/awards/', 'ms' ); ?>"><img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_getapp_black.svg" alt="<?php _e( 'GetApp', 'ms' ); ?>"></a>
				<a href="<?php _e( '/awards/', 'ms' ); ?>"><img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_g2_black.svg" alt="<?php _e( 'G2 Crowd', 'ms' ); ?>"></a>
			</p>
		</div>
	</div>

	<?php
	set_custom_source( 'shortcodes/ShortTrial' );
	return ob_get_clean();
}
add_shortcode( 'short-trial', 'ms_short_trial' );
