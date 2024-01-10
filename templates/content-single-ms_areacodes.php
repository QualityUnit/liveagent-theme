<?php // @codingStandardsIgnoreLine
global $post;
$post_slug        = $post->post_name;
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
	'titlelogo'  => $page_header_logo,
	'title'      => get_the_title(),
	'text'       => do_shortcode( '[urlslab-generator id="6"]' ),
	'toc'        => true,
	'cta_button' => get_cta_button_data(),
);

?>
<div class="Post Post--sidebar-right" itemscope itempro="location" itemtype="https://schema.org/Place">
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

				<h3><?php _e( 'Area code and other parts of a phone number', 'areacodes' ); ?></h3>
				<p>
					<?php _e( 'You`ve gone through the different area codes in the United States, but what do these numbers really mean? Phone numbers in the United States typically consist of 11 digits — the 1-digit country code, a 3-digit area code and a 7-digit telephone number. The 7-digit telephone number is further comprised of a 3-digit central office or exchange code and a 4-digit subscriber number. The country code of USA is +1. It is unique for every country. Area codes are of two types — local and toll-free. 800, 844, 855, 866, 877, and 888 are the different toll-free codes. All the remaining area codes represent the geopgraphic region to which a phone number belongs. The central office code denotes the telephone exchange to which the phone number is mapped. The last four digits, the subscriber number, is unique to each telephone line in the area served by the associated central exchange. These four digits are typically used by businesses to provide vanity numbers that offer great top-of-the-mind recall.', 'areacodes' ); ?>
				</p>
			</div>
		</div>
	</div>
</div>
