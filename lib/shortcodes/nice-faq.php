<?php

function ms_nicefaq( $atts ) {
	$atts = shortcode_atts(
		array(
			'schema'      => 'yes',
			'title1'      => '',
			'headline'    => '',
			'subheadline' => '',
			'question1'   => '',
			'answer1'     => '',
			'title2'      => '',
			'question2'   => '',
			'answer2'     => '',
			'title3'      => '',
			'question3'   => '',
			'answer3'     => '',
			'title4'      => '',
			'question4'   => '',
			'answer4'     => '',
			'title5'      => '',
			'question5'   => '',
			'answer5'     => '',
			'title6'      => '',
			'question6'   => '',
			'answer6'     => '',
			'title7'      => '',
			'question7'   => '',
			'answer7'     => '',
			'title8'      => '',
			'question8'   => '',
			'answer8'     => '',
			'title9'      => '',
			'question9'   => '',
			'answer9'     => '',
			'title10'     => '',
			'question10'  => '',
			'answer10'    => '',
			'title11'     => '',
			'question11'  => '',
			'answer11'    => '',
			'title12'     => '',
			'question12'  => '',
			'answer12'    => '',
			'title13'     => '',
			'question13'  => '',
			'answer13'    => '',
			'title14'     => '',
			'question14'  => '',
			'answer14'    => '',
			'title15'     => '',
			'question15'  => '',
			'answer15'    => '',
		),
		$atts,
		'nicefaq'
	);

	ob_start();
	?>

	<?php if ( 'yes' === $atts['schema'] ) { ?>
		<?php } ?>

		<div class="Faq" itemscope itemtype="https://schema.org/FAQPage">
			<h2 id="faq">
			<?php
				$headline = esc_html( $atts['headline'] );
				$words    = explode( ' ', $headline );
				$counter  = 0;
			foreach ( $words as $word ) {
				if ( 0 === $counter ) {
					echo '<span class="highlight">' . esc_html( $words[0] ) . '</span>';
				} else {
					echo ' ';
					echo esc_html( $word );
				}
				$counter++;
			}
			echo '</h2>';
			if ( $atts['subheadline'] ) {
				?>
				<div class="subhead--wrapper">
					<p class="subhead"><?= esc_html( $atts['subheadline'] ); ?></p>
				</div>
				<?php
			} 
			for ( $i = 1; $i <= 15; ++$i ) {
				if ( $atts[ 'title' . $i ] && $atts[ 'question' . $i ] && $atts[ 'answer' . $i ] ) { 
					?>
					<div class="Faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
						<h3 itemprop="name"><?= esc_html( $atts[ 'question' . $i ] ); ?></h3>
						<div class="Faq__outer-wrapper" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
							<div class="Faq__inner-wrapper" itemprop="text">
								<p><?= esc_html( $atts[ 'answer' . $i ] ); ?></p>
							</div>
						</div>
					</div>
					<?php 
				}
			} 
			?>
		</div>

	<?php
	set_custom_source( 'components/NiceFaq' );
	set_custom_source( 'nicefaq', 'js' );

	return ob_get_clean();
}
add_shortcode( 'nicefaq', 'ms_nicefaq' );
