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
					<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
					<div class="SimilarSources SimilarSources--blog">
						<div class="wrapper">
							<div class="SimilarSources__title h4"><?php _e( 'Related Resources', 'ms' ); ?></div>

							<?php echo do_shortcode( '[similarsources]' ); ?>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>

		<?php endwhile; ?>
	</div>
</div>
