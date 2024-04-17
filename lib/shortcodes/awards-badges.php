<?php

function ms_awards_badges() {
	ob_start();

	$img_bg = get_template_directory_uri() . '/assets/images/bg_glassy.jpg';
	?>

	<section class="block-badges">
		<div class="block-badges__bg" style="background-image: url(<?= esc_url( $img_bg ); ?>)">
			<div class="block-badges__wrap">
				<div class="block-badges__content">
					<h5 class="block-badges__subtitle">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/Awards.svg" alt="<?php _e( 'Awards', 'ms' ); ?>">
					</h5>
					<h2 class="block-badges__title h2 larger">
						<?php _e( 'Happy customers are <span class="highlight">the best</span> customers', 'ms' ); ?>
					</h2>
					<p>
						<?php _e( 'We offer concierge migration services from most of the popular help desk solutions.', 'ms' ); ?>
					</p>
					<p>
						<a href="<?= esc_url( __( '/awards/', 'ms' ) ); ?>" class="Button Button--full"><span><?php _e( 'View more' ); ?></span></a>
					</p>
				</div>
				<div class="award-badges">
					<?php
					foreach ( get_awards( 6 ) as $award_id ) {
						?>
						<div data-test="<?= esc_attr( $award_id ); ?>" style="background-image: url(<?= esc_attr( get_the_post_thumbnail_url( $award_id, 'box_archive_thumbnail' ) ); ?>)" alt="<?php _e( 'Badges', 'ms' ); ?>"></div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</section>

	<?php
	set_custom_source( 'shortcodes/BlockBadges' );
	return ob_get_clean();
}
add_shortcode( 'awards-badges', 'ms_awards_badges' );
