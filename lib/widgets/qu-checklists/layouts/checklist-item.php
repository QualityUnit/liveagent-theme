<?php 
function checklist_item( $attr ) {
	if ( isset( $_SERVER['HTTPS'] ) &&
		( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) || //@codingStandardsIgnoreLine
		isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) &&
		$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) { //@codingStandardsIgnoreLine
		$protocol = 'https://';
	} else {
		$protocol = 'http://';
	}
	$referer = urlencode($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); //@codingStandardsIgnoreLine;

	return '
		<div class="qu-ChecklistItem open" data-checklistitem="' . $attr['checklistItemId'] . '" 
			itemprop="step" itemscope itemtype="https://schema.org/HowToSection">
			<div class="qu-ChecklistItem__header">
				<input id="quChecklistItemCheckbox-' . $attr['checklistItemId'] . '" class="qu-ChecklistItem__checkbox" type="checkbox" />
				<label id="' . sanitize_title( $attr['header'] ) . '" class="qu-ChecklistItem__header--text" for="quChecklistCheckbox-' . $attr['checklistItemId'] . '" data-list="' . $attr['checklistId'] . '" data-checklistitem="' . $attr['checklistItemId'] . '" itemprop="name">
				<h2>' . 
					$attr['header'] 
		. ' </h2></label>
				<button class="qu-ChecklistItem__header__copy Button Button--outline Button--small" data-text="' . $protocol . urldecode( $referer ) . '#' . sanitize_title( $attr['header'] ) . '"><svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M16.667 6.5h-7.5A2.667 2.667 0 0 0 6.5 9.167v7.5a2.667 2.667 0 0 0 2.667 2.666h7.5a2.667 2.667 0 0 0 2.666-2.666v-7.5A2.667 2.667 0 0 0 16.667 6.5Zm0 2c.368 0 .666.298.666.667v7.5a.666.666 0 0 1-.666.666h-7.5a.666.666 0 0 1-.667-.666v-7.5c0-.369.298-.667.667-.667h7.5Z"/><path d="M4.167 11.5h-.833a.668.668 0 0 1-.667-.667v-7.5a.665.665 0 0 1 .667-.666h7.5a.667.667 0 0 1 .666.666v.834a1.001 1.001 0 0 0 2 0v-.834c0-.707-.281-1.385-.781-1.885a2.662 2.662 0 0 0-1.885-.781h-7.5A2.666 2.666 0 0 0 .667 3.333v7.5A2.666 2.666 0 0 0 3.334 13.5h.833a1 1 0 0 0 0-2Z"/></svg><span class="desktop--only">' . __( 'Copy link', 'ms' ) . '</span></button>
				<svg class="qu-ChecklistItem__header__arrow" width="18" height="11" viewBox="0 0 18 11"><path d="M2.4975 0.333496L9 6.82183L15.5025 0.333496L17.5 2.331L9 10.831L0.5 2.331L2.4975 0.333496Z" fill="#050505"/></svg>
				<div class="qu-ChecklistItem__header__pseudo"></div>
			</div>
			<div class="qu-ChecklistItem__content" itemprop="itemListElement" itemscope itemtype="https://schema.org/HowToStep">
				<div class="qu-ChecklistItem__content--inn" itemprop="text" >
				<meta itemprop="url" content="' . sanitize_title( $attr['header'] ) . '">
				<meta itemprop="name" content="' . $attr['header'] . '">' .
				$attr['content']
		. ' </div>
				<div class="qu-ChecklistItem__footer">' .
					( isset( $attr['customActionText'] )
					? '<label class="qu-ChecklistItem__footer--checkbox" for="quChecklistItemCheckbox-' . $attr['checklistItemId'] . '" data-list="' . $attr['checklistId'] . '" data-checklistitem="' . $attr['checklistItemId'] . '"> 
							<span>' . $attr['customActionText'] . '</span>
						</label>'
					: '' )
				. '</div>
			</div>
		</div>';
}
