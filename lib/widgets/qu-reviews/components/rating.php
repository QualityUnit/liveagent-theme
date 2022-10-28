<?php
require_once __DIR__ . '/progress-bar.php'; 

function rating( $editor_avg, $layout, $meta ) {
	$rating        = $meta->rating;
	$reviews_count = $meta->reviews_count;
	$stars         = $rating / 5 * 103.3;

	$first  = $meta->first_rating_value;
	$second = $meta->second_rating_value;
	$third  = $meta->third_rating_value;

	$colors = array( '#FFB928', '#48C6CE', '#FF492B' );

	$output = '';

	return '<div class="Reviews__rating">
	<div class="flex flex-align-center">
		<span class="Reviews__rating--rating mr-s">' . $rating . '</span>
		<div class="Reviews__rating--stars">
			<div class="Reviews__rating--stars__fill"
				style="width: ' . $stars . '%"></div>
		</div>
	</div>
		<div class="Reviews__rating--count">' . $reviews_count . ' ' . __( 'reviews', 'reviews' ) . '</div>
	</div>' .
	
	( ( 'editorrating' === $layout )
		? '
		<div class="Reviews__rating editor">
			<div class="Reviews__rating--count mb-s">' . __( "Editor's Rating", 'reviews' ) . '</div>
			<div class="flex flex-align-center">
				<span class="Reviews__rating--rating mr-s-tablet-landscape">' . $editor_avg . '</span>
				<div class="Reviews__rating--stars">
					<div class="Reviews__rating--stars__fill" 
					style="width:' . ( $editor_avg / 5 * 103.3 ) . '%"></div>
				</div>
			</div>

			<div class="Reviews__rating--progress">' .
					progressbar( $meta->first_rating, $first, $colors[0] ) .
					progressbar( $meta->second_rating, $second, $colors[1] ) .
					progressbar( $meta->third_rating, $third, $colors[2] ) . '
			</div>
		</div>'
		: '' );
}
