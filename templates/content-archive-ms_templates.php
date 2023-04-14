<?php // @codingStandardsIgnoreLine
set_source( 'templates', 'pages/Category', 'css' );
set_source( 'templates', 'filter', 'js' );
$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_templates_categories' ) ), SORT_REGULAR );
$page_header_title = __( 'Customer Service Templates', 'ms' );
$page_header_text = null;
if ( is_tax( 'ms_templates_categories' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text = term_description();
endif;
$filter_items_categories = array(
	array(
		'checked' => true,
		'value' => '',
		'title' => __( 'Any', 'ms' ),
		'onclick' => "_paq.push(['trackEvent', 'Activity', 'Academy', 'Templates - Category - Any'])",
	),
);
foreach ( $categories as $category ) :
	$filter_items_categories[] = array(
		'value' => $category->slug,
		'title' => $category->name,
		'onclick' => "_paq.push(['trackEvent', 'Activity', 'Academy', 'Templates - Category - " . $category->name . "'])",
	);
endforeach;
$filter_items = array(
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
		'src' => get_template_directory_uri() . '/assets/images/compact_header_templates.png?ver=' . THEME_VERSION,
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

<div id="category" class="Category">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<div class="wrapper Category__container">
		<div class="Category__content">
			<ul class="Category__content__items list">
				<?php
				while ( have_posts() ) :
					the_post();

					$category = '';

					$categories = get_the_terms( 0, 'ms_templates_categories' );

					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category_item ) {
							$category_item = array_shift( $categories );
							$category     .= $category_item->slug;
							$category     .= ' ';
						}
					}

					$category = substr( $category, 0, -1 );
					?>

					<li class="Category__item
					<?php
					if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) {
						echo 'pillar'; }
					?>
					" data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Go to <?php the_title(); ?> article'])">
						<a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) { ?>
								<span class="Category__item__thumbnail__image">
								<?php
							}
								the_post_thumbnail( 'archive_thumbnail' );
							if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) {
								?>
								</span>
							<?php } ?>
							<?php } else { ?>
								<?php if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) { ?>
									<span href="<?php the_permalink(); ?>" class="Category__item__thumbnail__image">
										<?php } ?>
									<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-book.svg" alt="<?php _e( 'Templates', 'ms' ); ?>">
									<?php if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) { ?>
								</span>
								<?php } ?>
							<?php } ?>
						</a>
						<?php
						if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) {
							?>
								<div class="Category__item__wrap">
							<?php
						}
						?>
							<h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="Category__item__excerpt item-excerpt">
								<a href="<?php the_permalink(); ?>">
									<?= esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) { ?>
										<span><?php _e( 'Read More', 'ms' ); ?></span>
									<?php } ?>
								</a>
							</div>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_pillar', true ) === 'on' ) {
								?>
								</div>
								<?php
							}
							?>
					</li>

					<?php
						$category = '';
					?>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>

</div>
