<?php
require_once __DIR__ . '/progress-bar.php'; 

function rating( $layout, $meta ) {
	$rating        = $meta->rating;
	$reviews_count = $meta->reviews_count;
	$stars         = $rating / 5 * 100;

	$first  = $meta->first_rating_value;
	$second = $meta->second_rating_value;
	$third  = $meta->third_rating_value;

	$average = 1;

	if ( ! empty( $first ) && ! empty( $second ) && ! empty( $third ) ) {
		$average = round( ( $first + $second + $third ) / 3, 1 );
	}

	$colors = array( '#FFB928', '#48C6CE', '#FF492B' );

	$output = '';

	if ( 'editorrating' !== $layout ) {
		return '<div class="Reviews__rating">
			<span class="Reviews__rating--rating mr-s-tablet-landscape">' . $rating . '</span>
			<div class="Reviews__rating--stars">
				<div class="Reviews__rating--stars__fill"
					style="width: ' . $stars . '%"></div>
			</div>
			<div class="Reviews__rating--count">' . $reviews_count . ' ' . __( 'reviews', 'reviews' ) . '</div>
		</div>';
	}
	
	if ( 'editorrating' === $layout ) {
		return '
		<div class="Reviews__rating editor">
			<div class="Reviews__rating--count">' . __( "Editor's Rating", 'reviews' ) . '</div>
			<span class="Reviews__rating--rating mr-s-tablet-landscape">' . $average . '</span>
			<div class="Reviews__rating--stars">
				<div class="Reviews__rating--stars__fill" 
				style="width:' . ( $average / 5 * 100 ) . '%"></div>
			</div>

			<div class="Reviews__rating--progress">' .
					progressbar( $meta->first_rating, $first, $colors[0] );
					progressbar( $meta->second_rating, $second, $colors[1] );
					progressbar( $meta->third_rating, $third, $colors[2] ) . '
			</div>
		</div>';
	}
}
