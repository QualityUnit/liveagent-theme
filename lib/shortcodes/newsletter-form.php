<?php

function ms_newsletter_form( $atts ) {
	$atts = shortcode_atts(
		array(
			'button-classes'       => 'Button',
			'form-classes'       => 'Newsletter__form',
		),
		$atts,
		'newsletterform'
	);
	ob_start();
	?>

	<div class="<?= esc_attr( $atts['form-classes'] ); ?>">
		<form action="https://qualityunit.us3.list-manage.com/subscribe/post?u=18d6ab6093f8e6cdbbd783635&amp;id=15f55e7660" method="post" name="mc-embedded-subscribe-form" target="_blank" style="position: relative; overflow: hidden;">
			<input type="email" value="" placeholder="<?php _e( 'Type your e-mail for updates', 'ms' ); ?>" name="EMAIL" class="Input" required>

			<div style="position: absolute; left: -5000px;" aria-hidden="true">
				<input type="text" name="b_18d6ab6093f8e6cdbbd783635_15f55e7660" tabindex="-1" value="">
			</div>

			<button type="submit" name="subscribe" class="<?= esc_attr( $atts['button-classes'] ); ?>">
				<span><?php _e( 'Subscribe', 'ms' ); ?></span>
			</button>
		</form>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'newsletterform', 'ms_newsletter_form' );
