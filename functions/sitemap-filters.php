<?php

// Removes 404 links from ms_reviews-sitemap.xml
function sitemap_exclude_posts_without_category( $exclude,  ) {
	$taxonomy = 'ms_reviews_categories';
	$reviews = get_posts(
		array(
			'post_type' => 'ms_reviews',
			'posts_per_page' => -1,
			'fields' => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'term_id',
					'terms'    => get_terms( $taxonomy, [ 'fields' => 'ids'  ] ),
					'operator' => 'NOT IN'
				)
			)
		)
	);
	return $reviews;
}

add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'sitemap_exclude_posts_without_category' );
