<?php

function urlslab_display_related_resources() {
	// do_shortcode for related resources
	$related_resources = do_shortcode( '[urlslab-related-resources url="' . get_the_permalink() . '" related-count="4" show-image="true" show-summary="true"]' );

	if ( ! empty( $related_resources ) ) :
		?>
		<div class="Post__content__resources">
			<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>
			<div class="SimilarSources">
				<?= wp_kses_post( $related_resources ); ?>
			</div>
		</div>
		<?php
	endif;
}
