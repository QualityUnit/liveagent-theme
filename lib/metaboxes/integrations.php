<?php

$metabox = array(
	'id'         => 'mb_integrations',
	'capability' => 'edit_posts',
	'name'       => 'Integrations',
	'post_type'  => array( 'ms_integrations' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_integrations_native_integration_url',
			'label'       => 'Native Integration URL',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_external_integration_url',
			'label'       => 'External Integration URL',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_zapier_integration_url',
			'label'       => 'Zapier Integration URL',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_partner_learn_more',
			'label'       => 'Partner - Learn More',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_partner_privacy_policy',
			'label'       => 'Partner - Privacy Policy',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_resources',
			'label'       => 'Resources',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_type',
			'label'       => 'Type',
			'description' => '',
			'type'        => 'multiselect',
			'args'        => array(
				'Native'   => 'native',
				'External' => 'external',
				'Zapier'   => 'zapier',
			),
		),
		array(
			'id'          => 'mb_integrations_plan',
			'label'       => 'Available in',
			'description' => '',
			'type'        => 'multiselect',
			'args'        => array(
				'Free'          => 'free',
				'Ticket'        => 'ticket',
				'Ticket+Chat'   => 'ticket-chat',
				'All-Inclusive' => 'all-inclusive',
				'Enterprise'    => 'enterprise',
				'Self-Hosted'   => 'self-hosted',
			),
		),


		array(
			'id'          => 'mb_integrations_collections',
			'label'       => 'Collections',
			'description' => '',
			'type'        => 'multiselect',
			'args'        => array(
				'Featured' => 'featured',
				'Popular'  => 'popular',
				'New'      => 'new',
			),
		),
		array(
			'id'          => 'mb_integrations_pillar',
			'label'       => 'Activate as Pillar page',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_integrations_faq-q1',
			'label'       => 'FAQ - Question #1',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a1',
			'label'       => 'FAQ - Answer #1',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q2',
			'label'       => 'FAQ - Question #2',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a2',
			'label'       => 'FAQ - Answer #2',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q3',
			'label'       => 'FAQ - Question #3',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a3',
			'label'       => 'FAQ - Answer #3',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q4',
			'label'       => 'FAQ - Question #4',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a4',
			'label'       => 'FAQ - Answer #4',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q5',
			'label'       => 'FAQ - Question #5',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a5',
			'label'       => 'FAQ - Answer #5',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q6',
			'label'       => 'FAQ - Question #6',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a6',
			'label'       => 'FAQ - Answer #6',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q7',
			'label'       => 'FAQ - Question #7',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a7',
			'label'       => 'FAQ - Answer #7',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q8',
			'label'       => 'FAQ - Question #8',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a8',
			'label'       => 'FAQ - Answer #8',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q9',
			'label'       => 'FAQ - Question #9',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a9',
			'label'       => 'FAQ - Answer #9',
			'description' => '',
			'type'        => 'editor',
		),
		array(
			'id'          => 'mb_integrations_faq-q10',
			'label'       => 'FAQ - Question #10',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_integrations_faq-a10',
			'label'       => 'FAQ - Answer #10',
			'description' => '',
			'type'        => 'editor',
		),
	),
);

new trueMetaBox( $metabox );
