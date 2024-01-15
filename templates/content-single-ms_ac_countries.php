<?php // @codingStandardsIgnoreLine
set_custom_source( 'pages/AreaCodes', 'css' );
$post_meta        = get_post_meta( get_the_ID() );
$flag_path        = get_template_directory_uri() . '/assets/country_flags/' . $post_meta['iso_code'][0] . '.svg';
$page_header_logo = array(
	'src' => $flag_path . '?ver=' . THEME_VERSION,
	'alt' => get_the_title(),
);

$page_header_args = array(
	'image'      => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_glossary.png?ver=' . THEME_VERSION,
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
				<div style="position: relative; width: 100%; height: 0; padding-bottom: 40%; overflow: hidden"><iframe frameborder="0" style="border:0; position: absolute; top: 0; left: 0;	margin: 0 !important;	width: 100% !important;	height: 100% !important;" scrolling="no" src="https://maps.google.com/maps?hl=en&amp;q='<?= esc_attr( get_the_title() ); ?>&amp;t=&amp;z=5&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>

				<?= do_shortcode( '[urlslab-generator id="7" country_name="' . get_the_title() . '"]' ); ?>

				<?php 
				if ( 'us' === $post_meta['iso_code'][0] ) {
					get_template_part( 'lib/custom-blocks/us-area-codes', null );
				}
				?>


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
