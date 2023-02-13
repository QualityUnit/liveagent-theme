<?php

/**
 * Setup variables
 */
define( 'THEME_VERSION', '1.9.28' );

/**
 * Includes
 */

$theme_includes = array(
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
	'functions/main.php', // Other includes
	'functions/rest-api.php', // Rest API mods
	'functions/post-query-mods.php', // Post Query mods
	'functions/redirects.php', // Taxonomies Redirects
	'functions/content-filters-functions.php', // Content filters functions
	'functions/content-filters.php', // Content filters
	'functions/content-filters-learn-more.php', // Content filters for Block--learnMore
	'functions/components-imports.php', // Import CSS and JS for blocks or components on page
	'functions/sideribbon-arrow.php', // Adds SVG with bookmark like ending
	'functions/import-functions.php', // Partials JS and SCSS import functions
	'functions/get-posts.php', // Function to get posts by ID (ie to be used in metaboxes functions)
	'functions/sidebar-toc.php', // TOC sidebar in features, integrations, blogs etc.
	'functions/taxonomies.php', // Import Custom Taxonomies
	'functions/post-types.php', // Import Custom Post Types
	'functions/metaboxes.php', // Import Metaboxes
	'functions/shortcodes.php', // Import ShortCodes
	'functions/sitemap-filters.php', // Sitemap XML filters for YOAST SEO (https://developer.yoast.com/features/xml-sitemaps/api/)
	'functions/widgets.php', // Import Widgets/Plugins
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
	function( $config ) {
		if ( defined( 'ELEMENTOR_VERSION' ) && did_action( 'admin_init' ) && get_current_screen()->id === 'wpml_page_tm/menu/translations-queue' ) {
			$config['wpautop'] = false;
		}

		return $config;
	}
);
