<?php

function ms_sucess_stories() {
	ob_start();
	?>

	<div class="Archive__container Archive__container--boxes Archive__container--success-stories">
		<ul class="Archive__container__content list">
		<?php
		$query_success_stories_posts = new WP_Query(
			array(
				'post_type'      => 'ms_success-stories',
				'posts_per_page' => 4,
			)
		);

		while ( $query_success_stories_posts->have_posts() ) :
			$query_success_stories_posts->the_post();
			?>

			<li <?php post_class( 'Archive__container__content__item' ); ?>>
				<article>
					<div class="Archive__container__content__item__thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
					<div class="Archive__container__content__item__main">
						<h3 class="Archive__container__content__item__title">
							<a class="Archive__container__content__item__title__link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="Archive__container__content__item__text Archive__container__content__item__text--visible">
							<?php the_excerpt(); ?>
							<p>
								<a class="more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e( 'Learn more', 'ms' ); ?>
								<svg class="more--arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
									<g>
										<path d="M16.662 8.404H0v2.192h16.662V8.404z" />
										<path d="M17.484 7.903 7.976 17.41l1.55 1.55 9.508-9.507-1.55-1.55z" />
										<path d="m9.558-.003-1.55 1.55 9.508 9.508 1.55-1.55L9.558-.003z" />
									</g>
								</svg>
								</a>
							</p>
						</div>
					</div>
				</article>
			</li>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'successstories', 'ms_sucess_stories' );
