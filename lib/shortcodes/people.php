<?php

function ms_people( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'    => '',
			'subtitle' => '',
			'category' => '',
		),
		$atts,
		'people'
	);

	ob_start();
	?>

	<div class="Archive__container Archive__container--boxes Archive__container--people">
		<div class="Archive__header--people">
			<?php if ( $atts['title'] ) { ?>
				<h2><?= esc_html( $atts['title'] ); ?></h2>
			<?php } ?>
			<?php if ( $atts['subtitle'] ) { ?>
				<p><?= esc_html( $atts['subtitle'] ); ?></p>
			<?php } ?>
		</div>

		<ul class="Archive__container__content list">
		<?php
		$query_people_posts = new WP_Query(
			array(
				'post_type'            => 'ms_people',
				'ms_people_categories' => $atts['category'],
				'posts_per_page'       => 90,
			)
		);

		while ( $query_people_posts->have_posts() ) :
			$query_people_posts->the_post();
			?>

			<li <?php post_class( 'Archive__container__content__item' ); ?>>
				<article>
					<div class="Archive__container__content__item__thumbnail">
						<img style="opacity: 0; transition: opacity 0.5s ease 0s;" data-src="<?php the_post_thumbnail_url( 'person_thumbnail' ); ?>" alt="<?php the_title(); ?>" />
					</div>

					<div class="Archive__container__content__item__text Archive__container__content__item__text--visible">
						<h3><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
					</div>
				</article>
			</li>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		</ul>
	</div>

	<?php
	return ob_get_clean();
}
	add_shortcode( 'people', 'ms_people' );
