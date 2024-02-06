<?php
while ( have_posts() ) :
	the_post();
	the_content();
	echo do_shortcode( '[good-hands-redesign]' );
endwhile;
