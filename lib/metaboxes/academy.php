<?php

$metabox = array(
	'id'         => 'mb_academy',
	'capability' => 'edit_posts',
	'name'       => 'Academy',
	'post_type'  => array( 'ms_academy' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_academy_sidebar_title',
			'label'       => 'Short Title',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_academy_resources',
			'label'       => 'Resources',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_academy_pillar',
			'label'       => 'Activate as Pillar page',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
	),
);

new trueMetaBox( $metabox );
