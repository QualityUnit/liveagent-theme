<?php

add_filter( 'simple_register_metaboxes', 'monthly_update_label_blog' );

function monthly_update_label_blog( $monthly_update ) {

	$monthly_update[] = array(
		'id'        => 'monthly_update',
		'name'      => 'Monthly Update: Cover Title & Text',
		'post_type' => 'post',
		'category'  => 'blog',
		'opened'    => true,
		'fields'    => array(
			array(
				'id'    => 'mb_update_label_enabled',
				'label' => 'Enable Monthly Update Label',
				'type'  => 'checkbox',
				'default' => 'off',
			),
			array(
				'id'    => 'mb_update_label_title',
				'label' => 'Label Title',
				'type'  => 'text',
			),
			array(
				'id'    => 'mb_update_label_text',
				'label' => 'Label Text',
				'type'  => 'text',
			),
		),
	);

	return $monthly_update;
}
