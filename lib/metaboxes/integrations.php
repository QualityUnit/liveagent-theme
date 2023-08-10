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
				'Small'        => 'ticket',
				'Medium'   => 'ticket-chat',
				'Large' => 'all-inclusive',
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
			'id'          => 'mb_integrations_faq-text',
			'label'       => 'FAQ - Subheadline',
			'description' => '',
			'type'        => 'text',
		),
	),
);

new trueMetaBox( $metabox );
