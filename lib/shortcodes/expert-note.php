<?php

function ms_expert_note() {
		$shortcode_text = do_shortcode( '[urlslab-generator id="1"]' );
		ob_start();
	if ( ! empty( $shortcode_text ) ) {
		?>

	<div class="ExpertNote" itemprop="comment" itemscope itemtype="https://schema.org/Comment">
		<h3 class="ExpertNote__title"><img class="ExpertNote__title--badge" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/expert_badge.svg" alt="<?php _e( 'Expert badge', 'ms' ); ?>" /><?php _e( 'Expert’s note', 'ms' ); ?></h3>
		<p class="ExpertNote__text" itemprop="text"><?= $shortcode_text; //@codingStandardsIgnoreLine ?></p>

		<div class="ExpertNote__agent" itemprop="author" itemscope itemtype="https://schema.org/Person">
			<div class="ExpertNote__agent--inn">
				<div class="ExpertNote__agent--info">
					<span class="ExpertNote__agent--name" itemprop="name"><?php _e( 'Andrej Saxon', 'ms' ); ?></span>
					<strong class="ExpertNote__agent--position" itemprop="jobTitle"><?php _e( 'Sales manager', 'ms' ); ?></strong>
				</div>
				<img class="ExpertNote__agent--image" itemprop="image" src="<?= esc_url( get_template_directory_uri() . '/assets/images/andrej_saxon_new.png?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Andrej Saxon', 'ms' ); ?>" >
			</div>
		</div>
	</div>

		<?php
	}
	return ob_get_clean();
}
set_custom_source( 'shortcodes/ExpertNote', 'css' );
add_shortcode( 'expert-note', 'ms_expert_note' );
