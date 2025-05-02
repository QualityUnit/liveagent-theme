<?php

function ms_success_stories_cards( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts'    => '2',
			'category' => '',
		),
		$atts,
		'slider_success_stories'
	);
	ob_start();
	?>


	<section class="success__stories">
		<?php $archive_url = get_post_type_archive_link( 'ms_success-stories' ); ?>
		<ul class="success__stories__list">
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
					'meta_query'     => array(
						array(
							'key'   => 'mb_success-stories_mb_success-stories-active-shortcode',
							'value' => 'on',
						),
					),
					'tax_query'      => $tax_query, // @codingStandardsIgnoreLine
				)
			);

			while ( $query_success_stories_posts->have_posts() ) :
				$query_success_stories_posts->the_post();

				$post_id    = get_the_ID();
				$categories = get_the_terms( $post_id, 'ms_success-stories_categories' );

				$regions = get_post_meta( $post_id, 'mb_success-stories_mb_success-stories-region', true );
				$region  = '';
				if ( ! empty( $regions ) ) {
					foreach ( $regions as $region_name ) {
						$region .= 'region_' . $region_name;
						$region .= ' ';
					}
					$region = substr( $region, 0, - 1 );
				}

				$category = '';
				$company  = get_the_title();

				if ( ! empty( $categories ) ) {
					foreach ( $categories as $category_item ) {
						$category_item = array_shift( $categories );
						$category      .= $category_item->slug;
						$category      .= ' ';
					}
				}
				$category = substr( $category, 0, - 1 );

				$headline_raw = get_post_meta( $post_id, 'mb_success-stories_mb_success-stories-headline', true );
				$headline     = ! empty( $headline_raw ) ? esc_html( $headline_raw ) : '';

				$short_description = get_post_meta( $post_id, 'mb_success-stories_mb_success-stories-text', true );
				$short_description = ! empty( $short_description ) ? esc_html( $short_description ) : '';

				$image_id = get_post_meta( $post_id, 'mb_success-stories_mb_success-stories-image', true );
				$image_url   = wp_get_attachment_image_url( $image_id, 'box_archive_thumbnail' );
				$image_default = esc_url( get_template_directory_uri() ) . '/assets/images/demo_bg.jpg';
				$image = ! empty( $image_url ) ? $image_url : $image_default;
				?>

				<li class="success__stories__item">
					<article data-category="<?= esc_attr( $category ); ?>"
									 data-region="<?= esc_attr( $region ); ?>" <?php post_class( 'success__stories__item__article' ); ?>>
						<a href="<?php the_permalink(); ?>" class="success__stories__item__link"
							 title="<?= esc_attr( str_replace( '${company}', $company, __( 'Read ${company}\'s story', 'use-case' ) ) ); ?>"></a>
						<div class="success__stories__item__thumbnail">
							<meta itemprop="image" content="<?= esc_url( $image ); ?>"></meta>
							<img data-splide-lazy="<?= esc_url( $image ); ?>"
									 alt="<?= esc_attr( str_replace( '${company}', $company, __( 'Read ${company}\'s story', 'use-case' ) ) ); ?>"/>
						</div>
						<div class="success__stories__item__content">
							<?php
							$categories = get_the_terms( 0, 'ms_success-stories_categories' );

							if ( ! empty( $categories ) ) {
								?>
								<div class="success__stories__item__content__category">
									<div class="postLabels">
										<?php
										foreach ( $categories as $key => $category_item ) {
											$category_item = array_shift( $categories );
											$category_name = $category_item->name;

											if ( $key <= 1 ) {
												?>
												<span class="postLabel"><?= esc_html( $category_name ); ?></span>
												<?php
											}
										}
										?>
									</div>
								</div>
								<?php
							}
							?>
							<div class="success__stories__item__content__main">
								<div class="success__stories__item__content__main__label"><?= esc_html( 'Customer Story' ); ?></div>
								<div class="success__stories__item__content__main__headline">
									<div class="headline"><?= esc_html( $headline ); ?></div>
								</div>
								<h3 class="success__stories__item__content__main__title">
									<?php the_title(); ?>
								</h3>
								<div class="success__stories__item__content__main__excerpt">
									<p itemprop="abstract" class="item-excerpt"><?= esc_html( $short_description ); ?></p>
								</div>
							</div>
							<div class="learn-more-wrap">
								<div class="line"></div>
								<p class="learn-more">
									<a href="<?php the_permalink(); ?>">
										<?php _e( 'Read their story', 'ms' ); ?>
									</a>
								</p>
							</div>
						</div>
					</article>
				</li>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</section>

	<?php

	set_custom_source( 'shortcodes/SuccessStories' );

	return ob_get_clean();
}

// slider_success_stories is the old name of the shortcode( we are removed slider form this shortcode ), but we can't change it because we had this shortcode implemented in many places in elementor
add_shortcode( 'slider_success_stories', 'ms_success_stories_cards' );
