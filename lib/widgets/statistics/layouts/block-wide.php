<?php 
function block_wide( $attr ) {
		return '
			<div
			class="Statistics--block Statistics--block__wide Post__m__negative Research--color-' . $attr['color'] . '">
				<h2 class="Statistics--block__wide--header">
					' . $attr['blockWide']['header'] . '
				</h2>

			<div class="Statistics--block__wide--top">
				<div class="value">
					<h4 class="elementor-heading-title">
						' . $attr['blockWide']['value'] . '
					</h4>
				</div>
				<div class="elementor-widget-text-editor text no-color">
					<p>' . $attr['blockWide']['text'] . '
						<span class="source">' . $attr['blockWide']['sourceData'] . '</span>
					</p>
				</div>
			</div>' .
			( $attr['blockWide']['imageId'] && $attr['blockWide']['imageUrl'] ?
				'<img class="Statistics--block__wide--image" src="' . $attr['blockWide']['imageUrl'] . '"
					alt="' . $attr['blockWide']['header'] . '"
				/>
			' : null ) .
			( $attr['blockWide']['url'] ? '
			<div class="to-bottom">
				<a
					class="Statistics--block__url"
					href="' . $attr['blockWide']['url'] . '" ' . ( $attr['blockWide']['urlInTab'] ? 'target="_blank"' : '' ) . '
				>
					' . $attr['blockWide']['urlText'] . '
				</a>
			</div></div>' : '</div>' );
}
