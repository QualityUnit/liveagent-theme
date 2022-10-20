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


	function render_reviews( $attr ) {
		return '
			<div class="qu-expertNote" itemscope itemtype="https://schema.org/Claim">
				<div class="qu-expertNote__top">
					<strong class="qu-expertNote__note">' . esc_html( $attr['expertNote'] ) . '</strong>' .
					( ! empty( $attr['reviewId'] )
					? '
					<div class="qu-expertNote__expert" itemscope itemprop="author" itemtype="https://schema.org/Person">
						<div class="qu-expertNote__expert--image">
						<meta itemprop="image" content="' . esc_url( get_the_post_thumbnail_url( $attr['reviewId'], 'logo_thumbnail' ) ) . '"></meta>
							' . get_the_post_thumbnail( $attr['reviewId'], 'logo_thumbnail' ) . // @codingStandardsIgnoreLine
							'
						</div>
						<div class="qu-expertNote__expert--info">
							<p class="qu-expertNote__expert--name" itemprop="name">' . esc_html( get_the_title( $attr['reviewId'] ) ) . '</p>
							<strong class="qu-expertNote__expert--position" itemprop="jobtitle">' . esc_html( $attr['expertPosition'] ) . '</strong>
						</div>
					</div>'
					: '' )
				. '
				</div>
				<h2 class="qu-expertNote__title" itemprop="headline">' . esc_html( $attr['header'] ) . '</h2>
				<div class="qu-expertNote__content" itemprop="text">' .
					$attr['content'] //@codingStandardsIgnoreLine
				. '</div>
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
				'reviewId' => array(
					'type'    => 'string',
					'default' => '3647',
				),
				'header'    => array(
					'type'    => 'string',
					'default' => 'Enter title here…',
				),
				'content'   => array(
					'type'    => 'string',
					'default' => '',
				),
			),
		),
	);
}


add_action( 'init', 'qu_reviews_init' );
