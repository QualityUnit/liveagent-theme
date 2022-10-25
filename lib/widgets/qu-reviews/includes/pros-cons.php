<?php

function pros_cons( $meta ) {
	$pros = $meta->pros;
	$cons = $meta->cons;

	if ( ! empty( $pros ) || ! empty( $cons ) ) {
		return '
	<div class="wp-block-columns">' .
		( ! empty( $pros ) ?
		'<div class="wp-block-column checklist checklist--pros">
			<h4>' . __( 'Pros', 'reviews' ) . '</h4>
			<ul>' .
				preg_replace( "/(.+?)(\n|$)/", '<li>$1</li>', $pros ) . '
			</ul>
		</div>' 
		: ''
		) .
		( ! empty( $cons ) ?
			'<div class="wp-block-column checklist checklist--cons">
				<h4>' . __( 'Cons', 'reviews' ) . '</h4>
				<ul>' .
					preg_replace( "/(.+?)(\n|$)/", '<li>$1</li>', $cons ) . '
				</ul>
			</div>'
			: ''
		) . '
	</div>';
	}
}
