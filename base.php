<?php
	use QualityUnit\Wrapper;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="app" class="liveagentWeb">
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

	<?php
		wp_footer();
		include_once 'base-scripts.php';
	?>
	</body>
</html>
