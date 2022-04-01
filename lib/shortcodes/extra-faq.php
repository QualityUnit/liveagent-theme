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
		),
		$atts,
		'extrafaq'
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
					<?php if ( $atts['question-1'] ) { ?>
					{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-1'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-1'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-2'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-2'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-2'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-3'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-3'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-3'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-4'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-4'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-4'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-5'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-5'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-5'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-6'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-6'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-6'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-7'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-7'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-7'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-8'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-8'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-8'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-9'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-9'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-9'] ); ?>"
						}
					}
					<?php } ?>
					<?php if ( $atts['question-10'] ) { ?>
					,{
						"@type": "Question",
						"name": "<?= esc_attr( $atts['question-10'] ); ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?= esc_attr( $atts['answer-10'] ); ?>"
						}
					}
					<?php } ?>
				]
			}
		</script>
		</div>
		<?php } ?>

		<div class="ExtraFaq <?= esc_html( $atts['is-wide'] === 'true' ? 'Post__m__negative':'' ); //@codingStandardsIgnoreLine ?>">
			<h2 id="faq"><?= esc_html( $atts['headline'] ); ?></h2>

			<?php if ( $atts['question-1'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-1'] ); ?></h3>
					<p><?= esc_html( $atts['answer-1'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-2'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-2'] ); ?></h3>
					<p><?= esc_html( $atts['answer-2'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-3'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-3'] ); ?></h3>
					<p><?= esc_html( $atts['answer-3'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-4'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-4'] ); ?></h3>
					<p><?= esc_html( $atts['answer-4'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-5'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-5'] ); ?></h3>
					<p><?= esc_html( $atts['answer-5'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-6'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-6'] ); ?></h3>
					<p><?= esc_html( $atts['answer-6'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-7'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-7'] ); ?></h3>
					<p><?= esc_html( $atts['answer-7'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-8'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-8'] ); ?></h3>
					<p><?= esc_html( $atts['answer-8'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-9'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-9'] ); ?></h3>
					<p><?= esc_html( $atts['answer-9'] ); ?></p>
				</div>
			<?php } ?>

			<?php if ( $atts['question-10'] ) { ?>
				<div class="ExtraFaq__item">
					<h3><?= esc_html( $atts['question-10'] ); ?></h3>
					<p><?= esc_html( $atts['answer-10'] ); ?></p>
				</div>
			<?php } ?>
		</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'extrafaq', 'ms_extrafaq' );
