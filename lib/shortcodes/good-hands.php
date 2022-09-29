<?php

function ms_good_hands( $atts ) {
	$atts = shortcode_atts(
		array(
			'clients' => 0,
		),
		$atts,
		'good-hands'
	);

	ob_start();
	?>

	<section class="elementor-section Reviews" style="margin-top: 50px">
		<div class="elementor-container">
			<div class="elementor-row">
				<div class="elementor-column elementor-col-100 elementor-top-column wrapper">
					<div class="elementor-column-wrap elementor-element-populated">
						<div class="elementor-widget-wrap">
							<div class="elementor-element elementor-widget elementor-widget-heading">
								<div class="elementor-widget-container">
									<h2 class="elementor-heading-title elementor-size-default"><?php _e( 'You Will Be in <span class="highlight-gradient">Good Hands!</span>', 'ms' ); ?></h2>
								</div>
							</div>

							<div class="elementor-element elementor-widget elementor-widget-text-editor">
								<div class="elementor-widget-container">
									<div class="elementor-text-editor elementor-clearfix">
										<p><?php _e( 'Do you know what Huawei, BMW, Yamaha and O2 have in common? You guessed right… LiveAgent!', 'ms' ); ?></p>
									</div>
								</div>
							</div>

							<?php
							if ( 0 === $atts['clients'] ) {
								?>
							<div class="elementor-element elementor-widget elementor-widget-html">
								<div class="elementor-widget-container">
									<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--medium Button--full"><span><?php _e( 'Try it now for free', 'ms' ); ?></span></a>
									<span class="no-cc"><?php _e( 'No Credit Card Required', 'ms' ); ?></span>

									<div class="Reviews__items">
										<div class="Reviews__items__item">
											<a href="<?php _e( '/awards/', 'ms' ); ?>" title="G2 Crowd">
												<img style="opacity: 0; transition: opacity .5s" data-src="https://www.liveagent.com/app/uploads/2019/11/logo_g2.svg" alt="G2 Crowd">
											</a>
											<div class="Reviews__items__item__stars">
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
											</div>
										</div>
										<div class="Reviews__items__item">
											<a href="<?php _e( '/awards/', 'ms' ); ?>" title="Trustpilot">
												<img style="opacity: 0; transition: opacity .5s" data-src="https://www.liveagent.com/app/uploads/2019/11/logo_trustpilot.svg" alt="Trustpilot">
											</a>
											<div class="Reviews__items__item__stars">
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
											</div>
										</div>
										<div class="Reviews__items__item">
											<a href="<?php _e( '/awards/', 'ms' ); ?>" title="GetApp">
												<img style="opacity: 0; transition: opacity .5s" data-src="https://www.liveagent.com/app/uploads/2019/11/logo_getapp.svg" alt="GetApp">
											</a>
											<div class="Reviews__items__item__stars">
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
												<span class="Reviews__items__item__stars__item"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
								<?php
							}
							if ( $atts['clients'] > 0 ) {
								echo do_shortcode( '[clients posts=' . $atts['clients'] . ']' );
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	return ob_get_clean();
}
add_shortcode( 'good-hands', 'ms_good_hands' );
