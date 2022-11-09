<?php
/**
 * Plugin Name:       QU Use Case
 * Description:       Use Cases block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Jozef Remen
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       usecase
*/

function qu_usecase_init() {
	$domain = 'qu-usecase/';
	$path   = get_parent_theme_file_path( '/lib/widgets/' . $domain );

	require_once $path . 'layouts/usecase-stats-item.php';

	// Resources for editor/admin part
	function usecase_editor_assets() {
		$domain   = 'qu-usecase/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		wp_enqueue_style(
			'qu_usecase_editor_style',
			$path_uri . 'build/qu_usecase_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_usecase_frontend_style',
			$path_uri . 'build/qu_usecase_frontend.css',
			array(),
			$version,
			false
		);

		wp_enqueue_script(
			'qu_usecase_stats_editor_script',
			$path_uri . 'build/qu_usecase_stats_edit.js',
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);

		wp_enqueue_script(
			'qu_usecase_editor_script',
			$path_uri . 'build/qu_usecase_edit.js',
			array( 'wp-blocks' ),
			$version,
			true
		);
	}

	// Resources for User visible part
	function usecase_assets() {
		$domain   = 'qu-usecase/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = THEME_VERSION;

		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/usecase', $id ) ) {
				wp_enqueue_style(
					'qu_usecase_frontend_style',
					$path_uri . 'build/qu_usecase_frontend.css',
					array(),
					$version,
					false
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'usecase_assets' );
	add_action( 'enqueue_block_editor_assets', 'usecase_editor_assets' );

	function render_usecase_stats_item( $attr ) {
		return usecase_stats_item( $attr );
	}

	register_block_type(
		'qu/usecasestats',
		array(
			'qu_usecase_editor_style'        => 'qu_usecase_editor_style',
			'qu_usecase_editor_script'       => 'qu_usecase_editor_script',
			'qu_usecase_stats_editor_script' => 'qu_usecase_stats_editor_script',
			'qu_usecase_style'               => 'qu_usecase_frontend_style',
			'render_callback'                => 'render_usecase_stats_item',
			'attributes'                     => array(
				'usecaseId'           => array(
					'type' => 'string',
				),
				'usecaseStatsId'      => array(
					'type' => 'string',
				),
				'usecaseStatsValue'   => array(
					'type'    => 'string',
					'default' => '15%',
				),
				'usecaseStatsTitle'   => array(
					'type'    => 'string',
					'default' => '15%',
				),
				'usecaseStatsContent' => array(
					'type'    => 'string',
					'default' => '',
				),
			),
		),
	);

	function render_usecase( $attr, $content ) {
		$pagetitle = preg_replace( '/\^(.+?)\^/i', '<span class="highlight-gradient">$1</span>', $attr['usecaseTitle'] );

		return '<div>
								<h1 itemprop="name">' . $pagetitle . '</h1>
								<h3 class="Post__subtitle">' . $attr['usecaseSubtitle'] . '</h3>
								<div>' . apply_filters( 'the_content', $content ) . '</div>
								<h2 class="Post__sectiontitle"><span>' . get_the_title() . ' ' . __( 'company location', 'use-case' ) . '</span></h2>
								<div class="qu-UseCase__map">' . $attr['usecaseMap'] . '</div>
						</div>';
	}

	register_block_type(
		'qu/usecase',
		array(
			'qu_usecase_editor_style'        => 'qu_usecase_editor_style',
			'qu_usecase_editor_script'       => 'qu_usecase_editor_script',
			'qu_usecase_stats_editor_script' => 'qu_usecase_stats_editor_script',
			'qu_usecase_style'               => 'qu_usecase_frontend_style',
			'render_callback'                => 'render_usecase',
			'attributes'                     => array(
				'usecaseId'       => array(
					'type' => 'string',
				),
				'usecaseTitle'    => array(
					'type'    => 'string',
					'default' => 'Use case title',
				),
				'usecaseSubtitle' => array(
					'type'    => 'string',
					'default' => 'Use case subtitle',
				),
				'usecaseMap'      => array(
					'type'    => 'string',
					'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2661.540344671987!2d17.128980316353633!3d48.15766627922503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c893556b5f817%3A0xe9985321b47c6832!2sMileti%C4%8Dova%20550%2F1%2C%20821%2008%20Bratislava!5e0!3m2!1sen!2ssk!4v1657800940668!5m2!1sen!2ssk" width="600" height="450" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe> ',
				),
			),
		),
	);
}


add_action( 'init', 'qu_usecase_init' );
