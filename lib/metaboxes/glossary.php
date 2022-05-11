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
		array(
			'id'          => 'mb_glossary_faq-q1',
			'label'       => 'FAQ - Question #1',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a1',
			'label'       => 'FAQ - Answer #1',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q2',
			'label'       => 'FAQ - Question #2',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a2',
			'label'       => 'FAQ - Answer #2',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q3',
			'label'       => 'FAQ - Question #3',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a3',
			'label'       => 'FAQ - Answer #3',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q4',
			'label'       => 'FAQ - Question #4',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a4',
			'label'       => 'FAQ - Answer #4',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q5',
			'label'       => 'FAQ - Question #5',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a5',
			'label'       => 'FAQ - Answer #5',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q6',
			'label'       => 'FAQ - Question #6',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a6',
			'label'       => 'FAQ - Answer #6',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q7',
			'label'       => 'FAQ - Question #7',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a7',
			'label'       => 'FAQ - Answer #7',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q8',
			'label'       => 'FAQ - Question #8',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a8',
			'label'       => 'FAQ - Answer #8',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q9',
			'label'       => 'FAQ - Question #9',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a9',
			'label'       => 'FAQ - Answer #9',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_glossary_faq-q10',
			'label'       => 'FAQ - Question #10',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_glossary_faq-a10',
			'label'       => 'FAQ - Answer #10',
			'description' => '',
			'type'        => 'editor',
		),
	),
);

new trueMetaBox( $metabox );
