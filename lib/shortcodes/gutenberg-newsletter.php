<?php

function ms_gutenberg_newsletter() {
	ob_start();
	?>

	<div class="Gutenberg">
		<section class="Newsletter Box Box--gray">
			<div class="wrapper">
				<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column">
						<div class="elementor-widget-heading">
							<div class="elementor-widget-container">
								<h3><?php _e( 'Subscribe to our newsletter', 'ms' ); ?></h3>
							</div>
						</div>
						<div class="elementor-widget-text-editor">
							<div class="elementor-text-editor">
								<p><?php _e( 'Be the first to receive exclusive offers and the latest news on our products and services directly in your inbox.', 'ms' ); ?></p>
							</div>
						</div>
					</div>
					<div class="elementor-column elementor-col-50 elementor-inner-column">
						<?php echo do_shortcode( '[newsletterform]' ); ?>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'gutenberg-newsletter', 'ms_gutenberg_newsletter' );
