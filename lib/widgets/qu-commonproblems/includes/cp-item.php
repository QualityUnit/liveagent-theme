<?php

	/**
	 * Provide a public-facing view for the plugin
	 *
	 * This file is used to markup the public-facing aspects of the plugin.
	 *
	 * @link       https://www.liveagent.com
	 * @since      1.0.0
	 *
	 * @package    QU_Common_Problems
	 *
	 *
	 */

function render_commonproblems_item( $attr ) {
	// Always define proper Schema microdata at schema.org

	return '
		<div class="qu-enhancedFAQ__item Faq__item">
			<h3 class="">' . 
				esc_html( $attr['question'] ) . '
			</h3>
			<div class="Faq__outer-wrapper">
			<div class="Faq__inner-wrapper">' .
					$attr['content'] //@codingStandardsIgnoreLine
			. '</div>
			</div>
		</div>
	';
}

register_block_type(
	'qu/commonproblems-item',
	array(
		'render_callback' => 'render_commonproblems_item',
		// Here goes attributes that are stored in React edit.js part
		'attributes'      => array(
			'question' => array(
				'type'    => 'string',
				'default' => __( 'Some default header name', 'qu-commonproblems' ),
			),
			'content'  => array(
				'type'    => 'string',
				'default' => '',
			),
		),
	),
);
