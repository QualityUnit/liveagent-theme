<?php
	/**
	 * Template Name: Page Like Blog Post – Helpdesk Header
	 */

	// set_custom_source( 'pages/blog', 'css' );

	global $post;
	$page_title       = str_replace( '^', '', get_the_title() );
	$page_header_args = array(
		'title'      => $page_title,
		'toc'        => true,
		'date'  => true,
	);
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
