<?php 
function block( $block, $attr, $styling = 'activeStyle' ) {
		return '
			<div
			class="Statistics--block Research--color-' . $attr['color'] . ' ' . ( $styling === 'activeStyle' ? $attr[$styling] : $attr['style'][$styling] ) . ' ' . ( isset( $attr['align'] ) ? 'align-' . $attr['align'] : '' ) . /*@codingStandardsIgnoreLine */ '">
			<div class="elementor-widget-text-editor text">
				<p>' . $attr[ $block ]['text'] . '</p>
			</div>
			<div class="value">
				<h4 class="elementor-heading-title">
					' . $attr[ $block ]['value'] . '
				</h4>
			</div>
			<div class="elementor-widget-text-editor source">
				<p>
					' . $attr[ $block ]['sourceData'] . '
				</p>
			</div>' .
			
			( $attr[ $block ]['url'] ? '
			<div class="to-bottom">
				<a
					class="Statistics--block__url"
					href="' . $attr[ $block ]['url'] . '" ' . ( $attr[ $block ]['urlInTab'] ? 'target="_blank"' : '' ) . '
				>
					' . $attr[ $block ]['urlText'] . '
					<svg
						width="8"
						height="12"
						viewBox="0 0 8 12"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path d="M0 10.59L4.58 6L0 1.41L1.41 0L7.41 6L1.41 12L0 10.59Z" />
					</svg>
				</a>
			</div></div>' : '
		</div>' );
}
