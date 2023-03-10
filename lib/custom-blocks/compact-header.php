<?php set_custom_source( 'components/compactHeader', 'css' ); ?>
<?php if ( isset( $args ) ) : ?>
	<?php
	$image_alt = '';
	if ( ! empty( $args['image'] ) ) {
		$image = $args['image'];
		if ( ! empty( $image['src'] ) ) {
			$image_src = $image['src'];
		}
		if ( ! empty( $image['alt'] ) ) {
			$image_alt = $image['alt'];
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
	?>
<div class="compact-header">
	<div class="compact-header__wrapper wrapper">
		<div class="compact-header__left">
			<?php site_breadcrumb(); ?>
			<?php if ( isset( $main_title ) ) : ?>
				<h1 itemprop="name" class="compact-header__title"><?= esc_html( $main_title ); ?></h1>
			<?php endif ?>
			<?php if ( isset( $text ) ) : ?>
				<div class="compact-header__text"><?= esc_html( $text ); ?></div>
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
											<svg class="">
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
				<div class="compact-header__image">
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
		<div class="compact-header__bottom"></div>
	</div>
</div>
<?php endif ?>
