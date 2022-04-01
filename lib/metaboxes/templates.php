<?php

$metabox = array(
	'id'         => 'mb_templates',
	'capability' => 'edit_posts',
	'name'       => 'Templates',
	'post_type'  => array( 'ms_templates' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_templates_resources',
			'label'       => 'Resources',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_templates_pillar',
			'label'       => 'Activate as Pillar page',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_help-desk-software',
			'label'       => 'Technologies - Help Desk Software',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_ticketing-software',
			'label'       => 'Technologies - Ticketing Software',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_live-chat-software',
			'label'       => 'Technologies - Live Chat Software',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_call-center-software',
			'label'       => 'Technologies - Call Center Software',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_social-media',
			'label'       => 'Technologies - Social Media Support',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_customer-portal-software',
			'label'       => 'Technologies - Customer Portal Software',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_knowledge-base',
			'label'       => 'Technologies - Knowledge Base Software',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_templates_affiliate-program',
			'label'       => 'Technologies - Affiliate Software',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
	),
);

new trueMetaBox( $metabox );
