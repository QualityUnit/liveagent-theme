<?php
/* Rewrite default route for ms_awards. https://www.liveagent.com/wp-json/wp/v2/ms-awards/ */

add_action( 'rest_api_init', 'override_custom_ms_awards_endpoint' );

function override_custom_ms_awards_endpoint() {
	register_rest_route(
		'wp/v2',
		'/ms_awards/',
		array(
			'methods' => 'GET',
			'callback' => 'get_custom_data_from_ms_awards',
			'permission_callback' => '__return_true',
		)
	);
}

function get_custom_data_from_ms_awards( WP_REST_Request $request ) {
	$paged = $request->get_param( 'page' ) ?? 1;

	$args = array(
		'post_type' => 'ms_awards',
		'posts_per_page' => 9,
		'post_status' => 'publish',
		'paged' => $paged,
	);

	$posts = new WP_Query( $args );
	$total_pages = $posts->max_num_pages;

	// Set the 'X-WP-TotalPages' header
	header( 'X-WP-TotalPages: ' . $total_pages );

	$data = array();

	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) {
			$posts->the_post();
			$id = get_the_ID();
			$post_terms = get_the_terms( $id, 'ms_awards_years' );
			$terms_array = array();

			if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
				foreach ( $post_terms as $term ) {
					$terms_array[] = array(
						'id' => $term->term_id,
						'name' => $term->name,
					);
				}
			}

			$data[] = array(
				'title' => get_the_title(),
				'excerpt' => get_the_excerpt(),
				'url' => get_post_meta( $id, 'mb_awards_mb_awards_url', true ),
				'image' => get_the_post_thumbnail_url( $id, 'box_archive_thumbnail' ),
				'ms_awards_years' => $terms_array,
			);
		}
		wp_reset_postdata();
	}

	return $data;
}
