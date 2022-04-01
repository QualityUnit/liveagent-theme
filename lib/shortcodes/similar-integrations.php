<?php

function ms_similar_integrations( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => '',
		),
		$atts,
		'similar-integrations'
	);

	ob_start();
	?>

	<div class="SimilarIntegrations__items">
	<?php
	$query_similar_integrations_posts = new WP_Query(
		array(
			'post_type'                  => 'ms_integrations',
			'ms_integrations_categories' => $atts['category'],
			'posts_per_page'             => 4,
			// @codingStandardsIgnoreLine
			'orderby'                    => 'rand',
		)
	);

	while ( $query_similar_integrations_posts->have_posts() ) :
		$query_similar_integrations_posts->the_post();
		?>

	<div class="SimilarIntegrations__item">
		<div class="SimilarIntegrations__item__thumbnail">
			<a href="<?php the_permalink(); ?>" target="_blank"><?php the_post_thumbnail( 'logo_small_thumbnail' ); ?></a>
		</div>

		<div class="SimilarIntegrations__item__text">
			<h3><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h3>
		</div>
	</div>

	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'similar-integrations', 'ms_similar_integrations' );
