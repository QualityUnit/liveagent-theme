<?php



add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Area Codes', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Area Code', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Area Codes', 'ms' ),
			'name_admin_bar' => __( 'Area Codes', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'areacodes/codes',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Area Codes', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'areacodes-manager',
			'menu_position'       => 52,
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
		register_post_type( 'ms_areacodes', $args );
	},
	0
);

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'Countries', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'Country', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'Countries', 'ms' ),
			'name_admin_bar' => __( 'Countries', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'areacodes/countries',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'Countries', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'areacodes-manager',
			'menu_position'       => 52,
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
		register_post_type( 'ms_ac_countries', $args );
	},
	0
);

add_action(
	'init',
	function () {
		$labels  = array(
			'name'           => _x( 'US States', 'Post Type General Name', 'ms' ),
			'singular_name'  => _x( 'US State', 'Post Type Singular Name', 'ms' ),
			'menu_name'      => __( 'US States', 'ms' ),
			'name_admin_bar' => __( 'US States', 'ms' ),
		);
		$rewrite = array(
			'slug'       => 'areacodes/usa',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);
		$args    = array(
			'label'               => __( 'US States', 'ms' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'areacodes-manager',
			'menu_position'       => 52,
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
		register_post_type( 'ms_ac_us_states', $args );
	},
	0
);
