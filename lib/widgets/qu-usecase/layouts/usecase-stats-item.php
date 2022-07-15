<?php 
function usecase_stats_item( $attr ) {
	$value   = $attr['usecaseStatsValue'];
	$title   = $attr['usecaseStatsTitle'];
	$content = $attr['usecaseStatsContent'];

	return '
		<div class="qu-UseCase__stats">
			<div class="qu-UseCase__stats--value highlight-gradient">' . $attr['usecaseStatsValue'] . '</div>
			<h4 class="qu-UseCase__stats--title">' . $attr['usecaseStatsTitle'] . '</h4>
			<p>' . $attr['usecaseStatsContent'] . '</p>'
	. '</div>';
}
