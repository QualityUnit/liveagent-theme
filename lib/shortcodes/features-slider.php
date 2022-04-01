<?php

function ms_features_slider() {
	ob_start();
	?>

	<div class="FeaturesSlider">
		<div class="FeaturesSlider__items FeaturesSlider__items--left">
		<?php
		$query_slider_left_posts = new WP_Query(
			array(
				'post_type'      => 'ms_features',
				'posts_per_page' => 100,
				'orderby'        => 'date',
			)
		);

		if ( $query_slider_left_posts->have_posts() ) :
			while ( $query_slider_left_posts->have_posts() ) :
				$query_slider_left_posts->the_post();
				if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_slider', true ) === 'on' ) {
					?>

			<div class="FeaturesSlider__items__item">
				<a href="<?php the_permalink(); ?>">
					<div class="FeaturesSlider__items__item__image">
						<?php the_post_thumbnail( 'logo_small_thumbnail' ); ?>
					</div>

					<div class="FeaturesSlider__items__item__text">
						<p class="FeaturesSlider__items__item__text__title"><?php the_title(); ?></p>
						<div class="FeaturesSlider__items__item__text__subtitle"><?php the_excerpt(); ?></div>
					</div>
				</a>
			</div>

			<?php } ?>
			<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<div class="FeaturesSlider__items FeaturesSlider__items--right">
		<?php
		$query_slide_right_posts = new WP_Query(
			array(
				'post_type'      => 'ms_features',
				'posts_per_page' => 100,
				'orderby'        => 'date',
			)
		);

		if ( $query_slide_right_posts->have_posts() ) :
			while ( $query_slide_right_posts->have_posts() ) :
				$query_slide_right_posts->the_post();
				if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_slider', true ) === 'on' ) {
					?>

			<div class="FeaturesSlider__items__item">
				<a href="<?php the_permalink(); ?>">
					<div class="FeaturesSlider__items__item__image">
						<?php the_post_thumbnail( 'logo_small_thumbnail' ); ?>
					</div>

					<div class="FeaturesSlider__items__item__text">
						<p class="FeaturesSlider__items__item__text__title"><?php the_title(); ?></p>
						<div class="FeaturesSlider__items__item__text__subtitle"><?php the_excerpt(); ?></div>
					</div>
				</a>
			</div>

			<?php } ?>
			<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'features-slider', 'ms_features_slider' );
