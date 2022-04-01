<?php

$metabox = array(
	'id'         => 'mb_success-stories',
	'capability' => 'edit_posts',
	'name'       => 'Success Stories',
	'post_type'  => array( 'ms_success-stories' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_success-stories_logo',
			'label'       => 'Logo',
			'description' => '',
			'type'        => 'image',
		),
	),
);

new trueMetaBox( $metabox );
