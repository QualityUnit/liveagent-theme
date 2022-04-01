<?php

$metabox = array(
	'id'         => 'mb_awards',
	'capability' => 'edit_posts',
	'name'       => 'Integrations',
	'post_type'  => array( 'ms_awards' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_awards_url',
			'label'       => 'External URL',
			'description' => '',
			'type'        => 'text',
		),
	),
);

new trueMetaBox( $metabox );
