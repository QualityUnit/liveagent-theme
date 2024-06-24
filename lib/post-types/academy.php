<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Academy', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Academy', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Academy', 'ms' ),
			'name_admin_bar' => __( 'Academy', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'academy',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Academy', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 31,
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
		register_post_type( 'ms_academy', $args );
	},
	0
);
