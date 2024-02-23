<?php // @codingStandardsIgnoreLine
	set_custom_source( 'components/Block', 'css' );
	set_custom_source( 'filter', 'js' );
	$page_header_title = __( 'Alternatives', 'alternatives' );
	$page_header_args  = array(
		'type'   => 'lvl-1',
		'image'  => array(
			'src' => get_template_directory_uri() . '/assets/images/alternatives-header_img.png?ver=' . THEME_VERSION,
			'alt' => $page_header_title,
		),
		'title'  => $page_header_title,
		'text'   => __( 'If you are just getting started with help desk software or customer service in general, you might have a problem with all those new words. We have put together complete list of customer service terminology.', 'alternatives' ),
		'search' => array( 'type' => 'alternative' ),
	);
	?>
<div id="archive" itemscope itemtype="https://schema.org/DefinedTermSet">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<?php echo do_shortcode( '[alternatives]' ); ?>

	<div class="wrapper__wide">
		<div class="ma-left ma-right">
			<section class="elementor-section Block--redesign">
					<div class="elementor-widget-heading ma-left ma-right text-align-center" style="max-width: 48em">
						<div class="elementor-widget-container">
							<h2 class="elementor-heading-title text-align-center"><span class="highlight-gradient"><?php _e( 'Save more', 'alternatives' ); ?></span> <?php _e( 'without compromise', 'alternatives' ); ?></h2>
							<p class="mt-l"><?php _e( 'Don’t overpay for key features to increase your agent productivity. Compare LiveAgent help desk software with alternative options and find out how you can save more regardless of company size.', 'alternatives' ); ?></p>
						</div>
					</div>
				<?php 
					echo do_shortcode( '[web_calc]' ); 
				?>
			</section>

			<section
				class="elementor-section elementor-top-section elementor-element elementor-element-0932f76 elementor-section-full_width mt-ultra mb-ultra BlockPricing BlockPricing--outside Block Block--background elementor-section-height-default elementor-section-height-default"
				data-id="0932f76" data-element_type="section">
				<div class="elementor-container elementor-column-gap-default">
					<div
						class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e38e9e2 wrapper"
						data-id="e38e9e2" data-element_type="column">
						<div class="elementor-widget-wrap elementor-element-populated">
							<section
								class="elementor-section elementor-inner-section elementor-element elementor-element-1bf6dfe elementor-section-boxed elementor-section-height-default elementor-section-height-default"
								data-id="1bf6dfe" data-element_type="section">
								<div class="elementor-container elementor-column-gap-default">
									<div
										class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-31637f9"
										data-id="31637f9" data-element_type="column">
										<div class="elementor-widget-wrap elementor-element-populated">
											<div class="elementor-element elementor-element-5c9896e elementor-widget elementor-widget-heading"
												data-id="5c9896e" data-element_type="widget" data-widget_type="heading.default">
												<div class="elementor-widget-container">
													<h2 class="elementor-heading-title elementor-size-default"
														id="h-the-best-value-for-your-money"><?php _e( 'The best value for your money​', 'alternatives' ); ?></h2>
												</div>
											</div>
											<div
												class="elementor-element elementor-element-8860c9c elementor-widget elementor-widget-text-editor"
												data-id="8860c9c" data-element_type="widget" data-widget_type="text-editor.default">
												<div class="elementor-widget-container">
													<p>
													<?php 
													_e(
														'We carefully selected features in our pricing plans so you can pick the most affordable
														plan with the best value. Pay only for what you use without breaking your budget.',
														'alternatives'
													); 
													?>
													</p>
												</div>
											</div>
											<div class="elementor-element elementor-element-13f4878 elementor-widget elementor-widget-html"
												data-id="13f4878" data-element_type="widget" data-widget_type="html.default">
												<div class="elementor-widget-container">
													<div class="pricing__tags">
														<div class="pricing__tags__label">
														<?php 
														_e( '7 or 30 days free trial', 'alternatives' ); 
														?>
														&nbsp;
															<div class="Tooltip">
																<span class="fontello-info"></span>
																<span class="Tooltip__text"
																	style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(442px, 19417.5px, 0px);"
																	data-popper-placement="bottom">
																	<?php 
																	_e(
																		'Free trial for 7 days with a free email, or 30 days with a company email',
																		'alternatives'
																	); 
																	?>
																	<span data-popper-arrow=""
																		style="position: absolute; left: 0px; transform: translate3d(0px, 0px, 0px);"></span></span>
															</div>
														</div>
														<div class="pricing__tags__label">
														<?php 
														_e( 'No Credit Card required', 'alternatives' ); 
														?>
														</div>
														<div class="pricing__tags__label"><?php _e( 'and many more', 'alternatives' ); ?> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div
										class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-089b952"
										data-id="089b952" data-element_type="column">
										<div class="elementor-widget-wrap elementor-element-populated">
											<div
												class="elementor-element elementor-element-5f408e8 elementor-widget elementor-widget-shortcode"
												data-id="5f408e8" data-element_type="widget" data-widget_type="shortcode.default">
												<div class="elementor-widget-container">
													<div class="elementor-shortcode">
														<?php echo do_shortcode( '[block_pricing]' ); ?>

													</div>
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
		</div>

		<?php echo do_shortcode( '[urlslab-faq]' ); ?>
	</div>

</div>
