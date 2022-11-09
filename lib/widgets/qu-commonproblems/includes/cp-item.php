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
		<div class="qu-enhancedFAQ__item" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
		<h3 data-quTarget="' . $attr['targetId'] . '" class="qu-enhancedFAQ__item--question"  itemprop="name" >
		<svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="9" r="9" fill="var(--qu-faq-color-light)" /><path fill="var(--qu-faq-color)" d="m11.781 6 1.414 1.414-5.657 5.657-1.414-1.414z" /><path fill="var(--qu-faq-color)" d="M8.953 11.657 7.54 13.071 4.004 9.536l1.414-1.414z" /></svg>' . esc_html( $attr['question'] ) . '
			</h3>
			<div data-quTargetId="' . $attr['targetId'] . '" class="qu-enhancedFAQ__item--answer" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
			<div itemprop="text">' .
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
			'targetId' => array(
				'type'    => 'string',
				'default' => '',
			),
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
