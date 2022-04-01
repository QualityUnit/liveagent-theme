<?php

function ms_nicefaq( $atts ) {
	$atts = shortcode_atts(
		array(
			'schema'     => 'yes',
			'title1'     => '',
			'question1'  => '',
			'answer1'    => '',
			'title2'     => '',
			'question2'  => '',
			'answer2'    => '',
			'title3'     => '',
			'question3'  => '',
			'answer3'    => '',
			'title4'     => '',
			'question4'  => '',
			'answer4'    => '',
			'title5'     => '',
			'question5'  => '',
			'answer5'    => '',
			'title6'     => '',
			'question6'  => '',
			'answer6'    => '',
			'title7'     => '',
			'question7'  => '',
			'answer7'    => '',
			'title8'     => '',
			'question8'  => '',
			'answer8'    => '',
			'title9'     => '',
			'question9'  => '',
			'answer9'    => '',
			'title10'    => '',
			'question10' => '',
			'answer10'   => '',
			'title11'    => '',
			'question11' => '',
			'answer11'   => '',
			'title12'    => '',
			'question12' => '',
			'answer12'   => '',
			'title13'    => '',
			'question13' => '',
			'answer13'   => '',
			'title14'    => '',
			'question14' => '',
			'answer14'   => '',
			'title15'    => '',
			'question15' => '',
			'answer15'   => '',
		),
		$atts,
		'nicefaq'
	);

	ob_start();
	?>

	<?php if ( 'yes' === $atts['schema'] ) { ?>
		<div class="hidden">
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "FAQPage",
				"mainEntity": [
					<?php 
					for ( $i = 1; $i <= 15; ++$i ) {
						if ( $atts[ 'question' . $i ] ) {
							?>
							<?= $i > 1 ? ',' : '' ?>{
						"@type": "Question",
						"name": "<?= esc_attr( $atts[ 'question' . $i ] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts[ 'answer' . $i ] ); ?>"
						}
					}
							<?php 
						}
					} 
					?>
				]
			}
		</script>
		</div>
		<?php } ?>

		<div class="NiceFaq">
			<div class="NiceFaq__main">
			<?php 
			for ( $i = 1; $i <= 15; ++$i ) {
				if ( $atts[ 'title' . $i ] && $atts[ 'question' . $i ] && $atts[ 'answer' . $i ] ) { 
					?>
						<div class="NiceFaq__item NiceFaq__item-<?= esc_html( $i . ( $i === 1 ? ' active' : '' ) ); // @codingStandardsIgnoreLine?>">
							<div class="NiceFaq__question">
								<div class="NiceFaq__item--person">
									<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/nicefaq_guy1.png" alt="FAQ person" />
								</div>
								<span><?= esc_html( $atts[ 'question' . $i ] ); ?></span>
							</div>
							<div class="NiceFaq__answer">
								<span><?= esc_html( $atts[ 'answer' . $i ] ); ?></span>
								<div class="NiceFaq__item--person">
									<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/nicefaq_guy2.png" alt="FAQ person" />
								</div>
							</div>
						</div>
					<?php 
				}
			} 
			?>
			</div>
			<div class="NiceFaq__sidebar">
			<ul class="NiceFaq__sidebar--items">
				<?php 
				for ( $i = 1; $i <= 15; ++$i ) {
					if ( $atts[ 'title' . $i ] && $atts[ 'question' . $i ] && $atts[ 'answer' . $i ] ) { 
						?>
						<li class="NiceFaq__sidebar--item <?= esc_html( $i === 1 ? 'active' : '' ); // @codingStandardsIgnoreLine?>" data-item="NiceFaq__item-<?= esc_html( $i ) ?>"><?= esc_html( $atts[ 'title' . $i ] ); ?></li>
						<?php 
					}
				} 
				?>
			</ul>
			</div>
		</div>

	<?php
	set_custom_source( 'components/NiceFaq' );
	set_custom_source( 'nicefaq', 'js' );

	if ( isset( $atts['question-9'] ) ) {
		set_custom_source( 'common/splide' );
		set_custom_source( 'splide', 'js' );
		set_custom_source( 'slider', 'js' );
	}
	return ob_get_clean();
}
add_shortcode( 'nicefaq', 'ms_nicefaq' );
