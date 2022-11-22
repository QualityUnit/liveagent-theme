<?php
/**
 * Plugin Name:       QU Reviews Widget
 * Description:       Reviews widget block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Jozef Remen
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       reviews
*/


function qu_reviews_init() {
	$domain = 'qu-reviews/';
	$path   = get_parent_theme_file_path( '/lib/widgets/' . $domain );

	// Resources for editor/admin part
	function reviews_editor_assets() {
		$domain   = 'qu-reviews/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		wp_enqueue_style(
			'qu_reviews_editor_style',
			$path_uri . 'build/qu_reviews_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_reviews_frontend_style',
			$path_uri . 'build/qu_reviews_frontend.css',
			array(),
			$version,
			false
		);

		wp_enqueue_script(
			'qu_reviews_editor_script',
			$path_uri . 'build/qu_reviews_edit.js',
			array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);
	}

	// Resources for User visible part
	function reviews_assets() {
		$domain   = 'qu-reviews/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/reviews', $id ) ) {
				wp_enqueue_style(
					'qu_reviews_frontend_style',
					$path_uri . 'build/qu_reviews_frontend.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'reviews_assets' );
	add_action( 'enqueue_block_editor_assets', 'reviews_editor_assets' );

	function review( $attr ) {
		$layout = $attr['layout'];
		$post   = '';

		if ( ! empty( $attr['reviewsSorted'] ) ) {
			foreach ( $attr['reviewsSorted'] as $order => $review ) {
				$number  = $order + 1;
				$review  = (object) $review;
				$url     = $review->link;
				$title   = str_replace( '^', '', $review->title['rendered'] );
				$excerpt = wp_trim_words( $review->excerpt['rendered'], 20 );
				$meta    = (object) $review->meta;

				$first  = $meta->first_rating_value;
				$second = $meta->second_rating_value;
				$third  = $meta->third_rating_value;

				$editor_average = round( ( $first + $second + $third ) / 3, 1 );
	
				require_once __DIR__ . '/components/rating.php';
				require_once __DIR__ . '/components/pricing.php';
				require_once __DIR__ . '/components/pros-cons.php';
				
				$post .= '<div class="qu-Reviews__post' . ' ' . ( 'editorrating' === $layout ? 'editor' : null ) . '" itemscope itemtype="https://schema.org/SoftwareApplication">
				<span itemprop="applicationCategory" content="BusinessApplication"><meta itemprop="name" content="BusinessApplication"></span>
					<a href="' . $url . '" title="' . $title . '" itemprop="url">
						<div class="qu-Reviews__post--inn">
							<span class="qu-Reviews__post--number mr-m-tablet">' . $number . '</span>
							<div class="qu-Reviews__post--main">
								<h3 class="qu-Reviews__post--title no-margin mb-s" itemprop="name">' . $title . '</h3>
								<div class="qu-Reviews__post--excerpt" itemprop="description">' . $excerpt . '</div>
							</div>' .
								rating( $editor_average, $layout, $meta ) . '
							<div class="qu-Reviews__post--arrow">
								<svg class="arrow">
									<use xlink:href="' . get_template_directory_uri() . '/assets/images/icons.svg#chevron-right"></use>
								</svg>
							</div>
						</div>' .
						( ! empty( $layout ) ?
						'<div class="qu-Reviews__post--data">' .
							( 'pricing' === $layout
								? pricing( $meta )
								: null
							) . ( 'proscons' === $layout
								? pros_cons( $editor_average, $meta )
								: null
							) . ( 'editorrating' === $layout
								? rating( $editor_average, $layout, $meta )
								: null
							) . '
						</div>'
						: '' ) . '
					</a>
			</div>';
			}
		}

		return $post;
	}

	function render_reviews( $attr ) {
		
		return '
			<div class="qu-Reviews Post__m__negative--mid" itemscope itemtype="https://schema.org/Product">' .
					review( $attr ) . '
			</div>
		';
		// @codingStandardsIgnoreEnd
	}

	register_block_type(
		'qu/reviews',
		array(
			'qu_reviews_editor_style'  => 'qu_reviews_editor_style',
			'qu_reviews_editor_script' => 'qu_reviews_editor_script',
			'qu_reviews_style'         => 'qu_reviews_frontend_style',
			'render_callback'          => 'render_reviews',
			'attributes'               => array(
				'categoryId'    => array(
					'type' => 'string',
				),
				'reviewsSorted' => array(
					'type' => 'array',
				),
				'layout'        => array(
					'type'    => 'string',
					'default' => '',
				),
				'maxReviews'    => array(
					'type'    => 'number',
					'default' => 10,
				),
			),
		),
	);
}


add_action( 'init', 'qu_reviews_init' );
