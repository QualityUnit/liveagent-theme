<?php

function progressbar( $text, $rating, $color ) {
	return '
		<div class="progressBar__wrapper">
			<strong class="progressBar__desc">' . $text . '</strong>
			<div class="progressBar">
				<div class="progressBar__inn" style="background-color: ' . $color . '; width:' . $rating / 5 * 100 . '%"></div>
			</div>
			<strong class="progressBar__rating">' . $rating . '</strong>
		</div>';
}
