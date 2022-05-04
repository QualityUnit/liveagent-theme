<?php

function ms_extrafaq( $atts ) {
	$atts = shortcode_atts(
		array(
			'schema'      => 'yes',
			'is-wide'     => 'true',
			'headline'    => '',
			'question-1'  => '',
			'answer-1'    => '',
			'question-2'  => '',
			'answer-2'    => '',
			'question-3'  => '',
			'answer-3'    => '',
			'question-4'  => '',
			'answer-4'    => '',
			'question-5'  => '',
			'answer-5'    => '',
			'question-6'  => '',
			'answer-6'    => '',
			'question-7'  => '',
			'answer-7'    => '',
			'question-8'  => '',
			'answer-8'    => '',
			'question-9'  => '',
			'answer-9'    => '',
			'question-10' => '',
			'answer-10'   => '',
			'question-11' => '',
			'answer-11'   => '',
			'question-12' => '',
			'answer-12'   => '',
			'question-13' => '',
			'answer-13'   => '',
			'question-14' => '',
			'answer-14'   => '',
			'question-15' => '',
			'answer-15'   => '',
		),
		$atts,
		'extrafaq'
	);

	ob_start();
	?>

	<?php if ( 'yes' === $atts['schema'] ) { ?>
		<?php } ?>

		<div class="Faq <?= esc_html( $atts['is-wide'] === 'true' ? 'Post__m__negative':'' ); //@codingStandardsIgnoreLine ?>" itemscope itemtype="https://schema.org/FAQPage">
			<h2 id="faq"><?= esc_html( $atts['headline'] ); ?></h2>
			<?php
			for ( $i = 1; $i <= 15; ++$i ) {
				if ( $atts[ 'question-' . $i ] && $atts[ 'answer-' . $i ] ) {
					?>
					<div class="Faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
						<h3 itemprop="name"><?= esc_html( $atts['question-' . $i] ); ?></h3>
						<div class="Faq__outer-wrapper" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
							<div class="Faq__inner-wrapper" itemprop="text">
								<p><?= esc_html( $atts['answer-' . $i] ); ?></p>
							</div>
						</div>
					</div>
				<?php }
			} ?>
		</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'extrafaq', 'ms_extrafaq' );
