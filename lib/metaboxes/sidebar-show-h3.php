<?php

$metabox = array(

	'id'         => 'sidebar',
	'capability' => 'edit_posts',
	'name'       => 'Post Settings',
	'post_type'  => array( 'post', 'page', 'ms_academy', 'ms_alternatives', 'ms_features', 'ms_glossary', 'ms_integrations', 'ms_templates' ),
	'priority'   => 'high',
	'args'       => array(

		array(
			'id'          => 'show_h3',
			'label'       => 'Show H3 subtitles in sidebar',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),

	),
);

new trueMetaBox( $metabox );
