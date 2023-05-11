<?php // @codingStandardsIgnoreLine
set_source( 'integrations', 'pages/Category', 'css' );
set_source( 'integrations', 'filter', 'js' );
$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_integrations_categories' ) ), SORT_REGULAR );
$page_header_title = __( 'Integrations', 'ms' );
$page_header_text = __( "Maximize the value of your existing help desk software and extend customer satisfaction with LiveAgent's range of integrations, plugins, and apps.", 'ms' );
if ( is_tax( 'ms_integrations_categories' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text = term_description();
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
		'name' => 'type',
		'title' => __( 'Type in', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value' => '',
				'title' => __( 'Any', 'ms' ),
			),
			array(
				'value' => 'native',
				'title' => __( 'Native', 'ms' ),
			),
			array(
				'value' => 'external',
				'title' => __( 'External', 'ms' ),
			),
			array(
				'value' => 'zapier',
				'title' => __( 'Zapier', 'ms' ),
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
		'src' => get_template_directory_uri() . '/assets/images/compact_header_integrations.png?ver=' . THEME_VERSION,
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
					?>

					<?php
						$collections = '';
						$data_type   = '';
						$category    = '';

					if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_type', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_type', true ) as $item ) {
								$data_type .= $item . ' ';
						}

							$data_type = substr( $data_type, 0, -1 );
					}

					if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_collections', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_collections', true ) as $item ) {
								$collections .= $item . ' ';
						}

							$collections = substr( $collections, 0, -1 );
					}

						$categories = get_the_terms( 0, 'ms_integrations_categories' );
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
					if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_pillar', true ) === 'on' ) {
						echo 'pillar'; }
					?>
					" data-collections="<?= esc_attr( $collections ); ?>" data-type="<?= esc_attr( $data_type ); ?>" data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Integrations', 'Go to <?php the_title(); ?> integration'])">
						<a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
								<?php if ( has_post_thumbnail() ) { ?>
										<?php the_post_thumbnail( 'archive_thumbnail' ); ?>
									<?php } ?>
						</a>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_pillar', true ) === 'on' ) {
								?>
									<div class="Category__item__wrap">
										<?php
							}
							?>
								<h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="Category__item__excerpt item-excerpt">
									<a href="<?php the_permalink(); ?>">
									<?= esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
									<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_pillar', true ) === 'on' ) { ?>
										<span><?php _e( 'Read More', 'ms' ); ?></span>
									<?php } ?>
									</a>
								</div>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_pillar', true ) === 'on' ) {
								?>
									</div>
								<?php
							}
							?>
					</li>

					<?php
						$collections = '';
						$data_type   = '';
						$category    = '';
					?>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>

</div>
