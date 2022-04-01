<?php if ( ! have_posts() ) : ?>
	<div>
		<?php _e( 'Sorry, no results were found.', 'ms' ); ?>
	</div>
<?php endif; ?>

<?php
while ( have_posts() ) :
	the_post();
	get_template_part( 'templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format() );
endwhile;

the_posts_navigation();
