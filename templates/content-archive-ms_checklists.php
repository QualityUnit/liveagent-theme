<?php // @codingStandardsIgnoreLine
set_source( 'checklists', 'pages/blog', 'css' );
set_source( 'checklists', 'pages/Category', 'css' );
set_source( 'checklists', 'pages/ChecklistsArchive', 'css' );
set_source( 'checklists', 'filter', 'js' );
$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_checklists_categories' ) ), SORT_REGULAR );
$page_header_title = __( 'Checklists', 'ms' );
$page_header_text = __( 'Pick from a variety of detailed checklists for all your business needs. Organize your workflows and get any job done efficiently without difficulties.', 'ms' );
$filter_items_categories = array(
	array(
		'checked' => true,
		'value' => '',
		'title' => __( 'All Categories', 'ms' ),
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
		'name' => 'category',
		'title' => __( 'Categories', 'ms' ),
		'items' => $filter_items_categories,
	),
);
$page_header_args = array(
	'type' => 'lvl-1',
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_checklist.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title' => $page_header_title,
	'text' => $page_header_text,
	'search' => array(
		'type' => 'academy',
	),
	'filter' => $filter_items,
);
?>

<div id="category" class="Category Checklists">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Category__container">
		<div class="Category__content">
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
								<h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?= esc_html( $post_title ); ?></a></h3>
								<a href="<?php the_permalink(); ?>" class="Category__item__excerpt item-excerpt">
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

