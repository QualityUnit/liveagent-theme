<?php

function ms_similarsources() {
	ob_start();
	?>

	<ul>
	<?php
	$current_path = str_replace( home_url(), '', get_permalink() );

	// @codingStandardsIgnoreLine
	$file = fopen( get_template_directory_uri() . '/outputs-20220516.csv', 'r' );

	if ( false !== $file ) {
		// @codingStandardsIgnoreLine
		while ( ( $data = fgetcsv( $file, 4800, ';' ) ) !== false ) {
			if ( $data[0] === $current_path ) {
				$urls = array();

				if ( $data[1] !== $current_path ) {
					if ( ! in_array( $data[1], $urls, true ) ) {
						array_push( $urls, $data[1], $data[2], $data[3] );
					}
				}

				if ( $data[4] !== $current_path ) {
					if ( ! in_array( $data[4], $urls, true ) ) {
						array_push( $urls, $data[4], $data[5], $data[6] );
					}
				}

				if ( $data[7] !== $current_path ) {
					if ( ! in_array( $data[7], $urls, true ) ) {
						array_push( $urls, $data[7], $data[8], $data[9] );
					}
				}

				if ( $data[10] !== $current_path ) {
					if ( ! in_array( $data[10], $urls, true ) ) {
						array_push( $urls, $data[10], $data[11], $data[12] );
					}
				}

				if ( $data[13] !== $current_path ) {
					if ( ! in_array( $data[13], $urls, true ) ) {
						array_push( $urls, $data[13], $data[14], $data[15] );
					}
				}

				if ( $data[16] !== $current_path ) {
					if ( ! in_array( $data[16], $urls, true ) ) {
						array_push( $urls, $data[16], $data[17], $data[18] );
					}
				}

				if ( $data[19] !== $current_path ) {
					if ( ! in_array( $data[19], $urls, true ) ) {
						array_push( $urls, $data[19], $data[20], $data[21] );
					}
				}

				if ( $data[22] !== $current_path ) {
					if ( ! in_array( $data[22], $urls, true ) ) {
						array_push( $urls, $data[22], $data[23], $data[24] );
					}
				}

				if ( array_key_exists( 0, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[0] ) . '" title="' . esc_attr( $urls[2] ) . '">' . esc_html( $urls[1] ) . '</a></li>';
				}

				if ( array_key_exists( 3, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[3] ) . '" title="' . esc_attr( $urls[5] ) . '">' . esc_html( $urls[4] ) . '</a></li>';
				}

				if ( array_key_exists( 6, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[6] ) . '" title="' . esc_attr( $urls[8] ) . '">' . esc_html( $urls[7] ) . '</a></li>';
				}

				if ( array_key_exists( 9, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[9] ) . '" title="' . esc_attr( $urls[11] ) . '">' . esc_html( $urls[10] ) . '</a></li>';
				}

				if ( array_key_exists( 12, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[12] ) . '" title="' . esc_attr( $urls[14] ) . '">' . esc_html( $urls[13] ) . '</a></li>';
				}

				if ( array_key_exists( 15, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[15] ) . '" title="' . esc_attr( $urls[17] ) . '">' . esc_html( $urls[16] ) . '</a></li>';
				}

				if ( array_key_exists( 18, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[18] ) . '" title="' . esc_attr( $urls[20] ) . '">' . esc_html( $urls[19] ) . '</a></li>';
				}

				if ( array_key_exists( 21, $urls ) !== 0 ) {
					echo '<li><a href="' . esc_url( $urls[21] ) . '" title="' . esc_attr( $urls[23] ) . '">' . esc_html( $urls[22] ) . '</a></li>';
				}
			}
		}

		fclose( $file );
	}
	?>
	</ul>

	<?php
	return ob_get_clean();
}
add_shortcode( 'similarsources', 'ms_similarsources' );
