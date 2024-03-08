<?php // @codingStandardsIgnoreLine
set_source( 'awards', 'pages/Category' );
set_source( 'awards', 'pages/awards' );
set_custom_source( 'awardsInfiniteScroll', 'js', array( 'app_js' ) );

$categories        = array_unique( get_categories( array( 'taxonomy' => 'ms_awards_years' ) ), SORT_REGULAR );
$page_header_title = __( 'Awards', 'ms' );
$page_header_text  = __( 'Learn more about the various awards and quality certificates won by LiveAgent during the course of the years.', 'ms' );
if ( is_tax( 'ms_awards_years' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text  = term_description();
endif;

$page_header_args = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_awards.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'text'   => $page_header_text,
);
?>

<div id="category" class="Category">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Awards__container">
		<?php

		$years = get_terms(
			array(
				'taxonomy' => 'ms_awards_years',
				'hide_empty' => true,
				'orderby' => 'name',
				'order' => 'DESC',
			)
		);

		if ( ! empty( $years ) ) {
			$newest_year = $years[0];

			$query_awards_posts = new WP_Query(
				array(
					'post_type' => 'ms_awards',
					'posts_per_page' => 9,
					'orderby' => 'date',
					'order' => 'DESC',
					'tax_query' => array(
						array(
							'taxonomy' => 'ms_awards_years',
							'field' => 'term_id',
							'terms' => $newest_year->term_id,
						),
					),
				)
			);

			?>
		<div data-year="<?= esc_attr( $newest_year->name ); ?>" class="Awards__container Archive__container Archive__container--boxes Archive__container--testimonials Archive__container--awards">
				<h3 class="Awards__container--year"><?= esc_html( $newest_year->name ); ?></h3>
				<ul class="Awards__content Archive__container__content">
			<?php
			while ( $query_awards_posts->have_posts() ) :
					$query_awards_posts->the_post();
				?>

					<li <?php post_class( 'Awards__item Archive__container__content__item' ); ?>>
						<article>
							<div class="Awards__item--thumbnail">
								<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_awards_mb_awards_url', true ) ); ?>" target="_blank" rel="nofollow noopener"><?php the_post_thumbnail( 'box_archive_thumbnail' ); ?></a>
							</div>

							<div class="Awards__item--text">
								<h3><a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_awards_mb_awards_url', true ) ); ?>" target="_blank" rel="nofollow noopener"><?php the_title(); ?></a></h3>
								<p><?= esc_html( preg_replace( '/(20\d{2})/', '$1, ', get_the_excerpt() ) ); ?></p>
							</div>
						</article>
					</li>

				<?php endwhile; ?>
				<?php
				wp_reset_postdata();
		}
		?>
		</ul>
	</div>
</div>
	<div class="Awards__items__loading invisible"><?php _e( 'Loading', 'ms' ); ?><span>.</span><span>.</span><span>.</span></div>
</div>
