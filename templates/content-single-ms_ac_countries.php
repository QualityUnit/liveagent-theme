<?php // @codingStandardsIgnoreLine
global $post;
$post_slug        = $post->post_name;
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
	'logo'       => $page_header_logo,
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
				<?php the_content(); ?>

				<?php 
				if ( 'unites-states' === $post_slug ) {
					get_template_part( 'lib/custom-blocks/us-area-codes', null );
				}
				?>
				<div class="Post__buttons">
					<a href="<?php _e( '/customer-support-glossary/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Glossary', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php
				$shortcode_text = do_shortcode( '[urlslab-generator id="1"]' );

				if ( ! empty( $shortcode_text ) ) {
					?>

					<div class="BlockDiscover BlockDiscover--expert">
						<p class="BlockDiscover__title"><?php _e( 'Expert note', 'ms' ); ?></p>
						<p class="BlockDiscover__text"><?php echo $shortcode_text; //@codingStandardsIgnoreLine ?></p>

						<div class="BlockDiscover__buttons">
							<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--knockout">
								<span><?php _e( 'Try LiveAgent', 'ms' ); ?></span>
							</a>
							<a href="<?php _e( '/demo/', 'ms' ); ?>" class="Button Button--outline Button--outline__white">
								<span><?php _e( 'Schedule a Demo', 'ms' ); ?></span>
							</a>
						</div>

						<div class="BlockDiscover__agent">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/agent-saxon.png" alt="<?php _e( 'Andrej Saxon', 'ms' ); ?>" class="BlockDiscover__agent__photo">
							<div>
								<div class="BlockDiscover__agent__name"><?php _e( 'Andrej Saxon', 'ms' ); ?></div>
								<div class="BlockDiscover__agent__position"><?php _e( 'Sales manager', 'ms' ); ?></div>
							</div>
						</div>
					</div>

					<?php set_custom_source( 'shortcodes/BlockDiscover' ); ?>
				<?php } ?>

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
