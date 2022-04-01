<?php
header( 'Access-Control-Allow-Origin: *' );
header( 'Access-Control-Allow-Methods: GET, OPTIONS, PUT, DELETE' );
header( 'Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With' );
header( 'Content-Type: application/json; charset=UTF-8' );

// $rest_json = file_get_contents( 'php://input' );
// $_GET = json_decode( $rest_json, true );

if ( empty( $_GET['email'] ) ) {
	die();
}

// if ( $_GET ) {
	http_response_code( 200 );

	define( 'API_URL_ADDRESS', 'https://support.qualityunit.com/api/v3/' );
	define( 'API_ACCESS_KEY', 'wm716ft436p4qebyir36t3c9av0coy8o' );
	define( 'API_DEPARTMENT_ID', 'd564fd60' );
	define( 'API_RECIPIENT_MAIL', 'sales@liveagent.com' );

if ( isset( $_GET['email'] ) ) {
	$visitor_email = $_GET['email'];
}

if ( isset( $_GET['agents'] ) ) {
	$agents = $_GET['agents'];
}

if ( isset( $_GET['features'] ) ) {
	$features = $_GET['features'];
}

	// validate first
if ( empty( $visitor_email ) ) {
		echo json_encode(
			array(
				'response' => 'ERROR',
				'message' => 'Email is mandatory!',
			)
		);
		exit;
}

if ( is_injected( $visitor_email ) ) {
		echo json_encode(
			array(
				'response' => 'ERROR',
				'message' => 'Bad email value!',
			)
		);
		exit;
}

	// create API data for new ticket
	$data = array(
		'useridentifier' => $visitor_email,
		'subject' => 'Custom pricing request from Web Calc',
		'departmentid' => API_DEPARTMENT_ID,
		'recipient' => API_RECIPIENT_MAIL,
		'message' => "User $visitor_email \n\n" . "Asking for custom pricing for:\n\n $agents agents\n\nSelected features: $features",
		'status' => 'N',
	);

	create_api_ticket( $data );
	// }

	/**
		 * main function to create ticket with API
		 *
		 * @param array $post_data
		 */

	function create_api_ticket( $post_data ) {
		$headers = array(
			'Accept:application/json',
			'Content-Type:application/json',
			'apikey:' . API_ACCESS_KEY,
		);
		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, API_URL_ADDRESS . 'tickets' );
		// curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post_data ) );

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$server_output = curl_exec( $ch );
		$server_output = json_decode( $server_output );

		curl_close( $ch );

		if ( $server_output->message ) {
			//	returns error message
			echo json_encode(
				array(
					'response' => 'ERROR',
					'message' => $server_output->message,
				)
			);
		} else {
			// success response
			echo json_encode( array( 'response' => 'OK' ) );
		}
		die;
	}
	/**
	 * function to validate against any email injection attempts
	 * @param string $input
	 * @return boolean
	 */
	function is_injected( $input ) {
		$injections = array(
			'(\n+)',
			'(\r+)',
			'(\t+)',
			'(%0A+)',
			'(%0D+)',
			'(%08+)',
			'(%09+)',
		);
		$inject = join( '|', $injections );
		$inject = "/$inject/i";
		if ( preg_match( $inject, $input ) ) {
				return true;
		} else {
			return false;
		}
	}
