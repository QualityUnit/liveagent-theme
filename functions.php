<?php

/**
 * Setup variables
 */
define( 'THEME_VERSION', '1.25.108' );

/**
 * Includes
 */

$theme_includes = array(
	'functions/detectmobilebrowser.php',             // Detects mobile
	'functions/content-filters-functions.php', // Content filters functions
	'functions/content-filters.php', // Content filters
	'functions/content-filters-learn-more.php', // Content filters for Block--learnMore
	'functions/import-functions.php', // Partials JS and SCSS import functions
	'functions/urlslab-related-posts.php', // Related posts
	'lib/assets.php',             // Scripts and stylesheets
	'lib/extras.php',             // Custom functions
	'lib/setup.php',              // Theme setup
	'lib/wrapper.php',            // Theme wrapper class
	'lib/cleaner/assets.php',     // Clean assets
	'lib/cleaner/comments.php',   // Disable comments
	'lib/cleaner/emojis.php',     // Disable emojis
	'lib/cleaner/oembed.php',     // Disable oembed
	'lib/cleaner/wordpress.php',  // Clean WordPress things
	'lib/cleaner/wpml.php',       // Clean WPML things
	'lib/cleaner/yoast.php',      // Clean Yoast things
	'lib/trial-signup/class-trial-signup.php', // Trial signup php submission
	'functions/main.php', // Other includes
	'functions/rest-api.php', // Rest API mods
	'functions/post-query-mods.php', // Post Query mods
	'functions/redirects.php', // Taxonomies Redirect
	'functions/sideribbon-arrow.php', // Adds SVG with bookmark like ending
	'functions/get-posts.php', // Function to get posts by ID (ie to be used in metaboxes functions)
	'functions/sidebar-toc.php', // TOC sidebar in features, integrations, blogs etc.
	'functions/compact-header-toc.php', // compact header TOC
	'functions/taxonomies.php', // Import Custom Taxonomies
	'functions/post-types.php', // Import Custom Post Types
	'functions/metaboxes.php', // Import Metaboxes
	'functions/shortcodes.php', // Import ShortCodes
	'functions/sitemap-filters.php', // Sitemap XML filters for YOAST SEO (https://developer.yoast.com/features/xml-sitemaps/api/)
	'functions/widgets.php', // Import Widgets/Plugins
	'functions/remove-base-classes.php', // Remove base classes
	'functions/get-cta-button-data.php', // Get data from metaboxes for cta button in the compact header
	'functions/header-banners.php', // Shows banners on selected pages
	'functions/create-language-menu.php', // Function for generate languages
	'functions/dynamic-award-badges.php', // Function to place award badges dynamically
	'functions/get-archive-items-images.php', // Get backgrounds for item on  the archive pages
	'functions/check-parent-child-slug.php', // Checking pages and subpages for compliance with the slug
	'functions/disable-speculative-loading.php', // Disable speculative loading

);

foreach ( $theme_includes as $file ) {
	$filepath = locate_template( $file );

	if ( ! $filepath ) {
		trigger_error( sprintf( esc_html( __( 'Error locating %s for inclusion', 'urlslab' ) ), esc_url( $file ) ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );


/**
 * TEMP: Fix for Visual/Text toggle removes paragraph tags on translations and shows on one line
 */

add_filter(
	'tiny_mce_before_init',
	function ( $config ) {
		if ( defined( 'ELEMENTOR_VERSION' ) && did_action( 'admin_init' ) && get_current_screen()->id === 'wpml_page_tm/menu/translations-queue' ) {
			$config['wpautop'] = false;
		}

		return $config;
	}
);
