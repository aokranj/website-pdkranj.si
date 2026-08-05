<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'gb' === $wbg_api_from ) {
    //$url = "https://www.googleapis.com/books/v1/volumes?q=isbn:{$isbn}";
    $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:{$isbn}&key=$apiKey";
}

if ( 'ol' === $wbg_api_from ) {
    //$url = "https://openlibrary.org/isbn/{$isbn}.json";
    //$url = "https://openlibrary.org/api/books?bibkeys=ISBN:{$isbn}";
    $url = "http://openlibrary.org/api/books?bibkeys=ISBN:{$isbn}&jscmd=details&format=json";
}

//$call_api = wp_remote_get( $url );
//$data = (array) json_decode( wp_remote_retrieve_body( $call_api ) );

// Perform the GET request
$response = wp_remote_get( $url, array(
    'timeout' => 20,
    'headers' => array(
        //'Authorization' => 'Bearer YOUR_API_KEY', // Optional auth header
        'Accept'        => 'application/json',
    )
) );

// Check for WordPress system errors (e.g., cURL timeout, invalid URL)
if ( is_wp_error( $response ) ) {
    return 'Error: Unable to reach the API.';
}

$response_code = wp_remote_retrieve_response_code( $response );

if ( $response_code !== 200 ) {
    return 'Error: Received server code ' . $response_code;
}

$body = wp_remote_retrieve_body( $response );
$data = json_decode( $body, true );

//echo '<pre>';
//print_r( $data );

if ( 'gb' === $wbg_api_from ) {

    if( ! empty( $data['items'][0]['volumeInfo'] ) ){

        $books[] = $data['items'][0]['volumeInfo'];
    }
}

if ( 'ol' === $wbg_api_from ) {
    
    if ( ! empty( $data["ISBN:{$isbn}"]['details'] ) ) {

        $books[] = $data["ISBN:{$isbn}"]['details'];
    }
}

// Prevent rate limiting
usleep(300000); // 0.3 second
?>