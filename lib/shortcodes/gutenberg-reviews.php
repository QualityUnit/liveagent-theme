<?php

function ms_gutenberg_reviews() {
	ob_start();
	?>

	<div class="Gutenberg">
			<div class="Reviews__items">
					<div class="Reviews__items__item">
							<a href="<?php _e( '/awards/', 'ms' ); ?>" title="<?php _e( 'G2 Crowd', 'ms' ); ?>">
									<img src="/app/uploads/2019/11/logo_g2.svg" alt="<?php _e( 'G2 Crowd', 'ms' ); ?>">
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
							<a href="<?php _e( '/awards/', 'ms' ); ?>" title="<?php _e( 'Trustpilot', 'ms' ); ?>">
									<img src="/app/uploads/2019/11/logo_trustpilot.svg" alt="<?php _e( 'Trustpilot', 'ms' ); ?>">
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
							<a href="<?php _e( '/awards/', 'ms' ); ?>" title="<?php _e( 'GetApp', 'ms' ); ?>">
									<img src="/app/uploads/2019/11/logo_getapp.svg" alt="<?php _e( 'GetApp', 'ms' ); ?>">
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
