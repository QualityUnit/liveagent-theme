<?php
//todo: vymazat zakomentovane includovanie 'sidebar_toc'
//todo: vymazat 'Post__header__small' v php a css
//todo: filter toggle ikona
//todo: content-archive-ms_reviews.php ... zobrazovat $whatis_post?

// Note: CSS was moved to assets.php because of CLS Web Vital
function inline_compact_header() {
		ob_start();
		$css  = file_get_contents( get_template_directory() . '/assets/dist/components/compactHeader' . isrtl() . wpenv() . '.css' );
		$css .= file_get_contents( get_template_directory() . '/assets/dist/components/Filter' . isrtl() . wpenv() . '.css' );
		ob_get_clean();

		// return the stored style
	if ( '' != $css ) {
		echo '<style id="compactheader-css" type="text/css">' . $css . '</style>'; // @codingStandardsIgnoreLine
	}
}
inline_compact_header();
?>
<?php set_custom_source( 'filterMenu', 'js' ); ?>
<?php set_custom_source( 'sortingMenu', 'js' ); ?>
<?php set_custom_source( 'compactHeader', 'js' ); ?>
<?php if ( isset( $args ) ) { ?>
	<?php
	$header_type = 'lvl-2';
	if ( ! empty( $args['type'] ) ) {
		$header_type = $args['type'];
	}
	if ( ! empty( $args['filter'] ) ) {
		$filer_items = $args['filter'];
	}
	if ( ! empty( $args['author'] ) ) {
		$author_infos = $args['author'];
	}
	if ( ! empty( $args['sort'] ) ) {
		$filer_sort = $args['sort'];
	}
	$search_class = '';
	if ( ! empty( $args['search'] ) ) {
		$filer_search = $args['search'];
		if ( ! empty( $filer_search['type'] ) ) {
			$search_type  = $filer_search['type'];
			$search_class = ' search--' . $search_type;
		}
	}
	if ( ! empty( $args['count'] ) ) {
		$filer_count = $args['count'];
	}
	if ( ! empty( $args['menu'] ) ) {
		$menu_header = $args['menu'];
	}
	if ( ! empty( $args['research_nav'] ) ) {
		$research_nav = $args['research_nav'];
	}
	if ( ! empty( $args['checklist'] ) ) {
		$checklist = $args['checklist'];
	}
	$mobile_filter = $args['mobile_filter'] ?? true;
	?>
	<div class="compact-header__placeholder">
	<div class="compact-header compact-header--<?= sanitize_html_class( $header_type ); ?> urlslab-skip-lazy">
		<div class="compact-header__wrapper wrapper"
		<?php
		if ( is_author() ) {
			?>
			 itemscope itemtype="http://schema.org/Person"
		<?php } ?> >
			<div class="compact-header__left">
				<!--Breadcrumb section-->
				<?php
				if ( ! empty( $args['breadcrumb'] ) ) {
					site_breadcrumb( $args['breadcrumb'] );
				} else {
					site_breadcrumb();
				}

				$itemprop_title = ( is_singular( 'ms_directory' ) || is_author() ) ? 'name' : 'headline';

				?>
				<!-- Breadcrumb section end -->
				<?php
				if ( is_author() ) {
					if ( ! empty( $author_infos['name'] ) ) {
						?>
						<!-- Author title section -->
						<h1 itemprop="<?= esc_attr( $itemprop_title ); ?>" class="compact-header__title"><?= esc_html( $author_infos['name'] ); ?></h1>
					<?php } ?>
					<!-- Author title section end -->
					<?php
				} else {
					if ( ! empty( $args['title'] ) ) {

						?>
						<!-- Title section -->
						<h1 itemprop="<?= esc_attr( $itemprop_title ); ?>" class="compact-header__title"><?= esc_html( $args['title'] ); ?></h1>
					<?php } ?>
					<!-- Title section end -->
				<?php } ?>
				<?php if ( ! empty( $args['update'] ) ) { ?>
					<!-- Reviews update section -->
					<div class="compact-header__update">
						<time class="Reviews__update" itemprop="dateModified" content="<?= esc_attr( get_the_modified_time( 'F j, Y g:i a' ) ); ?>">
							<?php if ( ! empty( $args['update']['label'] ) ) { ?>
								<?= esc_html( $args['update']['label'] . ' ' ); ?>
							<?php } ?>
							<em><?= esc_html( get_the_modified_time( 'F j, Y' ) ); ?></em>
						</time>
					</div>
					<!-- Reviews update section end -->
				<?php } ?>

				<?php
				if ( is_author() ) {
					if ( ! empty( $author_infos['text'] ) ) {
						?>
						<!-- Author description section -->
						<div class="compact-header__text" itemprop="description"><?= wp_kses_post( $author_infos['text'] ); ?></div>
					<?php } ?>
					<!-- Author description section end -->
					<?php
				} else {
					if ( ! empty( $args['text'] ) ) {
						?>
						<!-- Description section -->
						<div class="compact-header__text"><?= wp_kses_post( $args['text'] ); ?></div>
					<?php } ?>
					<!-- Description end -->
				<?php } ?>
				<?php
				if ( ! empty( $args['count_posts'] ) ) {
					$count_posts = $args['count_posts'];
					$count_posts_output = sprintf(
						_n(
							'%s migration',
							'%s migrations',
							$count_posts,
							'ms'
						),
						$count_posts
					);
					?>
					<!-- Count posts -->
						<div class="compact-header__count-posts"><?= esc_html( $count_posts_output ); ?></div>
					<!-- Count posts end -->
				<?php } ?>
				<?php
				if ( is_author() ) {
					if ( ! empty( $author_infos['socials'] ) ) {
						$website_link = $author_infos['website'];
						?>
						<div class="compact-header__author__social">
							<a href="<?= esc_url( $website_link ); ?>"  title="<?php printf( '%s&#39;s %s', esc_html( get_the_author() ), esc_html( __( 'Website', 'ms' ) ) ); ?>" rel="noopener nofollow">
								<svg>
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#globe' ); ?>"></use>
								</svg>
							</a>

							<?php
							foreach ( $author_infos['socials'] as $social_item ) {
								$social_name = $social_item['social_name'];
								$social_link = $social_item['social_link'];
								?>
									<?php if ( isset( $social_link ) && isset( $social_name ) ) { ?>
										<a href="<?= esc_url( $social_link ); ?>"
											<?php
											printf(
												'title="%s&#39;s %s"',
												esc_attr( $author_infos['name'] ),
												esc_attr( ucfirst( $social_name ) )
											);
											?>
											 target="_blank" itemprop="sameAs" rel="noopener nofollow"
										>
											<svg>
												<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#social-' . $social_name ); ?>"></use>
											</svg>
										</a>
									<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
			<?php	} ?>
				<?php if ( ! empty( $args['date'] ) ) { ?>
					<!-- Date section -->
					<?php
						$date_machine  = get_the_time( 'Y-m-d' );
						$date_human    = get_the_time( 'F j, Y' );
						$date_modified = get_the_modified_time( 'F j, Y' );
						$time_modified = get_the_modified_time( 'g:i a' );
						$author_name = get_the_author_meta( 'display_name' );
						$author_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
						$time_zone = wp_timezone_string();
					?>
					<div class="compact-header__date">
						<?php if ( isset( $date_machine ) && isset( $date_human ) ) { ?>
							<span itemprop="datePublished" content="<?= esc_attr( $date_machine . ' ' . $time_modified . ' ' . $time_zone ); ?>">
							<?= esc_html( __( 'Published on', 'ms' ) ); ?>
							<?= esc_html( $date_human ); ?>
							</span>
						<?php } ?>
						<?= esc_html( __( 'by', 'ms' ) ) . ' '; ?><a href="<?= esc_url( $author_link ); ?>"><?= esc_html( $author_name ); ?></a><?= '.'; ?>
						<?php if ( isset( $date_modified ) && isset( $time_modified ) ) { ?>
						<span itemprop="dateModified" content="<?= esc_attr( $date_modified . ' ' . $time_modified . ' ' . $time_zone ); ?>">
							<?= esc_html( __( 'Last modified on', 'ms' ) ); ?>
							<?= esc_html( $date_modified ); ?>
							<?= esc_html( __( 'at', 'ms' ) ); ?>
							<?= esc_html( $time_modified ) . '.'; ?>

						</span>
						<?php } ?>
					</div>
					<!-- Date section end -->
				<?php } ?>

				<?php
				$cta_button_info = $args['cta_button'] ?? array();
				$buttons         = $args['buttons'] ?? array();

				$render_cta_buttons = array();
				foreach ( $cta_button_info as $cta_button ) {
					if ( 'yes' === $cta_button['enabled'] ) {
						$render_cta_buttons[] = array(
							'url'  => esc_url( $cta_button['url'] ),
							'text' => esc_html( $cta_button['text'] ),
						);
					}
				}

				$render_buttons = array();
				foreach ( $buttons as $button ) {
					if ( isset( $button['title'], $button['href'] ) ) {
						$button_classes = isset( $button['target'] ) && '_blank' === $button['target']
							? 'Button Button--outline'
							: 'Button Button--outline Button--outline-gray';

						$render_buttons[] = array(
							'href'    => esc_url( $button['href'] ),
							'title'   => esc_attr( $button['title'] ),
							'target'  => isset( $button['target'] ) ? esc_attr( $button['target'] ) : '',
							'rel'     => isset( $button['rel'] ) ? esc_attr( $button['rel'] ) : '',
							'onclick' => isset( $button['onclick'] ) ? esc_attr( $button['onclick'] ) : '',
							'classes' => esc_attr( $button_classes ),
						);
					}
				}
				?>

				<?php
				if ( ! empty( $render_buttons ) || ! empty( $render_cta_buttons ) ) {
					?>
					<!-- Buttons section -->
					<div class="compact-header__buttons">
						<div class="compact-header__buttons-items">
							<?php
							foreach ( $render_cta_buttons as $cta_button ) :
								if ( $cta_button['url'] && $cta_button['text'] ) {
									?>

									<div class="compact-header__buttons-item">
										<a class="Button Button--full Button--without-icon" href="<?= esc_url( $cta_button['url'] ); ?>">
											<span><?= esc_html( $cta_button['text'] ); ?></span>
										</a>
									</div>
								<?php } ?>
								<?php endforeach; ?>

							<?php
							foreach ( $render_buttons as $button ) :
								?>
								<div class="compact-header__buttons-item">
									<a href="<?= esc_url( $button['href'] ); ?>"
										 class=" <?= esc_html( $button['classes'] ); ?>"
										 title="<?= esc_attr( $button['title'] ); ?>"
										 target="<?= esc_attr( $button['target'] ); ?>"
										 rel="<?= esc_attr( $button['rel'] ); ?>"
										 onclick="<?= esc_attr( $button['onclick'] ); ?>"
									>
										<span><?= esc_html( $button['title'] ); ?></span>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<!-- Buttons section end -->
					<?php
				}
				?>


				<?php if ( ! empty( $args['tags'] ) ) { ?>
					<!-- Tags section -->
					<div class="compact-header__tags">
						<?php foreach ( $args['tags'] as $item ) { ?>
							<div class="compact-header__tags-item">
								<?php if ( isset( $item['title'] ) ) { ?>
									<div class="compact-header__tags-title"><?= esc_html( $item['title'] ); ?>:</div>
								<?php } ?>
								<?php if ( isset( $item['list'] ) ) { ?>
									<ul class="compact-header__tags-list">
									<?php foreach ( $item['list'] as $tag_item ) { ?>
										<li>
											<?php if ( isset( $tag_item['href'] ) && isset( $tag_item['title'] ) ) { ?>
												<a href="<?= esc_url( $tag_item['href'] ); ?>"
												   title="<?= esc_attr( $tag_item['title'] ); ?>"
												   <?php if ( isset( $tag_item['target'] ) ) { ?>
													   target="<?= esc_attr( $tag_item['target'] ); ?>"
													<?php } ?>
													<?php if ( isset( $tag_item['rel'] ) ) { ?>
														rel="<?= esc_attr( $tag_item['rel'] ); ?>"
													<?php } ?>
													<?php if ( isset( $tag_item['onclick'] ) ) { ?>
														onclick="<?= esc_attr( $tag_item['onclick'] ); ?>"
													<?php } ?>
												>
													<svg class="icon-tag-solid">
														<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#tag-solid' ); ?>"></use>
													</svg>
													<?= esc_html( $tag_item['title'] ); ?>
												</a>
											<?php } ?>
										</li>
									<?php } ?>
								</ul>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<!-- Tags section end -->
				<?php } ?>

			</div>
			<div class="compact-header__right">
				<?php if ( ! empty( $args['toc'] ) ) { ?>
					<!-- TOC section -->
					<?php if ( isset( $args['toc']['items'] ) ) { ?>
						<?= wp_kses_post( compact_header_toc( null, $args['toc']['items'] ) ); ?>
					<?php } else { ?>
						<?= wp_kses_post( compact_header_toc() ); ?>
					<?php } ?>
					<!-- TOC section end -->
				<?php } ?>

				<?php if ( is_author() ) { ?>
					<?php if ( ! empty( $author_infos['img'] ) ) { ?>
						<!--Author thumbnail section-->
							<?php
							$img = $author_infos['img'];
							?>
							<?php if ( isset( $img ) ) { ?>
								<div class="compact-header__image">
									<?php
									if ( isset( $img ) ) {
										if ( get_post_meta( get_the_ID(), 'mb_update_label_enabled', true ) && is_single() ) {
											$monthly_update_label_title = get_post_meta( get_the_ID(), 'mb_update_label_title', true );
											$monthly_update_label_text = get_post_meta( get_the_ID(), 'mb_update_label_text', true );

											if ( ! empty( $monthly_update_label_title ) && ! empty( $monthly_update_label_text ) ) {
												?>
												<div class="compact-header__image__label">
													<div class="compact-header__image__label--title"><?php echo esc_html( $monthly_update_label_title ); ?></div>
													<div class="compact-header__image__label--text"><?php echo esc_html( $monthly_update_label_text ); ?></div>
												</div>
												<?php
											}
										}
										?>
										<meta itemprop="image" content="<?= esc_url( $img ); ?>">
										<img
											fetchpriority="high"
											src="<?= esc_url( $img ); ?>"
											alt="<?= esc_attr( $author_infos['name'] ); ?>"
											class="compact-header__img--author"
										>
									<?php } ?>
								</div>
							<?php } ?>
						<?php } ?>
					<!-- Author thumbnail section end -->
				<?php } else { ?>
					<?php if ( ! empty( $args['image'] ) ) { ?>
						<!-- Thumbnail section -->
						<?php
						$image = $args['image'];
						?>
						<?php if ( ! is_mobile() && ( isset( $image['src'] ) ) ) { ?>
							<div class="compact-header__image">
							<?php
							if ( isset( $image['src'] ) ) {
								if ( get_post_meta( get_the_ID(), 'mb_update_label_enabled', true ) && is_single() ) {
									$monthly_update_label_title = get_post_meta( get_the_ID(), 'mb_update_label_title', true );
									$monthly_update_label_text = get_post_meta( get_the_ID(), 'mb_update_label_text', true );

									if ( ! empty( $monthly_update_label_title ) && ! empty( $monthly_update_label_text ) ) {
										?>
										<div class="compact-header__image__label">
											<div class="compact-header__image__label--title"><?php echo esc_html( $monthly_update_label_title ); ?></div>
											<div class="compact-header__image__label--text"><?php echo esc_html( $monthly_update_label_text ); ?></div>
										</div>
										<?php
									}
								}
								?>
							<meta itemprop="image" content="<?= esc_url( $image['src'] ); ?>">
							<img
								fetchpriority="high"
								src="<?= esc_url( $image['src'] ); ?>"
								alt="<?= esc_attr( $image['alt'] ); ?>"
								class="compact-header__img"
							>
							<?php } ?>
							<?php
							if ( isset( $image['screenshot'] ) ) {
								echo $image['screenshot']; // @codingStandardsIgnoreLine
							}
							?>
							<?php if ( ! empty( $args['logo'] ) ) { ?>
								<?php $logo = $args['logo']; ?>
								<?php if ( isset( $logo['src'] ) ) { ?>
									<div class="compact-header__logo">
										<meta itemprop="image" content="<?= esc_url( $logo['src'] ); ?>">
										<img
											fetchpriority="high"
											src="<?= esc_url( $logo['src'] ); ?>"
											<?php if ( isset( $logo['alt'] ) ) { ?>
												alt="<?= esc_attr( $logo['alt'] ); ?>"
											<?php } ?>
											class="compact-header__logo-img"
										>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<?php } ?>
					<?php } ?>
					<!-- Thumbnail section end -->
				<?php } ?>
			</div>
			<!--Filter section-->
			<?php
			if ( ! is_author() ) {
				if ( isset( $filer_search ) || isset( $filer_items ) || isset( $filer_sort ) || isset( $filer_count ) || isset( $menu_header ) || isset( $research_nav ) || isset( $checklist ) ) {
					?>
				<div class="compact-header__bottom">
					   <?php if ( isset( $filer_search ) || isset( $filer_items ) || isset( $filer_sort ) || isset( $filer_count ) ) { ?>
							<?php if ( $mobile_filter ) { ?>
							<div class="compact-header__filters-toggle">
								<a class="Button Button--outline js-compact-header__toggle">
									<?= esc_html( __( 'Filters', 'ms' ) ); ?>
									<svg class="searchField__reset-icon icon-gear">
										<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#gear' ); ?>"></use>
									</svg>
								</a>
							</div>
						<?php } ?>
						<div class="compact-header__filters js-compact-header__close urlslab-skip-keywords">
							<a class="compact-header__filters-close js-compact-header__close">
								<svg class="icon-close">
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ); ?>"></use>
								</svg>
							</a>
							<?php
							$filter_fields_count = 0;
							if ( isset( $filer_search ) || isset( $filer_sort ) ) {
								$filter_fields_count++;
							}
							if ( isset( $filer_items ) ) {
								$filter_fields_count = $filter_fields_count + count( $filer_items );
							}
							?>
							<div class=" compact-header__filters-wrap
							<?php
							if ( isset( $filer_count ) ) {
								?>
								 compact-header__filters-wrap--count<?php } ?>">
								<span class="compact-header__filters-collapse js-compact-header__close"></span>
								<div class="compact-header__filters-inn
								<?php
								if ( $filter_fields_count < 3 ) {
									?>
									compact-header__filters-inn-sm<?php } ?>">
									<?php if ( isset( $filer_search ) ) { ?>
										<div class="compact-header__search">
											<div class="searchField">
												<svg class="searchField__icon icon-search">
													<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#search' ); ?>"></use>
												</svg>
												<input type="search" class="search<?= esc_attr( $search_class ); ?>" placeholder="<?php _e( 'Search', 'ms' ); ?>" maxlength="50">
												<span class="search-reset">
										<svg class="search-reset__icon icon-close">
											<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ); ?>"></use>
										</svg>
									</span>
											</div>
										</div>
									<?php } ?>
									<?php if ( isset( $filer_sort ) ) { ?>
										<?php
										if ( ! empty( $filer_sort['items'] ) ) {
											$sort_items = $filer_sort['items'];
										}
										?>
										<?php if ( isset( $sort_items ) ) { ?>
											<div class="FilterMenu__wrapper SortingMenu__wrapper flex-tablet flex-align-center">
											<?php if ( isset( $filer_sort['label'] ) ) { ?>
												<div class="FilterMenu__desc SortingMenu__desc"><?= esc_html( $filer_sort['label'] ); ?></div>
											<?php } ?>
											<div class="FilterMenu SortingMenu" data-sort="relatedReviews">
												<div class="FilterMenu__title SortingMenu__title flex flex-align-center" data-title>
													<?= esc_html( $sort_items[0]['title'] ); ?>
												</div>
												<div class="FilterMenu__items SortingMenu__items" data-items>
													<div class="FilterMenu__items--inn SortingMenu__items--inn">
														<?php
														$counter = 0;
														foreach ( $sort_items as $item ) {
															++$counter;
															?>
															<div class="sorting FilterMenu__item SortingMenu__item">
																<input class="sorting-item" type="radio" id="<?= esc_attr( $item['value'] ); ?>" value="<?= esc_attr( $item['value'] ); ?>" name="relatedReviews" data-sortBy="<?= esc_attr( $item['title'] ); ?>" <?= esc_attr( 1 === $counter ? 'checked' : '' ); ?> />
																<label for="<?= esc_attr( $item['value'] ); ?>">
																	<span
																		<?php if ( isset( $item['onclick'] ) ) { ?>
																			onclick="<?= esc_attr( $item['onclick'] ); ?>"
																		<?php } ?>
																	><?= esc_html( $item['title'] ); ?></span>
																</label>
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									<?php } ?>
									<?php if ( isset( $filer_items ) ) { ?>
										<?php foreach ( $filer_items as $filer_item ) { ?>
											<?php
											if ( ! empty( $filer_item['type'] ) ) {
												$filer_type = $filer_item['type'];
											}
											if ( ! empty( $filer_item['items'] ) ) {
												$filer_list = $filer_item['items'];
											}
											if ( ! empty( $filer_item['name'] ) ) {
												$filer_name = $filer_item['name'];
											}
											?>
											<?php if ( isset( $filer_list ) && isset( $filer_type ) ) { ?>
												<?php
												if ( ! empty( $filer_item['active'] ) ) {
													$filer_active = $filer_item['active'];
												} else {
													$filer_active = $filer_list[0]['title'];
												}
												?>
												<div class="compact-header__filter">
													<?php if ( ! empty( $filer_item['title'] ) ) { ?>
														<div class="compact-header__filter-label">
															<?= esc_html( $filer_item['title'] ); ?>
														</div>
													<?php } ?>
													<div class="FilterMenu">
														<div class="FilterMenu__title">
															<?= esc_html( $filer_active ); ?>
														</div>
														<div class="FilterMenu__items">
															<div class="FilterMenu__items--inn">
																<?php if ( 'radio' == $filer_type && isset( $filer_name ) ) { ?>
																	<?php foreach ( $filer_list as $filer_list_item ) { ?>
																		<?php
																		$item_checked = false;
																		$item_value   = '';
																		if ( ! empty( $filer_list_item['checked'] ) ) {
																			$item_checked = $filer_list_item['checked'];
																		}
																		if ( ! empty( $filer_list_item['value'] ) ) {
																			$item_value = $filer_list_item['value'];
																		}
																		if ( ! empty( $filer_list_item['title'] ) ) {
																			$item_title = $filer_list_item['title'];
																		}
																		if ( ! empty( $filer_list_item['onclick'] ) ) {
																			$item_onclick = $filer_list_item['onclick'];
																		}
																		if ( '' == $item_value ) {
																			$item_id = $filer_name . '-any';
																		} else {
																			$item_id = $filer_name . '-' . $item_value;
																		}
																		?>
																		<div class="checkbox FilterMenu__item">
																			<input
																				class="filter-item"
																				type="radio"
																				id="<?= esc_attr( $item_id ); ?>"
																				value="<?= esc_attr( $item_value ); ?>"
																				name="<?= esc_attr( $filer_name ); ?>"
																				<?php if ( isset( $item_title ) ) { ?>
																					title="<?= esc_attr( $item_title ); ?>"
																				<?php } ?>
																				<?php if ( $item_checked ) { ?>
																					checked
																				<?php } ?>
																			>
																			<label for="<?= esc_attr( $item_id ); ?>">
																				<span
																					class="FilterMenu__item-title"
																					<?php if ( isset( $item_onclick ) ) { ?>
																						onclick="<?= esc_attr( $item_onclick ); ?>"
																					<?php } ?>
																				>
																					<?php if ( isset( $item_title ) ) { ?>
																						<?= esc_html( $item_title ); ?>
																					<?php } ?>
																				</span>
																			</label>
																		</div>
																	<?php } ?>
																<?php } ?>
																<?php if ( 'link' == $filer_type && isset( $filer_name ) ) { ?>
																	<?php foreach ( $filer_list as $filer_list_item ) { ?>
																		<?php if ( isset( $filer_list_item['href'] ) && isset( $filer_list_item['title'] ) && isset( $filer_list_item['active'] ) ) { ?>
																			<a href="<?= esc_url( $filer_list_item['href'] ); ?>" class="checkbox FilterMenu__item
																			<?php if ( true == $filer_list_item['active'] ) { ?>
																				active
																			<?php } ?>
																			" active>
																				<span class="checkbox-label FilterMenu__item-title"><?= esc_html( $filer_list_item['title'] ); ?></span>
																			</a>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</div>
								<?php if ( isset( $filer_count ) ) { ?>
									<div class="compact-header__count">
										<span id="countPosts">
											<?php if ( isset( $filer_count['value'] ) ) { ?>
												<?= esc_html( $filer_count['value'] ); ?>
											<?php } ?>
										</span>
										<?php if ( isset( $filer_count['title'] ) ) { ?>
											<?= esc_html( $filer_count['title'] ); ?>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="compact-header__filters-apply">
							<a class="Button Button--full js-compact-header__apply">
								<span><?= esc_html( __( 'Apply', 'ms' ) ); ?></span>
							</a>
						</div>
					<?php } elseif ( isset( $menu_header ) ) { ?>
						<div class="compact-header__menu">
							<?php if ( isset( $menu_header['title'] ) ) { ?>
								<div class="compact-header__menu-title"><?= esc_html( $menu_header['title'] ); ?></div>
							<?php } ?>
							<?php if ( isset( $menu_header['items'] ) ) { ?>
								<div class="compact-header__menu-items">
									<ul>
										<?php foreach ( $menu_header['items'] as $menu_item ) { ?>
											<li
												<?php if ( isset( $menu_item['active'] ) ) { ?>
													<?php if ( $menu_item['active'] ) { ?>
														class="active"
													<?php } ?>
												<?php } ?>
											>
												<?php if ( isset( $menu_item['href'] ) ) { ?>
												<a href="<?= esc_url( $menu_item['href'] ); ?>">
													<?php } ?>
													<?php if ( isset( $menu_item['title'] ) ) { ?>
														<?= esc_html( $menu_item['title'] ); ?>
													<?php } ?>
													<?php if ( isset( $menu_item['href'] ) ) { ?>
												</a>
											<?php } ?>
											</li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
						</div>
					<?php } elseif ( isset( $research_nav ) ) { ?>
						<div class="compact-header__research">
							<nav class="Research--navigation">
								<div class="Research--navigation__title"><?php _e( 'Navigation', 'ms' ); ?></div>
								<div class="Research--navigation__posts">

									<div class="Research--navigation__selected" data-id="<?= esc_attr( get_the_ID() ); ?>"> <?php echo esc_html( str_replace( '^', '', get_the_title() ) ); ?> </div>

									<div class="Research--navigation__menu hidden">
										<ul class="Research--navigation__menu__inn">
											<?php $categories = array_unique( get_categories( array( 'taxonomy' => 'ms_research_categories' ) ), SORT_REGULAR ); ?>
											<?php
											$counter = 0;
											foreach ( $categories as $category ) {
												$query_research_posts = new WP_Query(
													array(
														'ms_research_categories' => $category->slug,
                                                        // @codingStandardsIgnoreLine
                                                        'posts_per_page' => 500,
														'orderby' => 'menu_order',
														'order'   => 'ASC',
													)
												);

												while ( $query_research_posts->have_posts() ) :
													$query_research_posts->the_post();
													++$counter;
													$color = $counter;
                                                    if ( $counter % 9 == 0 ) { // @codingStandardsIgnoreLine
														$color = 9;
													}
													if ( $counter % 9 > 0 ) {
														$color = $counter % 9;
													}
													?>
													<li data-id="<?= esc_attr( get_the_ID() ); ?>" data-color="<?php echo esc_attr( $color ); ?>" class="Research--navigation__post Research--color-<?php echo esc_html( $color ); ?>">
														<a class="Research--navigation__post__title" href="<?php the_permalink(); ?>">
													<span class="Research--navigation__counter">
													<?php
													echo esc_html( $counter < 10 ? ( '0' . $counter ) : $counter );
													?>
												</span>
															<?php echo esc_html( str_replace( '^', '', get_the_title() ) ); ?>
														</a>
													</li>
												<?php endwhile; ?>
												<?php wp_reset_postdata(); ?>
											<?php } ?>
										</ul>
									</div>
								</div>
							</nav>
						</div>
					<?php } elseif ( isset( $checklist ) ) { ?>
						<div class="compact-header__checklist">
							<div class="Checklists__toc__main" data-target="ChecklistTOC">
								<?php if ( checklists_toc() !== false ) { ?>
									<div class="Checklists__toc__label"><?php _e( 'Contents', 'ms' ); ?></div>
									<div class="Checklists__toc__block js-toc">
										<div class="Checklists__toc__title js-toc__title"><?= esc_html( checklists_toc()->title ); ?></div>
										<span class="Checklists__toc__activator"></span>
										<div class="Checklists__toc__wrapper hidden" data-targetId="ChecklistTOC">
											<div class="Checklists__toc__inn">
												<ul class="Checklists__toc js-toc__items">
													<?= wp_kses_post( checklists_toc()->toc ); ?>
												</ul>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
							<div class="compact-header__checklist-progress CircleProgressBar">
								<div class="CircleProgressBar__middle" id="circleProgressMiddle"></div>
								<div class="CircleProgressBar__spinner" id="circleProgressSpinner"></div>
							</div>
							<?php if ( checklists_toc() !== false ) { ?>
								<div class="compact-header__checklist-counter" id="checklistsCounter" data-checked="0" data-total="<?= esc_attr( checklists_toc()->count ); ?>">
									<?= esc_html( checklists_toc()->count ); ?>
								</div>
								<div class="compact-header__checklist-collapse">
									<span class="qu-Checklist__expander qu-Checklist__expander--collapse" data-action="closeAll">
										<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 18.59 8.83 20 12 16.83 15.17 20l1.41-1.41L12 14l-4.59 4.59Zm9.18-13.18L15.17 4 12 7.17 8.83 4 7.41 5.41 12 10l4.59-4.59Z" fill="#050505"/></svg>
										<span class="desktop--only"><?php _e( 'Collapse All', 'ms' ); ?></span>
									</span>
									<span class="qu-Checklist__expander qu-Checklist__expander--expand inactive" data-action="openAll">
										<svg viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 18.59 8.83 20 12 16.83 15.17 20l1.41-1.41L12 14l-4.59 4.59Z" style="fill:#050505" transform="translate(0 -10)"/><path d="M16.59 5.41 15.17 4 12 7.17 8.83 4 7.41 5.41 12 10l4.59-4.59Z" style="fill:#050505" transform="translate(0 10)"/></svg>
										<span class="desktop--only"><?php _e( 'Expand All', 'ms' ); ?></span>
									</span>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
					<?php
				}
			}
			?>
			<!--Filter section end-->
		</div>
	</div>
	</div>
<?php } ?>
