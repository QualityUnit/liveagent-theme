<?php
/**
 * Plugin Name:       Statistics
 * Description:       Statisticks block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       statistics
*/


function statistics_block_init() {
	$path = get_template_directory() . '/lib/widgets/statistics/';

	require_once $path . 'layouts/block.php';
	require_once $path . 'layouts/block-wide.php';
	require_once $path . 'layouts/columns.php';
	require_once $path . 'layouts/full.php';

	function statistics_editor_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/statistics/';
		$version  = THEME_VERSION;
		$js_data  = array(
			'url' => $path_uri . 'images',
		);

		wp_enqueue_script(
			'qu_statistics_block_editor_script',
			$path_uri . 'build/index.js',
			array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data' ),
			$version,
			true
		);

		wp_add_inline_script(
			'qu_statistics_block_editor_script',
			'const images = ' . wp_json_encode( $js_data ),
			'before'
		);

		wp_enqueue_style(
			'qu_statistics_block_editor_style',
			$path_uri . 'build/index.css',
			array( 'wp-edit-blocks' ),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_statistics_block_frontend_style',
			$path_uri . 'build/style-index.css',
			array(),
			$version,
			false
		);
	}

	add_action( 'enqueue_block_editor_assets', 'statistics_editor_assets' );

	function statistics_assets() {
		$path_uri = get_template_directory_uri() . '/lib/widgets/statistics/';
		$version  = THEME_VERSION;
		wp_enqueue_script( 'research_post', get_template_directory_uri() . '/assets/dist/research_post' . wpenv() . '.js', false, THEME_VERSION, true );

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/statistics', $id ) ) {

				wp_enqueue_style(
					'qu_statistics_block_frontend_style',
					$path_uri . 'build/style-index.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'statistics_assets' );

	function render_statistics( $attr ) {
		$layout = $attr['layout'];
		if ( $layout === 'full' ) {/*@codingStandardsIgnoreLine */
			return full( $attr );
		};
		if ( $layout === 'columns' ) {/*@codingStandardsIgnoreLine */
			return columns( $attr );
		};
		if ( $layout === 'single' ) {/*@codingStandardsIgnoreLine */
			return block( 'block1', $attr );
		};
		if ( $layout === 'singleWide' ) {/*@codingStandardsIgnoreLine */
			return block_wide( $attr );
		};
	}

	register_block_type(
		'qu/statistics',
		array(
			'qu_statistics_editor_script' => 'qu_statistics_block_editor_script',
			'copy_button_script'          => 'copy_button_script',
			'qu_statistics_editor_style'  => 'qu_statistics_block_editor_style',
			'qu_statistics_style'         => 'qu_statistics_block_frontend_style',
			'render_callback'             => 'render_statistics',
			'attributes'                  => array(
				'statisticsId' => array(
					'type' => 'string',
				),
				'blockWide'    => array(
					'type'    => 'object',
					'default' => array(
						'header'     => 'Scripted responses',
						'text'       => 'of consumers say speed, convenience, knowledgeable help, and friendly service are the most important elements of a positive customer experience.',
						'value'      => '80%',
						'sourceData' => 'Nicereply',
						'urlText'    => 'See more IVR statistics',
						'url'        => '',
						'urlInTab'   => false,
						'imageId'    => false,
						'imageUrl'   => '',
					),
				),
				'block1'       => array(
					'type'    => 'object',
					'default' => array(
						'text'       => 'The average net FCR for service desks worldwide is about',
						'value'      => '74%',
						'sourceData' => 'Metric Net',
						'urlText'    => 'See more',
						'url'        => '',
						'urlInTab'   => false,
					),
				),
				'block2'       => array(
					'type'    => 'object',
					'default' => array(
						'text'       => 'The average global CSAT benchmark that includes all industries is',
						'value'      => '86%',
						'sourceData' => 'Geckoboard',
						'urlText'    => 'See more',
						'url'        => '',
						'urlInTab'   => false,
					),
				),
				'block3'       => array(
					'type'    => 'object',
					'default' => array(
						'text'       => 'The average annual turnover rate for a customer service representative (CSR) is',
						'value'      => '29%',
						'sourceData' => 'LinkedIn',
						'urlText'    => 'See more',
						'url'        => '',
						'urlInTab'   => false,
					),
				),
				'layout'       => array(
					'type'    => 'string',
					'default' => 'full',
				),
				'align'        => array(
					'type'    => 'string',
					'default' => '',
				),
				'style'        => array(
					'type'    => 'array',
					'default' => array(
						'Statistics--block__negative has-bg',
						'',
						'Statistics--block__grey',
					),
				),
				'activeStyle'  => array(
					'type'    => 'string',
					'default' => 'Statistics--block__negative has-bg',
				),
				'color'        => array(
					'type'    => 'string',
					'default' => '1',
				),
			),
		)
	);
}

add_action( 'init', 'statistics_block_init' );
