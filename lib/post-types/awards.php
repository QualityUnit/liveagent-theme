<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'           => _x( 'Awards', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Award', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Awards', 'ms' ),
			'name_admin_bar' => __( 'Award', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'awards',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args   = array(
			'label'               => __( 'Awards', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'author' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 39,
			'menu_icon'           => 'dashicons-book',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'show_in_rest'        => true,

		);
		register_post_type( 'ms_awards', $args );
	},
	0
);
