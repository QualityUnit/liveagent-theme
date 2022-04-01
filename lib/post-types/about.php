<?php

	add_action(
		'init',
		function () {
			$labels  = array(
				'name'           => _x( 'About us', 'Post Type General Name', 'ms' ),
				'singular_name'  => _x( 'About us', 'Post Type Singular Name', 'ms' ),
				'menu_name'      => __( 'About us', 'ms' ),
				'name_admin_bar' => __( 'About us', 'ms' ),
			);
			$rewrite = array(
				'slug'       => 'about',
				'with_front' => true,
				'pages'      => true,
				'feeds'      => false,
			);
			$args    = array(
				'label'               => __( 'About us', 'ms' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 45,
				'menu_icon'           => 'dashicons-book',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'rewrite'             => $rewrite,
				'capability_type'     => 'post',
				'show_in_rest'        => true,
			);
			register_post_type( 'ms_about', $args );
		},
		0
	);
