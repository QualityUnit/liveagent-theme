<?php

$ms_options_page = array(
	'slug'       => 'ms_theme',
	'title'      => 'Theme Settings',
	'menuname'   => 'Theme Settings',
	'capability' => 'edit_posts',
	'sections'   => array(

		array(
			'id'     => 'ms_strings_options',
			'name'   => 'Strings',
			'fields' => array(

				array(
					'id'      => 'ms_strings_migrations',
					'label'   => 'List of Migrations',
					'type'    => 'editor',
					'default' => '',
				),

				array(
					'id'      => 'ms_strings_alternatives',
					'label'   => 'List of Alternatives',
					'type'    => 'editor',
					'default' => '',
				),

				array(
					'id'      => 'ms_strings_cc_features',
					'label'   => 'List of Call Center Features',
					'type'    => 'editor',
					'default' => '',
				),

			),
		),

	),
);

if ( class_exists( 'trueOptionspage' ) ) {
	new trueOptionspage( $ms_options_page );
}
