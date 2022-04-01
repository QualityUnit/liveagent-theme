<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'           => _x( 'Clients', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Client', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Clients', 'ms' ),
			'name_admin_bar' => __( 'Client', 'ms' ),
		);
		$args   = array(
			'label'               => __( 'Client', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 38,
			'menu_icon'           => 'dashicons-book',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
		);
		register_post_type( 'ms_clients', $args );
	},
	0
);
