<?php
set_custom_source( 'socialShareFunctions', 'js' );
set_custom_source( 'common/splide', 'css' );
global $post;
$page_header_args = array(
	'image' => array(
		'src' => get_the_post_thumbnail_url( $post, 'blog_post_thumbnail' ),
		'alt' => get_the_title(),
	),
	'title' => get_the_title(),
	'date'  => true,
	'toc'   => true,
);

$categories       = get_the_terms( $post->ID, 'category' );
if ( is_array( $categories ) ) {
	$page_header_tags = array();
	foreach ( $categories as $category ) {
		$page_header_tags[0]['list'][] = array(
			'href'  => get_category_link( $category->term_id ),
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
		<div class="Post__sidebar">
			<div class="Signup__sidebar-wrapper">
				<?= do_shortcode( '[signup-sidebar js-sticky="true"]' ); ?>
			</div>
		</div>
		<div class="BlogPost__content Post__content">
			<div class="Content" itemprop="articleBody">
				<?php the_content(); ?>

				<?php echo do_shortcode( '[urlslab-faq]' ); ?>

				<div class="BlogPost__share">
					<p class="BlogPost__share__title"><?php _e( 'Share this article', 'ms' ); ?></p>

					<div class="BlogPost__share__items">
						<div class="BlogPost__share__items__item">
							<button data-permalink="<?= esc_attr( get_permalink() ); ?>" onclick="shareOnFacebook(this);" itemprop="sameAs"
								title="<?php _e( 'Share on', 'ms' ); ?> <?php _e( 'Facebook', 'ms' ); ?>">
								<i class="fontello-facebook-f-brands"></i>
							</button>
						</div>
						<div class="BlogPost__share__items__item">
							<button data-permalink="<?= esc_attr( get_permalink() ); ?>" onclick="shareOnTwitter(this);" itemprop="sameAs"
								title="<?php _e( 'Share on', 'ms' ); ?> <?php _e( 'Twitter', 'ms' ); ?>">
								<i class="fontello-twitter-brands"></i>
							</button>
						</div>
						<div class="BlogPost__share__items__item">
							<button data-permalink="<?= esc_attr( get_permalink() ); ?>" onclick="shareOnLinkedin(this);" itemprop="sameAs"
								title="<?php _e( 'Share on', 'ms' ); ?> <?php _e( 'LinkedIn', 'ms' ); ?>">
								<i class="fontello-linkedin-in-brands"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="BlogPost__author-box" itemprop="author" itemscope itemtype="http://schema.org/Person">
					<div class="BlogPost__author-box__avatar">
						<meta itemprop="image" content="<?= esc_url( get_avatar_url( get_the_author_meta( 'ID' ), 250, 'gravatar_default', get_the_author() ) ); ?>">
						<?= get_avatar( get_the_author_meta( 'ID' ), 250, 'gravatar_default', get_the_author() ); ?>
					</div>

					<div class="BlogPost__author-box__content">
						<p class="BlogPost__author-box__content__name" itemprop="name"><?php the_author(); ?></p>
						<p class="BlogPost__author-box__content__description" itemprop="description"><?php the_author_meta( 'description' ); ?></p>
						<div class="BlogPost__author-box__content__social">
							<?php if ( get_the_author_meta( 'user_url' ) ) { ?>
								<a href="<?php the_author_meta( 'user_url' ); ?>" target="_blank" itemprop="sameAs url"  rel="noopener nofollow" title=" <?php printf( '%s&#39;s %s', esc_html( get_the_author() ), esc_html( __( 'Website', 'ms' ) ) ); ?>">
									<i class="fontello-menu-take-a-tour"></i>
								</a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'linkedin' ) ) { ?>
							<a href="<?php the_author_meta( 'linkedin' ); ?>" target="_blank" itemprop="sameAs url" rel="noopener nofollow" title=" <?php printf( '%s&#39;s %s', esc_html( get_the_author() ), esc_html( __( 'Linkedin', 'ms' ) ) ); ?>">
								<i class="fontello-linkedin-in-brands"></i>
							</a>
							<?php } ?>
							<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
							<a href="https://twitter.com/<?php the_author_meta( 'twitter' ); ?>" target="_blank" itemprop="sameAs url" rel="noopener nofollow" title=" <?php printf( '%s&#39;s %s', esc_html( get_the_author() ), esc_html( __( 'Twitter', 'ms' ) ) ); ?>">
								<i class="fontello-twitter-brands"></i>
							</a>
							<?php } ?>
						</div>
						<a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemprop="url"  class="BlogPost__author-box__archive--button"><?php _e( 'More articles by ', 'ms' ); ?> <?php the_author(); ?></a>
					</div>
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
