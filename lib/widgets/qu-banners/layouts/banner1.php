<?php 
function banner1( $attr ) {
		$banner = $attr['layout'];
		return '
			<div class="qu-Banner qu-Banner-' . $banner . ' ' . $attr[$banner]['activeStyle'] . /*@codingStandardsIgnoreLine */ '">
				<h3 class="qu-Banner--head">
					' . $attr[ $banner ]['header'] . '
				</h3>
			<div class="qu-Banner__content">
				' . $attr[ $banner ]['content'] . '
			</div>
			
				<a
					class="Button Button--full"
					href="' . $attr[ $banner ]['buttonUrl'] . '" ' . ( $attr[ $banner ]['openInTab'] ? 'target="_blank"' : '' ) . '
				>
					<span>' . $attr[ $banner ]['buttonText'] . '</span>
				</a>
		</div>';
}
