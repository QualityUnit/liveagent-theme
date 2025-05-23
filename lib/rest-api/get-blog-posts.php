<?php

/* Register Route  https://www.liveagent.com/wp-json/wp/v2/blog/id */
add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'wp/v2',
			// Endpoint URL with attributes cat_id, cat_slug etc.
			'/blog/(cat_id=(?P<id>\d+)|cat_slug=(?P<cat_slug>[^&]+))?(&?author_id=(?P<author_id>\d+))?(\&?page=(?P<page>\d+))?',
			array(
				'methods'             => 'GET',
				'callback'            => 'get_posts_from_category',
				'permission_callback' => '__return_true',
			)
		);
	}
);
/* Get all posts from the specific Category */
function get_posts_from_category( $attr ) {
	$paged = isset( $attr['page'] ) ? absint( $attr['page'] ) : 1;
	// Custom pagination using offset
	$posts_per_page = 9;
	$initial_posts_count = 10;
	$offset = ( $paged <= 1 ) ? 0 : $initial_posts_count + ( $paged - 2 ) * $posts_per_page;

	$query = new WP_Query(
		array(
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $posts_per_page,
			'offset'              => $offset,
			'post_status'         => 'publish',
			'orderby'             => 'date',
			'cat'                 => $attr['id'],
			'category_name'       => $attr['cat_slug'],
			'author'              => $attr['author_id'],
		)
	);

	$posts = $query->posts;

	$return_array = array();

	// Function to create custom category info
	function get_cats( $id ) {
		$categories = get_the_category( $id );
		$cat_array  = array();
		foreach ( $categories as $category ) {
			array_push(
				$cat_array,
				(object) array(
					'id'   => $category->cat_ID,
					'name' => $category->name,
					'slug' => $category->slug,
				)
			);
		}
		return $cat_array;
	}

	foreach ( $posts as $post ) {
		$id = $post->ID;

		$monthly_update_label_enabled = get_post_meta( $id, 'mb_update_label_enabled', true );
		$monthly_update_label_title   = get_post_meta( $id, 'mb_update_label_title', true );
		$monthly_update_label_text    = get_post_meta( $id, 'mb_update_label_text', true );

		array_push(
			$return_array,
			array(
				'id'         => $id,
				'title'      => $post->post_title,
				'excerpt'    => wp_trim_words( get_the_excerpt( $id ), 20 ),
				'categories' => get_cats( $id ),
				'date'       => get_the_time( 'F j, Y', $id ),
				'dateU'      => get_the_time( 'Y-m-d', $id ),
				'url'        => get_permalink( $id ),
				'image'      => get_the_post_thumbnail_url( $id, 'box_archive_thumbnail' ),
				'author'     => get_the_author_meta( 'display_name', $post->post_author ),
				'update_label' => ( ! empty( $monthly_update_label_enabled ) && ! empty( $monthly_update_label_title ) && ! empty( $monthly_update_label_text ) ) ? array(
					'title' => $monthly_update_label_title,
					'text'  => $monthly_update_label_text,
				) : null,
			)
		);
	}

	if ( empty( $posts ) ) {
		return null;
	}
	return $return_array;
}
