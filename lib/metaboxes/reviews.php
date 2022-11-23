<?php

add_filter( 'simple_register_taxonomy_settings', 'add_reviews_taxonomy_metaboxes' );

function add_reviews_taxonomy_metaboxes( $settings ) {

	$query_args = array(
	'post_type' => 'ms_reviews',
	'posts_per_page' => -1,
	);

	$show_posts    = new WP_Query( $query_args );

	while ( $show_posts->have_posts() ) :
		$show_posts->the_post();
		$post_lang = apply_filters( 'wpml_post_language_details', NULL, get_the_id() );
		if ( 'en' === $post_lang['language_code'] ) {
			$reviews_posts[get_the_id()] = str_replace( '^','', get_the_title() );
		}
	endwhile;

	wp_reset_postdata();


	$settings[] = array(
		'id'       => 'ms_reviews_category',
		'taxonomy' => array( 'ms_reviews_categories' ),
		'fields'   => array(
			array(
				'id'    => 'icon',
				'label' => 'Icon',
				'type'  => 'image',
			),
			array(
				'id'          => 'category_description_title',
				'label'       => 'Category details title',
				'description' => 'Title in Level 2 category after reviews',
				'type'        => 'text',
			),
			array(
				'id'          => 'category_description',
				'label'       => 'Category details',
				'description' => 'Text in Level 2 category after reviews',
				'type'        => 'textarea',
			),
			array(
				'id'    => 'category_learn_more',
				'label' => 'Url text',
				'type'  => 'text',
			),
			array(
				'id'    => 'category_learn_more_url',
				'label' => 'Url to article',
				'type'  => 'text',
			),
			array(
				'id'          => 'category_whatis_article',
				'label'       => 'What is article (bottom)',
				'type'        => 'select',
				'placeholder' => 'Select What is Article',
				'options'     => $reviews_posts,
			),
		),
	);

	return $settings;
}

add_filter( 'simple_register_metaboxes', 'add_reviews_pricing' );

function add_reviews_pricing( $pricing ) {

	$pricing[] = array(
		'id'        => 'ms_reviews_pricing',
		'name'      => 'Pricing',
		'post_type' => 'ms_reviews',
		'fields'    => array(
			array(
				'id'      => 'currency',
				'label'   => 'Currency',
				'type'    => 'text',
				'default' => '$',
			),
			array(
				'id'        => 'price',
				'label'     => 'Price',
				'type'      => 'text',
				'maxlength' => 10,
			),
			array(
				'id'      => 'period',
				'label'   => 'Payment period',
				'type'    => 'text',
				'default' => 'per month',
			),
			array(
				'id'    => 'note',
				'label' => 'Note',
				'type'  => 'textarea',
				'cols'  => 50,
			),
			array(
				'id'          => 'equal_la_plan',
				'label'       => 'Equal to LiveAgent plan',
				'type'        => 'select',
				'placeholder' => 'Select equal LA plan',
				'options'     => array(
					'free'        => 'Free',
					'ticket'      => 'Ticket',
					'ticket_chat' => 'Ticket + Chat',
					'all'         => 'All inclusive',
				),
			),
			array(
				'id'    => 'free_trial',
				'label' => 'Free Trial',
				'type'  => 'checkbox',
			),
			array(
				'id'    => 'free_version',
				'label' => 'Free Version',
				'type'  => 'checkbox',
			),
		),
	);

	return $pricing;
}

add_filter( 'simple_register_metaboxes', 'add_reviews_reviews' );

function add_reviews_reviews( $reviews ) {
	$reviews[] = array(
		'id'        => 'ms_reviews_review',
		'name'      => 'Reviews',
		'post_type' => array( 'ms_reviews' ),
		'opened'    => false,
		'fields'    => array(
			array(
				'id'      => 'rating',
				'label'   => 'Overall rating',
				'type'    => 'number',
				'default' => 3.0,
				'min'     => 1,
				'max'     => 5,
				'step'    => 0.1,
			),
			array(
				'id'      => 'reviews_count',
				'label'   => 'Number of reviews',
				'type'    => 'number',
				'default' => 0,
				'min'     => 0,
				'max'     => 200000,
			),
			array(
				'id'    => 'last_update',
				'label' => 'Last update',
				'type'  => 'date',
			),
		),
	);

	return $reviews;
}

add_filter( 'simple_register_metaboxes', 'add_reviews_editor_rating' );

