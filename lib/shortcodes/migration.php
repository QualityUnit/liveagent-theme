<?php

function ms_migrations() {
	ob_start();
	?>

	<div class="WordCloud__container">
		<?php echo wp_kses_post( get_option( 'ms_theme_ms_strings_migrations' ) ); ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'migrations', 'ms_migrations' );
