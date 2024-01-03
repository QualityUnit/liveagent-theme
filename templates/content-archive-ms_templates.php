<?php // @codingStandardsIgnoreLine
set_source( 'templates', 'pages/Category', 'css' );
set_source( 'templates', 'pages/CategoryImages', 'css' );
set_source( 'templates', 'pages/CategoryItemBgs', 'css' );
set_source( 'templates', 'pages/CategoryColorScheme', 'css' );
set_source( 'templates', 'filter', 'js' );
$categories        = array_unique( get_categories( array( 'taxonomy' => 'ms_templates_categories' ) ), SORT_REGULAR );
$page_header_title = __( 'Customer Service Templates', 'ms' );
$page_header_text  = null;
if ( is_tax( 'ms_templates_categories' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text  = term_description();
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
		'name'  => 'category',
		'title' => __( 'Category', 'ms' ),
		'items' => $filter_items_categories,
	),
);
$page_header_args = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_templates.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'text'   => $page_header_text,
	'search' => array(
		'type' => 'academy',
	),
	'filter' => $filter_items,
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
					$category       = '';
					$category_title = '';
					$cat_item       = '';

					$categories   = get_the_terms( 0, 'ms_templates_categories' );
					$current_lang = apply_filters( 'wpml_current_language', null );
					do_action( 'wpml_switch_language', 'en' );
					$categories_en = get_the_terms( 0, 'ms_templates_categories' );
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
					$pillar_value = ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) ?? '' );
					$pillar_class = '';
					if ( 'on' === $pillar_value ) {
							$pillar_class = 'pillar';
					}
					$category_item_classes      = 'Category__item redesign Category__item--templates ' . $pillar_class . ' ' . esc_attr( $category_en );
					$category_card_item_classes = 'Category__item redesign Category__item--templates ' . esc_attr( $category ) . ' ' . esc_attr( $category_en );

					// Element attributes.
					$category_item_attributes = array(
						'data-category' => esc_attr( $category ),
						'data-href'     => esc_url( $item_url ),
					);

					if ( 'on' === $pillar_value ) :
						?>
							<li class="<?= esc_attr( $category_item_classes ); ?>"
										<?php
										foreach ( $category_item_attributes as $name => $value ) {
											echo esc_html( $name ) . '="' . esc_attr( $value ) . '" ';
										}
										?>
							>
							<a href="<?= esc_url( $item_url ) ?>" class="Category__item__thumbnail">
								<span class="Category__item__thumbnail__image"></span>
							</a>
							<div class="Category__item__wrap">
								<h2 class="Category__item__title item-title"><a href="<?= esc_url( $item_url ) ?>"><?php the_title(); ?></a></h2>
								<div class="Category__item__excerpt item-excerpt">
									<a href="<?= esc_url( $item_url ) ?>">
						<?= esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?>
									</a>
								</div>
								<a class="Category__item__cta" href="<?= esc_url( $item_url ) ?>"><?php esc_html_e( 'Learn more', 'ms' ); ?></a>
							</div>
							</li>
						<?php else : ?>
							<li class="<?= esc_attr( $category_card_item_classes ); ?>"
													<?php
													foreach ( $category_item_attributes as $name => $value ) {
														echo esc_html( $name ) . '="' . esc_attr( $value ) . '" ';
													}
													?>
								>
								<div class="Category__item__wrap">
									<div class="Category__item__header">
										<div class="Category__item__header__image">
													<?php
													if ( has_post_thumbnail() ) {
														the_post_thumbnail( 'archive_thumbnail' );
													} else {
														?>
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php esc_attr_e( 'Templates', 'ms' ); ?>">

													<?php	} ?>
			</div>
										<div class="Category__item__header__label">
											<span class="Category__item__header__label__text"><?= esc_html( $category_title ); ?></span>
										</div>
									</div>
									<div class="Category__item__content">
										<h3 class="Category__item__content__title item-title"><a href="<?= esc_url( $item_url ) ?>" title="<?= esc_attr( get_the_title() ); ?>"><?= esc_html( wp_trim_words( get_the_title(), 5 ) ); ?></a></h3>
										<div class="Category__item__content__excerpt item-excerpt">
											<a href="<?= esc_url( $item_url ) ?>">
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
