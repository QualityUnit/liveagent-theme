<?php // @codingStandardsIgnoreLine
	$query_glossary_posts = new WP_Query(
		array(
			'post_type'      => 'ms_reviews',
			// @codingStandardsIgnoreLine
			'posts_per_page' => 500,
			'orderby'        => 'date',
			'order'          => 'ASC',
			'tax_query'      => array( // @codingStandardsIgnoreLine
				array(
					'taxonomy' => 'ms_reviews_categories',
					'field'    => 'term_id',
					'terms'    => $subpage->term_id,
				),
			),
		)
	);
	while ( $query_glossary_posts->have_posts() ) :
		$query_glossary_posts->the_post();
		?>
		<div class="">
			<a href="<?php the_permalink(); ?>" title="<?= esc_attr( str_replace( '^', '', get_the_title() ) ) ?>">
				<h3>
				<?= esc_html( str_replace( '^', '', get_the_title() ) ); ?>
			</h3>
				<?php the_excerpt(); ?>
			</a>
		</div>
		<?php
	endwhile;
	wp_reset_postdata();
	?>
