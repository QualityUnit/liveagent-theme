<?php // @codingStandardsIgnoreLine
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_integrations', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );
$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_integrations' );
$categories = get_the_terms( $current_id, 'ms_integrations_categories' );
$categories_url = get_post_type_archive_link( 'ms_integrations' );

$page_header_args = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_integrations.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'title' => get_the_title(),
	'text' => get_the_excerpt( $post ),
);
if ( has_post_thumbnail() ) {
	$page_header_args['logo'] = array(
		'src' => get_the_post_thumbnail_url( $post->ID, 'logo_thumbnail' ),
	);
}
if (
		get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_native_integration_url', true ) ||
		get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_external_integration_url', true ) ||
		get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_zapier_integration_url', true )
) {
	$header_buttons = array();
	if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_native_integration_url', true ) ) {
		$header_buttons[] = array(
			'href' => get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_native_integration_url', true ),
			'onclick' => "_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration " . get_the_title() . " - Button - Native Integration'])",
			'title' => __( 'Native Integration', 'ms' ),
		);
	}
	if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_external_integration_url', true ) ) {
		$header_buttons[] = array(
			'href' => get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_external_integration_url', true ) . '?utm_medium=referral&utm_source=liveagent&utm_campaign=integration',
			'onclick' => "_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration " . get_the_title() . " - Button - External Integration'])",
			'target' => '_blank',
			'title' => __( 'External Integration', 'ms' ),
		);
	}
	if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_zapier_integration_url', true ) ) {
		$header_buttons[] = array(
			'href' => get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_zapier_integration_url', true ) . '?utm_medium=referral&utm_source=liveagent&utm_campaign=integration',
			'onclick' => "_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration " . get_the_title() . " - Button - Zapier Integration'])",
			'target' => '_blank',
			'title' => __( 'Zapier Integration', 'ms' ),
		);
	}
	$page_header_args['buttons'] = $header_buttons;
}
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
	$page_header_args['tags'][] = $new_tags;
}
if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_plan', true ) ) {
	$new_tags = array(
		'title' => __( 'Available in', 'ms' ),
	);
	foreach ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_plan', true ) as $item ) {
		if ( 'ticket' === $item ) {
			$new_tags['list'][] = array(
				'title' => __( 'Small', 'ms' ),
			);
		}
		if ( 'ticket-chat' === $item ) {
			$new_tags['list'][] = array(
				'title' => __( 'Medium', 'ms' ),
			);
		}
		if ( 'all-inclusive' === $item ) {
			$new_tags['list'][] = array(
				'title' => __( 'Large', 'ms' ),
			);
		}
		if ( 'extensions' === $item ) {
			$new_tags['list'][] = array(
				'title' => __( 'Extensions', 'ms' ),
			);
		}
		if ( 'self-hosted' === $item ) {
			$new_tags['list'][] = array(
				'title' => __( 'Self-Hosted', 'ms' ),
			);
		}
	}
	$page_header_args['tags'][] = $new_tags;
}
?>

<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/TechArticle">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
 
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar urlslab-skip-keywords">

			<div class="Post__sidebar__partner">
				<div class="Post__sidebar__title h4"><?php _e( 'Partner', 'ms' ); ?></div>
				<ul>
					<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_learn_more', true ) ) { ?>
						<li>
							<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_learn_more', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" onclick="_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration <?php the_title(); ?> - Button - Partner - Learn More'])" target="_blank" rel="nofollow">
								<?php _e( 'Learn More', 'ms' ); ?>
							</a>
						</li>
					<?php } ?>
					<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_privacy_policy', true ) ) { ?>
						<li>
							<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_privacy_policy', true ) ) ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" onclick="_paq.push(['trackEvent', 'Activity', 'Integration', 'Integration <?php the_title(); ?> - Button - Partner - Privacy Policy'])" target="_blank" rel="nofollow">
								<?php the_title(); ?> <?php _e( 'Privacy Policy', 'ms' ); ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>

			<?php if ( sidebar_toc() !== false ) { ?>
				<div class="SidebarTOC-wrapper">
					<div class="SidebarTOC Post__SidebarTOC">
						<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
						<div class="SidebarTOC__slider slider splide">
							<div class="splide__track">
								<ul class="SidebarTOC__content splide__list">
									<?= wp_kses_post( sidebar_toc() ); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div class="Post__content">

			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q1', true ) ) { ?>
					<div class="Faq" itemscope itemtype="https://schema.org/FAQPage">
						<h2 id="faq"><?php _e( '<span class="highlight">Frequently</span> asked questions', 'ms' ); ?></h2>
						<?php
						if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-text', true ) ) {
							?>
							<div class="subhead--wrapper">
								<p class="subhead"><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-text', true ) ); ?></p>
							</div>
							<?php
						}
						for ( $i = 1; $i <= 10; ++$i ) {
							if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q' . $i, true ) ) {
								?>
								<div class="Faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
									<h3 itemprop="name"><?= esc_html( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-q' . $i, true ) ); ?></h3>
									<div class="Faq__outer-wrapper" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
										<div class="Faq__inner-wrapper" itemprop="text">
											<p><?= wp_kses_post( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_faq-a' . $i, true ) ); ?></p>
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
					<a href="<?php _e( '/integrations/', 'ms' ); ?>" class="Button Button--outline Button--back"  onclick="_paq.push(['trackEvent', 'Activity', 'Integrations', 'Back to Integrations'])"><span><?php _e( 'Back to Integrations', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Sign Up Trial'])">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<div class="Post__content__resources">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Resources', 'ms' ); ?></div>

					<div class="SimilarSources">
						<?php echo do_shortcode( '[urlslab-related-resources]' ); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
