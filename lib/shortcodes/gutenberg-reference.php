<?php

function ms_gutenberg_reference() {
	ob_start();
	set_custom_source( 'components/Reference' );
	?>

	<div class="Gutenberg">
		<section class="Reference Box Box--gray">
			<div class="wrapper">
				<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column Reference__image">
						<div class="elementor-widget-image">
							<div class="elementor-widget-container">
								<div class="elementor-image">
									<img src="https://www.liveagent.com/app/uploads/2019/11/komora.png" alt="<?php _e( 'Peter Komornik', 'ms' ); ?>">
								</div>
							</div>
						</div>
					</div>
					<div class="elementor-column elementor-col-50 elementor-inner-column Reference__text">
						<div class="elementor-blockquote--skin-clean elementor-blockquote--button-color-official elementor-widget elementor-widget-blockquote">
							<div class="elementor-widget-container">
								<blockquote class="elementor-blockquote">
									<p class="elementor-blockquote__content"><?php _e( 'LiveAgent combines <strong>excellent live chat, ticketing</strong> and automation that allow us to <strong>provide exceptional support to our customers.</strong>', 'ms' ); ?></p>
									<footer>
										<cite class="elementor-blockquote__author"><?php _e( 'Peter Komornik, CEO', 'ms' ); ?></cite>
									</footer>
								</blockquote>
							</div>
							<div class="elementor-widget-image">
								<div class="elementor-image">
									<img src="https://www.liveagent.com/app/uploads/2019/11/logo_slido_black.svg" alt="logo slido black">
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
add_shortcode( 'gutenberg-reference', 'ms_gutenberg_reference' );
