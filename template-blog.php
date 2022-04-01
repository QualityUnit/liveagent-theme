<?php
	/**
	 * Template Name: Page Like Blog Post
	 */

	set_custom_source( 'pages/post', 'css' );
	set_custom_source( 'pages/blog', 'css' );
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'sidebar_toc', 'js' );
	set_custom_source( 'custom_lightbox', 'js' );
?>

<div class="Post" itemscope itemtype="http://schema.org/Article">

	<div class="BlogPost__header wrapper__wide">
		<div class="BlogPost__thumbnail">
			<?php the_post_thumbnail( 'blog_post_thumbnail' ); ?>
		</div>
		<div class="BlogPost__intro">
			<h1 class="BlogPost__title" itemprop="name"><?php the_title(); ?></h1>

			<div class="BlogPost__author" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<div class="BlogPost__author__avatar">
					<meta itemprop="image" content="<?= esc_url( get_avatar_url( get_the_author_meta( 'ID' ), 220, 'gravatar_default', get_the_author() ) ); ?>"></meta>
					<?= get_avatar( get_the_author_meta( 'ID' ), 40, 'gravatar_default', get_the_author() ); ?>
				</div>

				<p class="BlogPost__author__name" itemprop="name"><?php the_author(); ?></p>
				<p class="BlogPost__author__position"><?php _e( 'Last modified on', 'ms' ); ?>
					<?php the_modified_time( 'F j, Y' ); ?> <?php _e( 'at', 'ms' ); ?> <?php the_modified_time( 'g:i a' ); ?></p>
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
