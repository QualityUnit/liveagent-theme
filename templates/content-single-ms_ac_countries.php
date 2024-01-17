<?php // @codingStandardsIgnoreLine
set_custom_source( 'pages/AreaCodes', 'css' );
$post_meta        = get_post_meta( get_the_ID() );
$phone_format     = array( 'calling_prefix' => '+' . $post_meta['calling_prefix'][0] );
$flag_path        = get_template_directory_uri() . '/assets/country_flags/' . $post_meta['iso_code'][0] . '.svg';
$page_header_logo = array(
	'src' => $flag_path . '?ver=' . THEME_VERSION,
	'alt' => get_the_title(),
);

$page_header_args = array(
	'image'      => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_areacodes_country.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'titlelogo'  => $page_header_logo,
	'title'      => get_the_title() . ' (+' . $post_meta['calling_prefix'][0] . ')',
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
				<div class="AreaCodes__map"><iframe frameborder="0" scrolling="no" src="https://maps.google.com/maps?hl=en&amp;q='<?= esc_attr( get_the_title() ); ?>&amp;t=&amp;z=5&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>

				<?= do_shortcode( '[urlslab-generator id="7" country_name="' . get_the_title() . '"]' ); ?>

				<?php 
				if ( 'us' === $post_meta['iso_code'][0] ) {
					get_template_part( 'lib/custom-blocks/us-area-codes', null );
				}
				get_template_part( '/lib/custom-blocks/areacodes-phone-format-banner', null, $phone_format );
				?>
			</div>
		</div>
	</div>
	<?php require_once get_template_directory() . '/lib/custom-blocks/areacodes-callcenter-banner.php'; ?>

	<div class="Post__content__resources wrapper">
		<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>

		<div class="SimilarSources">
			<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
		</div>
	</div>
</div>
