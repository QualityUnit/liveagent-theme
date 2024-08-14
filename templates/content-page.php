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

					$related_resources = do_shortcode( '[urlslab-related-resources url="' . get_the_permalink() . '" related-count="4" show-image="true" show-summary="true"]' );

					if ( ! empty( $related_resources ) ) {
						?>
					<div class="SimilarSources SimilarSources--blog">
						<div class="wrapper">
							<div class="SimilarSources__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>
								<?= wp_kses_post( $related_resources ); ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			</div>

		<?php endwhile; ?>
	</div>
</div>
