<?php

function ms_gutenberg_testimonials() {
	ob_start();
	?>

	<div class="Gutenberg">
		<section class="SliderTestimonials SliderTestimonials--shadow Block">
			<div class="wrapper">
				<?php echo do_shortcode( '[slidertestimonials]' ); ?>
			</div>
		</section>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'gutenberg-testimonials', 'ms_gutenberg_testimonials' );
