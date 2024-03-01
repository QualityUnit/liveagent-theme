<?php

function ms_success_stories( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts'    => '-1',
			'category' => '',
		),
		$atts,
		'successstories'
	);
	ob_start();
	?>

		<ul class="Category__content__items wider list">
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

			<li data-category="<?= esc_attr( $category ); ?>" data-region="<?= esc_attr( $region ); ?>" <?php post_class( 'Category__item Category__item--blogLike' ); ?>>
				<a href="<?php the_permalink(); ?>" title="<?= esc_attr( str_replace( '${company}', $company, __( 'Read ${company}\'s story', 'use-case' ) ) ); ?>">
					<div class="Blog__item__thumbnail Category__item--blogLike__thumbnail">
						<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( '' ) ); ?>"></meta>
						<img src="<?= esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?= esc_attr( str_replace( '${company}', $company, __( 'Read ${company}\'s story', 'use-case' ) ) ); ?>" />

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
					<div class="Blog__item__content">
						<h2 class="Blog__item__title item-title h3">
							<?php the_title(); ?>
						</h2>
						<div class="Blog__item__excerpt">
							<p itemprop="abstract" class="item-excerpt">
								<?= esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?>
								<span class="learn-more">
									<?php _e( 'Read story', 'ms' ); ?>
									<svg width="15" height="13" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" />
									</svg>
								</span>
							</p>
						</div>
					</div>
				</a>
			</li>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>

	<?php
	set_custom_source( 'pages/blog' );
	set_custom_source( 'pages/Category' );

	return ob_get_clean();
}
add_shortcode( 'successstories', 'ms_success_stories' );
