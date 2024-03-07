<?php

$metabox = array(
	'id'         => 'mb_webinars',
	'capability' => 'edit_posts',
	'name'       => 'Webinars',
	'post_type'  => array( 'ms_webinars' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_webinars_youtube_link',
			'label'       => 'YouTube Link',
			'description' => '',
			'type'        => 'text',
		),
	),
);

new trueMetaBox( $metabox );
