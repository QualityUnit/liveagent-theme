<?php // @codingStandardsIgnoreLine
set_custom_source( 'pages/Reviews', 'css' );
set_custom_source( 'pages/post', 'css' );
set_custom_source( 'blogLazyLoad', 'js', array( 'app_js' ) );

$subpage = get_queried_object();

$main_page = get_posts(
	array(
		'name'      => 'how-we-review',
		'post_type' => 'ms_reviews',
	)
);

if ( ! empty( $main_page ) ) {
	$main_page_id  = $main_page[0]->ID;
	$translated_id = apply_filters( 'wpml_object_id', $main_page_id, 'ms_reviews' );

	$mainpost     = get_post( $translated_id );
	$post_title   = $mainpost->post_title;
	$post_content = $mainpost->post_content;
}

if ( ! isset( $subpage->slug ) ) {
	$page_header_title_1 = __( 'Reviews categories', 'ms' );
	$page_header_description_1 = __( 'Find out which software in any category is the best option for your business. You are just getting started with help desk software or customer service in general, you might have a problem with all those new words. We have put together complete list of customer service terminology.', 'ms' );
	$page_header_args_1 = array(
		'type' => 'lvl-1',
		'image' => array(
			'src' => get_template_directory_uri() . '/assets/images/compact_header_reviews_1.png?ver=' . THEME_VERSION,
			'alt' => $page_header_title_1,
		),
		'title' => $page_header_title_1,
		'text' => $page_header_description_1,
	);
}
if ( isset( $subpage->slug ) ) {
	$query_posts_2 = new WP_Query(
		array(
			'post_type' => 'ms_reviews',
			// @codingStandardsIgnoreLine
			'posts_per_page' => 500,
			'orderby' => 'date',
			'order' => 'ASC',
			'tax_query' => array( // @codingStandardsIgnoreLine
				array(
					'taxonomy' => 'ms_reviews_categories',
					'field' => 'term_id',
					'terms' => $subpage->term_id,
				),
			),
		)
	);
	$page_header_title_2 = $subpage->name;
	$page_header_description_2 = $subpage->description;
	$page_header_breadcrumb_2 = array(
		array( __( 'Reviews', 'ms' ), __( '/reviews/', 'ms' ) ),
		array( $subpage->name ),
	);
	$sort_items_2 = array(
		'label' => __( 'Sort by:', 'ms' ),
		'items' => array(
			array(
				'checked' => true,
				'value' => 'reviews',
				'title' => __( 'Most reviews from external portals', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - Most reviews from external portals'])",
			),
			array(
				'checked' => true,
				'value' => 'rating',
				'title' => __( 'Best ratings from external portals', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - Best ratings from external portals'])",
			),
			array(
				'checked' => true,
				'value' => 'ourrating',
				'title' => __( 'Our best rating', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - Our best rating'])",
			),
			array(
				'checked' => true,
				'value' => 'updated',
				'title' => __( 'Recently updated', 'ms' ),
				'onclick' => "_paq.push(['trackEvent', 'Activity', 'Use case scenarios', 'Filter - Category - Recently updated'])",
			),
		),
	);
	$page_header_args_2 = array(
		'type' => 'lvl-1',
		'breadcrumb' => $page_header_breadcrumb_2,
		'image' => array(
			'src' => get_template_directory_uri() . '/assets/images/compact_header_reviews_2.png?ver=' . THEME_VERSION,
			'alt' => $page_header_title_2,
		),
		'title' => $page_header_title_2,
		'text' => $page_header_description_2,
		'sort' => $sort_items_2,
		'count' => array(
			'title' => $subpage->name,
			'value' => $query_posts_2->post_count,
		),
	);
}
?>
<div id="blog" class="Blog" itemscope itemtype="http://schema.org/Blog">
	<?php 
	// Main page level 1
	if ( ! isset( $subpage->slug ) ) {
		get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args_1 );
		require_once get_template_directory() . '/templates/content-archive-ms_reviews-categories.php';
	}
	if ( ! empty( $main_page ) && ! isset( $subpage->slug ) ) {
		?>
	<div class="wrapper mt-xxl Reviews__how">
		<?= do_shortcode( '[split-title title="' . $post_title . '"]' ); ?>
		<div class="Content">
			<?php
				$content = apply_filters( 'the_content', $post_content );
				echo $content // @codingStandardsIgnoreLine;
			?>
		</div>
	</div>
		<?php
	}

	// Category page level 2
	if ( isset( $subpage->slug ) ) { 
		?>
		<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args_2 ); ?>
		<?php require_once get_template_directory() . '/templates/content-archive-ms_reviews-posts.php'; ?>

		<div class="wrapper__wide">
			<div class="Reviews__categoryAbout">
				<div class="Reviews__categoryAbout--image__wrapper">
					<img 
						class="Reviews__categoryAbout--image"
						src="<?= esc_url( get_template_directory_uri() . '/assets/images/reviews_2nd_level_footer.png' ); ?>"
						alt="<?= esc_attr( get_term_meta( $subpage->term_id, 'description_title', true ) ); ?>"
					/>
				</div>
				<div class="Reviews__categoryAbout--description">
					<h2 class="Reviews__categoryAbout--title"><?= esc_html( get_term_meta( $subpage->term_id, 'category_description_title', true ) ); ?></h2>
					<p class="Reviews__categoryAbout--text">
						<?= esc_html( get_term_meta( $subpage->term_id, 'category_description', true ) ); ?>
					</p>
					<span class="learn-more">
						<a href="<?= esc_url( get_term_meta( $subpage->term_id, 'category_learn_more_url', true ) ); ?>"
						>
							<?= esc_html( get_term_meta( $subpage->term_id, 'category_learn_more', true ) ); ?>
						</a>
					</span>
				</div>
			</div>
		</div>

		<?php
			$whatis_post_id = get_term_meta( $subpage->term_id, 'category_whatis_article', true );
			
		if ( isset( $whatis_post_id ) ) {
			$whatis_post       = get_post( $whatis_post_id )->post_content;
			$whatis_post_title = get_post( $whatis_post_id )->post_title;
			$whatis_post_title = preg_replace( '/\^(.+?)\^/', '<span class="highlight-gradient">$1</span>', $whatis_post_title );
			$whatis_post       = apply_filters( 'the_content', $whatis_post );

			set_custom_source( 'pages/post', 'css' );
			set_custom_source( 'components/SidebarTOC', 'css' );
			set_custom_source( 'components/SignupSidebar', 'css' );
			set_custom_source( 'common/splide', 'css' );
			set_custom_source( 'splide', 'js' );
			//set_custom_source( 'sidebar_toc', 'js' );
			set_custom_source( 'custom_lightbox', 'js' );
			?>

		<div class="wrapper__wide Post__container">
			<div class="Post__sidebar urlslab-skip-keywords">
			<?php if ( sidebar_toc( $whatis_post ) !== false ) { ?>
					<div class="SidebarTOC-wrapper">
						<div class="SidebarTOC Post__SidebarTOC">
							<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
							<div class="SidebarTOC__slider slider splide">
								<div class="splide__track">
									<ul class="SidebarTOC__content splide__list">
										<?= wp_kses_post( sidebar_toc( $whatis_post ) ); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<div class="Signup__sidebar-wrapper">
			<?= do_shortcode( '[signup-sidebar]' ); ?>
			</div>
			<div class="Post__content">
				<div class="Content">
					<h2><?= $whatis_post_title; // @codingStandardsIgnoreLine ?></h2>
					<?= $whatis_post; // @codingStandardsIgnoreLine ?>
				</div>
			</div>
		</div>
			<?php
		}
	}
	?>
</div>
