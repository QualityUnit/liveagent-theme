<?php

function pros_cons( $editor_avg, $meta ) {
	$pros = $meta->pros;
	$cons = $meta->cons;

	return '
	<div class="Reviews__rating editor" itemprop="review" itemscope itemtype="https://schema.org/Review">
		<div class="Reviews__rating--count mb-s">' . __( "Editor's Rating", 'reviews' ) . '</div>
		<div class="flex flex-align-center">
			<span class="Reviews__rating--rating mr-s-tablet-landscape" itemprop="ratingValue">' . $editor_avg . '</span>
			<div class="Reviews__rating--stars">
				<div class="Reviews__rating--stars__fill" 
				style="width:' . ( $editor_avg / 5 * 103 ) . '%"></div>
			</div>
		</div>
	</div
		' .
		( ! empty( $pros ) || ! empty( $cons ) ? '
	<div class="wp-block-columns">' .
		( ! empty( $pros ) ?
		'<div class="wp-block-column checklist checklist--pros">
			<h4>' . __( 'Pros', 'reviews' ) . '</h4>
			<ul itemprop="positiveNotes" itemtype="https://schema.org/ItemList" itemscope>' . preg_replace( '/(.+?)(\n|$)/', '<li itemprop="itemListElement" itemtype="https://schema.org/ListItem" itemscope>
			<meta itemprop="name" content="$1" />
			$1
			</li>', $pros ) . '</ul>
		</div>' 
		: ''
		) .
		( ! empty( $cons ) ?
			'<div class="wp-block-column checklist checklist--cons">
				<h4>' . __( 'Cons', 'reviews' ) . '</h4>
				<ul itemprop="negativeNotes" itemtype="https://schema.org/ItemList" itemscope>' . preg_replace( "/(.+?)(\n|$)/", '<li itemprop="itemListElement" itemtype="https://schema.org/ListItem" itemscope>
				<meta itemprop="name" content="$1" />
				$1
				</li>', $cons ) . '</ul>
			</div>'
			: ''
		) . '
	</div>' : null );
}
