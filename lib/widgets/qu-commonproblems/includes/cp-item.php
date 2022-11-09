<?php

	/**
	 * Provide a public-facing view for the plugin
	 *
	 * This file is used to markup the public-facing aspects of the plugin.
	 *
	 * @link       https://www.liveagent.com
	 * @since      1.0.0
	 *
	 * @package    QU_Enhanced_FAQ
	 * @subpackage QU_Enhanced_FAQ/public/partials
	 *
	 *
	 */

function hex_to_hsl( $hex ) {
	$red   = hexdec( substr( $hex, 0, 2 ) ) / 255;
	$green = hexdec( substr( $hex, 2, 2 ) ) / 255;
	$blue  = hexdec( substr( $hex, 4, 2 ) ) / 255;

	$cmin  = min( $red, $green, $blue );
	$cmax  = max( $red, $green, $blue );
	$delta = $cmax - $cmin;

	if ( 0 === $delta ) {
		$hue = 0;
	} elseif ( $cmax === $red ) {
		$hue = ( ( $green - $blue ) / $delta ) % 6;
	} elseif ( $cmax === $green ) {
		$hue = ( $blue - $red ) / $delta + 2;
	} else {
		$hue = ( $red - $green ) / $delta + 4;
	}

	$hue = round( $hue * 60 );
	if ( $hue < 0 ) {
		$hue += 360;
	}

	$lightness  = ( ( $cmax + $cmin ) / 2 ) * 100;
	$saturation = $delta === 0 ? 0 : ( $delta / ( 1 - abs( 2 * $lightness - 1 ) ) ) * 100; //@codingStandardsIgnoreLine
	if ( $saturation < 0 ) {
		$saturation += 100;
	}

	$lightness  = round( $lightness );
	$saturation = round( $saturation );

	return array( $hue, $saturation, $lightness );
}

function render_qu_enhanced_faq_item( $attr ) {
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
	'qu/enhanced-faq-item',
	array(
		'render_callback' => 'render_qu_enhanced_faq_item',
		// Here goes attributes that are stored in React edit.js part
		'attributes'      => array(
			'targetId' => array(
				'type'    => 'string',
				'default' => '',
			),
			'question' => array(
				'type'    => 'string',
				'default' => __( 'Some default header name', 'qu-enhancedFAQ' ),
			),
			'content'  => array(
				'type'    => 'string',
				'default' => '',
			),
		),
	),
);

function render_qu_enhanced_faq( $attr, $content ) {
	return '
		<style type="text/css">
		.qu-enhancedFAQ {
			--qu-faq-color: ' . get_option( 'qu_enhanced_faq' )['color'] . ';
			--qu-faq-color-light: ' . get_option( 'qu_enhanced_faq' )['color-light'] . ';
		}

		 .qu-enhancedFAQ__title span.highlight, .qu-enhancedFAQ__item--answer a {
				color: var(--qu-faq-color);
		 }
		</style>
		<div class="qu-enhancedFAQ Post__m__negative" itemscope itemtype="https://schema.org/FAQPage">
			<h2 class="qu-enhancedFAQ__title">' . preg_replace( '/(.+?)\s(.+)/', '<span class="highlight">$1</span> $2', $attr['title'] ) . '</h2>' .
			$content
		. '</div>';
}

register_block_type(
	'qu/enhanced-faq',
	array(
		'attributes'      => array(
			'title' => array(
				'type'    => 'string',
				'default' => __( 'Frequently asked questions', 'qu-enhancedFAQ' ),
			),
		),
		'render_callback' => 'render_qu_enhanced_faq',
	),
);
