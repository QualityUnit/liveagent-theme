<div class="Page">
	<div class="wrapper">
		<?php while ( have_posts() ) :
			the_post(); ?>

			<div class="Page__header">
				<h1><?php the_title(); ?></h1>
			</div>

			<div class="Page__content Content">
				<?php the_content(); ?>

				<?php
				if ( ! is_page( array( 'sitemap' ) ) ) {
					?>
				<div class="SimilarSources SimilarSources--blog">
					<div class="wrapper">
						<div class="SimilarSources__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>

						<?php echo do_shortcode( '[urlslab-related-resources show-image="true" show-summary="true"]' ); ?>
					</div>
				</div>
				<?php } ?>
			</div>

		<?php endwhile; ?>
	</div>
</div>
