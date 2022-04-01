<?php
while ( have_posts() ) :
	the_post();
	get_template_part( 'templates/content', 'page' );
endwhile;
