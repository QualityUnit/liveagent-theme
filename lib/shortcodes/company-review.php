<?php

function ms_reviews() {
	ob_start();
	?>


	<div class="Company__review">
		<div class="Company__review__logo__and__rating">
				<a href="<?= esc_url( __( '/awards/', 'ms' ) ); ?>" title="<?= esc_attr( 'G2 Crowd' ); ?>">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/logo_g2.svg?ver=' . THEME_VERSION ); ?>" alt="<?= esc_attr( 'G2 Crowd' ); ?>">
			</a>
			<div class="Company__review__star__rating">
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
			</div>
		</div>
		<div class="Company__review__logo__and__rating">
				<a href="<?= esc_url( __( '/awards/', 'ms' ) ); ?>" title="<?= esc_attr( 'GetApp' ); ?>">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/logo_getapp.svg?ver=' . THEME_VERSION ); ?>" alt="<?= esc_attr( 'GetApp' ); ?>">
			</a>
			<div class="Company__review__star__rating">
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
			</div>
		</div>
		<div class="Company__review__logo__and__rating">
			<a href="<?= esc_url( __( '/awards/', 'ms' ) ); ?>" title="<?= esc_attr( 'Capterra' ); ?>">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/logo-capterra.svg?ver=' . THEME_VERSION ); ?>" alt="<?= esc_attr( 'Capterra' ); ?>">
			</a>
			<div class="Company__review__star__rating">
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
				<span class="Company__review__star__rating__item"></span>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'reviews', 'ms_reviews' );
