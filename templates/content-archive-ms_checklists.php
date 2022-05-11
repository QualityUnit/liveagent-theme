<?php // @codingStandardsIgnoreLine
	set_source( 'checklists', 'pages/blog', 'css' );
	set_source( 'checklists', 'pages/Category', 'css' );
	set_source( 'checklists', 'pages/ChecklistsArchive', 'css' );
	set_source( 'checklists', 'filter', 'js' );
?>

<div id="category" class="Category Checklists">
	<div class="Box Category__header Category__header--checklists">
		<div class="wrapper">
			<div class="Category__header--center">
				<h1 class="Category__header__title"><?php _e( 'Checklists', 'ms' ); ?></h1>
				<p class="Category__header__subtitle"><?php _e( 'Pick from a variety of detailed checklists for all your business needs. Organize your workflows and get any job done efficiently without difficulties.', 'ms' ); ?></p>

				<div class="Category__header__search searchField">
					<img class="searchField__icon" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-search_new_v2.svg" alt="<?php _e( 'Search', 'ms' ); ?>" />
					<input type="search" class="search search--academy" placeholder="<?php _e( 'Search', 'ms' ); ?>" maxlength="50">
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper Category__container">
		<div class="Category__sidebar" id="notFloating">
			<input class="Category__sidebar__showfilter" type="checkbox" id="showfilter">
			<label class="Button Button--outline Category__sidebar__showfilter--label" for="showfilter" data-hidden="<?php _e( 'Hide filters', 'ms' ); ?>">
				<img class="Category__sidebar__showfilter--icon" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-filter.svg" alt="<?php _e( 'Filters', 'ms' ); ?>">
				<span><?php _e( 'Filters', 'ms' ); ?></span>
			</label>

			<div class="Category__sidebar__items">
				<div class="Category__sidebar__item">
					<div class="Category__sidebar__item__title h4"><?php _e( 'Categories', 'ms' ); ?></div>
					<label>
						<input class="filter-item" type="radio" value="" name="category" checked />
						<span onclick="_paq.push(['trackEvent', 'Activity', 'Checklists', 'Filter - Category - All'])"><?php _e( 'All Categories', 'ms' ); ?></span>
					</label>
					<?php $categories = get_categories( array( 'taxonomy' => 'ms_checklists_categories' ) ); ?>
					<?php

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
							<span onclick="_paq.push(['trackEvent', 'Activity', 'Checklists', 'Filter - Category - <?= esc_html( $category->name ); ?>'])"><?= esc_html( $category->name ); ?></span>
						</label>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="Category__content">
			<div class="Category__content__description"><?php _e( 'List of checklists', 'ms' ); ?> <div>(<span id="countPosts"><?php echo esc_html( wp_count_posts( 'ms_features' )->publish ); ?></span>)</div></div>
			<ul class="Category__content__items list">
				<?php
				while ( have_posts() ) :
					the_post();
					$post_title = str_replace( '^', '', get_the_title() );
					?>

					<?php
						$category = '';

						$categories = get_the_terms( 0, 'ms_checklists_categories' );
					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category_item ) {
								$category_item = array_shift( $categories );
								$category     .= $category_item->slug;
								$category     .= ' ';
						}
					}
						$category = substr( $category, 0, -1 );
					?>

					<li class="Category__item Category__item--blogLike" data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Checklists', 'Go to <?= esc_attr( $post_title ); ?>'])">
							<a href="<?php the_permalink(); ?>" class="Category__item--blogLike__thumbnail">
								<?php 
									the_post_thumbnail();
								?>
							</a>
							<div class="Category__item--blogLike__content">
								<div class="Blog__item__meta__categories">
									<span class="Blog__item__meta__category"><?= esc_html( $category_item->name ); ?></span>
								</div>
								<h3 class="Category__item__title"><a href="<?php the_permalink(); ?>"><?= esc_html( $post_title ); ?></a></h3>
								<a href="<?php the_permalink(); ?>" class="Category__item__excerpt">
									<p>
										<?= esc_html( wp_trim_words( get_the_excerpt(), 12 ) ); ?>
									</p>
								</a>
							</div>
					</li>

					<?php
						$category = '';
					?>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>

