<?php

/**
 * IconTabs block CSS and JS importer
 */

function icontabs_sources( $content ) {
	$icontabs_block = preg_match( '/\<section.+class=".+IconTabs.+/', $content );

	if ( $icontabs_block || is_user_logged_in() ) {
		wp_enqueue_style( 'icontabs', get_template_directory_uri() . '/assets/dist/components/IconTabs' . isrtl() . wpenv() . '.css', false, THEME_VERSION );
	}
		return $content;
}

add_filter( 'the_content', 'icontabs_sources' );
add_action( 'admin_enqueue_scripts', 'icontabs_sources' );


function components_imports( $content ) {
	// $content = apply_filters( 'the_content', get_the_content() );
	
	$blocks = array(
		'table'                         => 'components/Table',
		'SoftphoneTable'                => 'components/SoftphoneTable',
		'BlockPoints'                   => 'components/BlockPoints',
		'BlogCTA'                       => 'components/BlogCTA',
		'FeaturesTableNew'              => 'components/FeaturesTable-New',
		'HeroBanner'                    => 'components/HeroBanner',
		'Block--video'                  => 'components/BlockVideo',
		'GutenbergVideo'                => 'components/GutenbergVideo',
		'BlockSuccess'                  => 'components/BlockSuccess',
		'Boxes'                         => 'components/Boxes',
		'Boxes--image'                  => 'components/BoxesImage',
		'Boxes--dotted'                 => 'components/BoxesDotted',
		'Boxes--stars'                  => 'components/BoxesStars',
		'RequestDemo'                   => 'layouts/tests/RequestDemo',
		'ScheduleDemo'                  => 'layouts/tests/ScheduleDemo',
		'BlockCoupon'                   => 'components/BlockCoupon',
		'IconList'                      => 'components/IconList',
		'urlslab-block-tableofcontents' => 'components/UrlslabTOC',
		'pricing-ai-assistant-banner'   => 'components/AiAssistantPricing',
		'TourPageNumbers'               => 'components/TourPageNumbers',
		'TourPageCTA'                   => 'components/TourPageCTA',
		'HelpDesk'                      => 'layouts/HelpDesk',
		'trialAd'                       => 'components/TrialBanner',
		'Block--research'               => 'components/BlockResearch',
		'Numbers'                       => 'components/Numbers',
		'BlockChannels'                 => 'components/BlockChannels',
		'FullHeadline'                  => 'components/FullHeadline',
		'BlockResources'                => 'components/BlockResources',
		'BannerTypingTest'              => 'components/BannerTypingTest',
		'Block--switcher'               => 'components/BlockSwitcher',
		'Reference'                     => 'components/Reference',
		'BlockSolution'                 => 'components/BlockSolution',
		'BlockSolutions'                => 'components/BlockSolutions',
	);

	// Array value in form of array, first is script name, second is dependency id
	$scripts = array(
		'/\<section.+class=".+IconTabs.+/' => array( 'IconTabs' ),
		'[data-lightbox="gallery"]'        => array( 'splide' ),
		'[data-lightbox="youtube"]'        => array( 'splide' ),
		'/data-lightbox="gallery/'         => array( 'custom_lightbox', 'splide' ),
		'/data-lightbox="youtube/'         => array( 'custom_lightbox_youtube', 'splide' ),
		'/class=.+Block--video/'           => array( 'custom_lightbox_youtube', 'splide' ),
		'/class=.+GutenbergVideo/'         => array( 'custom_lightbox_youtube', 'splide' ),
		'/\<table.+/'                      => array( 'responsiveTable' ),
	);

	if ( ! $content ) {
		return $content;
	}

	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
	libxml_clear_errors();
	$xpath = new DOMXPath( $dom );
	
	foreach ( $blocks as $class => $csspath ) {
		$id           = strtolower( $class );
		$found_blocks = $xpath->query( './/*[contains(@class, "' . $class . '")]' );
	
		if ( isset( $found_blocks[0] ) || ( isset( $_GET['action'] ) && ( 'edit' === $_GET['action'] || 'elementor' === $_GET['action'] ) ) ) {
			wp_enqueue_style( $id, get_template_directory_uri() . '/assets/dist/' . $csspath . isrtl() . wpenv() . '.css', false, THEME_VERSION );
		}
	}

	foreach ( $scripts as $selector => $runscript ) {
		$found_blocks = preg_match( $selector, $content );
		if ( $found_blocks || ( isset( $_GET['action'] ) && ( 'edit' === $_GET['action'] || 'elementor' === $_GET['action'] ) ) ) {
			set_custom_source( $runscript[0], 'js', isset( $runscript[1] ) );
		}
	}

	$dom->removeChild( $dom->doctype );
	$content = $dom->saveHtml();
	$content = str_replace( '<html><body>', '', $content );
	$content = str_replace( '</body></html>', '', $content );
	return $content;
}

add_action( 'the_content', 'components_imports' );
add_action( 'admin_enqueue_scripts', 'components_imports' );
