<?php // @codingStandardsIgnoreLine

set_custom_source( 'common/splide', 'css' );

$current_lang    = apply_filters( 'wpml_current_language', null );
$header_category = get_en_category( 'ms_features', $post->ID );
do_action( 'wpml_switch_language', $current_lang );
$la_pricing_url   = __( '/pricing/', 'ms' );
$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-custom-post_type.svg' . THEME_VERSION,
	'alt' => __( 'Integration', 'ms' ),
);
if ( has_post_thumbnail() ) {
	$page_header_logo['src'] = get_the_post_thumbnail_url( $post, 'logo_thumbnail' );
}
$page_header_image = 'features-category_' . $header_category . '.jpg';
$page_header_args  = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/' . $page_header_image,
		'alt' => get_the_title(),
	),
	'logo'  => $page_header_logo,
	'title' => get_the_title(),
	'text'  => do_shortcode( '[urlslab-generator id="6"]' ),
	'toc'   => true,
);
$current_id        = apply_filters( 'wpml_object_id', $post->ID, 'ms_features' );
$categories        = get_the_terms( $current_id, 'ms_features_categories' );
$categories_url    = get_post_type_archive_link( 'ms_features' );
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
if ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) ) {
	$new_tags = array(
		'title' => __( 'Available in', 'ms' ),
	);
	foreach ( get_post_meta( get_the_ID(), 'mb_features_mb_features_plan', true ) as $item ) {
		if ( 'ticket' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Small', 'ms' ),
			);
		}
		if ( 'ticket-chat' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Medium', 'ms' ),
			);
		}
		if ( 'all-inclusive' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Large', 'ms' ),
			);
		}
		if ( 'self-hosted' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Self-Hosted', 'ms' ),
			);
		}
		if ( 'enterprise' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Enterprise', 'ms' ),
			);
		}
		if ( 'extensions' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Extensions', 'ms' ),
			);
		}
	}
	if ( isset( $new_tags['list'] ) ) {
		$page_header_args['tags'][] = $new_tags;
	}
}
?>

<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/TechArticle">
	<span itemprop="author" itemscope itemtype="http://schema.org/Organization">
		<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
		<meta itemprop="name" content="LiveAgent">
	</span>

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
