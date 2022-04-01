<?php

function ms_testimonials( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts' => 9,
			'start' => 0,
		),
		$atts,
		'testimonials'
	);
	ob_start();
	?>

	<div class="Archive__container Archive__container--boxes Archive__container--testimonials">
		<ul class="Archive__container__content list">
		<?php
		$query_testimonials_posts = new WP_Query(
			array(
				'post_type'      => 'ms_testimonials',
				'posts_per_page' => $atts['posts'],
				'offset'         => $atts['start'],
			)
		);

		while ( $query_testimonials_posts->have_posts() ) :
			$query_testimonials_posts->the_post();
			if ( ! get_post_meta( get_the_ID(), 'mb_testimonials_mb_realtestimonials' ) ) {
				?>

			<li <?php post_class( 'Archive__container__content__item' ); ?>>
				<article>
					<div class="Archive__container__content__item__thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="Archive__container__content__item__main">
						<h3 class="Archive__container__content__item__title">
							<?= esc_html( ucfirst( get_the_title() ) ); ?>
						</h3>
						<div class="Archive__container__content__item__text Archive__container__content__item__text--visible">
							<?php the_content(); ?>
						</div>
					</div>
				</article>
			</li>

				<?php 
			}
		endwhile; 
		?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'testimonials', 'ms_testimonials' );
