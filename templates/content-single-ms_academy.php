<?php // @codingStandardsIgnoreLine
	set_source( 'single-post', 'common/splide', 'css' );
	set_source( 'single-post', 'splide', 'js' );
	//set_source( 'single-post', 'sidebar_toc', 'js' );
	set_source( 'single-post', 'custom_lightbox', 'js' );

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
	$page_header_args = array(
		'image' => array(
			'src' => get_template_directory_uri() . '/assets/images/compact_header_academy.png?ver=' . THEME_VERSION,
			'alt' => get_the_title(),
		),
		'logo' => $page_header_logo,
		'title' => get_the_title(),
		'text' => get_the_excerpt( $post ),
		'toc' => true,
	);
	$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_academy' );
	$categories = get_the_terms( $current_id, 'ms_academy_categories' );
	$categories_url = get_post_type_archive_link( 'ms_academy' );
	if ( $categories && $categories_url ) {
		$new_tags = array(
			'title' => __( 'Categories', 'ms' ),
		);
		foreach ( $categories as $category ) {
			$new_tags['list'][] = array(
				'href' => $categories_url . '#' . $category->slug,
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
					<a href="<?php _e( '/academy/', 'ms' ); ?>" class="Button Button--outline Button--back"  onclick="_paq.push(['trackEvent', 'Activity', 'Academy', 'Back to Academy'])"><span><?php _e( 'Back to Academy', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Sign Up Trial'])">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<div class="Post__content__resources">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>

					<div class="SimilarSources">
						<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
