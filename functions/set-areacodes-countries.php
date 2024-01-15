<?php

// Using package of countries from https://www.npmjs.com/package/world_countries_lists
// Country regions (like Zilinsky kraj or New Hampshire) are defined in subdivisions.php
// Function return an array about country by providing parameter like search_country(array('name' => 'France'));


// Function to insert country data into WordPress

function insert_areacodes_data() {
	// Path to CSV file

	require get_template_directory() . '/functions/us-states.php';
	

	$countries_posts = get_posts(
		array(
			'post_type' => 'ms_ac_countries',
			'fields'    => 'ids',
		)
	);
	
	if ( count( $countries_posts ) === 0 ) {
		$csv_file = get_template_directory() . '/countries.csv';
		// Read CSV file
		$countries = array_map( 'str_getcsv', file( $csv_file ) );
		foreach ( $countries as $country ) {

			$name           = $country[0];
			$calling_prefix = $country[10];
			$iso_code       = strtolower( $country[2] );
			$region_name    = $country[11];

	
			// Check if the region category exists, create if not
			$region_term = term_exists( $region_name, 'ms_areacodes_regions' );

			if ( ! $region_term && 'Unknown' !== $region_name ) {
				$region_term = wp_insert_term( $region_name, 'ms_areacodes_regions' );
			}
	
			// Insert country as a custom post type
			if ( 'Unknown' !== $region_name ) {
				$post_id = wp_insert_post(
					array(
						'post_title'  => $name,
						'post_type'   => 'ms_ac_countries',
						'post_status' => 'publish',
					)
				);
		
				// Save international calling prefix as post meta
				update_post_meta( $post_id, 'calling_prefix', $calling_prefix );
	
					// Save meta iso code
				update_post_meta( $post_id, 'iso_code', $iso_code );
			}
	
			// Assign the country to the region category
			if ( $region_term['term_id'] ) {
				wp_set_post_terms( $post_id, array( $region_term['term_id'] ), 'ms_areacodes_regions' );
			}
		}
	}

	$states_posts = get_posts(
		array(
			'post_type' => 'ms_ac_us_states',
			'fields'    => 'ids',
		)
	);
	
	if ( count( $states_posts ) === 0 ) {
		foreach ( $us_states as $state => $values ) {
	
			// Insert state as a custom post type
			$post_id = wp_insert_post(
				array(
					'post_title'  => $state,
					'post_type'   => 'ms_ac_us_states',
					'post_status' => 'publish',
				)
			);
		}
	}

	$areacode_posts = get_posts(
		array(
			'post_type' => 'ms_areacodes',
			'fields'    => 'ids',
		)
	);

	if ( count( $areacode_posts ) === 0 ) {
		foreach ( $us_states as $state => $values ) {

			foreach ( $values['area_codes'] as $areacode ) {
				// Insert state as a custom post type
					$post_id = wp_insert_post(
						array(
							'post_title'  => $areacode,
							'post_type'   => 'ms_areacodes',
							'post_status' => 'publish',
							'post_name'   => 'us_' . $areacode,
						)
					);
				
					// Save state capital as post meta
					update_post_meta( $post_id, 'state', $state );
			}   
		}
	}
}

if ( is_admin() ) {

	// // Run the function
	add_action( 'init', 'insert_areacodes_data', 0 );
}
