<?php // @codingStandardsIgnoreLine

set_custom_source( 'common/splide', 'css' );


$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-book.svg?ver=' . THEME_VERSION,
	'alt' => __( 'Glossary', 'ms' ),
);
if ( has_post_thumbnail() ) {
	$page_header_logo['src'] = get_the_post_thumbnail_url( $post, 'logo_thumbnail' );
}
$page_header_args = array(
	'image'      => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_glossary.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'logo'       => $page_header_logo,
	'title'      => get_the_title(),
	'text'       => do_shortcode( '[urlslab-generator id="6" input="{{page_url}}"]' ),
	'toc'        => true,
	'cta_button' => get_cta_button_data(),
);

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

				<div class="Post__buttons">
					<a href="<?php _e( '/customer-support-glossary/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Glossary', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php urlslab_display_related_resources(); ?>
			</div>
		</div>
	</div>
</div>
