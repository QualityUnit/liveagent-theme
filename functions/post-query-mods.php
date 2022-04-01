<?php
/**
	* Change order of posts
	*/

function orderby_modified_posts( $query ) {
	if ( ( $query->is_category() && $query->is_main_query() ) || ( $query->is_archiveg() && $query->is_main_query() ) ) {
		$query->set( 'orderby', 'modified' );
		$query->set( 'order', 'desc' );
	}
}
add_action( 'pre_get_posts', 'orderby_modified_posts' );


/**
	* Change count of posts
	*/

function set_posts_per_page( $query ) {
	global $wp_the_query;

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_category() ) ) {
		$query->set( 'posts_per_page', 9 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_archive() ) ) {
		$query->set( 'posts_per_page', 9 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_integrations' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_features' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_glossary' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_directory' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_academy' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_success-stories' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_voip-partners' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_templates' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_about' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_research' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	if ( ( $query === $wp_the_query ) && $query->is_main_query() && ( $query->is_post_type_archive( 'ms_checklists' ) ) ) {
		$query->set( 'posts_per_page', 999 );
	}

	return $query;
}
add_action( 'pre_get_posts', 'set_posts_per_page' );
