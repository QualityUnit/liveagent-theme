<?php // @codingStandardsIgnoreLine
$query_args = array(
	'post_type'      => 'ms_features',
	'posts_per_page' => -1,
	'fields'         => 'ids',
);

	$features_posts = new WP_Query( $query_args );
		wp_reset_query();
set_source( 'features', 'pages/Category' );
set_source( 'features', 'pages/CategoryColorScheme' );
set_source( 'features', 'filter', 'js' );
$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_features_categories' ) ), SORT_REGULAR );
if ( is_tax( 'ms_features_categories' ) === true ) :
	$page_header_title       = single_cat_title();
	$page_header_description = the_archive_description();
else :
	$page_header_title       = __( 'Features', 'ms' );
	$page_header_description = __( 'Get to know all LiveAgent features that are part of the comprehensive multi-channel help desk software, all described in one place and in depth.', 'ms' );
endif;
$filter_items_categories = array(
	array(
		'checked' => true,
		'value'   => '',
		'title'   => __( 'Any', 'ms' ),
	),
);
foreach ( $categories as $category ) :
	$filter_items_categories[] = array(
		'value' => $category->slug,
		'title' => $category->name,
	);
endforeach;
$filter_items     = array(
	array(
		'type'  => 'radio',
		'name'  => 'collections',
		'title' => __( 'Collections', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value'   => '',
				'title'   => __( 'Any', 'ms' ),
			),
			array(
				'value' => 'featured',
				'title' => __( 'Featured', 'ms' ),
			),
			array(
				'value' => 'popular',
				'title' => __( 'Popular', 'ms' ),
			),
			array(
				'value' => 'new',
				'title' => __( 'New', 'ms' ),
			),
		),
	),
	array(
		'type'  => 'radio',
		'name'  => 'plan',
		'title' => __( 'Available in', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value'   => '',
				'title'   => __( 'Any', 'ms' ),
			),
			array(
				'value' => 'free',
				'title' => __( 'Free', 'ms' ),
			),
			array(
				'value' => 'ticket',
				'title' => __( 'Small', 'ms' ),
			),
			array(
				'value' => 'ticket-chat',
				'title' => __( 'Medium', 'ms' ),
			),
			array(
				'value' => 'all-inclusive',
				'title' => __( 'Large', 'ms' ),
			),
			array(
				'value' => 'extensions',
				'title' => __( 'Extensions', 'ms' ),
			),
		),
	),
	array(
		'type'  => 'radio',
		'name'  => 'size',
		'title' => __( 'Suitable for', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value'   => '',
				'title'   => __( 'Any', 'ms' ),
			),
			array(
				'value' => 'individuals',
				'title' => __( 'Individuals', 'ms' ),
			),
			array(
				'value' => 'start-ups',
				'title' => __( 'Start-ups', 'ms' ),
			),
			array(
				'value' => 'smbs',
				'title' => __( 'SMBs', 'ms' ),
			),
			array(
				'value' => 'enterprise',
				'title' => __( 'Enterprise', 'ms' ),
			),
		),
	),
	array(
		'type'  => 'radio',
		'name'  => 'category',
		'title' => __( 'Category', 'ms' ),
		'items' => $filter_items_categories,
	),
);
$page_header_args = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_features.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'text'   => $page_header_description,
	'filter' => $filter_items,
	'search' => array( 'type' => 'academy' ),
);
?>

