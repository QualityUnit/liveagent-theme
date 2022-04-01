<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Research', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Research', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Research', 'ms' ),
			'name_admin_bar' => __( 'Research', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'research',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Research', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 50,
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
		register_post_type( 'ms_research', $args );
	},
	0
);
