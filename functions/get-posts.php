<?php

// Gets reviews posts to be used in reviews metaboxes

function get_reviews() {
		$query_args = array(
			'post_type' => 'ms_reviews',
			'posts_per_page' => -1,
			'fields'         => 'id',
		);

		$show_posts    = new WP_Query( $query_args );

		while ( $show_posts->have_posts() ) :
			$show_posts->the_post();
			$post_lang = apply_filters( 'wpml_post_language_details', null, get_the_id() );
			if ( 'en' === $post_lang['language_code'] ) {
				$reviews_posts[ get_the_id() ] = str_replace( '^', '', get_the_title() );
			}
		endwhile;

		wp_reset_query();

		return $reviews_posts;
}

	// Gets Directory posts IDs
function get_directory_contacts() {
	$query_args = array(
		'post_type' => 'ms_directory',
		'posts_per_page' => -1,
		'fields'         => 'id',
	);
		
	$show_posts    = new WP_Query( $query_args );

	while ( $show_posts->have_posts() ) :
		$show_posts->the_post();
		$post_lang = apply_filters( 'wpml_post_language_details', null, get_the_id() );
		if ( 'en' === $post_lang['language_code'] ) {
			$details_posts[ get_the_id() ] = str_replace( '^', '', get_the_title() );
		}
		endwhile;

	wp_reset_query();

	return $details_posts;
}
