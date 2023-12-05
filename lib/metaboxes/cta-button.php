<?php

add_filter( 'simple_register_metaboxes', 'edit_cta_button' );

function edit_cta_button( $cta_button ) {

	$cta_button[] = array(
		'id'        => 'edit_cta_button',
		'name'      => 'Edit CTA button',
		'post_type'  => array( 'post', 'page', 'ms_academy', 'ms_glossary', 'ms_templates' ),
		'opened'    => false,
		'fields'    => array(
			array(
				'id' => 'cta_button_switch',
				'type' => 'radio',
				'label' => 'Show CTA button',
				'options' => array(
					'yes' => 'Show',
					'no' => 'Hide',
				),
				'default' => 'yes',
			),
			array(
				'id'    => 'cta_button_text',
				'label' => 'Button text',
				'type'  => 'text',
			),
			array(
				'id'    => 'cta_button_url',
				'label' => 'Button url',
				'type'  => 'text',
			),
		),
	);

	return $cta_button;
}
