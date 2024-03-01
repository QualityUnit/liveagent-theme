<?php // @codingStandardsIgnoreLine
set_source( 'templates', 'pages/Category' );
set_source( 'templates', 'pages/CategoryColorScheme' );
set_source( 'templates', 'filter', 'js' );
$post_type_category = 'ms_templates_categories';
$categories        = array_unique( get_categories( array( 'taxonomy' => $post_type_category ) ), SORT_REGULAR );
$page_header_title = __( 'Customer Service Templates', 'ms' );
$page_header_text  = null;
if ( is_tax( $post_type_category ) ) :
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
				// Loop through posts and group them by category

				$posts_by_category = array(); // Initialize an array to group posts by categories

				$item_order = 0;
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();

						// Get post categories
						$categories = get_the_terms( get_the_ID(), $post_type_category );

						if ( ! empty( $categories ) ) {
							$current_lang = apply_filters( 'wpml_current_language', null ); // Save current language

							do_action( 'wpml_switch_language', 'en' ); // Switch to English language
							foreach ( $categories as $category ) {

								// Get the English version of the category
								$category_en = get_the_terms( get_the_ID(), $post_type_category );
								$category_en_slug = ! empty( $category_en ) ? $category_en[0]->slug : '';

								do_action( 'wpml_switch_language', $current_lang ); // Go back to original language

								// Prepare and store post information in the array
								$posts_by_category[ $category->name ][] = array(
									'title' => get_the_title(),
									'excerpt' => get_the_excerpt(),
									'category_name' => $category->name,
									'category_slug' => $category->slug,
									'category_en_slug' => $category_en_slug,
									'permalink' => get_permalink(),
									'pillar_value' => get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) ?? '',
									'custom_url' => get_post_meta( get_the_ID(), 'mb_custom_url', true ) ?? '',
									'backgrounds_urls' => get_archive_items_images( $post_type_category, 'templates' ),
									'icons_url' => get_the_post_thumbnail_url( get_the_ID(), 'archive_thumbnail' ),
								);
							}
						}
					}
				}

				?>

				<?php
				// Loop through the categorized posts for display
				foreach ( $posts_by_category as $category_name => $items ) {

					foreach ( $items as $item ) {
						$item_title = $item['title'];
						$item_permalink = $item['permalink'];
						$item_excerpt = wp_trim_words( $item['excerpt'], 10 );
						$category_slug = $item['category_slug'];
						$category_name = $item['category_name'];
						$category_en_slug = $item['category_en_slug'];

						$item_icons_url = $item['icons_url'];

						// Prepare data attributes
						$custom_link = $item['custom_url'];
						$item_url    = $custom_link ? $custom_link : $item_permalink;

						$pillar_value = $item['pillar_value'];
						$backgrounds_urls = $item['backgrounds_urls'];

						// Prepare data attributes
						$category_item_attributes = array(
							'data-category' => esc_attr( $category_slug ),
							'data-href'     => esc_url( $item_url ),
						);

						$pillar_class = '';
						if ( 'on' === $pillar_value ) {
							$pillar_class = 'pillar';
						}
						$category_item_classes      = 'Category__item redesign Category__item--templates ' . $pillar_class . ' ' . esc_attr( $category_slug ) . ' ' . esc_attr( $category_en_slug );
						$category_card_item_classes = 'Category__item redesign Category__item--templates  ' . esc_attr( $category_slug ) . ' ' . esc_attr( $category_en_slug );

						if ( 'on' === $pillar_value ) :
							?>
							<li class="<?= esc_attr( $category_item_classes ); ?>"
								<?php
								foreach ( $category_item_attributes as $name => $value ) {
									echo esc_html( $name ) . '="' . esc_attr( $value ) . '" ';
								}
								?>
									style="order: <?= esc_attr( $item_order ); ?>">
								<a href="<?= esc_url( $item_url ); ?>" class="Category__item__thumbnail">
									<span class="Category__item__thumbnail__image" style="background-image: url(<?= esc_url( $backgrounds_urls['pillar'] ); ?>);"></span>
								</a>
								<div class="Category__item__wrap">
									<h2 class="Category__item__title item-title"><a href="<?= esc_url( $item_url ); ?>"><?= esc_html( $item_title ); ?></a></h2>
									<div class="Category__item__excerpt item-excerpt">
										<a href="<?= esc_url( $item_url ); ?>">
											<?= esc_html( $item_excerpt ); ?>
										</a>
									</div>
									<a class="Category__item__cta" href="<?= esc_url( $item_url ); ?>"><?php esc_html_e( 'Learn more', 'ms' ); ?></a>
								</div>
							</li>


						<?php else : ?>
							<li class="<?= esc_attr( $category_card_item_classes ); ?>"
								<?php
								foreach ( $category_item_attributes as $name => $value ) {
									echo esc_html( $name ) . '="' . esc_attr( $value ) . '" ';
								}
								?>
									style="order: <?= esc_attr( $item_order + 1 ); ?>">
								<div class="Category__item__wrap">
									<div class="Category__item__header" style="background-image: url(<?= esc_url( $backgrounds_urls['background'] ); ?>);">
										<div class="Category__item__header__image">
											<?php
											if ( $item_icons_url ) {
												?>
												<img src="<?= esc_url( $item_icons_url ); ?>" alt="<?php esc_attr_e( 'Templates', 'ms' ); ?>">
												<?php
											} else {
												?>
												<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php esc_attr_e( 'Templates', 'ms' ); ?>">

											<?php	} ?>
										</div>
										<div class="Category__item__header__label">
											<span class="Category__item__header__label__text"><?= esc_html( $category_name ); ?></span>
										</div>
									</div>
									<div class="Category__item__content">
										<h3 class="Category__item__content__title item-title"><a href="<?= esc_url( $item_url ); ?>" title="<?= esc_attr( $item_title ); ?>"><?= esc_html( wp_trim_words( $item_title, 10 ) ); ?></a></h3>
										<div class="Category__item__content__excerpt item-excerpt">
											<a href="<?= esc_url( $item_url ); ?>">
												<?= esc_html( $item_excerpt ); ?>
											</a>
										</div>
									</div>
								</div>
							</li>



						<?php endif; ?>

					<?php	} ?>
					<?php $item_order += 2; ?>
				<?php } ?>


			</ul>
		</div>
	</div>

</div>
