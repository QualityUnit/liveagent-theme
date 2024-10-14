<?php // @codingStandardsIgnoreLine
set_custom_source( 'common/splide', 'css' );

$current_lang    = apply_filters( 'wpml_current_language', null );
$header_category = get_en_category( 'ms_videos', $post->ID );
do_action( 'wpml_switch_language', $current_lang );
$page_header_logo = array(
	'src' => get_template_directory_uri() . '/assets/images/icon-book.svg?ver=' . THEME_VERSION,
	'alt' => __( 'Videos', 'ms' ),
);
if ( has_post_thumbnail() ) {
	$page_header_logo['src'] = get_the_post_thumbnail_url( 'logo_thumbnail' );
}
$page_header_args = array(
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_webinars.png?ver=' . THEME_VERSION,
		'alt' => get_the_title(),
	),
	'logo'  => $page_header_logo,
	'title' => get_the_title(),
	'text'  => do_shortcode( '[urlslab-generator id="6" input="{{page_url}}"]' ),
	'toc'   => true,
);
$current_id       = apply_filters( 'wpml_object_id', $post->ID, 'ms_videos' );
$categories       = get_the_terms( $current_id, 'ms_videos_categories' );
$categories_url   = get_post_type_archive_link( 'ms_videos' );
if ( $categories && $categories_url ) {
	$new_tags = array(
		'title' => __( 'Categories', 'ms' ),
	);
	foreach ( $categories as $category ) {
		$new_tags['list'][] = array(
			'href'  => $categories_url . '#' . $category->slug,
			'title' => $category->name,
		);
	}
	if ( isset( $new_tags['list'] ) ) {
		$page_header_args['tags'][] = $new_tags;
	}
}
?>
<div class="Post Post--sidebar-right" itemscope itemtype="http://schema.org/Guide">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">
		<div class="Post__sidebar">
			<div class="Signup__sidebar-wrapper">
				<?= do_shortcode( '[signup-sidebar js-sticky="true"]' ); ?>
			</div>
		</div>
		<div class="Post__content">
			<div class="Content" itemprop="text">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) ); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

				<h3 class="youtube_urlslab_loader--titleBottom">
					<?= do_shortcode( '[urlslab-video videoid="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) . '" attribute="title"]' ); ?>
				</h3>

				<?= do_shortcode( '[urlslab-generator id="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_shortcode_id', true ) . '" input="https://www.youtube.com/watch?v=' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) . '"]' ); ?>

				<div class="urlslab-video-transcript">
					<h3><?php _e( 'Video transcript', 'ms' ); ?></h3>

					<div class="urlslab-video-transcript-inn">
						<p class="urlslab-video-transcript-text">
							<?= do_shortcode( '[urlslab-video videoid="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) . '" attribute="captions_text" nl2br=true]' ); ?>
						</p>

						<div class="urlslab-video-transcript-activator" data-activator><strong><?php _e( 'Show full video transcript', 'ms' ); ?></strong></div>
						<div class="urlslab-video-transcript-deactivator" data-deactivator><strong><?php _e( 'Hide full video transcript', 'ms' ); ?></strong></div>
					</div>
				</div>

				<?php the_content(); ?>

				<?php echo do_shortcode( '[urlslab-faq]' ); ?>

				<div class="Post__buttons" style="margin-top: 2em;">
					<a href="<?php _e( '/videos/', 'ms' ); ?>" class="Button Button--outline Button--back"><span><?php _e( 'Back to Videos', 'ms' ); ?></span></a>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Create account for FREE', 'ms' ); ?></span>
					</a>
				</div>

				<?php urlslab_display_related_resources(); ?>
			</div>
		</div>
	</div>
</div>
