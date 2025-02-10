<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Landing PPC', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Landing PPC', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Landing PPCs', 'ms' ),
			'name_admin_bar' => __( 'Landing PPC', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'landing',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Landing PPC', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 44,
			'menu_icon'           => 'dashicons-book',
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
		register_post_type( 'ms_landing', $args );
	},
	0
);
