<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link rel="preload" fetchpriority="high" as="image" href="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icons.svg?ver=<?= THEME_VERSION ?>">

	<link rel="apple-touch-icon" sizes="180x180" href="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/favicon/favicon-16x16.png">

	<link rel="mask-icon" href="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/favicon/safari-pinned-tab.svg" color="#f5912c">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">

	<?php
	if ( isset( $_GET['test'] ) || WP_ENV === 'local' || WP_ENV === 'development' ) {
		?>
		<script src="<?= esc_url( get_template_directory_uri() ); ?>/assets/scripts/static/perf.js"></script>
		<?php
	}
	?>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Patrick+Hand&family=Poppins:wght@400;700&display=swap">

	<?php wp_head(); ?>

	<?php get_template_part( 'lib/pagesources' ); ?>
</head>
