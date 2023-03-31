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
	if ( ! is_page( array( 'sitemap' ) ) ) {
		?>
		<div class="SimilarSources">
			<div class="wrapper">
				<div class="SimilarSources__title h3"><?php _e( 'Related Articles to ', 'ms' ); ?><?php the_title(); ?></div>
				<?php echo do_shortcode( '[urlslab-related-resources related-count="6" show-image="true" show-summary="true"]' ); ?>
			</div>
		</div>
	<?php } ?>

<?php endwhile; ?>
