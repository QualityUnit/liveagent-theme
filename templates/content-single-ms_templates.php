<?php // @codingStandardsIgnoreLine

	set_custom_source( 'common/splide', 'css' );

	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_templates', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );

	$page_header_logo = array(
		'src' => get_template_directory_uri() . '/assets/images/icon-book.svg?ver=' . THEME_VERSION,
		'alt' => __( 'Templates', 'ms' ),
	);
	if ( has_post_thumbnail() ) {
		$page_header_logo['src'] = get_the_post_thumbnail_url( $post, 'logo_thumbnail' );
	}
	$page_header_image = 'templates-category_' . $header_category . '.jpg';
	$page_header_args  = array(
		'image'      => array(
			'src' => get_template_directory_uri() . '/assets/images/' . $page_header_image . '?ver=' . THEME_VERSION,
			'alt' => get_the_title(),
		),
		'logo'       => $page_header_logo,
		'title'      => get_the_title(),
		'text'       => do_shortcode( '[urlslab-generator id="6"]' ),
		'toc'        => true,
		'cta_button' => get_cta_button_data(),
	);
	$current_id        = apply_filters( 'wpml_object_id', $post->ID, 'ms_templates' );
	$categories        = get_the_terms( $current_id, 'ms_templates_categories' );
	$categories_url    = get_post_type_archive_link( 'ms_templates' );
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
	if ( ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_help-desk-software', true ) === 'on' )
	|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_ticketing-software', true ) === 'on' )
	|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_live-chat-software', true ) === 'on' )
	|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_call-center-software', true ) === 'on' )
	|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_social-media', true ) === 'on' )
	|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_customer-portal-software', true ) === 'on' )
	|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_knowledge-base', true ) === 'on' )
	|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_affiliate-program', true ) === 'on' )
	) {
		$new_tags = array(
			'title' => __( 'Technologies', 'ms' ),
		);
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_help-desk-software', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'  => __( '/help-desk-software/', 'ms' ),
				'title' => __( 'Help Desk Software', 'ms' ),
			);
		}
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_ticketing-software', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'  => __( '/ticketing-software/', 'ms' ),
				'title' => __( 'Ticketing Software', 'ms' ),
			);
		}
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_live-chat-software', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'  => __( '/live-chat-software/', 'ms' ),
				'title' => __( 'Live Chat Software', 'ms' ),
			);
		}
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_call-center-software', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'  => __( '/call-center-software/', 'ms' ),
				'title' => __( 'Call Center Software', 'ms' ),
			);
		}
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_social-media', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'  => __( '/social-media-customer-service/', 'ms' ),
				'title' => __( 'Social Media Support', 'ms' ),
			);
		}
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_customer-portal-software', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'  => __( '/customer-portal-software/', 'ms' ),
				'title' => __( 'Customer Portal Software', 'ms' ),
			);
		}
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_knowledge-base', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'  => __( '/knowledge-base-software/', 'ms' ),
				'title' => __( 'Knowledge Base Software', 'ms' ),
			);
		}
		if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_affiliate-program', true ) === 'on' ) {
			$new_tags['list'][] = array(
				'href'   => __( 'https://www.postaffiliatepro.com/?utm_medium=referral&utm_source=liveagent&utm_campaign=directory', 'ms' ),
				'title'  => __( 'Affiliate Software', 'ms' ),
				'target' => '_blank',
				'rel'    => 'nofollow',
			);
		}
		if ( isset( $new_tags['list'] ) ) {
			$page_header_args['tags'][] = $new_tags;
		}
	}
	?>
<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/Guide">
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

			<div class="Content" itemprop="text">
				<?php the_content(); ?>

				<?php echo do_shortcode( '[urlslab-faq]' ); ?>

				<div class="Post__buttons">
					<a href="<?php _e( '/templates/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Templates', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php urlslab_display_related_resources(); ?>
			</div>
		</div>
	</div>
</div>
