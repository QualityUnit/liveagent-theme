<?php
	/**
	 * Template Name: Page Like Blog Post – Helpdesk Header
	 */

	// set_custom_source( 'pages/blog', 'css' );
	set_custom_source( 'pages/post', 'css' );
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'splide', 'js' );

	global $post;
	$page_title       = str_replace( '^', '', get_the_title() );
	$page_header_args = array(
		'title' => $page_title,
		'text'  => do_shortcode( '[urlslab-generator id="6"]' ),
		'toc'   => true,
		'date'  => true,
	);
	if ( has_post_thumbnail() ) {
		$page_header_args['image'] = array(
			'type' => 'main',
			'src'  => get_the_post_thumbnail_url( $post, 'blog_post_thumbnail' ),
			'alt'  => $page_title,
		);
	}
	?>

<div class="Post Post--sidebar-right">

	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">
		<div class="BlogPost__content Post__content">
			<div class="Content">
				<?php the_content(); ?>

				<div class="Post__content__resources">
					<div class="Post__sidebar__title h4"><?php _e( 'Related Articles', 'ms' ); ?></div>
					<div class="SimilarSources">
						<?php echo do_shortcode( '[urlslab-related-resources related-count="4" show-image="true" show-summary="true"]' ); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="Post__sidebar">
			<div class="Signup__sidebar-wrapper">
				<?= do_shortcode( '[signup-sidebar js-sticky="true"]' ); ?>
			</div>
		</div>
	</div>
</div>
