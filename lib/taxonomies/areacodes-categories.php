<?php

/*-------------------------------------------------
Functions for custom Admin menu to group post types
--------------------------------------------------- */
function areacodes_admin_menu() {
	add_menu_page(
		'Area Codes',
		'Area Codes',
		'read',
		'areacodes-manager',
		'', // Callback, leave empty
		'dashicons-phone',
		52 // Position
	);
}

add_action( 'admin_menu', 'areacodes_admin_menu' );

// Shows categories in custom Area codes admin menu
function areacodes_regions_menu() {
		add_submenu_page( 'areacodes-manager', 'Regions', 'Regions', 'read', 'edit-tags.php?taxonomy=ms_areacodes_regions' );
}

add_action( 'admin_menu', 'areacodes_regions_menu' );

// Keeps Area codes admin menu open when editing categories
function menu_highlight( $parent_file ) {
	global $current_screen;

	$taxonomy = $current_screen->taxonomy;
	if ( 'ms_areacodes_regions' === $taxonomy ) {
			$parent_file = 'areacodes-manager';
	}

	return $parent_file;
}

add_action( 'parent_file', 'menu_highlight' );

add_action(
	'init',
	function () {
		$labels = array(
			'name'          => _x( 'AreaCodes Regions', 'Taxonomy General Name', 'ms' ),
			'singular_name' => _x( 'AreaCodes Regions', 'Taxonomy Singular Name', 'ms' ),
			'menu_name'     => __( 'Regions', 'ms' ),
		);
		$args   = array(
			'label'             => 'AreaCodes Regions',
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_in_menu'      => true,
			'show_tagcloud'     => false,
			'show_in_rest'      => true,
		);
		register_taxonomy( 'ms_areacodes_regions', array( 'ms_ac_countries' ), $args );
	},
	0
);
