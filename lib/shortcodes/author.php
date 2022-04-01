<?php

function ms_author( $atts ) {
	$atts = shortcode_atts(
		array(
			'photo'       => '',
			'name'        => '',
			'description' => '',
		),
		$atts,
		'author'
	);
	ob_start();
	?>

	<div class="BlogPost__co-author">
		<div class="BlogPost__co-author__image">
			<img src="<?= esc_url( $atts['photo'] ); ?>" alt="<?= esc_attr( $atts['name'] ); ?>">
		</div>
		<div class="BlogPost__co-author__content">
			<p class="BlogPost__co-author__content__title"><?php _e( 'Guest Post Author', 'ms' ); ?></p>
			<p class="BlogPost__co-author__content__name"><?= esc_html( $atts['name'] ); ?></p>
			<p class="BlogPost__co-author__content__description"><?= esc_html( $atts['description'] ); ?></p>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'author', 'ms_author' );
