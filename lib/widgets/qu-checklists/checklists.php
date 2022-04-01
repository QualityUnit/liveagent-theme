<?php
/**
 * Plugin Name:       QU Checklists
 * Description:       Checklists block for Gutenberg.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Jozef Remen
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       checklists
*/


function qu_checklists_init() {
	$domain = 'qu-checklists/';
	$path   = get_parent_theme_file_path( '/lib/widgets/' . $domain );
	
	require_once $path . 'layouts/checklist-item.php';

	// Resources for editor/admin part
	function checklists_editor_assets() {
		$domain   = 'qu-checklists/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = gmdate( 'ymdGis', filemtime( get_parent_theme_file_path( '/lib/widgets/' . $domain . 'build/qu_checklists_edit.js' ) ) );

		wp_enqueue_style(
			'qu_checklist_block_editor_style',
			$path_uri . 'build/qu_checklists_edit.css',
			array(),
			$version,
			false
		);

		wp_enqueue_style(
			'qu_checklist_block_frontend_style',
			$path_uri . 'build/qu_checklists_frontend.css',
			array(),
			$version,
			false 
		);

		wp_enqueue_script(
			'qu_checklist_item_editor_script',
			$path_uri . 'build/qu_checklist_edit_item.js',
			array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data' ),
			$version,
			true
		);

		wp_enqueue_script(
			'qu_checklist_editor_script',
			$path_uri . 'build/qu_checklists_edit.js',
			array( 'wp-blocks' ),
			$version,
			true
		);
	}

	// Resources for User visible part
	function checklists_assets() {
		$domain   = 'qu-checklists/';
		$path_uri = get_template_directory_uri() . '/lib/widgets/' . $domain;
		$version  = gmdate( 'ymdGis', filemtime( get_parent_theme_file_path( '/lib/widgets/' . $domain . 'build/qu_checklists_edit.js' ) ) );
		
		if ( is_singular() ) {
			$id = get_the_ID();
			if ( has_block( 'qu/checklist', $id ) ) {
				wp_enqueue_style(
					'qu_checklist_block_frontend_style',
					$path_uri . 'build/qu_checklists_frontend.css',
					array(),
					$version,
					false 
				);

				wp_enqueue_script(
					'qu_checklist_block_frontend_script',
					$path_uri . 'build/qu_checklists_frontend.js',
					'',
					$version,
					true 
				);

				wp_add_inline_script(
					'qu_checklist_block_frontend_script', 
					'
			if ( !localStorage.getItem( "quChecklists" ) )
			localStorage.setItem("quChecklists","{}");
			',
					'before'
				);
			}
		}
	}

	add_action( 'enqueue_block_assets', 'checklists_assets' );
	add_action( 'enqueue_block_editor_assets', 'checklists_editor_assets' );


	function render_checklist_item( $attr ) {
		return checklist_item( $attr );
	}

	register_block_type(
		'qu/checklistitem',
		array(
			'qu_checklist_editor_style'       => 'qu_checklist_block_editor_style',
			'qu_checklist_item_editor_script' => 'qu_checklist_item_editor_script',
			'qu_checklist_style'              => 'qu_checklist_block_frontend_style',
			'qu_checklist_frontend'           => 'qu_checklist_block_frontend_script',
			'render_callback'                 => 'render_checklist_item',
			'attributes'                      => array(
				'checklistId'      => array(
					'type' => 'string',
				),
				'checklistItemId'  => array(
					'type' => 'string',
				),
				'header'           => array(
					'type'    => 'string',
					'default' => 'Enter checklist title here…',
				),
				'content'          => array(
					'type'    => 'string',
					'default' => '',
				),
				'isOpen'           => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'customActionText' => array(
					'type' => 'string',
				),
			), 
		),
	);

	function render_checklist( $attr, $content ) {
		$pagetitle = explode( '^', get_the_title() );
		if ( isset( $pagetitle[1] ) ) {
			$pagetitle = esc_html( $pagetitle[0] . ' ' . $pagetitle[1] . ' ' . $pagetitle[2] );
		} else {
			$pagetitle = get_the_title();
		}
		return '<div class="qu-Checklist Post__m__negative" itemscope itemtype="https://schema.org/HowTo" 
							data-list="' . $attr['checklistId'] . '">
							<span itemprop="name" style="display:none">' . $pagetitle . '</span>' .
								apply_filters( 'the_content', $content ) 
						. '</div>';
	}

	register_block_type(
		'qu/checklist',
		array(
			'qu_checklist_editor_style'  => 'qu_checklist_block_editor_style',
			'qu_checklist_editor_script' => 'qu_checklist_editor_script',
			'qu_checklist_style'         => 'qu_checklist_block_frontend_style',
			'qu_checklist_frontend'      => 'qu_checklist_block_frontend_script',
			'render_callback'            => 'render_checklist',
			'attributes'                 => array(
				'checklistId' => array(
					'type' => 'string',
				),
			),
		),
	);
}


add_action( 'init', 'qu_checklists_init' );

