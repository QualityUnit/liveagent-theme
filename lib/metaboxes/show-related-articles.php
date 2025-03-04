<?php
add_filter( 'simple_register_metaboxes', 'register_related_posts_metabox' );

function register_related_posts_metabox( $metaboxes ) {
	$metaboxes[] = array(
		'id'        => 'mb_related_settings',
		'name'      => 'Related Articles Settings',
		'post_type' => array( 'page' ),
		'priority'  => 'default',
		'fields'    => array(
			array(
				'id'           => 'mb_related_enable',
				'label'        => 'Enable Related Posts Section',
				'description'  => 'Toggle the visibility of the related posts section below the content.',
				'type'         => 'radio',
				'default'      => 'on',
				'options'      => array(
					'on'  => 'Enable',
					'off' => 'Disable',
				),
			),
		),
	);

	return $metaboxes;
}
