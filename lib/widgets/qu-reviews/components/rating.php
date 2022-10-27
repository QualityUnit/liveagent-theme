<?php
require_once __DIR__ . '/progress-bar.php'; 

function rating( $editor_avg, $layout, $meta ) {
	$rating        = $meta->rating;
	$reviews_count = $meta->reviews_count;
	$stars         = $rating / 5 * 100;

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
			<span class="Reviews__rating--rating mr-s-tablet-landscape">' . $editor_avg . '</span>
			<div class="Reviews__rating--stars">
				<div class="Reviews__rating--stars__fill" 
				style="width:' . ( $editor_avg / 5 * 100 ) . '%"></div>
			</div>

			<div class="Reviews__rating--progress">' .
					progressbar( $meta->first_rating, $first, $colors[0] );
					progressbar( $meta->second_rating, $second, $colors[1] );
					progressbar( $meta->third_rating, $third, $colors[2] ) . '
			</div>
		</div>';
	}
}
