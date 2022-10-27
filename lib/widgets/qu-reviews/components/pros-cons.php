<?php

function pros_cons( $editor_avg, $meta ) {
	$pros = $meta->pros;
	$cons = $meta->cons;

	return '
	<div class="flex flex-align-center">
		<div class="Reviews__rating--count">' . __( "Editor's Rating", 'reviews' ) . ' ' . $editor_avg . '</div>
		<div class="Reviews__rating--stars">
			<div class="Reviews__rating--stars__fill" 
			style="width:' . ( $editor_avg / 5 * 100 ) . '%"></div>
		</div>
	</div>
		' .
		( ! empty( $pros ) || ! empty( $cons ) ? '
	<div class="wp-block-columns">' .
		( ! empty( $pros ) ?
		'<div class="wp-block-column checklist checklist--pros">
			<h4>' . __( 'Pros', 'reviews' ) . '</h4>
			<ul>' . preg_replace( '/(.+?)(\n|$)/', '<li>$1</li>', $pros ) . '</ul>
		</div>' 
		: ''
		) .
		( ! empty( $cons ) ?
			'<div class="wp-block-column checklist checklist--cons">
				<h4>' . __( 'Cons', 'reviews' ) . '</h4>
				<ul>' . preg_replace( "/(.+?)(\n|$)/", '<li>$1</li>', $cons ) . '</ul>
			</div>'
			: ''
		) . '
	</div>' : null );
}
