<?php
//todo: bug: filter - rozklikavanie selectov
//todo: bug: pri vyske stranky,ktora je len o par stovak px vyssia ako okno preblikava compact header
?>
<?php set_custom_source( 'components/compactHeader', 'css' ); ?>
<?php set_custom_source( 'components/Filter', 'css' ); ?>
<?php set_custom_source( 'filterMenu', 'js' ); ?>
<?php set_custom_source( 'compactHeader', 'js' ); ?>
<?php if ( isset( $args ) ) : ?>
	<?php
	$header_type = 'lvl-2';
	if ( ! empty( $args['type'] ) ) {
		$header_type = $args['type'];
	}
	if ( ! empty( $args['filter'] ) ) {
		$filer_items = $args['filter'];
	}
	$search_class = '';
	if ( ! empty( $args['search'] ) ) {
		$filer_search = $args['search'];
		if ( ! empty( $filer_search['type'] ) ) {
			$search_type = $filer_search['type'];
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
	?>
	<div class="compact-header compact-header--<?= sanitize_html_class( $header_type ); ?>">
		<div class="compact-header__wrapper wrapper">
			<div class="compact-header__left">
				<?php site_breadcrumb(); ?>
				<?php if ( ! empty( $args['title'] ) ) : ?>
					<h1 itemprop="name" class="compact-header__title"><?= esc_html( $args['title'] ); ?></h1>
				<?php endif ?>
				<?php if ( ! empty( $args['text'] ) ) : ?>
					<div class="compact-header__text"><?= wp_kses_post( $args['text'] ); ?></div>
				<?php endif ?>
				<?php if ( ! empty( $args['date'] ) ) : ?>
					<?php
						$date_machine = get_the_time( 'Y-m-d' );
						$date_human = get_the_time( 'F j, Y' );
						$date_modified = get_the_modified_time( 'F j, Y' );
						$time_modified = get_the_modified_time( 'g:i a' );
					?>
					<div class="compact-header__date">
						<?php if ( isset( $date_machine ) && isset( $date_human ) ) : ?>
							<span itemprop="datePublished" content="<?= esc_attr( $date_machine ); ?>"><?=
								esc_html( $date_human ); ?></span>
						<?php endif ?>
						<?php if ( isset( $date_modified ) && isset( $time_modified ) ) : ?>
							<?= esc_html( __( 'Last modified on', 'ms' ) ); ?>
							<?= esc_html( $date_modified ); ?>
							<?= esc_html( __( 'at', 'ms' ) ); ?>
							<?= esc_html( $time_modified ); ?>
						<?php endif ?>
					</div>
				<?php endif ?>
				<?php if ( ! empty( $args['buttons'] ) ) : ?>
					<div class="compact-header__buttons">
						<div class="compact-header__buttons-items">
							<?php foreach ( $args['buttons'] as $button ) : ?>
								<?php if ( isset( $button['title'] ) && isset( $button['href'] ) ) : ?>
									<?php
									$button_classes = 'Button Button--outline Button--outline-gray';
									if ( isset( $button['target'] ) ) :
										if ( '_blank' == $button['target'] ) :
											$button_classes = 'Button Button--outline';
										endif;
									endif;
									?>
									<div class="compact-header__buttons-item">
										<a href="<?= esc_url( $button['href'] ); ?>"
										   class="<?= esc_attr( $button_classes ); ?>"
										   title="<?= esc_attr( $button['title'] ); ?>"
											<?php if ( isset( $button['target'] ) ) : ?>
												<?php $button_classes .= 'Button'; ?>
												target="<?= esc_attr( $button['target'] ); ?>"
											<?php endif; ?>
											<?php if ( isset( $button['rel'] ) ) : ?>
												rel="<?= esc_attr( $button['rel'] ); ?>"
											<?php endif; ?>
											<?php if ( isset( $button['onclick'] ) ) : ?>
												onclick="<?= esc_attr( $button['onclick'] ); ?>"
											<?php endif; ?>
										>
											<span><?= esc_html( $button['title'] ); ?></span>
										</a>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $args['tags'] ) ) : ?>
					<div class="compact-header__tags">
						<?php foreach ( $args['tags'] as $item ) : ?>
							<div class="compact-header__tags-item">
								<?php if ( isset( $item['title'] ) ) : ?>
									<div class="compact-header__tags-title"><?= esc_html( $item['title'] ); ?>:</div>
								<?php endif; ?>
								<?php if ( isset( $item['list'] ) ) : ?>
									<ul class="compact-header__tags-list">
									<?php foreach ( $item['list'] as $tag_item ) : ?>
										<li>
											<?php if ( isset( $tag_item['href'] ) && isset( $tag_item['title'] ) ) : ?>
												<a href="<?= esc_url( $tag_item['href'] ); ?>"
												   title="<?= esc_attr( $tag_item['title'] ); ?>"
												   <?php if ( isset( $tag_item['target'] ) ) : ?>
													   target="<?= esc_attr( $tag_item['target'] ); ?>"
													<?php endif; ?>
													<?php if ( isset( $tag_item['rel'] ) ) : ?>
														rel="<?= esc_attr( $tag_item['rel'] ); ?>"
													<?php endif; ?>
													<?php if ( isset( $tag_item['onclick'] ) ) : ?>
														onclick="<?= esc_attr( $tag_item['onclick'] ); ?>"
													<?php endif; ?>
												>
													<svg class="icon-tag-solid">
														<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#tag-solid' ) ?>"></use>
													</svg>
													<?= esc_html( $tag_item['title'] ); ?>
												</a>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="compact-header__right">
				<?php if ( ! empty( $args['toc'] ) ) : ?>
					<?php if ( isset( $args['toc']['items'] ) ) : ?>
						<?= wp_kses_post( compact_header_toc( null, $args['toc']['items'] ) ); ?>
					<?php else : ?>
						<?= wp_kses_post( compact_header_toc() ); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ( ! empty( $args['image'] ) ) : ?>
					<?php
					$image = $args['image'];
					?>
					<?php if ( isset( $image['src'] ) ) : ?>
						<div class="compact-header__image">
							<img
								src="<?= esc_url( $image['src'] ); ?>"
								alt="<?= esc_attr( $image['alt'] ); ?>"
								class="compact-header__img"
							>
							<?php if ( ! empty( $args['logo'] ) ) : ?>
								<?php $logo = $args['logo']; ?>
								<?php if ( isset( $logo['src'] ) ) : ?>
									<div class="compact-header__logo">
										<img
											src="<?= esc_url( $logo['src'] ); ?>"
											<?php if ( isset( $logo['alt'] ) ) : ?>
												alt="<?= esc_attr( $logo['alt'] ); ?>"
											<?php endif; ?>
											class="compact-header__logo-img"
										>
									</div>
								<?php endif; ?>
							<?php endif ?>
						</div>
					<?php endif ?>
				<?php endif ?>
			</div>
			<?php if ( isset( $filer_search ) || isset( $filer_items ) || isset( $menu_header ) || isset( $research_nav ) ) : ?>
				<div class="compact-header__bottom">
					<?php if ( isset( $filer_search ) || isset( $filer_items ) ) : ?>
						<div class="compact-header__filters-toggle">
							<a class="Button Button--outline js-compact-header__toggle">
								<?= esc_html( __( 'Filters', 'ms' ) ); ?>
								<svg class="searchField__reset-icon icon-gear">
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#gear' ) ?>"></use>
								</svg>
							</a>
						</div>
						<div class="compact-header__filters urlslab-skip-keywords">
							<a class="compact-header__filters-close js-compact-header__close">
								<svg class="icon-close">
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ) ?>"></use>
								</svg>
							</a>
							<div class="compact-header__filters-wrap">
								<div class="compact-header__filters-inn">
									<?php if ( isset( $filer_search ) ) : ?>
										<div class="compact-header__search">
											<div class="searchField">
												<svg class="searchField__icon icon-search">
													<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#search' ) ?>"></use>
												</svg>
												<input type="search" class="search<?= esc_attr( $search_class ); ?>" placeholder="<?php _e( 'Search', 'ms' ); ?>" maxlength="50">
												<span class="search-reset">
										<svg class="search-reset__icon icon-close">
											<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ) ?>"></use>
										</svg>
									</span>
											</div>
										</div>
									<?php endif ?>
									<?php if ( isset( $filer_items ) ) : ?>
										<?php foreach ( $filer_items as $filer_item ) : ?>
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
											if ( ! empty( $filer_item['title'] ) ) {
												$filer_title = $filer_item['title'];
											}
											?>
											<?php if ( isset( $filer_list ) && isset( $filer_type ) && isset( $filer_title ) ) : ?>
												<div class="compact-header__filter">
													<div class="compact-header__filter-label">
														<?= esc_html( $filer_title ); ?>
													</div>
													<div class="FilterMenu">
														<div class="FilterMenu__title">
															<?= esc_html( $filer_list[0]['title'] ); ?>
														</div>
														<div class="FilterMenu__items">
															<div class="FilterMenu__items--inn">
																<?php if ( 'radio' == $filer_type && isset( $filer_name ) ) : ?>
																	<?php foreach ( $filer_list as $filer_list_item ) : ?>
																		<?php
																		$item_checked = false;
																		$item_value = '';
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
																		<div class="sorting FilterMenu__item">
																			<input
																				class="filter-item"
																				type="radio"
																				id="<?= esc_attr( $item_id ); ?>"
																				value="<?= esc_attr( $item_value ); ?>"
																				name="<?= esc_attr( $filer_name ); ?>"
																				<?php if ( $item_checked ) : ?>
																					checked
																				<?php endif; ?>
																			>
																			<label for="<?= esc_attr( $item_id ); ?>">
																				<span
																					class="FilterMenu__item-title"
																					<?php if ( isset( $item_onclick ) ) : ?>
																						onclick="<?= esc_attr( $item_onclick ); ?>"
																					<?php endif; ?>
																				>
																					<?php if ( isset( $item_title ) ) : ?>
																						<?= esc_html( $item_title ); ?>
																					<?php endif; ?>
																				</span>
																			</label>
																		</div>
																	<?php endforeach; ?>
																<?php endif; ?>
																<?php if ( 'link' == $filer_type && isset( $filer_name ) ) : ?>
																	<?php foreach ( $filer_list as $filer_list_item ) : ?>
																		<?php if ( isset( $filer_list_item['href'] ) && isset( $filer_list_item['title'] ) ) : ?>
																			<div class="sorting FilterMenu__item">
																				<a href="<?= esc_url( $filer_list_item['href'] ); ?>" class="FilterMenu__item-title">
																					<?= esc_html( $filer_list_item['title'] ); ?>
																				</a>
																			</div>
																		<?php endif; ?>
																	<?php endforeach; ?>
																<?php endif; ?>
															</div>
														</div>
													</div>
												</div>
											<?php endif ?>
										<?php endforeach; ?>
									<?php endif ?>
								</div>
							</div>
						</div>
						<div class="compact-header__filters-apply">
							<a class="Button Button--full js-compact-header__apply">
								<span><?= esc_html( __( 'Apply', 'ms' ) ); ?></span>
							</a>
						</div>
					<?php elseif ( isset( $menu_header ) ) : ?>
						<div class="compact-header__menu">
							<?php if ( isset( $menu_header['title'] ) ) : ?>
								<div class="compact-header__menu-title"><?= esc_html( $menu_header['title'] ); ?></div>
							<?php endif ?>
							<?php if ( isset( $menu_header['items'] ) ) : ?>
								<div class="compact-header__menu-items">
									<ul>
										<?php foreach ( $menu_header['items'] as $menu_item ) : ?>
											<?php
											$menu_item_href = $menu_item['href'];
											$menu_item_title = $menu_item['title'];
											$menu_item_active = $menu_item['active'];
											?>
											<li
												<?php if ( isset( $menu_item_active ) ) : ?>
													<?php if ( $menu_item_active ) : ?>
														class="active"
													<?php endif; ?>
												<?php endif; ?>
											>
												<?php if ( isset( $menu_item_href ) ) : ?>
												<a href="<?= esc_url( $menu_item_href ); ?>">
													<?php endif; ?>
													<?php if ( isset( $menu_item_title ) ) : ?>
														<?= esc_html( $menu_item_title ); ?>
													<?php endif; ?>
													<?php if ( isset( $menu_item_href ) ) : ?>
												</a>
											<?php endif; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
						</div>
					<?php elseif ( isset( $research_nav ) ) : ?>
						<div class="compact-header__research">
							<div class="Research--wrapper Research--wrapper__navigation">
								<nav class="Research--navigation">

									<div class="Research--navigation__title"><?php _e( 'Navigation', 'ms' ); ?></div>
									<div class="Research--navigation__posts">

										<div class="Research--navigation__selected h4" data-id="<?php echo get_the_ID(); ?>"> <?php echo esc_html( str_replace( '^', '', get_the_title() ) ); ?> </div>

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
														<li data-id="<?php echo get_the_ID(); ?>" data-color="<?php echo esc_attr( $color ); ?>" class="Research--navigation__post Research--color-<?php echo esc_html( $color ); ?>">
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
						</div>
					<?php endif ?>
				</div>
			<?php endif ?>
		</div>
	</div>
<?php endif ?>
