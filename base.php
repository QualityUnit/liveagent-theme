<?php
	use QualityUnit\Wrapper;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="app">
		<?php
			do_action( 'get_header' );
			get_template_part( 'templates/header' );
		?>

		<div class="AppContainer" data-copied="<?php _e( 'Copied!', 'ms' ); ?>">
			<?php require Wrapper\template_path(); ?>
		</div>

		<?php
			do_action( 'get_footer' );
			get_template_part( 'templates/footer' );
		?>

		<div id="papPlaceholder"></div>
	</div>

	<?php get_template_part( 'lib/pagesources' ); ?>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Patrick+Hand&family=Poppins:wght@400;600;700&display=swap">

	<?php
		wp_footer();
		include_once( 'base-scripts.php' );
	?>
	</body>
</html>
