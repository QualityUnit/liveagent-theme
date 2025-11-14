<?php
	set_custom_source( 'components/BlackFridayBanner', 'css' );
	set_custom_source( 'blackfridaybanner', 'js', array( 'app_js' ) );

	// Array of available Black Friday banner images
	$black_friday_images = array(
		'black-friday-2025-bg-black-man-popup-banner.png',
		'black-friday-2025-bg-white-woman-popup-banner.png',
		'black-friday-2025-bg-assian-woman-popup-banner.png',
	);

	// Shuffle images randomly - professional approach like header-banners.php
	shuffle( $black_friday_images );
	$random_image = $black_friday_images[0];
	?>

<div id="blackfridaybanner" class="BlackFridayBanner hidden">
	<a href="/black-friday/" class="BlackFridayBanner__link">
			<span class="BlackFridayBanner__close" id="blackfridaybanner-close">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/close.png' ); ?>" alt="<?= esc_attr( __( 'Close', 'ms' ) ); ?>" />
			</span>
		<div class="BlackFridayBanner__wrapper wrapper">
				<div class="BlackFridayBanner__text">
				<span class="BlackFridayBanner__pretitle"><?= esc_html( __( '12.Nov-11.Dec 2025', 'ms' ) ); ?></span>
				<h2 class="BlackFridayBanner__title text-stroke-primary"><?= esc_html( __( 'BLACK FRIDAY', 'ms' ) ); ?></h2>
				<h3 class="BlackFridayBanner__subtitle"><?= esc_html( __( '75% OFF', 'ms' ) ); ?></h3>
				<p class="BlackFridayBanner__desc"><?= esc_html( __( 'For all new accounts for the first 6 months', 'ms' ) ); ?></p>
			</div>
			<div class="BlackFridayBanner__image">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/' . $random_image ); ?>" alt="<?= esc_attr( __( 'Black Friday Offer', 'ms' ) ); ?>" />
			</div>
		</div>
	</a>
</div>
