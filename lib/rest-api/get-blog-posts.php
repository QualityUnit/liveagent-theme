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
/* Get all posts from the specific Caetgory */
function get_posts_from_category( $attr ) {

	$query = new WP_Query(
		array(
			'ignore_sticky_posts' => true,
			'posts_per_page'      => 9,
			'post_status'         => 'publish',
			'orderby'             => 'date',
			'cat'                 => $attr['id'],
			'category_name'       => $attr['cat_slug'],
			'paged'               => $attr['page'],
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
			)
		);
	}

	if ( empty( $posts ) ) {
		return null;
	}
	return $return_array;
}
