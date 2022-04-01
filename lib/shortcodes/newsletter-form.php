<?php

function ms_newsletter_form() {
	ob_start();
	?>

	<div class="Newsletter__form">
		<form action="https://qualityunit.us3.list-manage.com/subscribe/post?u=18d6ab6093f8e6cdbbd783635&amp;id=15f55e7660" method="post" name="mc-embedded-subscribe-form" target="_blank" style="position: relative; overflow: hidden;">
			<input type="email" value="" placeholder="<?php _e( 'Type your e-mail for updates', 'ms' ); ?>" name="EMAIL" class="Input" required>

			<div style="position: absolute; left: -5000px;" aria-hidden="true">
				<input type="text" name="b_18d6ab6093f8e6cdbbd783635_15f55e7660" tabindex="-1" value="">
			</div>

			<button type="submit" name="subscribe" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Newsletter Footer', 'Signup'])">
				<span><?php _e( 'Subscribe', 'ms' ); ?></span>
			</button>
		</form>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'newsletterform', 'ms_newsletter_form' );
