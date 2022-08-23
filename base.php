<?php
	use QualityUnit\Wrapper;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<?php get_template_part( 'lib/pagesources' ); ?>
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
			<div class="fakeChatButton hidden">
				<span class="fakeChatButton__msg"><?php _e( 'Please accept our cookies before we start a chat.', 'ms' ); ?></span>
			</div>
		</div>

		<?php 
			wp_footer();
			include_once( 'base-scripts.php' );
		?>
	</body>
</html>
