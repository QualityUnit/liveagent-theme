<?php

$metabox = array(
	'id'         => 'mb_people',
	'capability' => 'edit_posts',
	'name'       => 'People',
	'post_type'  => array( 'ms_people' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_people_position',
			'label'       => 'Position',
			'description' => '',
			'type'        => 'text',
		),
	),
);

new trueMetaBox( $metabox );
