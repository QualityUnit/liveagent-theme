<?php
/* Gets all metaboxes for post to rest API output */

add_action( 'rest_api_init', 'create_api_posts_meta_field' );

function create_api_posts_meta_field() {
	$post_type = array( 'post', 'page', 'ms_academy', 'ms_alternatives', 'ms_awards', 'ms_directory', 'ms_features', 'ms_glossary', 'ms_integrations', 'ms_people', 'ms_success-stories', 'ms_templates', 'ms_testimonials' );
 
	foreach ( $post_type as $postname ) {
		register_rest_field(
			$postname,
			'metaboxes',
			array(
				'get_callback' => 'get_post_meta_for_api',
				'schema'       => null,
			)
		);
	}
}

function get_post_meta_for_api( $object ) {
	//get the id of the post object array
	$post_id = $object['id'];
 
	//return the post meta
	return get_post_meta( $post_id );
}
