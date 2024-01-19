<?php
function get_current_lang() {
	$currentlang = apply_filters( 'wpml_current_language', null );
	return array( 'language_code' => $currentlang );
}

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'wp/v2',
			'/lang/',
			array(
				'methods'             => 'GET',
				'callback'            => 'get_current_lang',
				'permission_callback' => '__return_true',
			)
		);
	} 
);

function assign_lang_to_domain() {

	$languages = icl_get_languages();
	$domains   = array();
	foreach ( $languages as $lang ) {

			$domain    = array( $lang['url'] => $lang['language_code'] );
			$domains[] = $domain;
	}

	return array_merge( ...$domains );
}

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'wp/v2',
			'/languages/',
			array(
				'methods'             => 'GET',
				'callback'            => 'assign_lang_to_domain',
				'permission_callback' => '__return_true',
			)
		);
	} 
);
