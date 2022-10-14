<?php // @codingStandardsIgnoreLine

function meta( $metabox_id ) {
	return get_post_meta( get_the_ID(), $metabox_id, true );
}

	$counter             = 0;
	$query_reviews_posts = new WP_Query(
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
	?>
<ul class="wrapper flex-direction-column Reviews__relatedReviews" data-sortingList="relatedReviews" data-sortedBy="">
<?php
while ( $query_reviews_posts->have_posts() ) :
	$query_reviews_posts->the_post();

	$first  = meta( 'first_rating_value' );
	$second = meta( 'second_rating_value' );
	$third  = meta( 'third_rating_value' );

	$average = 1;

	if ( ! empty( $first ) && ! empty( $second ) && ! empty( $third ) ) {
		$average = round( ( $first + $second + $third ) / 3, 1 );
	}

	$rating_update = new DateTime( meta( 'last_update' ) );
		
	?>
		<li class="Reviews__relatedReviews--post Reviews__relatedReviews--post__level2" data-id="<?= get_the_ID(); ?>" data-reviews="<?= esc_attr( meta( 'reviews_count' ) ? meta( 'reviews_count' ) : 0 ); ?>" data-rating="<?= esc_attr( meta( 'rating' ) ? meta( 'rating' ) : 1 ); ?>" data-ourrating="<?= esc_attr( $average ); ?>" data-updated="<?= esc_attr( $rating_update->format( 'Ymd' ) ); ?>">
			<a class="flex Reviews__relatedReviews--post__inn" href="<?= get_post()->post_name; // @codingStandardsIgnoreLine ?>" title="<?= esc_attr( str_replace( '^', '', get_the_title() ) ) ?>">
				<span class="Reviews__relatedReviews--post__number mr-xl-tablet" data-order><?= esc_html( ++$counter ); ?></span>
				<div class="Reviews__relatedReviews--post__main">
					<h3 class="Reviews__relatedReviews--post__title"><?= esc_html( str_replace( '^', '', get_the_title() ) ); ?></h3>
					<div class="Reviews__relatedReviews--post__excerpt"><?= esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></div>
				</div>
			<?php
				$rating_post = meta( 'rating' );
			if ( $rating_post || $average ) {
				?>
					<div class="Reviews__rating">
						<span class="Reviews__rating--rating mr-s-tablet-landscape"><?= esc_html( $rating_post ); ?></span>
						<div class="Reviews__rating--stars">
							<div class="Reviews__rating--stars__fill" 
							style="width:<?= esc_attr( ( $rating_post / 5 * 100 ) . '%' ); ?>"></div>
						</div>
						<div class="Reviews__rating--count"><?= esc_html( meta( 'reviews_count' ) . ' ' . __( 'reviews', 'reviews' ) ); ?></div>
					</div>
					<div class="Reviews__rating editor">
						<div class="Reviews__rating--avatar">
							<?= get_avatar( get_the_author_meta( 'ID' ), 220, 'mystery', get_the_author() ); ?>
						</div>
						<span class="Reviews__rating--rating mr-s-tablet-landscape"><?= esc_html( $average ); ?></span>
						<div class="Reviews__rating--stars">
							<div class="Reviews__rating--stars__fill" 
							style="width:<?= esc_attr( ( $average / 5 * 100 ) . '%' ); ?>"></div>
						</div>
						<div class="Reviews__rating--count"><?php _e( "Editor's overall Rating", 'reviews' ); ?></div>
					</div>
					<?php
			}
			?>
				<div class="Reviews__relatedReviews--post__arrow">
					<svg viewBox="0 0 13 22" fill="white" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.93934 0.93934C1.52513 0.353553 2.47487 0.353553 3.06066 0.93934L12.0339 9.91255C12.6197 10.4983 12.6197 11.4481 12.0339 12.0339L3.06066 21.0071C2.47487 21.5929 1.52513 21.5929 0.93934 21.0071C0.353553 20.4213 0.353553 19.4716 0.93934 18.8858L8.85189 10.9732L0.93934 3.06066C0.353553 2.47487 0.353553 1.52513 0.93934 0.93934Z" />
					</svg>
				</div>
			</a>
		</li>
		<?php
	endwhile;
	wp_reset_postdata();
?>
</ul>
