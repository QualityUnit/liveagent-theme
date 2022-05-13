<?php
	namespace Roots\Sage\Setup;

/**
	* Theme setup
	*/

add_action(
	'after_setup_theme',
	function () {
		// Enable features from Soil when plugin is activated
		// https://roots.io/plugins/soil/
		add_theme_support(
			'soil',
			array(
				'clean-up',
				'disable-trackbacks',
				'js-to-footer',
				'nice-search',
			)
		);

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'editor-style.css' );

		// Make theme available for translation
		load_theme_textdomain( 'ms', get_template_directory() . '/lang' );

		// Enable plugins to manage the document title
		// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
		add_theme_support( 'title-tag' );

		// Register wp_nav_menu() menus
		// http://codex.wordpress.org/Function_Reference/register_nav_menus
		register_nav_menus(
			array(
				'header_navigation'        => __( 'Header Navigation', 'ms' ),
				'header_navigation_mobile' => __( 'Header Navigation - Mobile', 'ms' ),
				'footer_bottom_navigation' => __( 'Footer Bottom Navigation', 'ms' ),
				'blog_filter_navigation'   => __( 'Blog Filter Navigation', 'ms' ),
			)
		);

		// Enable post thumbnails
		// http://codex.wordpress.org/Post_Thumbnails
		// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		// http://codex.wordpress.org/Function_Reference/add_image_size
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'archive_thumbnail', 185, 50 );
		add_image_size( 'archive_small_thumbnail', 175, 25 );
		add_image_size( 'blog_thumbnail', 380, 380, array( 'center', 'center' ) );
		add_image_size( 'blog_post_thumbnail', 960, 335 );
		add_image_size( 'box_archive_thumbnail', 700, 400 );
		add_image_size( 'logo_thumbnail', 185, 185 );
		add_image_size( 'logo_small_thumbnail', 110, 110 );
		add_image_size( 'person_thumbnail', 485, 485 );

		// Enable post formats
		// http://codex.wordpress.org/Post_Formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

		// Enable HTML5 markup support
		// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
		add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'script' ) );

		// Use main stylesheet for visual editor
		// add_editor_style( get_template_directory_uri() . '/assets/dist/app.css' );
	}
);


/**
	* Register sidebars
	*/

add_action(
	'widgets_init',
	function () {
		register_sidebar(
			array(
				'name'          => __( 'Footer Column #1', 'ms' ),
				'id'            => 'footer_column_1',
				'before_widget' => '<div class="%1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="Footer__top__column__title Footer__top__column__title--image h4"><img src="' . get_template_directory_uri() . '/assets/images/logo_liveagent.svg" alt="' . get_bloginfo( 'name' ) . '">',
				'after_title'   => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column #2', 'ms' ),
				'id'            => 'footer_column_2',
				'before_widget' => '<div class="%1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="Footer__top__column__title h4">',
				'after_title'   => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column #3', 'ms' ),
				'id'            => 'footer_column_3',
				'before_widget' => '<div class="%1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="Footer__top__column__title h4">',
				'after_title'   => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column #4', 'ms' ),
				'id'            => 'footer_column_4',
				'before_widget' => '<div class="%1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="Footer__top__column__title h4">',
				'after_title'   => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer Column #5', 'ms' ),
				'id'            => 'footer_column_5',
				'before_widget' => '<div class="%1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="Footer__top__column__title h4">',
				'after_title'   => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Header Language Switcher', 'ms' ),
				'id'            => 'header_flags',
				'before_widget' => '<div class="%1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="Header__flags__title h4">',
				'after_title'   => '</div>',
			)
		);
	}
);
