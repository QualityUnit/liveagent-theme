<article <?php post_class(); ?>>
	<header>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<time datetime="<?= esc_attr( get_post_time( 'c', true ) ); ?>"><?= get_the_date(); ?></time>
		<p><?= esc_html( __( 'By', 'urlslab' ) ); ?> <a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?= get_the_author(); ?></a></p>
	</header>
	<div>
		<?php the_excerpt(); ?>
	</div>
</article>
