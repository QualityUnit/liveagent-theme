<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'Awards Years', 'Taxonomy General Name', 'ms' ),
			'singular_name' => _x( 'Award Year', 'Taxonomy Singular Name', 'ms' ),
			'menu_name'     => __( 'Award Years', 'ms' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
			'show_in_rest'      => true,
		);
		register_taxonomy( 'ms_awards_years', array( 'ms_awards' ), $args );
	},
	0
);
