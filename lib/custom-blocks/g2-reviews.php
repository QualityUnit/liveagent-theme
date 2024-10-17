<?php
// Path to the image stored on the server
$image_url = get_template_directory_uri() . '/assets/images/reviews/g2-reviews-img.png';
?>

	<a class="Footer__middle__reviews__img" href="https://www.g2.com/products/liveagent/reviews?utm_source=review-widget" target="_blank" title="Read reviews of LiveAgent on G2">
		<img src="<?php echo esc_url( $image_url ); ?>" alt="Read LiveAgent reviews on G2">
	</a>

<?php
// Path to the JSON file on the server
$json_file = get_template_directory() . '/assets/i18n/g2-reviews/g2-reviews.json';

// Loading the content of the JSON file
if ( file_exists( $json_file ) ) {
	$json_content = file_get_contents( $json_file );
	// Ensure the JSON-LD content is safely escaped before output
	echo '<script type="application/ld+json">' . wp_kses_post( $json_content ) . '</script>';
}
?>
