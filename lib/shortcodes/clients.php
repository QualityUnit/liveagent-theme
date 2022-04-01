<?php

function ms_clients( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts' => '6',
		),
		$atts,
		'clients'
	);

	ob_start();
	?>

	<div class="Clients">
	<?php
	$query_clients_posts = new WP_Query(
		array(
			'post_type'      => 'ms_clients',
			'posts_per_page' => $atts['posts'],
		)
	);

	if ( $query_clients_posts->have_posts() ) :
		while ( $query_clients_posts->have_posts() ) :
			$query_clients_posts->the_post();
			?>

		<div class="Clients__item">
			<?php the_post_thumbnail( 'archive_small_thumbnail' ); ?>
		</div>

	<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'clients', 'ms_clients' );
