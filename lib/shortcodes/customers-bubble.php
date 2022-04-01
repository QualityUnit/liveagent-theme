<?php

function ms_customersbubble( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts_per_page' => 10,
			'start'          => 0,
		),
		$atts,
		'customersbubble'
	);
	ob_start();
	?>

	<div class="CustomersBubbles">
		<section class="slider splide">
			<div class="splide__track">
				<ul class="splide__list">
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
		while ( $query_testimonials_posts->have_posts() ) :
			$query_testimonials_posts->the_post();
			if ( ! get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_reference' ) ) {
				?>

			<li <?php post_class( 'splide__slide white--bubble white--bubble--quote' ); ?>>
				<div class="slide__inn elementor-widget-container">
					<?= get_the_content(); // @codingStandardsIgnoreLine ?>
					<div class="white--bubble--quote__logo"><?= wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_logo', true ), 'testimonials_box_logo' ) ?></div>
				</div>
			</li>

				<?php 
			}
		endwhile; 
		?>
			<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	</section>
	</div>

	<?php
	set_custom_source( 'common/splide' );
	set_custom_source( 'components/CustomersBubbles' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'slider', 'js' );
	?>
	<?php
	return ob_get_clean();
}
add_shortcode( 'customersbubble', 'ms_customersbubble' );
