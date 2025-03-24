<?php

add_filter('simple_register_metaboxes', 'monthly_update_label_blog');

function monthly_update_label_blog( $monthly_update_label) {

	$monthly_update_label[] = array(
		'id'        => 'monthly_update_label',
		'name'      => 'Title and text to cover of article with label "monthly_update"',
		'post_type' => 'post',
		'category'  => 'blog',
		'opened'    => true,
		'fields'    => array(
			array(
				'id'    => 'mb_monthly_update_label_checkbox',
				'label' => 'Monthly update label checkbox',
				'type'        => 'checkbox',
				'default'     => 'off',
			),
			array(
				'id'    => 'mb_monthly_update_label_title',
				'label' => 'Monthly update label title',
				'type'        => 'text',
			),
			array(
				'id'    => 'mb_monthly_update_label_text',
				'label' => 'Monthly update label text',
				'type'        => 'text',
			),
		),
	);

	return $monthly_update_label;
}
