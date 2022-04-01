<?php

function ms_copy( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'button' => 'yes',
		),
		$atts,
		'copy'
	);

	ob_start();
	?>

	<div class="Copy">
		<div class="textarea-pseudo">
			<?= $content; // @codingStandardsIgnoreLine ?>
		</div>

		<?php if ( 'yes' === $atts['button'] ) { ?>
			<button class="Button Button--outline Button--copy"><span><?php _e( 'Copy to clipboard', 'ms' ); ?></span></button>
		<?php } ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'copy', 'ms_copy' );
