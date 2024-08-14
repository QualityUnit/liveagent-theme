<?php // @codingStandardsIgnoreLine
	set_custom_source( 'common/splide', 'css' );

	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_academy', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );

	$page_header_logo = array(
		'src' => get_template_directory_uri() . '/assets/images/icon-book.svg',
		'alt' => __( 'Academy', 'ms' ),
	);
	if ( has_post_thumbnail() ) {
		$page_header_logo['src'] = get_the_post_thumbnail_url( $post, 'logo_thumbnail' );
	}
	$page_header_image = 'academy-category_' . $header_category . '.jpg';
	$page_header_args  = array(
		'image'      => array(
			'src' => get_template_directory_uri() . '/assets/images/' . $page_header_image . '?ver=' . THEME_VERSION,
			'alt' => get_the_title(),
		),
		'logo'       => $page_header_logo,
		'title'      => get_the_title(),
		'text'       => do_shortcode( '[urlslab-generator id="6"]' ),
		'toc'        => true,
		'cta_button' => get_cta_button_data(),
	);
	$current_id        = apply_filters( 'wpml_object_id', $post->ID, 'ms_academy' );
	$categories        = get_the_terms( $current_id, 'ms_academy_categories' );
	$categories_url    = get_post_type_archive_link( 'ms_academy' );

	if ( $categories && $categories_url ) {
		$new_tags = array(
			'title' => __( 'Categories', 'ms' ),
		);
		foreach ( $categories as $category ) {
			$new_tags['list'][] = array(
				'href'  => $categories_url . '#' . $category->slug,
				'title' => $category->name,
			);
		}
		if ( isset( $new_tags['list'] ) ) {
			$page_header_args['tags'][] = $new_tags;
		}
	}

	?>

<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">
		<div class="Post__sidebar">
			<div class="Signup__sidebar-wrapper">
				<?= do_shortcode( '[signup-sidebar js-sticky="true"]' ); ?>
			</div>
		</div>
		<div class="Post__content">

			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<?php echo do_shortcode( '[urlslab-faq]' ); ?>

				<div class="Post__buttons">
					<a href="<?php _e( '/academy/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Academy', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php urlslab_display_related_resources(); ?>
			</div>
		</div>
	</div>
</div>
