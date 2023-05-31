<?php // @codingStandardsIgnoreLine
$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-book.svg?ver=' . THEME_VERSION,
	'alt' => __( 'Glossary', 'ms' ),
);
if ( has_post_thumbnail() ) {
	$page_header_logo['src'] = get_the_post_thumbnail_url( $post, 'logo_thumbnail' );
}
$page_header_args = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_glossary.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'logo' => $page_header_logo,
	'title' => get_the_title(),
	'text' => get_the_excerpt( $post ),
	'toc' => true,
);
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

				<?php if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q1', true ) ) { ?>
						<div class="Faq" itemscope itemtype="https://schema.org/FAQPage">
							<h2 id="faq"><?php _e( '<span class="highlight">Frequently</span> asked questions', 'ms' ); ?></h2>
							<?php
							if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-text', true ) ) {
								?>
								<div class="subhead--wrapper">
									<p class="subhead"><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-text', true ) ); ?></p>
								</div>
								<?php
							}
							for ( $i = 1; $i <= 10; ++$i ) {
								if ( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q' . $i, true ) ) {
									?>
									<div class="Faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
										<h3 itemprop="name"><?= esc_html( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-q' . $i, true ) ); ?></h3>
										<div class="Faq__outer-wrapper" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
											<div class="Faq__inner-wrapper" itemprop="text">
												<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_glossary_mb_glossary_faq-a' . $i, true ) ); ?></p>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
				<?php } ?>

				<div class="Post__buttons">
					<a href="<?php _e( '/customer-support-glossary/', 'ms' ); ?>" class="Button Button--outline Button--back" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Back to Glossary'])"><span><?php _e( 'Back to Glossary', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Sign Up Trial'])">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php
				$shortcode_text = do_shortcode( '[urlslab-generator id="1"]' );

				if ( ! empty( $shortcode_text ) ) {
					?>

					<div class="BlockDiscover BlockDiscover--expert">
						<p class="BlockDiscover__title"><?php _e( 'Expert note', 'ms' ); ?></p>
						<p class="BlockDiscover__text"><?php echo esc_html( $shortcode_text ); ?></p>

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
