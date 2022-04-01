<?php

function ms_gutenberg_signup() {
	ob_start();
	?>

	<div class="Gutenberg">
		<section class="ShortTrial Block Block--background">
			<div class="wrapper">
				<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column">
						<div class="elementor-widget-heading">
							<div class="elementor-widget-container">
								<h2><?php _e( 'Try LiveAgent Today', 'ms' ); ?>​</h2>
							</div>
						</div>
						<div class="elementor-widget-text-editor">
							<div class="elementor-text-editor">
								<p><?php _e( 'We offer concierge migration services from most of the popular help desk solutions.', 'ms' ); ?></p>
							</div>
						</div>
					</div>
					<div class="elementor-column elementor-col-50 elementor-inner-column">
						<?php echo do_shortcode( '[short-trial]' ); ?>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'gutenberg-signup', 'ms_gutenberg_signup' );
