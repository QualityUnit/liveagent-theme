<?php

$metabox = array(
	'id'         => 'mb_videos',
	'capability' => 'edit_posts',
	'name'       => 'Videos',
	'post_type'  => array( 'ms_videos' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_videos_video_id',
			'label'       => 'Video ID',
			'description' => '',
			'type'        => 'text',
			'editor_args' => array(),
		),
		array(
			'id'          => 'mb_videos_shortcode_id',
			'label'       => 'Shortcode ID',
			'description' => '',
			'type'        => 'text',
			'editor_args' => array(),
		),
	),
);

new trueMetaBox( $metabox );
