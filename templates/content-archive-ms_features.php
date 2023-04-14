<?php // @codingStandardsIgnoreLine
set_source( 'features', 'pages/Category', 'css' );
set_source( 'features', 'pages/CategoryImages', 'css' );
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
		'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Category - Any'])",
	),
);
foreach ( $categories as $category ) :
	$filter_items_categories[] = array(
		'value' => $category->slug,
		'title' => $category->name,
		'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Category - " . $category->name . "'])",
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
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Collections - Any'])",
			),
			array(
				'value' => 'featured',
				'title' => __( 'Featured', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Collections - Featured'])",
			),
			array(
				'value' => 'popular',
				'title' => __( 'Popular', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Collections - Popular'])",
			),
			array(
				'value' => 'new',
				'title' => __( 'New', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Collections - New'])",
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
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Plan - Any'])",
			),
			array(
				'value' => 'free',
				'title' => __( 'Free', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Plan - Free'])",
			),
			array(
				'value' => 'ticket',
				'title' => __( 'Small', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Plan - Small'])",
			),
			array(
				'value' => 'ticket-chat',
				'title' => __( 'Medium', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Plan - Medium'])",
			),
			array(
				'value' => 'all-inclusive',
				'title' => __( 'Large', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Plan - Large'])",
			),
			array(
				'value' => 'extensions',
				'title' => __( 'Extensions', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Plan - Extensions'])",
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
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Size - Any'])",
			),
			array(
				'value' => 'individuals',
				'title' => __( 'Individuals', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Size - Individuals'])",
			),
			array(
				'value' => 'start-ups',
				'title' => __( 'Start-ups', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Size - Start-ups'])",
			),
			array(
				'value' => 'smbs',
				'title' => __( 'SMBs', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Size - SMBs'])",
			),
			array(
				'value' => 'enterprise',
				'title' => __( 'Enterprise', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Features', 'Filter - Size - Enterprise'])",
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

					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) as $item ) {
								$plan .= $item . ' ';
						}

							$plan = substr( $plan, 0, -1 );
					}

					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_size', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_size', true ) as $item ) {
								$size .= $item . ' ';
						}

							$size = substr( $size, 0, -1 );
					}

					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_collections', true ) ) {
						foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_collections', true ) as $item ) {
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

					<li class="Category__item
					<?php
					if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) {
						echo 'pillar'; }
					?>
					<?= esc_attr( $category ); ?> <?= esc_attr( $category_en ) ?>" data-collections="<?= esc_attr( $collections ); ?>" data-plan="<?= esc_attr( $plan ); ?>" data-size="<?= esc_attr( $size ); ?>" data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Features', 'Go to <?php the_title(); ?> feature'])">
							<a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
								<?php if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) { ?>
									<span class="Category__item__thumbnail__image"></span>
								<?php } elseif ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail( 'archive_thumbnail' ); ?>
								<?php } else { ?>
									<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg" alt="<?php _e( 'Features', 'ms' ); ?>">
								<?php } ?>
							</a>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) {
								?>
									<div class="Category__item__wrap">
								<?php
							}
							?>
								<h3 class="Category__item__title item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="Category__item__excerpt item-excerpt">
									<a href="<?php the_permalink(); ?>">
										<?= esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
										<?php if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) { ?>
											<span><?php _e( 'Read more about', 'ms' ); ?> <?= esc_html( strtolower( get_the_title() ) ); ?></span>
										<?php } ?>
									</a>
								</div>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_pillar', true ) === 'on' ) {
								?>
									</div>
								<?php
							}
							?>
					</li>

					<?php
						$collections = '';
						$plan        = '';
						$size        = '';
						$category    = '';
					?>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
