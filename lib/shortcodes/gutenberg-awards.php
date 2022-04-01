<?php

function ms_gutenberg_awards() {
	ob_start();
	?>

	<div class="Gutenberg">
		<section class="BlockBadges Block Block--background">
			<div class="wrapper">
				<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column">
						<div class="elementor-widget-heading">
							<div class="elementor-widget-container">
								<h2><?php _e( 'Happy customers are the best customers', 'ms' ); ?></h2>
							</div>
						</div>
						<div class="elementor-widget-text-editor">
							<div class="elementor-text-editor">
								<p><?php _e( 'We offer concierge migration services from most of the popular help desk solutions.', 'ms' ); ?></p>
							</div>
						</div>
					</div>
					<div class="elementor-column elementor-col-50 elementor-inner-column">
						<div class="elementor-widget-image">
							<div class="elementor-widget-container">
								<div class="elementor-image">
									<img src="/app/uploads/2020/03/badges.png" alt="<?php _e( 'Badges', 'ms' ); ?>" loading="lazy">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'gutenberg-awards', 'ms_gutenberg_awards' );
