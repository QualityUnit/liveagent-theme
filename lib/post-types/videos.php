<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Videos', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Video', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Videos', 'ms' ),
			'name_admin_bar' => __( 'Videos', 'ms' ),
		);
		$args    = array(
			'label'               => __( 'Videos', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 52,
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
		register_post_type( 'ms_videos', $args );
	},
	0
);
