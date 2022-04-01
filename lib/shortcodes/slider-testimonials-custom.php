<?php

function ms_slidertestimonials_custom( $atts ) {
	$atts = shortcode_atts(
		array(
			'category' => '',
		),
		$atts,
		'author'
	);

	ob_start();
	?>

	<div class="SliderTestimonials__slider">
		<section class="slider splide">
			<div class="splide__track">
				<ul class="splide__list">
				<?php
				$query_slider_testimonials_custom_posts = new WP_Query(
					array(
						'post_type'                  => 'ms_alternatives',
						'ms_alternatives_categories' => $atts['category'],
						'posts_per_page'             => 30,
					)
				);

				if ( $query_slider_testimonials_custom_posts->have_posts() ) :
					while ( $query_slider_testimonials_custom_posts->have_posts() ) :
						$query_slider_testimonials_custom_posts->the_post();
						?>

					<li class="splide__slide">
						<div class="slide__inn">
							<div class="SliderTestimonials__slider__header">
								<div class="SliderTestimonials__slider__header__person
								<?php
								if ( wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_alternatives_mb_alternatives_person', true ), 'logo_thumbnail' ) === '' ) {
									echo 'no-person';
								}
								?>
								">
									<?= wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_alternatives_mb_alternatives_person', true ), 'logo_thumbnail' ) ?>
								</div>
								<b class="SliderTestimonials__slider__header__person__name"><?php the_title(); ?></b>
								<div class="SliderTestimonials__slider__header__text">
								</div>
							</div>
							<div class="SliderTestimonials__slider__content
							<?php
							if ( wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_alternatives_mb_alternatives_person', true ), 'logo_thumbnail' ) === '' ) {
								echo 'no-person';
							}
							?>
							">
								<p><?php the_content(); ?></p>
							</div>
							<div class="SliderTestimonials__slider__header__text__logo">
								<?php the_post_thumbnail( 'logo_thumbnail' ); ?>
							</div>
						</div>
					</li>

				<?php endwhile; ?>
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
add_shortcode( 'slidertestimonials-custom', 'ms_slidertestimonials_custom' );
