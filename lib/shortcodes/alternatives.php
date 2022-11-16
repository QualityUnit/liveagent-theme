<?php
function ms_alternatives() {
	ob_start();
	?>

	<div class="WordCloud__container">
		<?php echo wp_kses_post( get_option( 'ms_theme_ms_strings_alternatives' ) ); ?>
	</div>

	<?php
	set_custom_source( 'shortcodes/WordCloud' );
	return ob_get_clean();
}
add_shortcode( 'alternatives', 'ms_alternatives' );
