<?php

function ms_slidertestimonials() {
	ob_start();
	?>

	<div class="SliderTestimonials__slider">
		<section class="slider splide">
			<div class="splide__track">
				<ul class="splide__list">
				<?php
				$query_slider_testimonials_posts = new WP_Query(
					array(
						'post_type'      => 'ms_testimonials',
						'posts_per_page' => 30,
					)
				);

				if ( $query_slider_testimonials_posts->have_posts() ) :
					while ( $query_slider_testimonials_posts->have_posts() ) :
						$query_slider_testimonials_posts->the_post();
						if ( ! get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_reference' ) ) {
							?>

					<li class="splide__slide">
						<div class="slide__inn">
							<div class="SliderTestimonials__slider__header">
								<div class="SliderTestimonials__slider__header__photo">
									<?= wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_photo', true ), 'logo_small_thumbnail' ) ?>
								</div>
								<div class="SliderTestimonials__slider__header__text">
									<p class="SliderTestimonials__slider__header__text__name"><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_name', true ) ) ?></p>
									<p class="SliderTestimonials__slider__header__text__position"><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_position', true ) ) ?></p>
									<div class="SliderTestimonials__slider__header__text__logo">
										<?= wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_logo', true ), 'logo_thumbnail' ) ?>
									</div>
								</div>
							</div>
							<div class="SliderTestimonials__slider__content">
								<p><?= esc_html( wp_trim_words( get_the_content(), 20, '...' ) ); ?></p>
							</div>
						</div>
					</li>

							<?php 
						}
			endwhile; 
					?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>
	</div>

	<?php
	set_custom_source( 'common/splide' );
	set_custom_source( 'components/SliderTestimonials' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'slider', 'js' );

	return ob_get_clean();
}
add_shortcode( 'slidertestimonials', 'ms_slidertestimonials' );
