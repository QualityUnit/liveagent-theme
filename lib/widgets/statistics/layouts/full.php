<?php 
function full( $attr ) {
	$path = get_template_directory() . '/lib/widgets/statistics/';

	require_once $path . 'layouts/block-wide.php';
	require_once $path . 'layouts/columns.php';

	return block_wide( $attr ) . columns( $attr );
}
