<?php

function ms_typing_test() {
	ob_start();
	?>

	<div id="root" dir="ltr"></div>
	<?php // @codingStandardsIgnoreStart ?>
	<script src="<?= esc_url( get_template_directory_uri() ); ?>/apps/typing-test/build/bundle.js?ver=1.0"></script>
	<?php // @codingStandardsIgnoreEnd ?>

	<?php
	return ob_get_clean();
}
add_shortcode( 'typing-test', 'ms_typing_test' );
