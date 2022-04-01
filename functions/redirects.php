<?php

/**
	* Redirect Integrations Categories
	*/

function integration_category_redirect() {
	if ( is_tax( 'ms_integrations_categories' ) ) {
		wp_safe_redirect( '/integrations/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'integration_category_redirect' );


/**
	* Redirect Features Categories
	*/

function features_category_redirect() {
	if ( is_tax( 'ms_features_categories' ) ) {
		wp_safe_redirect( '/features/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'features_category_redirect' );


/**
	* Redirect Academy Categories
	*/

function academy_category_redirect() {
	if ( is_tax( 'ms_academy_categories' ) ) {
		wp_safe_redirect( '/academy/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'academy_category_redirect' );


/**
	* Redirect Glossary Categories
	*/

function glossary_category_redirect() {
	if ( is_tax( 'ms_glossary_categories' ) ) {
		wp_safe_redirect( '/customer-support-glossary/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'glossary_category_redirect' );


/**
	* Redirect Directory Categories
	*/

function directory_category_redirect() {
	if ( is_tax( 'ms_directory_categories' ) ) {
		wp_safe_redirect( '/directory/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'directory_category_redirect' );

/**
	* Redirect About us Categories
	*/

function about_category_redirect() {
	if ( is_tax( 'ms_about_categories' ) ) {
		wp_safe_redirect( '/about/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'about_category_redirect' );

/**
	* Redirect Research Categories
	*/

function research_category_redirect() {
	if ( is_tax( 'ms_research_categories' ) ) {
		wp_safe_redirect( '/research/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'research_category_redirect' );

/**
	* Redirect Checklists Categories
	*/

function checklists_category_redirect() {
	if ( is_tax( 'ms_checklists_categories' ) ) {
		wp_safe_redirect( '/checklists/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'checklists_category_redirect' );


/**
	* Redirect VoIP Partners Categories
	*/

function voip_category_redirect() {
	if ( is_tax( 'ms_voip-partners_categories' ) ) {
		wp_safe_redirect( '/voip-partners/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'voip_category_redirect' );

/**
	* Redirect Awards Years
	*/
function awards_years_redirect() {
	if ( is_tax( 'ms_awards_years' ) ) {
		wp_safe_redirect( '/awards/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'awards_years_redirect' );
