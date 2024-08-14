<?php
	/**
	 * Template Name: Elementor
	 */
?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<?php the_content(); ?>

	<?php
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
		<?php } ?>
	<?php } ?>

<?php endwhile; ?>
