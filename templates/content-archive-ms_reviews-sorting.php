<?php // @codingStandardsIgnoreLine
	set_custom_source( 'components/Filter', 'css' );
	set_custom_source( 'sortingMenu', 'js' );

	$filters = array(
		'reviews'   => __( 'Most reviews from external portals', 'reviews' ),
		'rating'    => __( 'Best ratings from external portals', 'reviews' ),
		'ourrating' => __( 'Our best rating', 'reviews' ),
		'updated'   => __( 'Recently updated', 'reviews' ),
	);

	$query_posts = new WP_Query(
		array(
			'post_type'      => 'ms_reviews',
			// @codingStandardsIgnoreLine
			'posts_per_page' => 500,
			'orderby'        => 'date',
			'order'          => 'ASC',
			'tax_query'      => array( // @codingStandardsIgnoreLine
				array(
					'taxonomy' => 'ms_reviews_categories',
					'field'    => 'term_id',
					'terms'    => $subpage->term_id,
				),
			),
		)
	);
	?>

<div class="Filter">
	<div class="FilterMenu__wrapper SortingMenu__wrapper flex-tablet flex-align-center">
		<strong class="FilterMenu__desc mr-xs"><?php _e( 'Sort by:', 'reviews' ); ?></strong>
		<div class="FilterMenu SortingMenu" data-sort="relatedReviews">
			<div class="FilterMenu__title SortingMenu__title flex flex-align-center" data-title>
				<?= esc_html( $filters['reviews'] ); ?>
			</div>
			<div class="FilterMenu__items SortingMenu__items" data-items>
				<div class="FilterMenu__items--inn SortingMenu__items--inn">
					<?php
					$counter = 0;
					foreach ( $filters as $key => $filter ) {
						++$counter;
						?>

							<div class="sorting FilterMenu__item SortingMenu__item">
								<input class="sorting-item" type="radio" id="<?= esc_attr( $key ); ?>" value="<?= esc_attr( $key ); ?>" name="relatedReviews" data-sortBy="<?= esc_attr( $filter ); ?>" <?= esc_attr( 1 === $counter ? 'checked' : '' ); ?> />

								<label for="<?= esc_attr( $key ); ?>">
									<span><?= esc_html( $filter ); ?></span>
								</label>
							</div>
						<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="Category__content__description">
		<div>
			<span id="countPosts"><?= esc_html( $query_posts->post_count . ' ' . $subpage->name ); ?></span>
		</div>
	</div>
</div>
