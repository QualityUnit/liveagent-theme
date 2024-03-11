<?php

function ms_typing_test() {
	ob_start();
	?>
	<style type="text/css">
		#root {
			min-height: 80.375em;
		}
		
		@media (min-width: 768px) {

			#root {
				min-height: 29.75em;
			}
		}
	</style>

<div data-widget>
	<div id="root" dir="ltr"></div>
	<script <?= ! is_user_logged_in() ? 'data-' : ''; ?>src='<?= esc_url( get_template_directory_uri() ); ?>/apps/typing-test/build/bundle.js?ver=<?= esc_attr( THEME_VERSION ); ?>'></script>
</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'typing-test', 'ms_typing_test' );
