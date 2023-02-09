<?php

function ms_slider_success_stories( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts'    => '6',
			'category' => '',
		),
		$atts,
		'slider_success_stories'
	);
	ob_start();
	?>

	<div class="SliderSuccessStories SliderSuccessStories__slider">
		<section class="slider splide">
			<div class="splide__track">
				<ul class="splide__list">
				<?php
				$tax_query = array( 'relation' => 'AND' );

				if ( strlen( $atts['category'] ) > 0 ) {
					$tax_query = array(
						array(
							'taxonomy' => 'ms_success-stories_categories',
							'field'    => 'term_id',
							'terms'    => $atts['category'],
						),
					);
				}
				$query_success_stories_posts = new WP_Query(
					array(
						'post_type'      => 'ms_success-stories',
						'posts_per_page' => $atts['posts'],
						'tax_query'      => $tax_query, // @codingStandardsIgnoreLine
					)
				);

				while ( $query_success_stories_posts->have_posts() ) :
					$query_success_stories_posts->the_post();
					$categories = get_the_terms( 0, 'ms_success-stories_categories' );

					$regions = get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-region', true );
					$region  = '';
					if ( ! empty( $regions ) ) {
						foreach ( $regions as $region_name ) {
							$region .= 'region_' . $region_name;
							$region .= ' ';
						}
						$region = substr( $region, 0, -1 );
					}

					$category = '';
					$company  = get_the_title();

					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category_item ) {
							$category_item = array_shift( $categories );
							$category     .= $category_item->slug;
							$category     .= ' ';
						}
					}
					$category = substr( $category, 0, -1 );
					?>

					<li class="splide__slide">
						<article data-category="<?= esc_attr( $category ) ?>" data-region="<?= esc_attr( $region ) ?>" <?php post_class( 'SliderSuccessStories__article' ); ?>>
								<a href="<?php the_permalink(); ?>" class="SliderSuccessStories__link" title="<?= esc_attr( str_replace( '${company}', $company, __( 'Read ${company}\'s story', 'use-case' ) ) ); ?>"></a>
								<div class="SliderSuccessStories__thumbnail">
									<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( '' ) ); ?>"></meta>
									<img data-splide-lazy="<?= esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?= esc_attr( str_replace( '${company}', $company, __( 'Read ${company}\'s story', 'use-case' ) ) ); ?>" />

									<?php
									$categories = get_the_terms( 0, 'ms_success-stories_categories' );
									if ( ! empty( $categories ) ) {
										?>
										<div class="postLabels">
											<?php
											foreach ( $categories as $key => $category_item ) {
												$category_item = array_shift( $categories );
												$category_name = $category_item->name;

												if ( $key <= 1 ) {
													?>
													<span class="postLabel">
								<svg viewBox="0 0 16 26"><path d="M7.779 3.052C9.978 1.018 12.897 0 15.892 0v26c-2.995 0-5.914-1.018-8.113-3.052C4.547 19.96.233 15.502.233 13c0-2.502 4.314-6.96 7.546-9.948Z"/></svg>
													<?= esc_html( $category_name ); ?>
							</span>
													<?php
												}
											}
											?>
										</div>
										<?php
									}
									?>
								</div>
								<div class="SliderSuccessStories__content">
									<h3 class="SliderSuccessStories__title">
										<?php the_title(); ?>
									</h3>
									<div class="SliderSuccessStories__excerpt">
										<p itemprop="abstract" class="item-excerpt">
											<?= esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?>
										</p>
										<p class="learn-more">
											<a href="<?php the_permalink(); ?>">
												<?php _e( 'Read more about', 'ms' ); ?> <?php the_title(); ?>
											</a>
										</p>
									</div>
								</div>
							</article>
					</li>

					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>
	</div>

	<?php
	set_custom_source( 'common/splide' );
	set_custom_source( 'shortcodes/SliderSuccessStories' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'slider', 'js' );

	return ob_get_clean();
}
add_shortcode( 'slider_success_stories', 'ms_slider_success_stories' );
