<?php

function ms_hero_banner_awards() {
	ob_start();
	?>
	<div class="heroBanner__awards__wrapper">
		<div class="heroBanner__awards__bg" style="background: url(<?= esc_url( get_template_directory_uri() . '/assets/images/hero-banner-awards.png?ver=' . THEME_VERSION ); ?>) center top no-repeat; background-size: contain"></div>
	
		<img class="heroBanner__awards__title" src="<?= esc_url( get_template_directory_uri() . '/assets/images/hero-banner-awards__title.png?ver=' . THEME_VERSION ); ?>" alt="Awards" />
	<?php
	foreach ( get_awards( 3 ) as $award_id ) {
		?>

	<div class="heroBanner__awards__img" style="background: url(<?= esc_attr( get_the_post_thumbnail_url( $award_id, 'box_archive_thumbnail' ) ); ?>) center center no-repeat"></div>

		<?php
	}
	?>
	</div>
	<?php
	set_custom_source( 'shortcodes/HeroBannerAwards', 'css', false, false );
	return ob_get_clean();
}
add_shortcode( 'hero-banner-awards', 'ms_hero_banner_awards' );
