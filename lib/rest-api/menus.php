<?php
/**
 * Returns menu items in a array based on the navigation menu id passed
 *  -------------------
 *  Use in url as:
	*   https://www.liveagent.com/wp-json/wp/v2/navigation/10012?lang=de
	*   where number ie 10012 is the menu ID in english found via:
	*   https://www.liveagent.com/wp-json/wp/v2/navigation/
	*   ------------------
 * @param object The actual request where parameters can be accessed.
 * @return array The menu items contained in that specific menu
 */
function expose_navigation( $request ) {
	$id = $request['id'];
	return wp_get_nav_menu_items( $id );
}

/**
 * Exposes under /navigation/{id} the menu items in the wp-json api
 *
 * @return void
 */
function expose_navigation_to_rest() {
	register_rest_route(
		'wp/v2',
		'/navigation/(?P<id>\d+)',
		array(
			'methods'             => 'GET',
			'callback'            => 'expose_navigation',
			'permission_callback' => '__return_true',
		)
	);
}

add_action( 'rest_api_init', 'expose_navigation_to_rest' );

// Gets all menu items
function wpdocs_menu_route() {
	$menu_locations = get_nav_menu_locations(); // Get nav locations set in theme, usually functions.php
	return $menu_locations;
}

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'wp/v2',
			'/navigation/',
			array(
				'methods'             => 'GET',
				'callback'            => 'wpdocs_menu_route',
				'permission_callback' => '__return_true',
			) 
		);
	} 
);
