<?php // @codingStandardsIgnoreLine
	set_source( 'features', 'pages/Category', 'css' );
	set_source( 'features', 'pages/CategoryImages', 'css' );
	set_source( 'features', 'filter', 'js' );
?>

<div id="category" class="Category">
	<div class="Box Category__header Category__header--features">
		<div class="wrapper">
			<div class="Category__header--center">
				<?php if ( is_tax( 'ms_features_categories' ) ) { ?>
					<h1 class="Category__header__title"><?php single_cat_title(); ?></h1>
					<div class="Category__header__subtitle"><p><?php the_archive_description(); ?></p></div>
				<?php } else { ?>
					<h1 class="Category__header__title"><?php _e( 'Features', 'ms' ); ?></h1>
					<p class="Category__header__subtitle"><?php _e( 'Get to know all LiveAgent features, that are part of the complex multi-channel help desk software. Described in one place and in depth.', 'ms' ); ?></p>
				<?php } ?>

				<div class="Category__header__search searchField">
					<img class="searchField__icon" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-search_new_v2.svg" alt="<?php _e( 'Search', 'ms' ); ?>" />
					<input type="search" class="search search--academy" placeholder="<?php _e( 'Search', 'ms' ); ?>" maxlength="50">
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper Category__container">
		<div class="Category__sidebar">
			<input class="Category__sidebar__showfilter" type="checkbox" id="showfilter">
			<label class="Button Button--outline Category__sidebar__showfilter--label" for="showfilter" data-hidden="<?php _e( 'Hide filters', 'ms' ); ?>">
				<img class="Category__sidebar__showfilter--icon" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-filter.svg" alt="<?php _e( 'Filters', 'ms' ); ?>">
				<span><?php _e( 'Filters', 'ms' ); ?></span>
			</label>

			<div class="Category__sidebar__items">
				<div class="Category__sidebar__item">
					<div class="Category__sidebar__item__title h4"><?php _e( 'Collections', 'ms' ); ?></div>

					<?php
						$collections = array(
							''         => 'Any',
							'featured' => 'Featured',
							'popular'  => 'Popular',
							'new'      => 'New',
						);

						foreach ( $collections as $key => $value ) {
							?>
						<label>
							<input class="filter-item" type="radio" value="<?php echo esc_attr( $key ); ?>" name="collections"
							<?php
							if ( current( $collections ) === $value ) {
								echo 'checked';
							}
							?>
							>
							<span onclick="_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Collections - <?php echo esc_html( $value ); ?>'])"><?php echo esc_html( $value ); ?></span>
						</label>
					<?php } ?>
				</div>

				<div class="Category__sidebar__item">
					<div class="Category__sidebar__item__title h4"><?php _e( 'Available in', 'ms' ); ?></div>

					<?php
						$plan = array(
							''              => 'Any',
							'free'          => 'Free',
							'ticket'        => 'Ticket',
							'ticket-chat'   => 'Ticket+Chat',
							'all-inclusive' => 'All-Inclusive',
							'extensions'    => 'Extensions',
						);

						foreach ( $plan as $key => $value ) {
							?>
						<label>
							<input class="filter-item" type="radio" value="<?php echo esc_attr( $key ); ?>" name="plan"
							<?php
							if ( current( $plan ) === $value ) {
								echo 'checked';
							}
							?>
							>
							<span onclick="_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Plan - <?php echo esc_html( $value ); ?>'])"><?php echo esc_html( $value ); ?></span>
						</label>
					<?php } ?>
				</div>

				<div class="Category__sidebar__item">
					<div class="Category__sidebar__item__title h4"><?php _e( 'Suitable for', 'ms' ); ?></div>

					<?php
						$size = array(
							''            => 'Any',
							'individuals' => 'Individuals',
							'start-ups'   => 'Start-ups',
							'smbs'        => 'SMBs',
							'enterprise'  => 'Enterprise',
						);

						foreach ( $size as $key => $value ) {
							?>
						<label>
							<input class="filter-item" type="radio" value="<?php echo esc_attr( $key ); ?>" name="size"
							<?php
							if ( current( $size ) === $value ) {
								echo 'checked';
							}
							?>
							>
							<span onclick="_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Size - <?php echo esc_html( $value ); ?>'])"><?php echo esc_html( $value ); ?></span>
						</label>
					<?php } ?>
				</div>

				<div class="Category__sidebar__item">
					<div class="Category__sidebar__item__title h4"><?php _e( 'Category', 'ms' ); ?></div>
					<label>
						<input class="filter-item" type="radio" value="" name="category" checked />
						<span onclick="_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Category - Any'])"><?php _e( 'Any', 'ms' ); ?></span>
					</label>
					<?php
					$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_features_categories' ) ), SORT_REGULAR );
					foreach ( $categories as $category ) {
						?>
						<label>
							<input class="filter-item" type="radio" value="<?php echo esc_attr( $category->slug ); ?>" name="category"
							<?php
							if ( current( $category ) === $category->slug ) {
								echo 'checked';
							}
							?>
							>
							<span onclick="_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Category - <?= esc_html( $category->name ); ?>'])"><?= esc_html( $category->name ); ?></span>
						</label>
					<?php } ?>
				</div>
			</div>

		</div>

		<div class="Category__content">
			<div class="Category__content__description"><?php _e( 'List of features', 'ms' ); ?> <div>(<span id="countPosts"><?php echo esc_html( wp_count_posts( 'ms_features' )->publish ); ?></span>)</div></div>
			<ul class="Category__content__items list">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<?php
						$collections = '';
						$plan        = '';
						$size        = '';
						$category    = '';

					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) as $item ) {
								$plan .= $item . ' ';
						}

							$plan = substr( $plan, 0, -1 );
					}

					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_size', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_size', true ) as $item ) {
								$size .= $item . ' ';
						}

							$size = substr( $size, 0, -1 );
					}

					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_collections', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_collections', true ) as $item ) {
								$collections .= $item . ' ';
						}

							$collections = substr( $collections, 0, -1 );
					}

						$categories   = get_the_terms( 0, 'ms_features_categories' );
						$current_lang = apply_filters( 'wpml_current_language', null );
						do_action( 'wpml_switch_language', 'en' );
						$categories_en = get_the_terms( 0, 'ms_features_categories' );
					if ( ! empty( $categories_en ) ) {
						$category_en = array_shift( $categories_en )->slug;
					}
						do_action( 'wpml_switch_language', $current_lang );
					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category_item ) {
								$category_item = array_shift( $categories );
								$category     .= $category_item->slug;
								$category     .= ' ';
						}
					}
						$category = substr( $category, 0, -1 );

					?>

					<li class="Category__item
					<?php
					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) {
						echo 'pillar'; }
					?>
					<?= esc_attr( $category ); ?> <?= esc_attr( $category_en ) ?>" data-collections="<?= esc_attr( $collections ); ?>" data-plan="<?= esc_attr( $plan ); ?>" data-size="<?= esc_attr( $size ); ?>" data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Features', 'Go to <?php the_title(); ?> feature'])">
							<a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
								<?php if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) { ?>
									<span class="Category__item__thumbnail__image"></span>
								<?php } elseif ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail( 'archive_thumbnail' ); ?>
								<?php } else { ?>
									<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php _e( 'Features', 'ms' ); ?>">
								<?php } ?>
							</a>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) {
								?>
									<div class="Category__item__wrap">
								<?php
							}
							?>
								<h3 class="Category__item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="Category__item__excerpt">
									<a href="<?php the_permalink(); ?>">
										<?= esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
										<?php if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) { ?>
											<span><?php _e( 'Read More', 'ms' ); ?></span>
										<?php } ?>
									</a>
								</div>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) {
								?>
									</div>
								<?php
							}
							?>
					</li>

					<?php
						$collections = '';
						$plan        = '';
						$size        = '';
						$category    = '';
					?>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
