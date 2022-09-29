<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Reviews', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Review', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Reviews', 'ms' ),
			'name_admin_bar' => __( 'Review', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'reviews/%ms_reviews_categories%',
			'with_front' => false,
			'pages'      => false,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Review', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 30,
			'menu_icon'           => 'dashicons-book',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => 'reviews',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'taxonomies'          => array( 'ms_reviews_categories' ),
		);
		register_post_type( 'ms_reviews', $args );
	},
	0
);
