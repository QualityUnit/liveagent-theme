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

	<div class="">
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
			if ( ! empty( $categories ) ) {
				foreach ( $categories as $category_item ) {
						$category_item = array_shift( $categories );
						$category     .= $category_item->slug;
						$category     .= ' ';
				}
			}
				$category = substr( $category, 0, -1 );
			?>


			<li data-category="<?= esc_attr( $category ) ?>" data-region="<?= esc_attr( $region ) ?>" <?php post_class( 'Category__item Category__item--blogLike' ); ?>>
				<a href="<?php the_permalink(); ?>">
					<div class="Blog__item__thumbnail Category__item--blogLike__thumbnail">
						<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( '' ) ); ?>"></meta>
						<img style="opacity: 0; transition: opacity 0.2s;" data-lasrc="<?= esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?= esc_attr( get_the_title() ); ?>" />

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
						<h3 class="Blog__item__title item-title ">
							<?php the_title(); ?>
						</h3>
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
	</div>

	<?php
	set_custom_source( 'pages/blog' );
	set_custom_source( 'pages/Category' );

	return ob_get_clean();
}
add_shortcode( 'successstories', 'ms_success_stories' );


// Filter shortcode for searchbar and filter menu
function ms_success_stories_filter() {
	ob_start();
	$query_success_stories_posts = new WP_Query(
		array(
			'post_type'      => 'ms_success-stories',
			'posts_per_page' => -1,
		)
	);
	while ( $query_success_stories_posts->have_posts() ) :
			$query_success_stories_posts->the_post();

			$regions_meta = get_post_meta( get_the_ID(), 'mb_success-stories_mb_success-stories-region', true );
		if ( $regions_meta ) {
			$regions[] = $regions_meta;
		}
	endwhile;
	wp_reset_postdata();

	$regions = array_merge( ...$regions );
	?>

	<div class="Filter">
		<div class="searchField">
			<img class="searchField__icon" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-search_new_v2.svg" alt="<?php _e( 'Search', 'ms' ); ?>" />
			<input type="search" class="search search--use-cases" placeholder="<?php _e( 'Search company', 'use-case' ); ?>" maxlength="50">
		</div>

		<div class="FilterMenu">
			<div class="FilterMenu__title flex flex-align-center">
				<?php _e( 'Industry', 'use-case' ); ?>
			</div>
			<div class="FilterMenu__items">
				<div class="FilterMenu__items--inn">
					<div class="checkbox FilterMenu__item">
						<input class="filter-item" type="radio" id="cat-all" value="" name="category" checked />
						<label for="cat-all">
							<span onclick="_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - Any'])"><?php _e( 'Any', 'ms' ); ?></span>
						</label>
					</div>
						<?php
						$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_success-stories_categories' ) ), SORT_REGULAR );
						foreach ( $categories as $category ) {
							?>

							<div class="checkbox FilterMenu__item">
								<input class="filter-item" type="radio" id="<?php echo esc_attr( $category->slug ); ?>" value="<?php echo esc_attr( $category->slug ); ?>" name="category" />

								<label for="<?php echo esc_attr( $category->slug ); ?>" >
									<span onclick="_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - <?= esc_html( $category->name ); ?>'])"><?= esc_html( $category->name ); ?></span>
								</label>
							</div>
						<?php } ?>
				</div>

			</div>
		</div>

		<div class="FilterMenu">
			<div class="FilterMenu__title flex flex-align-center">
				<?php _e( 'Region', 'use-case' ); ?>
			</div>
			<div class="FilterMenu__items">
				<div class="FilterMenu__items--inn">
					<div class="checkbox FilterMenu__item">
						<input class="filter-item" type="radio" id="region-all" value="" name="region" checked />
						<label for="region-all">
							<span onclick="_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - Any'])"><?php _e( 'Any', 'ms' ); ?></span>
						</label>
					</div>
					<?php
					if ( ! empty( $regions ) ) {
						$region_name = '';

						foreach ( $regions as $region ) {
							if ( 'worldwide' === $region ) {
								$region_name = __( 'World Wide', 'regions' );
							} elseif ( 'europe' === $region ) {
								$region_name = __( 'Europe', 'regions' );
							} elseif ( 'northamerica' === $region ) {
								$region_name = __( 'North America', 'regions' );
							} elseif ( 'southamerica' === $region ) {
								$region_name = __( 'South America', 'regions' );
							} elseif ( 'asia' === $region ) {
								$region_name = __( 'Asia', 'regions' );
							} elseif ( 'middleeast' === $region ) {
								$region_name = __( 'Middle East', 'regions' );
							} elseif ( 'pacific' === $region ) {
								$region_name = __( 'Pacific', 'regions' );
							}
							?>

							<div class="checkbox FilterMenu__item">
								<input class="filter-item" type="radio" id="region_<?php echo esc_attr( $region ); ?>" value="region_<?php echo esc_attr( $region ); ?>" name="region" />

								<label for="region_<?php echo esc_attr( $region ); ?>" >
									<span onclick="_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - <?= esc_html( $region_name ); ?>'])"><?= esc_html( $region_name ); ?></span>
								</label>
							</div>
							<?php 
						} 
					} 
					?>
				</div>

			</div>
		</div>

		<div class="Category__content__description">
			<div>
				<span id="countPosts"></span>&nbsp;
				<?php _e( 'use case scenarios', 'use-case' ); ?>
			</div>
		</div>
	</div>

	<?php
	set_custom_source( 'components/Filter', 'css' );
	set_custom_source( 'filter', 'js' );
	set_custom_source( 'filterMenu', 'js' );
	return ob_get_clean();
}

add_shortcode( 'successstories-filter', 'ms_success_stories_filter' );
