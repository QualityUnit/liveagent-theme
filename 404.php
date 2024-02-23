<?php // @codingStandardsIgnoreLine
set_custom_source( 'layouts/ErrorPage', 'css', false, false );
?>
<div class="ErrorPage">
	<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/background-404.svg" alt="<?php _e( 'Error 404', 'ms' ); ?>">

	<h1><?php _e( 'Error 404', 'ms' ); ?></h1>
	<p><?php _e( 'You have found InactiveAgent, ', 'ms' ); ?></p>
	<p><?php _e( 'please proceed to our live pages to find what you have been searching for.', 'ms' ); ?></p>

	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Button Button--full">
		<span><?php _e( 'Start discovering our web', 'ms' ); ?></span>
	</a>
</div>
