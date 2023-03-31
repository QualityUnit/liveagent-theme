<?php
global $post;
$page_header_args = array(
	'image' => array(
		'src' => get_the_post_thumbnail_url( $post, 'blog_post_thumbnail' ),
		'alt' => get_the_title(),
	),
	'title' => get_the_title(),
	'text' => get_the_excerpt( $post ),
	'date' => true,
	'toc' => true,
);
$categories = get_the_terms( $post->ID, 'category' );
if ( isset( $categories ) ) {
	$page_header_tags = array();
	foreach ( $categories as $category ) {
		$page_header_tags[0]['list'][] = array(
			'href' => get_category_link( $category->term_id ),
			'title' => $category->name,
		);
	}
	if ( isset( $page_header_tags[0]['list'] ) ) {
		$page_header_args['tags'] = $page_header_tags;
	}
}
?>
<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/BlogPosting">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	
	<div class="wrapper Post__container">
		<div class="BlogPost__content Post__content">
			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<div class="BlogPost__share">
					<p class="BlogPost__share__title"><?php _e( 'Share this article', 'ms' ); ?></p>

					<div class="BlogPost__share__items">
						<div class="BlogPost__share__items__item">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" itemprop="sameAs"
								title="<?php _e( 'Share on', 'ms' ); ?> <?php _e( 'Facebook', 'ms' ); ?>">
								<i class="fontello-facebook-f-brands"></i>
							</a>
						</div>
						<div class="BlogPost__share__items__item">
							<a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" itemprop="sameAs"
								title="<?php _e( 'Share on', 'ms' ); ?> <?php _e( 'Twitter', 'ms' ); ?>">
								<i class="fontello-twitter-brands"></i>
							</a>
						</div>
						<div class="BlogPost__share__items__item">
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank" itemprop="sameAs"
								title="<?php _e( 'Share on', 'ms' ); ?> <?php _e( 'LinkedIn', 'ms' ); ?>">
								<i class="fontello-linkedin-in-brands"></i>
							</a>
						</div>
					</div>
				</div>

				<div class="BlogPost__author-box" itemprop="author" itemscope itemtype="http://schema.org/Person">
					<div class="BlogPost__author-box__avatar">
						<meta itemprop="image" content="<?= esc_url( get_avatar_url( get_the_author_meta( 'ID' ), 220, 'gravatar_default', get_the_author() ) ); ?>"></meta>
						<?= get_avatar( get_the_author_meta( 'ID' ), 220, 'gravatar_default', get_the_author() ); ?>
					</div>

					<div class="BlogPost__author-box__content">
						<p class="BlogPost__author-box__content__name" itemprop="name"><?php the_author(); ?></p>
						<p class="BlogPost__author-box__content__position"><?php the_author_meta( 'position' ); ?></p>
						<p class="BlogPost__author-box__content__description" itemprop="description"><?php the_author_meta( 'description' ); ?></p>
						<div class="BlogPost__author-box__content__social">
							<?php if ( (bool) get_the_author_meta( 'instagram' ) ) { ?>
							<a href="<?php the_author_meta( 'instagram' ); ?>" target="_blank" itemprop="sameAs">
								<i class="fontello-instagram-brands"></i>
							</a>
							<?php } ?>
							<?php if ( (bool) get_the_author_meta( 'facebook' ) ) { ?>
							<a href="<?php the_author_meta( 'facebook' ); ?>" target="_blank" itemprop="sameAs">
								<i class="fontello-facebook-f-brands"></i>
							</a>
							<?php } ?>
							<?php if ( (bool) get_the_author_meta( 'linkedin' ) ) { ?>
							<a href="<?php the_author_meta( 'linkedin' ); ?>" target="_blank" itemprop="sameAs">
								<i class="fontello-linkedin-in-brands"></i>
							</a>
							<?php } ?>
							<?php if ( (bool) get_the_author_meta( 'twitter' ) ) { ?>
							<a href="https://twitter.com/<?php the_author_meta( 'twitter' ); ?>" target="_blank" itemprop="sameAs">
								<i class="fontello-twitter-brands"></i>
							</a>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="BlogPost__articles urlslab-skip-keywords">
					<?php
					$query_blog_posts = new WP_Query(
						array(
							'posts_per_page' => 2,
							'orderby'        => 'modified',
						)
					);
					if ( $query_blog_posts->have_posts() ) :
						while ( $query_blog_posts->have_posts() ) :
							$query_blog_posts->the_post();
							?>
					<div class="BlogPost__articles__article">
						<div class="BlogPost__articles__article__thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail( 'person_thumbnail', array( 'alt' => get_the_title() ) ); ?>
							</a>
						</div>
						<p class="BlogPost__articles__article__title"><a href="<?php the_permalink(); ?>"
								title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>

				<div class="Post__content__resources">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>
					<div class="SimilarSources">
						<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
