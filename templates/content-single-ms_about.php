<?php // @codingStandardsIgnoreLine
	set_source( 'about', 'pages/Directory', 'css' );
	set_source( 'about', 'pages/About', 'css' );
	$header_category = get_the_terms( $post->ID, 'ms_about_categories' );
if ( ! empty( $header_category ) ) {
	$header_category = array_shift( $header_category );
	$header_category = $header_category->slug;
}
$post_permalink = get_the_permalink();
$categories = get_categories( array( 'taxonomy' => 'ms_about_categories' ) );
$page_header_args = array(
	'image' => array(
		'type' => 'main',
		'src' => get_template_directory_uri() . '/assets/images/compact_header_about_us.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'title' => get_the_title(),
	'menu' => array(
		//'title' => 'Nejaky nazov',
	),
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
					'orderby'    => 'date',
					'order'      => 'ASC',
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
					'href' => get_the_permalink(),
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
			'href' => get_the_permalink(),
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
 
	<div class="Post__header about">
		<div class="wrapper__wide"></div>
	</div>

	<div class="wrapper__wide Post__container">
        <div class="Post__sidebar urlslab-skip-keywords">
			<?php if ( sidebar_toc() !== false ) { ?>
                <div class="SidebarTOC-wrapper">
                    <div class="SidebarTOC">
                        <strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
                        <div class="SidebarTOC__slider slider splide">
                            <div class="splide__track">
                                <ul class="SidebarTOC__content splide__list">
									<?= wp_kses_post( sidebar_toc() ); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			<?php } ?>
        </div>

		<div class="Post__content">
			<div class="Post__logo Post__logo--about">
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_about-us.svg" alt="<?php _e( 'About us', 'ms' ); ?>">
			</div>
			<h1 itemprop="name" class="Post__main-title"><?php the_title(); ?></h1>

			<div class="Content" itemprop="text" >
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
