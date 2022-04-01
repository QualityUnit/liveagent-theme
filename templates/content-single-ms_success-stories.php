<?php // @codingStandardsIgnoreLine ?>
<div class="Article Article--blog" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<div class="Article__thumbnail wrapper
	<?php
	if ( ! has_post_thumbnail() ) {
		echo 'empty';
	}
	?>
	">
		<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( $post, 'blog_post_thumbnail' ) ); ?>"></meta>
		<?php the_post_thumbnail( 'blog_post_thumbnail' ); ?>
	</div>

	<div class="wrapper Article__container">
		<div class="Article__container__content">
			<div class="Content">
				<h1 class="Article__container__content__title" itemprop="name"><?php the_title(); ?></h1>

				<div itemprop="articleBody">
					<?php the_content(); ?>
				</div>

				<div class="Article__container__content__back">
					<a href="<?php _e( '/customers/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Back', 'ms' ); ?></span>
					</a>
				</div>
			</div>
		</div>

		<div class="Article__container__sidebar">
			<div class="Article__container__sidebar__category stories">
				<div class="h4"><?php _e( 'More Stories', 'ms' ); ?></div>
				<ul>
					<?php
					$query_success_stories_posts = new WP_Query(
						array(
							'post_type'      => 'ms_success-stories',
							'posts_per_page' => 100,
							'orderby'        => 'title',
							'order'          => 'ASC',
						)
					);
					while ( $query_success_stories_posts->have_posts() ) :
						$query_success_stories_posts->the_post();
						?>
						<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
