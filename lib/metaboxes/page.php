<?php

$metabox = array(
	'id'         => 'mb_page',
	'capability' => 'edit_posts',
	'name'       => 'Page Settings',
	'post_type'  => array( 'page' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_page_newsletter',
			'label'       => 'Hide Newsletter in Footer',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
	),
);

new trueMetaBox( $metabox );
