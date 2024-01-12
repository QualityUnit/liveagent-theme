<?php
global $pagenow;


// Using package of countries from https://www.npmjs.com/package/world_countries_lists
// Country regions (like Zilinsky kraj or New Hampshire) are defined in subdivisions.php
// Function return an array about country by providing parameter like search_country(array('name' => 'France'));


// Function to insert country data into WordPress

function insert_countries() {
	// Path to CSV file
	$csv_file = get_template_directory() . '/countries.csv';
	// Read CSV file
	$countries = array_map( 'str_getcsv', file( $csv_file ) );

	$countries_posts = get_posts(
		array(
			'post_type'      => 'ms_ac_countries',
			'posts_per_page' => 50,
		)
	);
	
	foreach ( $countries as $country ) {
		if ( count( $countries_posts ) !== 0 ) {
			break;
		}

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

function insert_us_states() {
	require get_template_directory() . '/functions/us-states.php';

	$states_posts = get_posts(
		array(
			'post_type'      => 'ms_ac_us_states',
			'posts_per_page' => 80,
		)
	);
	
	foreach ( $us_states as $state => $values ) {
		if ( count( $states_posts ) !== 0 ) {
			break;
		}

		$name       = $state;
		$capital    = $values['major_city'];
		$gtm_diff   = $values['gmt_timezone_diff'];
		$area_codes = $values['area_codes'];

	
		// Insert state as a custom post type
			$post_id = wp_insert_post(
				array(
					'post_title'  => $name,
					'post_type'   => 'ms_ac_us_states',
					'post_status' => 'publish',
				)
			);
		
			// Save state capital as post meta
			update_post_meta( $post_id, 'capital', $capital );
	
			// Save GTM time difference as meta
			update_post_meta( $post_id, 'gtm_diff', $gtm_diff );

			// Save Area codes as meta
			update_post_meta( $post_id, 'area_codes', $area_codes );
	}
}

if ( is_admin() ) {

	// Run the function with the path to your CSV file
	add_action( 'init', 'insert_countries', 0 );
	add_action( 'init', 'insert_us_states', 0 );
}
