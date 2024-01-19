<?php


add_filter( 'simple_register_metaboxes', 'custom_url_for_archive_items' );

function custom_url_for_archive_items( $custom_url ) {

	$custom_url[] = array(
		'id'        => 'mb_custom_urls',
		'name'      => 'Custom url for post on archive - if you want linking archive item to other url',
		'post_type'  => array( 'ms_features' ),
		'opened'    => true,
		'fields'    => array(
			array(
				'id'    => 'mb_custom_url',
				'label' => 'Custom url',
				'type'  => 'text',
			),
		),
	);

	return $custom_url;
}
