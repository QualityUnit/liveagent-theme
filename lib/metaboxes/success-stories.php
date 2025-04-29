<?php

$metabox = array(
	'id'         => 'mb_success-stories',
	'capability' => 'edit_posts',
	'name'       => 'Details',
	'post_type'  => array( 'ms_success-stories' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'mb_success-stories-headline',
			'label'       => 'Headline',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-image',
			'label'       => 'Featured Image for Success Stories',
			'description' => '',
			'type'        => 'image',
		),
		array(
			'id'          => 'mb_success-stories-text',
			'label'       => 'Short description',
			'description' => '',
			'cols'        => 43,
			'class'       => 'textarea',
			'maxlength'   => 256,
			'type'        => 'textarea',
		),
		array(
			'id'          => 'mb_success-stories-active-shortcode',
			'label'       => 'Activate for "Success Stories" shortcode',
			'description' => '',
			'type'        => 'checkbox',
			'default'     => 'off',
		),
		array(
			'id'          => 'mb_success-stories-website',
			'label'       => 'Company Website',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-insta',
			'label'       => 'Company Instagram',
			'description' => '',
			'default'     => 'https://www.instagram.com/',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-fb',
			'label'       => 'Company Facebook',
			'description' => '',
			'default'     => 'https://www.facebook.com/',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-twitter',
			'label'       => 'Company Twitter',
			'description' => '',
			'default'     => 'https://twitter.com/',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-linkedin',
			'label'       => 'Company LinkedIn',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-yt',
			'label'       => 'Company YouTube',
			'description' => '',
			'default'     => 'https://www.youtube.com/user/',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-founded',
			'label'       => 'Founded',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-headquarters',
			'label'       => 'Headquarters',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'mb_success-stories-region',
			'label'       => 'Region',
			'description' => '',
			'type'        => 'multiselect',
			'args'        => array(
				'WorldWide'     => 'worldwide',
				'Europe'        => 'europe',
				'North America' => 'northamerica',
				'South America' => 'southhamerica',
				'Asia'          => 'asia',
				'Middle East'   => 'middleeast',
				'Pacific'       => 'pacific',
			),
		),
	),
);

$author = array(
	'id'         => 'mb_ss-author',
	'capability' => 'edit_posts',
	'name'       => 'Author',
	'post_type'  => array( 'ms_success-stories' ),
	'priority'   => 'high',
	'args'       => array(
		array(
			'id'          => 'image',
			'label'       => 'Photo',
			'description' => '',
			'type'        => 'image',
		),
		array(
			'id'          => 'name',
			'label'       => 'Name',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'position-company',
			'label'       => 'Position, company',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'about',
			'label'       => 'About author',
			'description' => '',
			'cols'        => 43,
			'class'       => 'textarea',
			'maxlength'   => 256,
			'type'        => 'textarea',
		),
		array(
			'id'          => 'email',
			'label'       => 'Email',
			'description' => '',
			'maxlength'   => 50,
			'type'        => 'text',
		),
		array(
			'id'          => 'phone',
			'label'       => 'Phone',
			'description' => '',
			'type'        => 'text',
		),
		array(
			'id'          => 'linkedin',
			'label'       => 'LinkedIn URL',
			'description' => '',
			'default'     => 'https://www.linkedin.com/',
			'type'        => 'text',
		),
	),
);

add_filter( 'simple_register_metaboxes', 'single_sidebar_info' );

function single_sidebar_info( $info ) {
	$info[] = array(
		'id'        => 'mb_ss-company',
		'name'      => 'Information about company (sidebar in single post)',
		'post_type' => array( 'ms_success-stories' ),
		'opened'    => false,
		'fields'    => array(
			array(
				'id'          => 'description',
				'label'       => 'Company description',
				'description' => '',
				'cols'        => 50,
				'type'        => 'textarea',
			),
			array(
				'id'          => 'location',
				'label'       => 'Company location',
				'description' => '',
				'default'     => '',
				'type'        => 'text',
			),
			array(
				'id'          => 'features',
				'label'       => 'Company key features',
				'description' => '',
				'type'        => 'repeater',
				'subfields' => array(
					array(
						'id'          => 'name',
						'label'       => 'Name',
						'description' => '',
						'type'        => 'text',
					),
					array(
						'id'          => 'url',
						'label'       => 'URL',
						'description' => '',
						'type'        => 'text',
					),
				),
			),
		),
	);

	return $info;
}

new trueMetaBox( $author );
new trueMetaBox( $metabox );
