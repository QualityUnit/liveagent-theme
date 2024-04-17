<?php

function ms_gutenberg_reviews() {
	ob_start();
	?>

	<div class="Gutenberg">
			<div class="Reviews__items">
					<div class="Reviews__items__item">
							<a href="<?php _e( '/awards/', 'ms' ); ?>" title="G2 Crowd">
								<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/logo_g2.svg?ver=' . THEME_VERSION ); ?>" alt="G2 Crowd">
							</a>
							<div class="Reviews__items__item__stars">
									<span class="Reviews__items__item__stars__item"></span>
									<span class="Reviews__items__item__stars__item"></span>
									<span class="Reviews__items__item__stars__item"></span>
									<span class="Reviews__items__item__stars__item"></span>
									<span class="Reviews__items__item__stars__item"></span>
							</div>
					</div>
					<div class="Reviews__items__item">
						<a href="<?php _e( '/awards/', 'ms' ); ?>" title="Capterra">
							<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/logo-capterra.svg?ver=' . THEME_VERSION ); ?>" alt="Capterra">
						</a>
						<div class="Reviews__items__item__stars">
							<span class="Reviews__items__item__stars__item"></span>
							<span class="Reviews__items__item__stars__item"></span>
							<span class="Reviews__items__item__stars__item"></span>
							<span class="Reviews__items__item__stars__item"></span>
							<span class="Reviews__items__item__stars__item"></span>
						</div>
					</div>
				<div class="Reviews__items__item">
					<a href="<?php _e( '/awards/', 'ms' ); ?>" title="GetApp">
						<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/logo_getapp.svg?ver=' . THEME_VERSION ); ?>" alt="GetApp">
					</a>
					<div class="Reviews__items__item__stars">
						<span class="Reviews__items__item__stars__item"></span>
						<span class="Reviews__items__item__stars__item"></span>
						<span class="Reviews__items__item__stars__item"></span>
						<span class="Reviews__items__item__stars__item"></span>
						<span class="Reviews__items__item__stars__item"></span>
					</div>
				</div>
			</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'gutenberg-reviews', 'ms_gutenberg_reviews' );
