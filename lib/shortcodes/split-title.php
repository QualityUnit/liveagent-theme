<?php

function ms_splittitle( $atts ) {
	$atts = shortcode_atts(
		array(
			'title' => '',
		),
		$atts,
		'split-title'
	);

	ob_start();

	$title = preg_replace( '/\^(.+?)\^/', '<span class="highlight-gradient">$1</span>', $atts['title'] );
	?>

	<div class="Split__title">
		<h2><?= $title; // @codingStandardsIgnoreLine ?></h2>
		<div class="Split__title__bg"></div>
	</div>

	<script>
		const splitTitle = document.querySelectorAll('.Split__title h2').item(0);
		const splitTitleBg = document.querySelectorAll('.Split__title__bg');

		const setTitleOffset = () => {
			const posTitle = splitTitle.getBoundingClientRect().left;
			const hdQuery = window.matchMedia('(max-width: 1920px)');

			if(hdQuery.matches) {
				splitTitleBg.forEach(bg => {
					bg.style.transform = `translateX(-${posTitle}px)`
				});
			}
			if(! hdQuery.matches) {
				splitTitleBg.forEach(bg => {
					bg.style.transform = `translateX(calc(50vw - ${posTitle}px - 960px))`;
				});
			}
		};

		const resizeObserver = new ResizeObserver((entries) => {
			setTitleOffset();
		});

		setTitleOffset();

		resizeObserver.observe( document.body );
	</script>

	<?php
	return ob_get_clean();
}
add_shortcode( 'split-title', 'ms_splittitle' );
