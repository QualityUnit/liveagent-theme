<?php
	/**
	 * Template Name: Page Like Blog Post – Helpdesk Header
	 */
	set_custom_source( 'components/SidebarTOC', 'css' );
	set_custom_source( 'components/SignupSidebar', 'css' );
	set_custom_source( 'pages/post', 'css' );
	set_custom_source( 'pages/blog', 'css' );
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'sidebar_toc', 'js' );
	set_custom_source( 'custom_lightbox', 'js' );
?>

<style type="text/css" rel="stylesheet">
	.animation {
		min-width: 27em;
		width: 45% !important;
		left: -35% !important;
		padding: 10% 0;
	}

	.heroHeadline {
		margin-bottom: 4.25em;
	}

	@media (min-width: 768px) {
		.heroHeadline {
			margin-bottom: 6.25em;
		}
	}
</style>

<section class="elementor-section elementor-top-section elementor-element heroHeadline elementor-section-full_width elementor-section-height-default elementor-section-height-default">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-column elementor-col-100 elementor-top-column elementor-element wrapper">
			<div class="elementor-widget-wrap elementor-element-populated">
				<section class="elementor-section elementor-inner-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default">
					<div class="elementor-container elementor-column-gap-default">
						<div class="elementor-column heroHeadline__home--info">
							<div class="elementor-widget-wrap">
								<div class="heroHeadline__title elementor-widget elementor-widget-heading" data-widget_type="heading.default">
									<div class="elementor-widget-container">
										<h1 class="elementor-heading-title elementor-size-default">
											<?php
											$pagetitle = explode( '^', get_the_title() );
											if ( isset( $pagetitle[1] ) ) {
												?>
												<?= esc_html( $pagetitle[0] ) . ' ' ?>
												<span class="highlight-gradient"><?= esc_html( $pagetitle[1] ); ?></span>
												<?= esc_html( ' ' . $pagetitle[2] ) ?>
												<?php
											} else {
												the_title();
											}
											?>
										</h1>
									</div>
								</div>
								<div class="heroHeadline__home--subtitle elementor-widget elementor-widget-text-editor">
									<div class="elementor-widget-container">
										<div class="elementor-text-editor elementor-clearfix">
											<div class="h3"><?php _e( 'Impress your customers and increase their satisfaction.', 'ms' ); ?></div>
										</div>
									</div>
								</div>
								<div class="elementor-widget elementor-widget-html">
									<div class="elementor-widget-container">
										<ul class="no-cc">
											<li>✓ <?php _e( 'No setup fee', 'ms' ); ?>&nbsp;&nbsp;&nbsp;</li>
											<li>✓ <?php _e( 'Customer service 24/7', 'ms' ); ?> &nbsp;&nbsp;&nbsp;</li>

											<li>✓ <?php _e( 'No credit card required', 'ms' ); ?> &nbsp;&nbsp;&nbsp;</li>
											<li>✓ <?php _e( 'Cancel any time', 'ms' ); ?></li>
										</ul>
										<div class="flex flex-wrap">
											<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
												<span><?php _e( 'Get Started | 14 days free', 'ms' ); ?> </span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="elementor-column heroHeadline--bg urlslab-skip-lazy">
							<div class="elementor-widget-wrap elementor-element-populated">
								<div class="animation elementor-widget elementor-widget-image urlslab-min-width-1024">
									<div class="elementor-widget-container">
										<img class="attachment-large size-large"
											 alt="<?php _e( 'Header Animation', 'ms' ); ?>" height="100" width="100"
											 src="https://www.liveagent.com/app/uploads/2021/06/helpdesk-2.svg">
									</div>
								</div>
								<div class="elementor-widget-image urlslab-min-width-768">
									<div class="elementor-widget-container">
										<img width="970" height="1024"
											 class="attachment-large size-large" alt="<?php _e( 'Helpdesk software', 'ms' ); ?>"
											 src="https://www.liveagent.com/app/uploads/2021/06/helpdesk_bg-970x1024.jpg">
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</section>

<div class="Post">
	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar urlslab-skip-keywords">
			<?php if ( sidebar_toc() !== false ) { ?>
			<div class="SidebarTOC-wrapper">
				<div class="SidebarTOC">
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

		<div class="BlogPost__content Post__content">
			<div class="Content">
				<?php the_content(); ?>

				<div class="Post__content__resources">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>
					<div class="SimilarSources">
						<?php echo do_shortcode( '[urlslab-related-resources show-image="true" show-summary="true"]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
