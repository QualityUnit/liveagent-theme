<?php

function ms_expert_note( $atts ) {
		$shortcode_text = do_shortcode( '[urlslab-generator id="1"]' );
		$atts           = shortcode_atts(
			array(
				'photo'    => get_template_directory_uri() . '/assets/images/andrej_saxon_new.png?ver=' . THEME_VERSION,
				'name'     => 'Andrej Saxon',
				'position' => 'Sales manager',
			),
			$atts,
			'expert-note'
		);
		ob_start();
	if ( ! empty( $shortcode_text ) ) {
		?>

	<div class="ExpertNote" itemprop="comment" itemscope itemtype="https://schema.org/Comment">
		<h3 class="ExpertNote__title"><img class="ExpertNote__title--badge" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/expert_badge.svg" alt="<?php _e( 'Expert badge', 'ms' ); ?>" /><?php _e( 'Expert’s note', 'ms' ); ?></h3>
		<p class="ExpertNote__text" itemprop="text"><?= $shortcode_text; //@codingStandardsIgnoreLine ?></p>

		<div class="ExpertNote__agent" itemprop="author" itemscope itemtype="https://schema.org/Person">
			<div class="ExpertNote__agent--inn">
				<div class="ExpertNote__agent--info">
					<span class="ExpertNote__agent--name" itemprop="name"><?= esc_html( $atts['name'] ); ?></span>
					<strong class="ExpertNote__agent--position" itemprop="jobTitle"><?= esc_html( $atts['position'] ); ?></strong>
				</div>
				<img class="ExpertNote__agent--image" itemprop="image" src="<?= esc_url( $atts['photo'] ); ?>" alt="<?= esc_attr( $atts['name'] ); ?>" >
			</div>
		</div>
	</div>

		<?php
	}
	set_custom_source( 'shortcodes/ExpertNote', 'css' );
	return ob_get_clean();
}
add_shortcode( 'expert-note', 'ms_expert_note' );
