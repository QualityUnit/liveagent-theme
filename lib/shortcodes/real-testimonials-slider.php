<?php

function ms_realtestimonials( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts_per_page' => 10,
			'start'          => 0,
		),
		$atts,
		'realtestimonials'
	);
	ob_start();
	?>

	<?php
		$query_testimonials_posts = new WP_Query(
			array(
				// @codingStandardsIgnoreLine
				'post_type'      => 'ms_testimonials',
				'posts_per_page' => $atts['posts_per_page'],
				'fields'         => 'ids',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'offset'         => $atts['start'],
			)
		);
	?>

	<div class="RealTestimonials">
		<section class="RealTestimonials__main splide">
			<div class="splide__track">
				<ul class="splide__list">
		<?php
		while ( $query_testimonials_posts->have_posts() ) :
			$query_testimonials_posts->the_post();
			if ( get_post_meta( get_the_ID(), 'mb_testimonials_mb_realtestimonials' ) ) {
				?>

			<li class="RealTestimonials__main__slide splide__slide">
						<div class="RealTestimonials__main__inn slide__inn">
							<div class="RealTestimonials__main__photo">
								<img data-splide-lazy="<?= esc_url( wp_get_attachment_image_url( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_photo', true ), '' ) ) ?>" alt="<?= esc_attr( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_name', true ) ) ?>" />
							</div>
							<div class="RealTestimonials__main__content">
								<div class="RealTestimonials__main__content--inn">
									<?= get_the_content(); // @codingStandardsIgnoreLine ?>
									<div class="RealTestimonials__main__content--bottom">
										<strong class="RealTestimonials__name"><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_name', true ) ) ?></strong>
										<span><span class="comma">,&nbsp;</span><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_position', true ) ) ?></span>
										<div class="RealTestimonials__main__logo logo">
											<img data-splide-lazy="<?= esc_url( wp_get_attachment_image_url( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_logo', true ), 'logo_thumbnail' ) ) ?>" alt="<?= esc_attr( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_position', true ) ) ?>"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>

				<?php
			}
		endwhile;
		?>
			</ul>
		</div>
	</section>

		<section class="RealTestimonials__thumbnails splide">
			<div class="splide__track">
				<ul class="splide__list">
		<?php
		while ( $query_testimonials_posts->have_posts() ) :
			$query_testimonials_posts->the_post();
			if ( get_post_meta( get_the_ID(), 'mb_testimonials_mb_realtestimonials' ) ) {
				?>

			<li <?php post_class( 'RealTestimonials__thumbnails__slide splide__slide' ); ?>>
					<?= wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_logo', true ), 'testimonials_box_logo' ) ?>
			</li>

				<?php
			}
		endwhile;
		?>
			<?php wp_reset_postdata(); ?>
			</ul>
		</div>
		<div class="splide__arrows arrows">
				<button class="splide__arrow splide__arrow--prev">
					<span><?php _e( 'See less', 'ms' ); ?></span>
				</button>
				<button class="Button Button--full splide__arrow splide__arrow--next">
					<span class="flex"><?php _e( 'See more', 'ms' ); ?>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8.1 13.117"><path d="M0 11.577 5.006 6.56 0 1.542 1.541.001 8.1 6.56l-6.559 6.558z"/></svg>
					</span>
				</button>
			</div>
	</section>
		</div>
	<?php
	set_custom_source( 'common/splide' );
	set_custom_source( 'components/RealTestimonialsSlider' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'slider', 'js' );
	?>
	<?php
	return ob_get_clean();
}
add_shortcode( 'realtestimonials', 'ms_realtestimonials' );
