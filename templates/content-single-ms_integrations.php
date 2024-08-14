<?php // @codingStandardsIgnoreLine
set_custom_source( 'pages/Directory', 'css' );
$current_lang    = apply_filters( 'wpml_current_language', null );
$header_category = get_en_category( 'ms_integrations', $post->ID );
do_action( 'wpml_switch_language', $current_lang );
$current_id     = apply_filters( 'wpml_object_id', $post->ID, 'ms_integrations' );
$categories     = get_the_terms( $current_id, 'ms_integrations_categories' );
$categories_url = get_post_type_archive_link( 'ms_integrations' );
$la_pricing_url = __( '/pricing/', 'ms' );

$page_header_args = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_integrations.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'title' => get_the_title(),
	'text'  => do_shortcode( '[urlslab-generator id="6"]' ),
	'toc'   => true,
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
			'href'  => get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_native_integration_url', true ),
			'title' => __( 'Native Integration', 'ms' ),
		);
	}
	if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_external_integration_url', true ) ) {
		$header_buttons[] = array(
			'href'   => get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_external_integration_url', true ) . '?utm_medium=referral&utm_source=liveagent&utm_campaign=integration',
			'target' => '_blank',
			'title'  => __( 'External Integration', 'ms' ),
		);
	}
	if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_zapier_integration_url', true ) ) {
		$header_buttons[] = array(
			'href'   => get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_zapier_integration_url', true ) . '?utm_medium=referral&utm_source=liveagent&utm_campaign=integration',
			'target' => '_blank',
			'title'  => __( 'Zapier Integration', 'ms' ),
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
			'href'  => $categories_url . '#' . $category->slug,
			'title' => $category->name,
		);
	}
	if ( isset( $new_tags['list'] ) ) {
		$page_header_args['tags'][] = $new_tags;
	}
}
if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_plan', true ) ) {
	$new_tags = array(
		'title' => __( 'Available in', 'ms' ),
	);
	foreach ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_plan', true ) as $item ) {
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
		if ( 'extensions' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Extensions', 'ms' ),
			);
		}
		if ( 'self-hosted' === $item ) {
			$new_tags['list'][] = array(
				'href'  => $la_pricing_url,
				'title' => __( 'Self-Hosted', 'ms' ),
			);
		}
	}
	if ( isset( $new_tags['list'] ) ) {
		$page_header_args['tags'][] = $new_tags;
	}
}
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

				<div class="Directory__blocks">
					<h2 id="customer-service-contacts" class="Post__sectiontitle"><span><?= esc_html( $page_header_args['title'] ), ' ', esc_html_e( 'integration', 'ms' ); ?></span></h2>
					<div class="Directory__blocks__items">
						<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_learn_more', true ) ) { ?>
						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-ticket.svg" alt="">
							<h3>Partner website</h3>
							<p>
								<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_learn_more', true ) ); ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" target="_blank" rel="nofollow">
									<?php _e( 'Learn More', 'ms' ); ?>
								</a>
							</p>
						</div>
						<?php } ?>
						<?php if ( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_privacy_policy', true ) ) { ?>
						<div class="Directory__blocks__items__item">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-directory-live-chat.svg" alt="">
							<h3><?php _e( 'Partner Privacy Policy', 'ms' ); ?></h3>
							<p>
								<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_integrations_mb_integrations_partner_privacy_policy', true ) ); ?>?utm_medium=referral&utm_source=liveagent&utm_campaign=integration" target="_blank" rel="nofollow">
									<?php the_title(); ?> <?php _e( 'Privacy Policy', 'ms' ); ?>
								</a>
							</p>
						</div>
						<?php } ?>
					</div>
				</div>

				<?php the_content(); ?>
				<?php echo do_shortcode( '[urlslab-faq]' ); ?>

				<div class="Post__buttons">
					<a href="<?php _e( '/integrations/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Integrations', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php urlslab_display_related_resources(); ?>
			</div>

		</div>
	</div>
</div>
