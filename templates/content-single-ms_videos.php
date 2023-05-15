<?php // @codingStandardsIgnoreLine
	$current_lang    = apply_filters( 'wpml_current_language', null );
	$header_category = get_en_category( 'ms_videos', $post->ID );
	do_action( 'wpml_switch_language', $current_lang );
?>
<div class="Post" itemscope itemtype="http://schema.org/Guide">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<div class="Post__header <?= esc_attr( $header_category ); ?>">
		<div class="wrapper__wide"></div>
	</div>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar urlslab-skip-keywords">

			<div class="Post__sidebar__categories">
				<div class="Post__sidebar__title h4"><?php _e( 'Categories', 'ms' ); ?></div>
				<ul class="Post__sidebar__categories__labels">
					<?php
					$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_videos' );
					$categories = get_the_terms( $current_id, 'ms_videos_categories' );

					if ( $categories ) {
						foreach ( $categories as $category ) {
							?>
					<li class="Post__sidebar__link">
						<a href="../#<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>"><?= esc_html( $category->name ); ?></a>
					</li>
							<?php
						}
					}
					?>
				</ul>
			</div>

			<?php if ( sidebar_toc() !== false ) { ?>
				<div class="SidebarTOC-wrapper">
					<div class="SidebarTOC Post__SidebarTOC">
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

		<div class="Post__content">
			<div class="Post__logo">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( 'logo_thumbnail' ); ?>
				<?php } else { ?>
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-book.svg" alt="<?php _e( 'Videos', 'ms' ); ?>">
				<?php } ?>
			</div>
			<div class="Post__content__breadcrumbs">
				<ul>
					<li><a href="<?php _e( '/videos/', 'ms' ); ?>"><?php _e( 'Videos', 'ms' ); ?></a></li>
					<li><?php the_title(); ?></li>
				</ul>
			</div>

			<h1 itemprop="name"><?php the_title(); ?></h1>

			<div class="Content" itemprop="text">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) ); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

				<?= do_shortcode( '[urlslab-generator id="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_shortcode_id', true ) . '" videoid="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) . '"]' ); ?>

				<?php the_content(); ?>

				<div class="Post__buttons" style="margin-top: 2em;">
					<a href="<?php _e( '/videos/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Videos', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
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
