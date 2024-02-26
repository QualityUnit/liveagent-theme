<?php // @codingStandardsIgnoreLine
	set_custom_source( 'components/FullHeadline', 'css', false, false );
	set_source( 'success-stories', 'components/Filter', 'css' );
	set_source( 'success-stories', 'pages/blog', 'css' );
	set_source( 'success-stories', 'pages/Category', 'css' );
	set_source( 'success-stories', 'filter', 'js' );
	set_source( 'success-stories', 'filterMenu', 'js' );
?>

<div id="category" class="Category">
	<div class="FullHeadline FullHeadline__use-cases">
		<div class="wrapper text-align-center">
			<h1 class="FullHeadline__title">
				<?php _e( '<span class="highlight__bubble">Use case</span> scenarios', 'use-case' ); ?>
			</h1>
			<div class="FullHeadline__subtitle"><?php _e( 'Boost satisfaction, revenue, and loyalty starting today.', 'use-case' ); ?></div>

			<div class="flex flex-justify-center Buttons">
					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Start 14 day trial', 'ms' ); ?></span>
					</a>
					<a href="<?php _e( '/business/', 'use-case' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Find my solution', 'use-case' ); ?></span>
					</a>
			</div>

			<?php
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
					$regions = $regions_meta;
				}
			endwhile;
			wp_reset_postdata();
			if ( isset( $regions ) ) {
				$regions = array_merge( ...$regions );
			}
			?>

	<div class="Filter">
		<div class="searchField">
			<img class="searchField__icon" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-search_new_v2.svg" alt="<?php _e( 'Search', 'ms' ); ?>" />
			<input type="search" class="search search--use-cases" placeholder="<?php _e( 'Search company', 'use-case' ); ?>" maxlength="50">
		</div>

		<?php
			$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_success-stories_categories' ) ), SORT_REGULAR );

		if ( isset( $categories ) && count( $categories ) > 0 ) {
			?>

		<div class="FilterMenu">
			<div class="FilterMenu__title flex flex-align-center">
			<?php _e( 'Industry', 'use-case' ); ?>
			</div>
			<div class="FilterMenu__items">
				<div class="FilterMenu__items--inn">
					<div class="checkbox FilterMenu__item">
						<input class="filter-item" type="radio" id="cat-all" value="" name="category" checked />
						<label for="cat-all">
							<span><?php _e( 'Any', 'ms' ); ?></span>
						</label>
					</div>
					<?php
					foreach ( $categories as $category ) {
						?>

							<div class="checkbox FilterMenu__item">
								<input class="filter-item" type="radio" id="<?php echo esc_attr( $category->slug ); ?>" value="<?php echo esc_attr( $category->slug ); ?>" name="category" />

								<label for="<?php echo esc_attr( $category->slug ); ?>" >
									<span><?= esc_html( $category->name ); ?></span>
								</label>
							</div>
						<?php } ?>
				</div>
			</div>
		</div>

			<?php
		}

		if ( isset( $regions ) && count( $regions ) > 0 ) {
			?>
		<div class="FilterMenu">
			<div class="FilterMenu__title flex flex-align-center">
			<?php _e( 'Region', 'use-case' ); ?>
			</div>
			<div class="FilterMenu__items">
				<div class="FilterMenu__items--inn">
					<div class="checkbox FilterMenu__item">
						<input class="filter-item" type="radio" id="region-all" value="" name="region" checked />
						<label for="region-all">
							<span><?php _e( 'Any', 'ms' ); ?></span>
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
									<span><?= esc_html( $region_name ); ?></span>
								</label>
							</div>
							<?php
					}
				}
				?>
				</div>

			</div>
		</div>
		<?php } ?>
		<div class="Category__content__description">
			<div>
				<span id="countPosts"></span>&nbsp;
				<?php _e( 'use case scenarios', 'use-case' ); ?>
			</div>
		</div>
	</div>
		</div>
	</div>


		<div class="wrapper">
			<?php
				echo do_shortcode( '[successstories]' );
			?>
		</div>
</div>
