<?php

$metabox = array(
	'id'         => 'mb_checklists',
	'capability' => 'edit_posts',
	'name'       => 'Checklists',
	'post_type'  => array( 'ms_checklists' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_checklists_icon',
			'label'       => 'Navigation Icon',
			'description' => '',
			'type'        => 'image',
		),
		array(
			'id'          => 'mb_checklists_sidebar_title',
			'label'       => 'Sidebar Title',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_checklists_pillar',
			'label'       => 'Activate as Pillar page',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
	),
);

new trueMetaBox( $metabox );
