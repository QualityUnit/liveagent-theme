<?php // @codingStandardsIgnoreLine

$post_meta       = get_post_meta( get_the_ID() );
$current_lang    = apply_filters( 'wpml_current_language', null );
$header_category = get_en_category( 'ms_alternatives', $post->ID );
do_action( 'wpml_switch_language', $current_lang );

$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-alternative__tower.svg?ver=' . THEME_VERSION,
	'alt' => __( 'Alternative', 'ms' ),
);

$screenshot        = isset( $post_meta['screenshot_url'] ) ? $post_meta['screenshot_url'][0] : null;
$page_header_image = array(
	'src' => get_template_directory_uri() . '/assets/images/alternatives-header_img.png?ver=' . THEME_VERSION,
	'alt' => get_the_title(),
);

if ( isset( $screenshot ) ) {

	$img = do_shortcode( '[urlslab-screenshot url="' . $screenshot . '" alt="' . get_the_title() . '" default-image="' . get_template_directory_uri() . '/assets/images/alternatives-header_img.png?ver=' . THEME_VERSION . '"]' );

	$page_header_image = array(
		'screenshot' => $img,
	);
}

$page_header_args = array(
	'image' => $page_header_image,
	'logo'  => $page_header_logo,
	'title' => get_the_title(),
	'text'  => do_shortcode( '[urlslab-generator id="6"]' ),
	'toc'   => true,
);

$current_id     = apply_filters( 'wpml_object_id', $post->ID, 'ms_alternatives' );
$categories     = get_the_terms( $current_id, 'ms_alternatives_categories' );
$categories_url = get_post_type_archive_link( 'ms_alternatives' );

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

			</div>
		</div>
	</div>
	<?php echo do_shortcode( '[alternatives]' ); ?>
</div>
