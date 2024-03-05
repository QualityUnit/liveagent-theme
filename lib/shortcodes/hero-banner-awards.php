<?php

function ms_hero_banner_awards( $atts ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
			'bg'    => '',
		),
		$atts,
		'hero-banner-awards'
	);
	set_source( false, 'shortcodes/HeroBannerAwards' );
	ob_start();
	?>
	<div class="heroBanner__awards__wrapper">
		<div class="heroBanner__awards__bg" style="background: url(<?= esc_url( get_template_directory_uri() . '/assets/images/' . ( ! empty( $atts['bg'] ) ? $atts['bg'] : 'hero-banner-awards.png' ) . '?ver=' . THEME_VERSION ); ?>) center top no-repeat; background-size: contain"></div>
	
		<?php
		if ( 'false' !== $atts['title'] ) {
			?>
		<img class="heroBanner__awards__title" src="<?= esc_url( get_template_directory_uri() . '/assets/images/hero-banner-awards__title.png?ver=' . THEME_VERSION ); ?>" alt="Awards" />
			<?php
		}
		foreach ( get_awards( 3 ) as $award_id ) {
			?>

	<div class="heroBanner__awards__img" style="background: url(<?= esc_attr( get_the_post_thumbnail_url( $award_id, 'box_archive_thumbnail' ) ); ?>) center center no-repeat"></div>

			<?php
		}
		?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'hero-banner-awards', 'ms_hero_banner_awards' );
