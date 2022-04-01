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
		<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
		<div class="SimilarSources">
			<div class="wrapper">
				<div class="SimilarSources__title h3"><?php _e( 'Related Resources to ', 'ms' ); ?><?php the_title(); ?></div>

				<?php echo do_shortcode( '[similarsources]' ); ?>
			</div>
		</div>
		<?php } ?>
	<?php } ?>

<?php endwhile; ?>
