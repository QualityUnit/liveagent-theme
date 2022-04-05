<?php
/**
 * Plugin Name:       QU Expert Note
 * Description:       Expert's Note block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Jozef Remen
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       expertnote
*/


function qu_expertnote_init() {
	$domain = 'qu-expertnote/';
	$path   = get_parent_theme_file_path( '/lib/widgets/' . $domain );
	
	// Resources for editor/admin part
	function expertnote_editor_assets() {
		$domain   = 'qu-expertnote/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = $_ENV['THEME_VERSION'];

		wp_enqueue_style(
			'qu_expertnote_editor_style',
			$path_uri . 'build/qu_expertnote_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_expertnote_frontend_style',
			$path_uri . 'build/qu_expertnote_frontend.css',
			array(),
			$version,
			false 
		);

		wp_enqueue_script(
			'qu_expertnote_editor_script',
			$path_uri . 'build/qu_expertnote_edit.js',
			array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);
	}

	// Resources for User visible part
	function expertnote_assets() {
		$domain   = 'qu-expertnote/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = $_ENV['THEME_VERSION'];
		
		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/expertnote', $id ) ) {
				wp_enqueue_style(
					'qu_expertnote_frontend_style',
					$path_uri . 'build/qu_expertnote_frontend.css',
					array(),
					$version,
					false 
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'expertnote_assets' );
	add_action( 'enqueue_block_editor_assets', 'expertnote_editor_assets' );


	function render_expertnote( $attr ) {
		return '
			<div class="qu-expertNote" itemscope itemtype="https://schema.org/Claim">
				<div class="qu-expertNote__top">
					<strong class="qu-expertNote__note">' . esc_html( $attr['expertNote'] ) . '</strong>' . 
					( ! empty( $attr['expertId'] ) 
					? '
					<div class="qu-expertNote__expert" itemscope itemprop="author" itemtype="https://schema.org/Person">
						<div class="qu-expertNote__expert--image">
						<meta itemprop="image" content="' . esc_url( get_the_post_thumbnail_url( $attr['expertId'], 'logo_thumbnail' ) ) . '"></meta>
							' . get_the_post_thumbnail( $attr['expertId'], 'logo_thumbnail' ) . // @codingStandardsIgnoreLine
							'
						</div>
						<div class="qu-expertNote__expert--info">
							<p class="qu-expertNote__expert--name" itemprop="name">' . esc_html( get_the_title( $attr['expertId'] ) ) . '</p>
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
		'qu/expertnote',
		array(
			'qu_expertnote_editor_style'  => 'qu_expertnote_editor_style',
			'qu_expertnote_editor_script' => 'qu_expertnote_editor_script',
			'qu_expertnote_style'         => 'qu_expertnote_frontend_style',
			'render_callback'             => 'render_expertnote',
			'attributes'                  => array(
				'expertId'       => array(
					'type'    => 'string',
					'default' => '3647',
				),
				'expertPosition' => array(
					'type'    => 'string',
					'default' => '',
				),
				'expertNote'     => array(
					'type'    => 'string',
					'default' => "Expert's note",
				),
				'header'         => array(
					'type'    => 'string',
					'default' => 'Enter title here…',
				),
				'content'        => array(
					'type'    => 'string',
					'default' => '',
				),
			), 
		),
	);
}


add_action( 'init', 'qu_expertnote_init' );

