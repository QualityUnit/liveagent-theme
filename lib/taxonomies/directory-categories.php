<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'Directory Categories', 'Taxonomy General Name', 'ms' ),
			'singular_name' => _x( 'Directory Category', 'Taxonomy Singular Name', 'ms' ),
			'menu_name'     => __( 'Categories', 'ms' ),
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
		register_taxonomy( 'ms_directory_categories', array( 'ms_directory' ), $args );
	},
	0
);
