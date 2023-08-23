<?php

function ms_hero_banner_awards() {
	ob_start();
	?>
	<img class="heroBanner__awards__img" src="<?= esc_url( get_template_directory_uri() . '/assets/images/hero-banner-awards.png' ) ?>" alt="<?php _e( 'Awards', 'ms' ); ?>">

	<?php
	return ob_get_clean();
}
add_shortcode( 'hero-banner-awards', 'ms_hero_banner_awards' );
