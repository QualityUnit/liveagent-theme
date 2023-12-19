<?php

add_filter( 'simple_register_taxonomy_settings', 'add_features_taxonomy_card' );

function add_features_taxonomy_card( $settings ) {
	global $integrations_posts;

	$settings[] = array(
		'id'       => 'ms_features',
		'taxonomy' => array( 'ms_features_categories' ),
		'fields'   => array(
			array(
				'id'        => 'card',
				'label'     => 'Custom Card Link',
				'type'      => 'repeater',
				'subfields' => array(
					array(
						'id'          => 'integration_post',
						'label'       => 'Integration post',
						'type'        => 'select',
						'placeholder' => 'Select Integration post to link card to',
						'options'     => $integrations_posts,
					),
				),
			),
		),
	);

	return $settings;
}


$metabox = array(
	'id'         => 'mb_features',
	'capability' => 'edit_posts',
	'name'       => 'Features',
	'post_type'  => array( 'ms_features' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_features_plan',
			'label'       => 'Available in',
			'description' => '',
			'type'        => 'multiselect',
			'args'        => array(
				'Free'       => 'free',
				'Small'      => 'ticket',
				'Medium'     => 'ticket-chat',
				'Large'      => 'all-inclusive',
				'Enterprise' => 'enterprise',
				'Extensions' => 'extensions',
			),
		),
		array(
			'id'          => 'mb_features_size',
			'label'       => 'Suitable for',
			'description' => '',
			'type'        => 'multiselect',
			'args'        => array(
				'Individuals' => 'individuals',
				'Start-ups'   => 'start-ups',
				'SMBs'        => 'smbs',
				'Enterprise'  => 'enterprise',
			),
		),
		array(
			'id'          => 'mb_features_collections',
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
			'id'          => 'mb_features_new',
			'label'       => 'New Feature?',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_features_slider',
			'label'       => 'Add to Features Slider?',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_features_pillar',
			'label'       => 'Activate as Pillar page',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
	),
);

new trueMetaBox( $metabox );
