<?php

$metabox = array(
	'id'         => 'mb_alternatives',
	'capability' => 'edit_posts',
	'name'       => 'Slider media',
	'post_type'  => array( 'ms_alternatives' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_alternatives_person',
			'label'       => 'Person image',
			'description' => '',
			'type'        => 'image',
		),
	),
);

new trueMetaBox( $metabox );
