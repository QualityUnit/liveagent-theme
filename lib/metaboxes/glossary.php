<?php

$metabox = array(
	'id'         => 'mb_glossary',
	'capability' => 'edit_posts',
	'name'       => 'Glossary',
	'post_type'  => array( 'ms_glossary' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_glossary_related-articles',
			'label'       => 'Related Articles',
			'description' => '',
			'type'        => 'editor',
			'editor_args' => array(),
		),
		array(
			'id'          => 'mb_glossary_resources',
			'label'       => 'Resources',
			'description' => '',
			'type'        => 'editor',
			'editor_args' => array(),
		),
		array(
			'id'          => 'mb_glossary_faq-text',
			'label'       => 'FAQ - Subheadline',
			'description' => '',
			'type'        => 'text',
		),
	),
);

new trueMetaBox( $metabox );
