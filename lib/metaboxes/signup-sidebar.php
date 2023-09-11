<?php

add_filter( 'simple_register_metaboxes', 'edit_signup_sidebar' );

function edit_signup_sidebar( $signup ) {

	$signup[] = array(
		'id'        => 'edit_signup_sidebar',
		'name'      => 'Edit Signup sidebar',
		'post_type'  => array( 'post', 'page', 'ms_academy', 'ms_alternatives', 'ms_features', 'ms_glossary', 'ms_integrations', 'ms_reviews', 'ms_checklists', 'ms_templates', 'ms_videos' ),
		'opened'    => false,
		'fields'    => array(
			array(
				'id'    => 'signup_title',
				'label' => 'Title',
				'type'  => 'text',
			),
			array(
				'id'    => 'signup_subtitle',
				'label' => 'Subtitle',
				'type'  => 'text',
			),
			array(
				'id'    => 'signup_button',
				'label' => 'Button',
				'type'  => 'text',
			),
		),
	);

	return $signup;
}
