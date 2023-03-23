<?php
//todo: menu polozky na mobile
//todo: selectbox chovanie
//todo: ?awards je elementor stranka?
?>
<?php set_custom_source( 'components/compactHeader', 'css' ); ?>
<?php set_custom_source( 'components/Filter', 'css' ); ?>
<?php set_custom_source( 'filterMenu', 'js' ); ?>
<?php set_custom_source( 'compactHeader', 'js' ); ?>
<?php if ( isset( $args ) ) : ?>
	<?php
	$image_alt = '';
	$image_type = 'default';
	if ( ! empty( $args['image'] ) ) {
		$image = $args['image'];
		if ( ! empty( $image['src'] ) ) {
			$image_src = $image['src'];
		}
		if ( ! empty( $image['alt'] ) ) {
			$image_alt = $image['alt'];
		}
		if ( ! empty( $image['type'] ) ) {
			$image_type = $image['type'];
		}
	}
	if ( ! empty( $args['logo'] ) ) {
		$logo = $args['logo'];
	}
	if ( ! empty( $args['title'] ) ) {
		$main_title = $args['title'];
	}
	if ( ! empty( $args['text'] ) ) {
		$text = $args['text'];
	}
	if ( ! empty( $args['date'] ) ) {
		$date = $args['date'];
		$date_machine = get_the_time( 'Y-m-d' );
		$date_human = get_the_time( 'F j, Y' );
		$date_modified = get_the_modified_time( 'F j, Y' );
		$time_modified = get_the_modified_time( 'g:i a' );
	}
	if ( ! empty( $args['tags'] ) ) {
		$tags = $args['tags'];
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
	?>
	<div class="compact-header compact-header__top">
		<div class="compact-header__wrapper wrapper">
			<div class="compact-header__left">
				<?php site_breadcrumb(); ?>
				<?php if ( isset( $main_title ) ) : ?>
					<h1 itemprop="name" class="compact-header__title"><?= esc_html( $main_title ); ?></h1>
				<?php endif ?>
				<?php if ( isset( $text ) ) : ?>
					<div class="compact-header__text"><?= wp_kses_post( $text ); ?></div>
				<?php endif ?>
				<?php if ( isset( $date ) ) : ?>
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
				<?php if ( isset( $tags ) ) : ?>
					<div class="compact-header__tags">
						<?php foreach ( $tags as $item ) : ?>
							<div class="compact-header__tags-item">
								<?php if ( isset( $item['title'] ) ) : ?>
									<div class="compact-header__tags-title"><?= esc_html( $item['title'] ); ?>:</div>
								<?php endif; ?>
								<?php if ( isset( $item['list'] ) ) : ?>
									<ul class="compact-header__tags-list">
									<?php foreach ( $item['list'] as $tag_item ) : ?>
										<li>
											<a href="<?= esc_url( $tag_item['href'] ); ?>"
											   title="<?= esc_attr( $tag_item['title'] ); ?>"
											   <?php if ( $tag_item['target'] ) : ?>
												   target="<?= esc_attr( $tag_item['target'] ); ?>"
												<?php endif; ?>
												<?php if ( $tag_item['rel'] ) : ?>
													rel="<?= esc_attr( $tag_item['rel'] ); ?>"
												<?php endif; ?>
												<?php if ( $tag_item['onclick'] ) : ?>
													onclick="<?= esc_attr( $tag_item['onclick'] ); ?>"
												<?php endif; ?>
											>
												<svg class="icon-tag-solid">
													<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#tag-solid' ) ?>"></use>
												</svg>
												<?= esc_html( $tag_item['title'] ); ?>
											</a>
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
				<?php if ( isset( $image_src ) ) : ?>
					<div class="compact-header__image
					<?php if ( isset( $image_type ) ) : ?>
						 compact-header__image--<?= sanitize_html_class( $image_type ) ?>
					<?php endif; ?>">
						<img
							src="<?= esc_url( $image_src ); ?>"
							alt="<?= esc_attr( $image_alt ); ?>"
							class="compact-header__img"
						>
						<?php if ( isset( $logo ) ) : ?>
							<div class="compact-header__logo">
								<img
									<?php if ( $logo['src'] ) : ?>
										src="<?= esc_url( $logo['src'] ); ?>"
									<?php endif; ?>
									<?php if ( $logo['alt'] ) : ?>
										alt="<?= esc_attr( $logo['alt'] ); ?>"
									<?php endif; ?>
									class="compact-header__logo-img"
								>
							</div>
						<?php endif ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
	<?php if ( isset( $filer_search ) || isset( $filer_items ) || isset( $filer_count ) || isset( $menu_header ) ) : ?>
		<div class="compact-header compact-header__bottom">
			<div class="compact-header__wrapper wrapper">
				<?php if ( isset( $filer_search ) || isset( $filer_items ) || isset( $filer_count ) ) : ?>
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
										<span class="searchField__reset">
											<svg class="searchField__reset-icon icon-close">
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
											<div class="FilterMenu">
												<div class="FilterMenu__title">
													<?= esc_html( $filer_title ); ?>
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
																		<a href="<?= esc_url( $filer_list_item['href'] ); ?>"><?= esc_html( $filer_list_item['title'] ); ?></a>
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
							<?php if ( isset( $filer_count ) ) : ?>
								<div class="compact-header__count">
										<span id="countPosts">
											<?php if ( isset( $filer_count['value'] ) ) : ?>
												<?= esc_html( $filer_count['value'] ); ?>
											<?php endif ?>
										</span>
									<?php if ( isset( $filer_count['title'] ) ) : ?>
										<?= esc_html( $filer_count['title'] ); ?>
									<?php endif ?>
								</div>
							<?php endif; ?>
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
				<?php endif ?>
			</div>
		</div>
	<?php endif ?>
<?php endif ?>
