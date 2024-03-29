<?php

add_action(
	'init',
	function () {
		$labels = array(
			'name'           => _x( 'Webinars', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Webinar', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Webinars', 'ms' ),
			'name_admin_bar' => __( 'Webinar', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'webinars',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args   = array(
			'label'               => __( 'Webinar', 'ms' ),
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
		register_post_type( 'ms_webinars', $args );
	},
	0
);
