<?php
function get_archive_items_images( $taxonomy, $image_path ) {
	$image_urls = array(
		'background' => '',
		'pillar' => '',
	);

	$current_language = apply_filters( 'wpml_current_language', null );
	do_action( 'wpml_switch_language', 'en' );

	$categories_en = get_the_terms( 0, $taxonomy );
	$slug_en = '';
	if ( ! empty( $categories_en ) && ! is_wp_error( $categories_en ) ) {
		$category_en = array_shift( $categories_en );
		$slug_en = $category_en->slug;
	}

	$item_image_path = get_template_directory_uri() . '/assets/images/' . $image_path . '/archive/' . $slug_en . '_item_bg.jpg';
	$pillar_image_path = get_template_directory_uri() . '/assets/images/' . $image_path . '/archive/' . $slug_en . '_pillar.png';

	$image_urls['background'] = $item_image_path;
	$image_urls['pillar'] = $pillar_image_path;

	do_action( 'wpml_switch_language', $current_language );

	return $image_urls;
}
