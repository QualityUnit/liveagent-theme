<?php

/**
 * IconTabs block CSS and JS importer
 */

function icontabs_sources( $content ) {
	$icontabs_block = preg_match( '/\<section.+class=".+IconTabs.+/', $content );

	if ( $icontabs_block || is_user_logged_in() ) {
		wp_enqueue_style( 'icontabs', get_template_directory_uri() . '/assets/dist/components/IconTabs' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		wp_enqueue_script( 'icontabs', get_template_directory_uri() . '/assets/dist/IconTabs' . wpenv() . '.js', false, THEME_VERSION, true );
	}
		return $content;
}

add_filter( 'the_content', 'icontabs_sources' );
add_action( 'admin_enqueue_scripts', 'icontabs_sources' );

/**
 * Alternatives Table block CSS importer
 */

function alternative_table( $content ) {
	$alternativetable = preg_match( '/.+class=".+AlternativeTable.+/', $content );

	if ( $alternativetable || is_user_logged_in() ) {
		wp_enqueue_style( 'alternativetable', get_template_directory_uri() . '/assets/dist/components/AlternativeTable' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'alternative_table' );
add_action( 'admin_enqueue_scripts', 'alternative_table' );


/**
 * Softphone Table block CSS importer
 */

function softphone_table( $content ) {
	$softphonetable = preg_match( '/.+class=".+SoftphoneTable.+/', $content );

	if ( $softphonetable || is_user_logged_in() ) {
		wp_enqueue_style( 'softphonetable', get_template_directory_uri() . '/assets/dist/components/SoftphoneTable' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'softphone_table' );
add_action( 'admin_enqueue_scripts', 'softphone_table' );

/**
 * Blockpoints Table block CSS importer
 */

function blockpoints( $content ) {
	$blockpoints = preg_match( '/.+class=".+BlockPoints.+/', $content );

	if ( $blockpoints || is_user_logged_in() ) {
		wp_enqueue_style( 'blockpoints', get_template_directory_uri() . '/assets/dist/components/BlockPoints' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'blockpoints' );
add_action( 'admin_enqueue_scripts', 'blockpoints' );

/* Features table in Call center */

function features_table( $content ) {
	$features_table = preg_match( '/.+class=".+FeaturesTableNew.+/', $content );

	if ( $features_table || is_user_logged_in() ) {
		wp_enqueue_style( 'featurestable', get_template_directory_uri() . '/assets/dist/components/FeaturesTable-New' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'features_table');
add_action( 'admin_enqueue_scripts', 'features_table' );

/* Hero banner – to be removed*/

function herobanner( $content ) {
	$herobanner = preg_match( '/.+class=".+HeroBanner.+/', $content );

	if ( $herobanner || is_user_logged_in() ) {
		wp_enqueue_style( 'herobanner', get_template_directory_uri() . '/assets/dist/components/HeroBanner' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'herobanner' );
add_action( 'admin_enqueue_scripts', 'herobanner' );


/* Block Video */

function block_video( $content ) {
	$block_video = preg_match( '/.+class=".+Block--video.+/', $content );

	if ( $block_video || is_user_logged_in() ) {
		wp_enqueue_style( 'blockvideo', get_template_directory_uri() . '/assets/dist/components/BlockVideo' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'block_video' );
add_action( 'admin_enqueue_scripts', 'block_video' );


/* Boxes with image */

function boxes_image( $content ) {
	$boxes_image = preg_match( '/.+class=".+Boxes--image.+/', $content );

	if ( $boxes_image || is_user_logged_in() ) {
		wp_enqueue_style( 'blockvideo', get_template_directory_uri() . '/assets/dist/components/BoxesImage' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'boxes_image' );
add_action( 'admin_enqueue_scripts', 'boxes_image' );
