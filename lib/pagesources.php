<?php
// Blog page
set_source( 'single-post', 'pages/blog', 'css' );
set_source( 'single-post', 'common/splide', 'css' );
set_source( 'single-post', 'splide', 'js' );

set_source( 'single-post', 'custom_lightbox', 'js' );

// Archive type pages
$archive_type = array( 'archive', 'about', 'awards', 'testimonials', 'customers' );

foreach ( $archive_type as $specific_page ) {
	set_source( $specific_page, 'pages/Archive', 'css' );
}

// Post type page
set_source( 'post', 'pages/post', 'css' );
set_source( 'post', 'components/SidebarTOC', 'css' );
set_source( 'post', 'components/SignupSidebar', 'css' );
set_source( 'post', 'splide', 'js' );
set_source( 'post', 'custom_lightbox', 'js' );

// Article (success stories)
set_source( 'single-ms_success-stories', 'pages/SuccessStoriesArticle', 'css' );

// Features, Academy, Integrations, Templates
$category_pages = array( 'features', 'glossary', 'academy', 'integrations', 'reviews', 'templates' );

foreach ( $category_pages as $pagename ) {
	set_source( 'single-ms_' . $pagename, 'common/splide', 'css' );
	set_source( 'single-ms_' . $pagename, 'splide', 'js' );
}

// Pricing page
//set_source( 'pricing', 'pages/pricing', 'css' );
//set_source( 'pricing', 'pricing', 'js' );
set_source( 'pricing', 'pages/PricingNew', 'css' );
set_source( 'pricing', 'pricingNew', 'js' );
//set_source( 'enterprise', 'pages/PricingNew', 'css' );
//set_source( 'enterprise', 'pricingNew', 'js' );

//Startups page
set_source( 'startups', 'pages/Startups', 'css' );
