<?php

$metabox = array(
	'id'         => 'mb_testimonials',
	'capability' => 'edit_posts',
	'name'       => 'Testimonials',
	'post_type'  => array( 'ms_testimonials' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_realtestimonials',
			'label'       => 'Activate as Real Testimonials Slider',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_testimonials_name',
			'label'       => 'Name',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_testimonials_position',
			'label'       => 'Position',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_testimonials_photo',
			'label'       => 'Photo',
			'description' => '',
			'type'        => 'image',
		),
		array(
			'id'          => 'mb_testimonials_logo',
			'label'       => 'Logo',
			'description' => '',
			'type'        => 'image',
		),
	),
);

new trueMetaBox( $metabox );
