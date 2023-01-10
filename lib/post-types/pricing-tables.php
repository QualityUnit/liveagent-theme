<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Pricing tables', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Pricing table', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Pricing tables', 'ms' ),
			'name_admin_bar' => __( 'Pricing table', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'pricing-table',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Pricing', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 50,
			'menu_icon'           => 'dashicons-editor-table',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
		);
		register_post_type( 'ms_pricing', $args );
	},
	0
);
