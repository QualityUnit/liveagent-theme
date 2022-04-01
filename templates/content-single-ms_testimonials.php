<?php // @codingStandardsIgnoreLine ?>
<div class="Article Article--blog">
	<div class="Article__thumbnail wrapper
	<?php
	if ( ! has_post_thumbnail() ) {
		echo 'empty';
	}
	?>
	">
		<?php the_post_thumbnail( 'blog_post_thumbnail' ); ?>
	</div>

	<div class="wrapper Article__container">
		<div class="Article__container__content Content">
			<h1 class="Article__container__content__title"><?php the_title(); ?></h1>
			<?php the_excerpt(); ?>
			<?php the_content(); ?>
		</div>

		<div class="Article__container__sidebar">
			<div class="Article__container__sidebar__author">
				<div class="Article__container__sidebar__author__avatar">
					<?= wp_get_attachment_image( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_photo', true ), 'logo_small_thumbnail' ) ?>
				</div>

				<div class="Article__container__sidebar__author__content">
					<div class="h4"><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_name', true ) ) ?></div>
					<p><strong><?= esc_html( get_post_meta( get_the_ID(), 'mb_testimonials_mb_testimonials_position', true ) ) ?></strong></p>
				</div>
			</div>
		</div>
	</div>
</div>