<div id="category" class="Category">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Category__container">
		<div class="Category__content">
			<ul class="Category__content__items list">
				<?php
				$item_order = 0;

				while ( have_posts() === true ) :
					the_post();

					$collections    = '';
					$plan           = '';
					$size           = '';
					$category       = '';
					$cat_item       = '';
					$category_title = '';

					$future_plans       = ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) ?? '' );
					$future_sizes       = ( get_post_meta( get_the_ID(), 'mb_features_mb_features_size', true ) ?? '' );
					$future_collections = ( get_post_meta( get_the_ID(), 'mb_features_mb_features_collections', true ) ?? '' );

					$plan        = is_array( $future_plans ) ? implode( ' ', $future_plans ) : '';
					$size        = is_array( $future_sizes ) ? implode( ' ', $future_sizes ) : '';
					$collections = is_array( $future_collections ) ? implode( ' ', $future_collections ) : '';

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
							$category_item  = array_shift( $categories );
							$category      .= $category_item->slug;
							$category      .= ' ';
							$cat_item       = $category_item;
							$category_title = $category_item->name;
						}
					}

					$category = substr( $category, 0, -1 );

					// Custom link for items
					$custom_link = get_post_meta( get_the_ID(), 'mb_custom_url', true );
					$item_url    = $custom_link ? $custom_link : get_the_permalink();

					// Element classes.
					$pillar_value = ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) ?? '' );
					$pillar_class = '';
					if ( 'on' === $pillar_value ) {
							$pillar_class = 'pillar';
							$item_order++;
					}
					$category_item_classes      = 'Category__item redesign Category__item--features ' . $pillar_class . ' ' . esc_attr( $category ) . ' ' . esc_attr( $category_en );
					$category_card_item_classes = 'Category__item redesign Category__item--features ' . esc_attr( $category ) . ' ' . esc_attr( $category_en );

					// Element attributes.
					$category_item_attributes = array(
						'data-plan'        => esc_attr( $plan ),
						'data-collections' => esc_attr( $collections ),
						'data-size'        => esc_attr( $size ),
						'data-category'    => esc_attr( $category ),
						'data-href'        => esc_url( $item_url ),
					);

					$backgrounds_urls = get_archive_items_images( 'ms_features_categories', 'features' );

					if ( 'on' === $pillar_value ) :
						?>
							<li class="<?= esc_attr( $category_item_classes ); ?>" style="order: <?= esc_attr( $item_order ); ?>"
										<?php
										foreach ( $category_item_attributes as $name => $value ) {
											echo esc_html( $name ) . '="' . esc_attr( $value ) . '" ';
										}
										?>
							>
							<a href="<?= esc_url( $item_url ); ?>" class="Category__item__thumbnail">
								<span class="Category__item__thumbnail__image" style="background-image: url(<?= esc_url( $backgrounds_urls['pillar'] ); ?>);"></span>
							</a>
							<div class="Category__item__wrap">
								<h2 class="Category__item__title item-title"><a href="<?= esc_url( $item_url ); ?>"><?php the_title(); ?></a></h2>
								<div class="Category__item__excerpt item-excerpt">
									<a href="<?= esc_url( $item_url ); ?>">
						<?= esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?>
									</a>
								</div>
								<a class="Category__item__cta" href="<?= esc_url( $item_url ); ?>"><?php esc_html_e( 'Learn more', 'ms' ); ?></a>
							</div>
							</li>
							<?php
							$integrations = get_term_meta( $cat_item->term_id, 'card', true );
							if ( ! empty( $integrations ) ) {
								foreach ( $integrations as $integration ) {
									$integration_id = $integration['integration_post'];
									?>

							<li class="<?= esc_attr( $category_card_item_classes ); ?>" style="order: <?= esc_attr( $item_order + 1 ); ?>"
											<?php
											foreach ( $category_item_attributes as $name => $value ) {
													echo esc_html( $name ) . '="' . esc_attr( $value ) . '" ';
											}
											?>
								>
								<div class="Category__item__wrap">
									<div class="Category__item__header">
										<div class="Category__item__header__image">
											<img src="<?= esc_url( get_the_post_thumbnail_url( $integration_id, 'archive_thumbnail' ) ); ?>" alt="<?php esc_attr_e( 'Features', 'ms' ); ?>">
										</div>
										<div class="Category__item__header__label">
											<span class="Category__item__header__label__text">
												<?= esc_html( $category_title ); ?>
											</span>
										</div>
									</div>
									<div class="Category__item__content">
										<h3 class="Category__item__content__title item-title"><a href="<?= esc_url( get_the_permalink( $integration_id ) ); ?>"><?= esc_html( get_the_title( $integration_id ) ); ?></a></h3>
										<div class="Category__item__content__excerpt item-excerpt">
											<a href="<?= esc_url( get_the_permalink( $integration_id ) ); ?>">
									<?= esc_html( wp_trim_words( get_the_excerpt( $integration_id ), 11 ) ); ?>
											</a>
										</div>
									</div>
								</div>
							</li>
									<?php
								}
							}
							?>
					<?php else : ?>
							<li class="<?= esc_attr( $category_item_classes ); ?>"
									style="background-image: url(<?= esc_url( $backgrounds_urls['pillar'] ); ?>); order: <?= esc_attr( $item_order ); ?>"
											<?php
											foreach ( $category_item_attributes as $name => $value ) {
												echo esc_html( $name ) . '="' . esc_attr( $value ) . '" ';
											}
											?>
								>
								<div class="Category__item__wrap">
									<div class="Category__item__header" style="background-image: url(<?= esc_url( $backgrounds_urls['background'] ); ?>);">
										<div class="Category__item__header__image">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'archive_thumbnail' );
						} else {
							?>
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php esc_attr_e( 'Features', 'ms' ); ?>">

						<?php	} ?>
			</div>
										<div class="Category__item__header__label">
											<span class="Category__item__header__label__text"><?= esc_html( $category_title ); ?></span>
										</div>
									</div>
									<div class="Category__item__content">
										<h3 class="Category__item__content__title item-title"><a href="<?= esc_url( $item_url ); ?>"><?php the_title(); ?></a></h3>
										<div class="Category__item__content__excerpt item-excerpt">
											<a href="<?= esc_url( $item_url ); ?>">
												<?= esc_html( wp_trim_words( get_the_excerpt(), 11 ) ); ?>
											</a>
										</div>
									</div>
								</div>
							</li>
		<?php endif; ?>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
