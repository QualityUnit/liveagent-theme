<?php set_custom_source( 'components/compactHeader', 'css' ); ?>
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
	?>
<div class="compact-header">
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
		<div class="compact-header__bottom">
			<?php if ( isset( $filer_search ) || isset( $filer_items ) ) : ?>
				<div class="compact-header__filter urlslab-skip-keywords">
					<a class="compact-header__filter-toggle"></a>
					<div class="compact-header__filter-wrap">
						<?php if ( isset( $filer_search ) ) : ?>
							<div class="compact-header__search searchField">
								<svg class="compact-header__search-icon icon-search">
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#search' ) ?>"></use>
								</svg>
								<input type="search" class="search<?= esc_attr( $search_class ); ?>" placeholder="<?php _e( 'Search', 'ms' ); ?>" maxlength="50">
								<span class="compact-header__search-reset">
									<svg class="compact-header__search-close icon-close">
										<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ) ?>"></use>
									</svg>
								</span>
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
								?>
								<?php if ( isset( $filer_list ) && isset( $filer_type ) ) : ?>
									<?php if ( 'radio' == $filer_type && isset( $filer_name ) ) : ?>
										<div>
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
												?>
											<label>
												<input
													class="filter-item"
													type="radio"
													value="<?= esc_attr( $item_value ); ?>"
													name="<?= esc_attr( $filer_name ); ?>"
													<?php if ( $item_checked ) : ?>
														checked
													<?php endif; ?>
												>
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
										<?php endforeach; ?>
										</div>
									<?php endif; ?>
								<?php endif ?>
							<?php endforeach; ?>
						<?php endif ?>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>
<?php endif ?>
