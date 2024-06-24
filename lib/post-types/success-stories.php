<?php
// We have to use ms_success-stories everywhere to preserve old DB records
add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Use Case Scenarios', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Use Case Scenario', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Use Case Scenarios', 'ms' ),
			'name_admin_bar' => __( 'Use Case Scenario', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'use-case-scenarios',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Use Case Scenario', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 37,
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
		register_post_type( 'ms_success-stories', $args );
	},
	0
);
