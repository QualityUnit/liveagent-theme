<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'Reviews Categories', 'Taxonomy General Name', 'ms' ),
			'singular_name' => _x( 'Review Category', 'Taxonomy Singular Name', 'ms' ),
			'menu_name'     => __( 'Categories', 'ms' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_menu'      => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'reviews',
				'with_front' => false,
			),
			'show_in_rest'      => true,
		);
		register_taxonomy( 'ms_reviews_categories', array( 'ms_reviews' ), $args );
	},
	0
);
