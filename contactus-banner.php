<?php
	// Array of available ContactUs banner images
	$contactus_banner_images = array(
		'black-friday-2025-bg-black-man-mini-banner.png',
		'black-friday-2025-bg-white-woman-mini-banner.png',
		'black-friday-2025-bg-assian-woman-mini-banner.png',
	);

	// Shuffle images randomly - professional approach like header-banners.php
	shuffle( $contactus_banner_images );
	$random_image = $contactus_banner_images[0];

	// Check if we're on pricing page
	$is_pricing_page = is_page( 'pricing' ) || ( isset( $_SERVER['REQUEST_URI'] ) && strpos( $_SERVER['REQUEST_URI'], '/pricing' ) !== false );
	$pricing_class = $is_pricing_page ? 'ContactUsBanner--pricing' : '';
	?>

<div class="ContactUsBanner <?php echo esc_attr( $pricing_class ); ?>">
	<a href="<?= esc_url( __( '/black-friday/', 'ms' ) ); ?>" class="ContactUsBanner__link" style="background-image: url('<?= esc_url( get_template_directory_uri() . '/assets/images/' . $random_image ); ?>');">
		<div class="ContactUsBanner__wrapper wrapper">
			<h2 class="ContactUsBanner__title text-stroke-primary"><?= esc_html( __( 'Black Friday', 'ms' ) ); ?></h2>
			<h3 class="ContactUsBanner__subtitle"><?= esc_html( __( '75% OFF', 'ms' ) ); ?></h3>
		</div>
	</a>
</div>
