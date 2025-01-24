<?php
add_filter( 'simple_register_metaboxes', 'landing_ppc_metaboxes' );

function landing_ppc_metaboxes( $metaboxes ) {

	$metaboxes[] = array(
		'id'        => 'landingppc',
		'name'      => 'Attributes',
		'post_type' => array( 'ms_landing' ),
		'fields'    => array(
			array(
				'id'           => 'title',
				'label'        => 'Main title',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
			),
			array(
				'id'           => 'subtitle',
				'label'        => 'Subtitle',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
			),
			array(
				'id'           => 'box1_icon',
				'label'        => 'Box 1 Icon',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
			),
			array(
				'id'           => 'box1_title',
				'label'        => 'Box 1 Title',
				'description'  => '',
				'type'         => 'text',
				'show_in_rest' => true,
			),
			array(
				'id'           => 'box1_text',
				'label'        => 'Box 1 Text',
				'description'  => '',
				'type'         => 'textarea',
				'show_in_rest' => true,
			),
			array(
				'id'          => 'box2_icon',
				'label'       => 'Box 2 Icon',
				'description' => '',
				'type'        => 'text',
			),
			array(
				'id'          => 'box2_title',
				'label'       => 'Box 2 Title',
				'description' => '',
				'type'        => 'text',
			),
			array(
				'id'          => 'box2_text',
				'label'       => 'Box 2 Text',
				'description' => '',
				'type'        => 'textarea',
			),
			array(
				'id'          => 'box3_icon',
				'label'       => 'Box 3 Icon',
				'description' => '',
				'type'        => 'text',
			),
			array(
				'id'          => 'box3_title',
				'label'       => 'Box 3 Title',
				'description' => '',
				'type'        => 'text',
			),
			array(
				'id'          => 'box3_text',
				'label'       => 'Box 3 Text',
				'description' => '',
				'type'        => 'textarea',
			),
		),
	);

	return $metaboxes;
}
