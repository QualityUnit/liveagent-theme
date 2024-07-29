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


/**
 * Redirect Videos Categories
 */
function videos_category_redirect() {
	if ( is_tax( 'ms_videos_categories' ) ) {
		wp_safe_redirect( '/videos/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'videos_category_redirect' );


/**
 * Redirect Templates Categories
 */
function templates_category_redirect() {
	if ( is_tax( 'ms_templates_categories' ) ) {
		wp_safe_redirect( '/templates/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'templates_category_redirect' );


/**
	* Success Stories / Use case scenarios redirect
	We have to use ms_success-stories everywhere to preserve old DB records
	*/
function success_stories_category_redirect() {
	if ( is_tax( 'ms_success-stories_categories' ) ) {
		wp_safe_redirect( '/use-case-scenarios/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'success_stories_category_redirect' );

/**
	* Reviews
	*/
function reviews_category_redirect( $post_link, $post ) {
	if ( $post->post_type ) {
		$terms = wp_get_object_terms( $post->ID, 'ms_reviews_categories' );
		if ( $terms ) {
			return str_replace( '%ms_reviews_categories%', $terms[0]->slug, $post_link );
		}
	}
	return $post_link;
}
add_action( 'post_type_link', 'reviews_category_redirect', 1, 2 );

/**
	* Alternatives
	*/

function alternatives_category_redirect() {
	if ( is_tax( 'ms_alternatives_categories' ) ) {
		wp_safe_redirect( '/alternatives/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'alternatives_category_redirect' );


/**
 * Awards Single redirect
**/
function awards_single_redirect() {
	if ( is_singular( 'ms_awards' ) ) {
		wp_safe_redirect( '/awards/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'awards_single_redirect' );

/**
 * Webinars Single redirect
 **/
function webinars_single_redirect() {
	if ( is_singular( 'ms_webinars' ) ) {
		wp_safe_redirect( '/webinars/', 301 );
		exit;
	}
}
add_action( 'template_redirect', 'webinars_single_redirect' );
