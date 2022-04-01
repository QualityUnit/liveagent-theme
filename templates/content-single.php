<div class="Post" itemscope itemtype="http://schema.org/BlogPosting">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	<div class="BlogPost__header wrapper__wide">
		<div class="BlogPost__thumbnail">
			<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( $post, 'blog_post_thumbnail' ) ); ?>"></meta>
			<?php the_post_thumbnail( 'blog_post_thumbnail' ); ?>
		</div>
		<div class="BlogPost__intro">
			<div class="BlogPost__category">
				<?php /* translators: %s: don't modify */ ?>
				<?= wp_kses_post( preg_replace( '/(Blog|, and|,|and)/', '', get_the_taxonomies( 0, array( 'template' => __( '<span class="hidden">%s:</span><span>%l</span>' ) ) ) )['category'] ); 
				?>
			</div>
			<h1 itemprop="name" class="BlogPost__title"><?php the_title(); ?></h1>

			<div class="BlogPost__author">
				<div class="BlogPost__author__avatar">
					<?= get_avatar( get_the_author_meta( 'ID' ), 40, 'gravatar_default', get_the_author() ); ?>
				</div>
				<p class="BlogPost__author__name"><?php the_author(); ?></p>
				<p class="BlogPost__author__position">
					<span itemprop="datePublished" content="<?= esc_html( get_the_time( 'Y-m-d' ) ); ?>"><?php echo get_the_time( 'F j, Y' ) . '</span><br />' .// @codingStandardsIgnoreStart
					__( 'Last modified on', 'ms' ) . ' ' .
					get_the_modified_time( 'F j, Y' ) . ' ' .
					__( 'at', 'ms' ) . ' ' .
					get_the_modified_time( 'g:i a' ); // @codingStandardsIgnoreEnd
					?>
				</p>
			</div>
		</div>
	</div>


	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">
			<?php if ( sidebar_toc() !== false ) { ?>
				<div class="SidebarTOC-wrapper">
					<div class="SidebarTOC">
						<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
						<div class="SidebarTOC__slider slider splide">
							<div class="splide__track">
								<ul class="SidebarTOC__content splide__list">
									<?= wp_kses_post( sidebar_toc() ); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div class="Signup__sidebar-wrapper">
			<?= do_shortcode( '[signup-sidebar]' ); ?>
		</div>

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

				<div class="BlogPost__articles">
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
				<?php if ( ICL_LANGUAGE_CODE === 'en' ) { ?>
				<div class="Post__content__resources Post__m__negative">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Resources', 'ms' ); ?></div>
					<div class="SimilarSources">
						<?php echo do_shortcode( '[similarsources]' ); ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
