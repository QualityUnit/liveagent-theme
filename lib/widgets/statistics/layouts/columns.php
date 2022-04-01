<?php 
function columns( $attr ) {
	$path = get_template_directory() . '/lib/widgets/statistics/';
	require_once $path . 'layouts/block.php';

	return '
		<div class="Post__m__negative Statistics__columns">' .
			block( 'block1', $attr, '0' ) .
			block( 'block2', $attr, '1' ) .
			block( 'block3', $attr, '2' ) .
		'</div>
	';
}
