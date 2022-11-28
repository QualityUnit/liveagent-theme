<?php

// Gets reviews posts to be used in reviews metaboxes

function get_reviews() {
		$query_args = array(
			'post_type' => 'ms_reviews',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		);

		$show_posts    = new WP_Query( $query_args );

		foreach ( $show_posts->posts as $post_id ) {
			$post_lang = apply_filters( 'wpml_post_language_details', null, $post_id );
			if ( is_array( $post_lang ) && 'en' === $post_lang['language_code'] ) {
				$reviews_posts[ $post_id ] = str_replace( '^', '', get_the_title( $post_id ) );
			}
		}

		wp_reset_query();

		return $reviews_posts;
}

	// Gets Directory posts IDs
function get_directory_contacts() {
	$query_args = array(
		'post_type' => 'ms_directory',
		'posts_per_page' => -1,
		'fields'         => 'ids',
	);
		
	$show_posts    = new WP_Query( $query_args );

	foreach ( $show_posts->posts as $post_id ) {
		$post_lang = apply_filters( 'wpml_post_language_details', null, $post_id );
		if ( is_array( $post_lang ) && 'en' === $post_lang['language_code'] ) {
			$details_posts[ $post_id ] = str_replace( '^', '', get_the_title( $post_id ) );
		}
	}

	wp_reset_query();

	return $details_posts;
}
