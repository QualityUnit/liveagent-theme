<?php // @codingStandardsIgnoreLine
	set_source( 'about', 'pages/Directory', 'css' );
	set_source( 'about', 'pages/About', 'css' );
	set_custom_source( 'common/splide', 'css' );
	$header_category = get_the_terms( $post->ID, 'ms_about_categories' );
if ( ! empty( $header_category ) ) {
	$header_category = array_shift( $header_category );
	$header_category = $header_category->slug;
}
$post_permalink   = get_the_permalink();
$categories       = get_categories( array( 'taxonomy' => 'ms_about_categories' ) );
$page_header_args = array(
	'image' => array(
		'type' => 'main',
		'src'  => get_template_directory_uri() . '/assets/images/compact_header_about_us.png?ver=' . THEME_VERSION,
		'alt'  => get_the_title(),
	),
	'logo'  => array(
		'src' => get_template_directory_uri() . '/assets/images/icon-book.svg?ver=' . THEME_VERSION,
		'alt' => __( 'About us', 'ms' ),
	),
	'title' => get_the_title(),
	'menu'  => array(
		//'title' => 'Nejaky nazov',
	),
	'toc'   => true,
);
$menu_items = array();
if ( ! empty( $categories ) ) :
	foreach ( $categories as $category ) :
		if ( 'photos' !== $category->slug ) :
			$query_glossary_posts = new WP_Query(
				array(
					'ms_about_categories' => $category->slug,
                    // @codingStandardsIgnoreLine
                    'posts_per_page' => 500,
					'orderby'             => 'date',
					'order'               => 'ASC',
				)
			);
			while ( $query_glossary_posts->have_posts() ) :
				$query_glossary_posts->the_post();
				$menu_item_active = false;
				if ( get_the_permalink() == $post_permalink ) :
					$menu_item_active = true;
				endif;
				$menu_items[] = array(
					'title'  => get_the_title(),
					'href'   => get_the_permalink(),
					'active' => $menu_item_active,
				);
			endwhile;
			wp_reset_postdata();
		endif;
	endforeach;
else :
	$query_glossary_posts = new WP_Query(
		array(
			'post_type'      => 'ms_about',
            // @codingStandardsIgnoreLine
            'posts_per_page' => 500,
			'orderby'        => 'date',
			'order'          => 'ASC',
		)
	);
	while ( $query_glossary_posts->have_posts() ) :
		$query_glossary_posts->the_post();
		$menu_item_active = false;
		if ( get_the_permalink() == $post_permalink ) :
			$menu_item_active = true;
		endif;
		$menu_items[] = array(
			'title' => get_the_title(),
			'href'  => get_the_permalink(),
		);
	endwhile;
	wp_reset_postdata();
endif;
$page_header_args['menu']['items'] = $menu_items;
?>

<div class="Post Post--sidebar-right about" itemscope itemtype="http://schema.org/AboutPage">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	
	<div class="wrapper Post__container">
		<div class="Post__content">
			<div class="Content" itemprop="text" >
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
