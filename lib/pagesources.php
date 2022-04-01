<?php
// Blog page
set_source( 'blog', 'pages/blog', 'css' );
set_source( 'search', 'pages/blog', 'css' );
set_source( 'single-post', 'common/splide', 'css' );
set_source( 'single-post', 'splide', 'js' );
set_source( 'single-post', 'sidebar_toc', 'js' );
set_source( 'single-post', 'custom_lightbox', 'js' );

// Archive type pages
$archive_type = array( 'archive', 'about', 'awards', 'testimonials', 'customers' );

foreach ( $archive_type as $specific_page ) {
	set_source( $specific_page, 'pages/Archive', 'css' );
}

// Post type page
set_source( 'post', 'pages/post', 'css' );
set_source( 'post', 'splide', 'js' );
set_source( 'post', 'custom_lightbox', 'js' );

// Article (success stories)
set_source( 'single-ms_success-stories', 'pages/SuccessStoriesArticle', 'css' );

// Features, Academy, Integrations, Templates
$category_pages = array( 'features', 'glossary', 'academy', 'integrations', 'templates' );

foreach ( $category_pages as $pagename ) {
	set_source( 'single-ms_' . $pagename, 'common/splide', 'css' );
	set_source( 'single-ms_' . $pagename, 'splide', 'js' );
	set_source( 'single-ms_' . $pagename, 'sidebar_toc', 'js' );
}

// Pricing page
set_source( 'pricing', 'pages/pricing', 'css' );
set_source( 'pricing', 'pricing', 'js' );