function add_reviews_editor_rating( $rating ) {
	$rating[] = array(
		'id'        => 'ms_reviews_rating',
		'name'      => 'Editor\'s rating',
		'post_type' => array( 'ms_reviews' ),
		'opened'    => false,
		'fields'    => array(
			array(
				'id'    => 'first_rating',
				'label' => 'First rating – name',
				'type'  => 'text',
			),
			array(
				'id'      => 'first_rating_value',
				'label'   => 'First rating – value',
				'type'    => 'number',
				'default' => 3.0,
				'min'     => 1,
				'max'     => 5,
				'step'    => 0.1,
			),
			array(
				'id'    => 'second_rating',
				'label' => 'Second rating – name',
				'type'  => 'text',
			),
			array(
				'id'      => 'second_rating_value',
				'label'   => 'Second rating – value',
				'type'    => 'number',
				'default' => 3.0,
				'min'     => 1,
				'max'     => 5,
				'step'    => 0.1,
			),
			array(
				'id'    => 'third_rating',
				'label' => 'Third rating – name',
				'type'  => 'text',
			),
			array(
				'id'      => 'third_rating_value',
				'label'   => 'Third rating – value',
				'type'    => 'number',
				'default' => 3.0,
				'min'     => 1,
				'max'     => 5,
				'step'    => 0.1,
			),
			array(
				'id'          => 'pros',
				'label'       => 'Pros',
				'description' => 'Every line represents new item',
				'type'        => 'textarea',
				'cols'        => 50,
			),
			array(
				'id'          => 'cons',
				'label'       => 'Cons',
				'description' => 'Every line represents new item',
				'type'        => 'textarea',
				'cols'        => 50,
			),
		),
	);

	return $rating;
}

add_filter( 'simple_register_metaboxes', 'add_reviews_media' );

function add_reviews_media( $media ) {

	$media[] = array(
		'id'        => 'ms_reviews_media',
		'name'      => 'Media',
		'post_type' => array( 'ms_reviews' ),
		'opened'    => false,
		'fields'    => array(
			array(
				'id'    => 'gallery',
				'label' => 'Gallery',
				'type'  => 'gallery',
			),
			array(
				'id'    => 'video',
				'label' => 'YouTube URL',
				'type'  => 'text',
			),
		),
	);

	return $media;
}

add_filter( 'simple_register_metaboxes', 'add_reviews_details' );

function add_reviews_details( $details ) {
	$query_args = array(
		'post_type' => 'ms_directory',
		'posts_per_page' => -1,
	);
	
	$show_posts    = new WP_Query( $query_args );

	while ( $show_posts->have_posts() ) :
		$show_posts->the_post();
		$post_lang = apply_filters( 'wpml_post_language_details', NULL, get_the_id() );
		if ( 'en' === $post_lang['language_code'] ) {
			$details_posts[get_the_id()] = str_replace( '^','', get_the_title() );
		}
	endwhile;
	wp_reset_postdata();

	$howitworks_args = array(
		'post_type' => 'ms_reviews',
		'posts_per_page' => -1,
	);

	$query_posts    = new WP_Query( $howitworks_args );

	while ( $query_posts->have_posts() ) :
		$query_posts->the_post();
		$post_lang = apply_filters( 'wpml_post_language_details', NULL, get_the_id() );
		if ( 'en' === $post_lang['language_code'] ) {
			$howitworks_posts[get_the_id()] = str_replace( '^','', get_the_title() );
		}
	endwhile;

	wp_reset_postdata();


	$details[] = array(
		'id'        => 'ms_reviews_details',
		'name'      => 'Details',
		'post_type' => array( 'ms_reviews' ),
		'opened'    => false,
		'fields'    => array(
			array(
				'id'          => 'details_contacts',
				'label'       => 'Directory Contacts',
				'type'        => 'select',
				'placeholder' => 'Select Directory post',
				'options'     => $details_posts,
			),
			array(
				'id'          => 'how_it_works',
				'label'       => 'How it works post below',
				'type'        => 'select',
				'placeholder' => 'Select How it works post',
				'options'     => $howitworks_posts,
			),
		),
	);

	foreach ( $details as $fields ) {
		foreach ( $fields['fields'] as $field ) {
			register_post_meta(
				'ms_reviews', 
				$field['id'], 
				array( 
					'single'       => true,
					'show_in_rest' => true,
				)
			);
		}
	}

	return $details;
}
