<?php

function check_parent_child_slug( array $parent_slugs ): bool {
	global $post;


	if ( ! isset( $post ) || ! is_object( $post ) ) {
		return false;
	}

	$slug = $post->post_name;
	$parent_id = $post->post_parent;

	if ( $parent_id && in_array( get_post_field( 'post_name', $parent_id ), $parent_slugs, true ) ) {
		return true;
	}

	return in_array( $slug, $parent_slugs, true );
}
