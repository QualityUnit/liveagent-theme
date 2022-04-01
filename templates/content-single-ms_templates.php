<?php // @codingStandardsIgnoreLine
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_templates', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );
?>
<div class="Post" itemscope itemtype="http://schema.org/Guide">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<div class="Post__header <?= esc_attr( $header_category ); ?>">
		<div class="wrapper__wide"></div>
	</div>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">

			<div class="Post__sidebar__categories">
				<div class="Post__sidebar__title h4"><?php _e( 'Categories', 'ms' ); ?></div>
				<ul class="Post__sidebar__categories__labels">
					<?php
					$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_templates' );
					$categories = get_the_terms( $current_id, 'ms_templates_categories' );

					if ( $categories ) {
						foreach ( $categories as $category ) {
							?>
					<li class="Post__sidebar__link">
						<a href="../#<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>"><?= esc_html( $category->name ); ?></a>
					</li>
							<?php
						}
					}
					?>
				</ul>
			</div>

			<?php
			if (
				( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_help-desk-software', true ) === 'on' )
				|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_ticketing-software', true ) === 'on' )
				|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_live-chat-software', true ) === 'on' )
				|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_call-center-software', true ) === 'on' )
				|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_social-media', true ) === 'on' )
				|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_customer-portal-software', true ) === 'on' )
				|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_knowledge-base', true ) === 'on' )
				|| ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_affiliate-program', true ) === 'on' )
			) {
				?>
				<div class="Post__sidebar__categories">
					<div class="Post__sidebar__title h4"><?php _e( 'Technologies', 'ms' ); ?></div>
					<div class="Post__sidebar__categories__labels">
						<?php if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_help-desk-software', true ) === 'on' ) { ?>
							<a href="<?php _e( '/help-desk-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Help Desk Software'])"><?php _e( 'Help Desk Software', 'ms' ); ?></a>
						<?php } if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_ticketing-software', true ) === 'on' ) { ?>
							<a href="<?php _e( '/ticketing-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Ticketing Software])"><?php _e( 'Ticketing Software', 'ms' ); ?></a>
						<?php } if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_live-chat-software', true ) === 'on' ) { ?>
							<a href="<?php _e( '/live-chat-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Live Chat Software])"><?php _e( 'Live Chat Software', 'ms' ); ?></a>
						<?php } if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_call-center-software', true ) === 'on' ) { ?>
							<a href="<?php _e( '/call-center-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Call Center Software])"><?php _e( 'Call Center Software', 'ms' ); ?></a>
						<?php } if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_social-media', true ) === 'on' ) { ?>
							<a href="<?php _e( '/social-media-customer-service/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Social Media Support])"><?php _e( 'Social Media Support', 'ms' ); ?></a>
						<?php } if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_customer-portal-software', true ) === 'on' ) { ?>
							<a href="<?php _e( '/customer-portal-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Customer Portal Software])"><?php _e( 'Customer Portal Software', 'ms' ); ?></a>
						<?php } if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_knowledge-base', true ) === 'on' ) { ?>
							<a href="<?php _e( '/knowledge-base-software/', 'ms' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Knowledge Base Software])"><?php _e( 'Knowledge Base Software', 'ms' ); ?></a>
						<?php } if ( get_post_meta( get_the_ID(), 'mb_templates_mb_templates_affiliate-program', true ) === 'on' ) { ?>
							<a href="https://www.postaffiliatepro.com/?utm_medium=referral&utm_source=liveagent&utm_campaign=directory" target="_blank" rel="nofollow" onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Label - Technologies - Affiliate Program])"><?php _e( 'Affiliate Software', 'ms' ); ?></a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

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

		<div class="Signup__sidebar-wrapper">
			<?= do_shortcode( '[signup-sidebar]' ); ?>
		</div>

		<div class="Post__content">
			<div class="Post__logo">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( 'logo_thumbnail' ); ?>
				<?php } else { ?>
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-book.svg" alt="<?php _e( 'Templates', 'ms' ); ?>">
				<?php } ?>
			</div>
			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/templates/', 'ms' ); ?>"><?php _e( 'Templates', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<h1 itemprop="name"><?php the_title(); ?></h1>

			<div class="Content" itemprop="text">
				<?php the_content(); ?>

				<div class="Post__m__negative Post__buttons">
					<a href="<?php _e( '/templates/', 'ms' ); ?>" class="Button Button--outline Button--back"  onclick="_paq.push(['trackEvent', 'Activity', 'Templates', 'Back to Templates'])"><span><?php _e( 'Back to Templates', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Glossary', 'Sign Up Trial'])">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
					<div class="Post__content__resources Post__m__negative">
						<div class="Post__sidebar__title h4"><?php _e( 'Related Resources', 'ms' ); ?></div>

						<div class="SimilarSources">
							<?php echo do_shortcode( '[similarsources]' ); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
