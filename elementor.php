<?php
/**
 * Template Name: Elementor
 */
?>
<?php
while ( have_posts() ) :
	the_post();

	the_content();

	$show_related_posts = get_post_meta( get_the_ID(), 'mb_related_enable', true );

	if ( 'on' === $show_related_posts || '' === $show_related_posts ) {

		if ( ! is_page( array( 'sitemap' ) ) && ! is_front_page() ) {
			$related_resources = do_shortcode( '[urlslab-related-resources url="' . get_the_permalink() . '" related-count="4" show-image="true" show-summary="true"]' );

			if ( ! empty( $related_resources ) ) {
				?>
				<div class="SimilarSources">
					<div class="wrapper">
						<div class="SimilarSources__title h3"><?php _e( 'Related Articles to ', 'ms' ); ?><?php the_title(); ?></div>
						<?= wp_kses_post( $related_resources ); ?>
					</div>
				</div>
				<?php
			}
		}
	}

endwhile;
