<?php

function ms_voip_partners() {
	ob_start();
	?>
	<div class="VoIP__partners Logos__slider slider splide">
		<div class="splide__track">
	<ul class="splide__list">
	<?php
	$query_voip_partners_posts = new WP_Query(
		array(
			'post_type' => 'ms_integrations',
		)
	);

	if ( $query_voip_partners_posts->have_posts() ) :
		$counter = 0;
		while ( $query_voip_partners_posts->have_posts() ) :
			$query_voip_partners_posts->the_post();

			$current_lang = apply_filters( 'wpml_current_language', null );
				do_action( 'wpml_switch_language', 'en' );
				$categories_en = get_the_terms( 0, 'ms_integrations_categories' );
			if ( ! empty( $categories_en ) ) {
				$category_en = array_shift( $categories_en )->slug;
			}
			do_action( 'wpml_switch_language', $current_lang );

			if ( $category_en == 'voip-partners' ) { // @codingStandardsIgnoreLine
				++$counter;
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$attachment        = wp_get_attachment_image_src( $attachment_id = $post_thumbnail_id ); // @codingStandardsIgnoreLine
				$width             = $attachment[1];
				$height            = $attachment[2];

				if ( $width > $height ) {
					?>
		<li class="VoIP__partner Logo__slide splide__slide">
			<a href="<?= esc_url( get_the_permalink() ); ?>">
					<?php the_post_thumbnail( 'archive_thumbnail' ); ?>
			</a>
		</li>

					<?php 
				}
			}
endwhile;
		?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	</ul>
	</div>
</div>

	<?php
	set_custom_source( 'common/splide' );
	set_custom_source( 'components/LogosSlider' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'slider', 'js' );
	return ob_get_clean();
}
add_shortcode( 'voip-partners', 'ms_voip_partners' );
