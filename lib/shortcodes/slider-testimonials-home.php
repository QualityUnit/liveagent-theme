<?php

function ms_slidertestimonials_home( $atts ) {
	$atts = shortcode_atts(
		array(
			'horizontal' => '',
		),
		$atts,
		'slidertestimonials_home'
	);
	ob_start();
	?>

	<div class="<?= ( $atts['horizontal'] ) ? 'SliderTestimonials__slider--horizontal' : 'SliderTestimonials__slider--home' ?>">
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
							<div class="SliderTestimonials__slider__header__photo">
								<img data-splide-lazy="<?= esc_url( wp_get_attachment_image_url( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_photo', true ), 'logo_small_thumbnail' ) ) ?>" alt="<?= esc_attr( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_name', true ) ) ?>" />
							</div>
							<div class="SliderTestimonials__slider__content">
								<?= esc_html( wp_trim_words( get_the_content(), 20, '...' ) ); ?>
								<div class="SliderTestimonials__slider__content__bottom">
									<strong class="SliderTestimonials__slider__name"><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_name', true ) ) ?></strong>
									<span class="SliderTestimonials__slider__position"><span class="comma">,&nbsp;</span><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_position', true ) ) ?></span>
									<div class="SliderTestimonials__slider__logo">
										<img data-splide-lazy="<?= esc_url( wp_get_attachment_image_url( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_logo', true ), 'logo_thumbnail' ) ) ?>" alt="<?= esc_attr( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_position', true ) ) ?>"/>
									</div>
								</div>
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
add_shortcode( 'slidertestimonials_home', 'ms_slidertestimonials_home' );
