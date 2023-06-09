<?php // @codingStandardsIgnoreLine
set_source( 'features', 'pages/Category', 'css' );
set_source( 'features', 'pages/CategoryImages', 'css' );
set_source( 'features', 'pages/CategoryLabelColors', 'css' );
set_source( 'features', 'filter', 'js' );
$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_features_categories' ) ), SORT_REGULAR );
if ( is_tax( 'ms_features_categories' ) ) :
	$page_header_title = single_cat_title();
	$page_header_description = the_archive_description();
else :
	$page_header_title = __( 'Features', 'ms' );
	$page_header_description = __( 'Get to know all LiveAgent features, that are part of the complex multi-channel help desk software. Described in one place and in depth.', 'ms' );
endif;
$filter_items_categories = array(
	array(
		'checked' => true,
		'value' => '',
		'title' => __( 'Any', 'ms' ),
	),
);
foreach ( $categories as $category ) :
	$filter_items_categories[] = array(
		'value' => $category->slug,
		'title' => $category->name,
	);
endforeach;
$filter_items = array(
	array(
		'type' => 'radio',
		'name' => 'collections',
		'title' => __( 'Collections', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value' => '',
				'title' => __( 'Any', 'ms' ),
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
		'type' => 'radio',
		'name' => 'plan',
		'title' => __( 'Available in', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value' => '',
				'title' => __( 'Any', 'ms' ),
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
		'type' => 'radio',
		'name' => 'size',
		'title' => __( 'Suitable for', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value' => '',
				'title' => __( 'Any', 'ms' ),
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
		'type' => 'radio',
		'name' => 'category',
		'title' => __( 'Category', 'ms' ),
		'items' => $filter_items_categories,
	),
);
$page_header_args = array(
	'type' => 'lvl-1',
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_features.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title' => $page_header_title,
	'text' => $page_header_description,
	'filter' => $filter_items,
	'search' => array(
		'type' => 'academy',
	),
);
?>

<div id="category" class="Category">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Category__container">
		<div class="Category__content">
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

						$future_plans = get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) ?? '';
						$future_sizes = get_post_meta( get_the_ID(), 'mb_features_mb_features_size', true ) ?? '';
						$future_collections = get_post_meta( get_the_ID(), 'mb_features_mb_features_collections', true ) ?? '';

						if ( $future_plans ) {

							foreach ($future_plans as $item)  {
									$plan .= $item . ' ';
							}

								$plan = substr( $plan, 0, -1 );
						}

						if ( $future_sizes ) {
							foreach ($future_sizes as $item ) {
									$size .= $item . ' ';
							}

								$size = substr( $size, 0, -1 );
						}

						if ( $future_collections ) {
							foreach ($future_collections as $item ) {
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

					<?php
						// Element classes
						$pillar_value = get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) ?? '';
						$pillar_class = $pillar_value === 'on' ? 'pillar ' : '';
						$category_item_classes = 'Category__item redesign Category__item--features ' . $pillar_class . ' ' . esc_attr($category) . ' ' . esc_attr($category_en);

						// Element attributes
						$category_item_attributes = [
							'data-plan' => esc_attr($plan),
							'data-collections' => esc_attr($collections),
							'data-size' => esc_attr($size),
							'data-category' => esc_attr($category),
							'data-href' => get_permalink()
						];
						if ($pillar_value === 'on') : ?>
							<li class="<?= $category_item_classes ?>" <?php foreach ($category_item_attributes as $name => $value) { echo $name . '="' . $value . '" '; }?>>
							<a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
								<span class="Category__item__thumbnail__image"></span>
							</a>
							<div class="Category__item__wrap">
								<h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="Category__item__excerpt item-excerpt">
									<a href="<?php the_permalink(); ?>">
										<?= esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?>
									</a>
								</div>
								<a class="Category__item__cta" href="<?php the_permalink(); ?>"><?php _e( 'Learn more', 'ms' ); ?></a>
							</div>
							</li>
						<?php else : ?>
							<li class="<?= $category_item_classes ?>" <?php foreach ($category_item_attributes as $name => $value) { echo $name . '="' . $value . '" '; }?>>
								<div class="Category__item__wrap">
									<div class="Category__item__header">
										<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'archive_thumbnail' );
											}
											else { ?>
												<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php _e( 'Features', 'ms' ); ?>">
										<?php	} ?>
										<div class="Category__item__header__label">
											<span class="Category__item__header__label_text">Ticketing system</span>
										</div>
									</div>
									<div class="Category__item__content">
										<h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="Category__item__excerpt item-excerpt">
											<a href="<?php the_permalink(); ?>">
												<?= esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?>
											</a>
										</div>
										<a class="Category__item__cta" href="<?php the_permalink(); ?>"><?php _e( 'Learn more', 'ms' ); ?></a>
									</div>
								</div>
							</li>
					<?php endif; ?>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
