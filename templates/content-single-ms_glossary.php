<?php // @codingStandardsIgnoreLine

set_custom_source( 'common/splide', 'css' );

$page_header_args = array(
	'title'      => get_the_title(),
	'toc'        => true,
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
