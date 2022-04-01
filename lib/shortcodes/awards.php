<?php

function ms_awards() {
	ob_start();
	?>
	<?php 
		$years   = array_unique( get_categories( array( 'taxonomy' => 'ms_awards_years' ) ), SORT_REGULAR );
		$counter = 0;
	foreach ( $years as $year ) {
		++$counter;
		// @codingStandardsIgnoreStart
		?>
	<div data-year="<?= esc_html( $year->slug ); ?>" class="Awards__container Archive__container Archive__container--boxes Archive__container--testimonials Archive__container--awards <?= esc_html( $counter === 1 ? 'active':'' ); ?>">
		<h3 class="Awards__container--year"><?= esc_html( $year->slug ); ?></h3>
		<ul class="Awards__content Archive__container__content list">
		<?php
		// @codingStandardsIgnoreEnd
			$query_awards_posts = new WP_Query(
				array(
					'ms_awards_years' => $year->slug,
					'post_type'       => 'ms_awards',
					'posts_per_page'  => 99,
					'orderby'         => 'menu_order',
					'order'           => 'ASC',
				)
			);

		while ( $query_awards_posts->have_posts() ) :
			$query_awards_posts->the_post();
			?>

			<li <?php post_class( 'Awards__item Archive__container__content__item' ); ?>>
				<article>
					<div class="Awards__item--thumbnail">
						<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_awards_mb_awards_url', true ) ) ?>" target="_blank"><?php the_post_thumbnail( 'box_archive_thumbnail' ); ?></a>
					</div>

					<div class="Awards__item--text">
						<h3><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_awards_mb_awards_url', true ) ) ?>" target="_blank"><?php the_title(); ?></a></h3>
				<?= esc_html( preg_replace( '/(20\d{2})/', '$1, ', get_the_excerpt() ) ); ?>
					</div>
				</article>
			</li>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
		</ul>
	</div>
	<?php } ?>

	<?php
	return ob_get_clean();
}
add_shortcode( 'awards', 'ms_awards' );
