<?php

function ms_awards_small( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts' => '8',
		),
		$atts,
		'awards_small'
	);
	ob_start();
	?>
	<div class="AwardsSmall">
		<ul class="AwardsSmall__list flex">
		<?php
		// @codingStandardsIgnoreEnd
			$query_awards_posts = new WP_Query(
				array(
					'post_type'      => 'ms_awards',
					'posts_per_page' => $atts['posts'],
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				)
			);
			$counter            = 0;
		while ( $query_awards_posts->have_posts() ) :
			$query_awards_posts->the_post();
				
			if ( get_previous_post() && $counter < 4 ) { // @codingStandardsIgnoreLine
				$next_post    = get_previous_post(); // @codingStandardsIgnoreLine
				$next_excerpt = preg_replace( '/(20\d{2})/', '$1, ', $next_post->post_excerpt );
				$excerpt      = preg_replace( '/(20\d{2})/', '$1, ', get_the_excerpt() );
				if ( strcasecmp( $next_excerpt, $excerpt ) ) {
					++ $counter;
					?>
				<li <?php post_class( 'AwardsSmall__item' ); ?>>
					<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_awards_mb_awards_url', true ) ) ?>" target="_blank"><?php the_post_thumbnail( 'blog_thumbnail' ); ?></a>
				</li>
					<?php 
				}
			}
			endwhile; 
		?>
				<?php wp_reset_postdata(); ?>
		</ul>
	</div>

	<?php
	set_custom_source( 'components/AwardsSmall' );
	return ob_get_clean();
}
add_shortcode( 'awards_small', 'ms_awards_small' );
