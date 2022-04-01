<div class="ErrorPage">
	<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/background-404.svg" alt="<?php _e( 'Error 404', 'ms' ); ?>">

	<h1><?php _e( 'Error 404', 'ms' ); ?></h1>
	<p><?php _e( 'You have found InactiveAgent, ', 'ms' ); ?></p>
	<p><?php _e( 'please proceed to our live pages to find what you have been searching for.', 'ms' ); ?></p>

	<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', '404 Error', 'Back to Home'])">
		<span><?php _e( 'Start discovering our web', 'ms' ); ?></span>
	</a>
</div>

<!-- QualityUnit - Analytics - Track 404 Error -->
<script type="text/javascript">
	var _paq = window._paq || [];
	_paq.push(["trackEvent", "error", "404", ""])
</script>
