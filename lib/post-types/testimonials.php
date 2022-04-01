<?php

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Testimonials', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Testimonial', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Testimonials', 'ms' ),
			'name_admin_bar' => __( 'Testimonial', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'testimonials',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Testimonial', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 36,
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
		register_post_type( 'ms_testimonials', $args );
	},
	0
);
