<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Migrations', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Migration', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Migrations', 'ms' ),
			'name_admin_bar' => __( 'Migration', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'migrations',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Migration', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 45,
			'menu_icon'           => 'dashicons-migrate',
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
		register_post_type( 'ms_migrations', $args );
	},
	0
);
