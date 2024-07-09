<?php // @codingStandardsIgnoreLine
set_source( 'videos', 'pages/Category', 'css' );
set_source( 'videos', 'filter', 'js' );

function duration_to_time( $youtube_time ) {
	if ( $youtube_time ) {
		$start = new DateTime( '@0' ); // Unix epoch
		$start->add( new DateInterval( $youtube_time ) );
		$youtube_time = ltrim( ltrim( $start->format( 'H:i:s' ), '0' ), ':' );
	}

	return $youtube_time;
}

$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_videos_categories' ) ), SORT_REGULAR );
if ( is_tax( 'ms_videos_categories' ) ) :
	$page_header_title       = single_cat_title();
	$page_header_description = the_archive_description();
else :
	$page_header_title = __( 'Videos', 'ms' );
endif;
if ( is_tax( 'ms_videos_categories' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text  = term_description();
endif;
$filter_items_categories = array(
	array(
		'checked' => true,
		'value'   => '',
		'title'   => __( 'Any', 'ms' ),
	),
);
foreach ( $categories as $category ) :
	$filter_items_categories[] = array(
		'value' => $category->slug,
		'title' => $category->name,
	);
endforeach;
$filter_items     = array(
	array(
		'type'  => 'radio',
		'name'  => 'category',
		'title' => __( 'Category', 'ms' ),
		'items' => $filter_items_categories,
	),
);
$page_header_args = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_webinars.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'search' => array(
		'type' => 'academy',
	),
	'filter' => $filter_items,
);
?>

<div id="category" class="Category">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Category__container">
		<div class="Category__content">
			<ul class="Category__content__items list">
				<?php
				while ( have_posts() ) :
					the_post();

					$category = '';

					$categories = get_the_terms( 0, 'ms_videos_categories' );

					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category_item ) {
							$category_item = array_shift( $categories );
							$category     .= $category_item->slug;
							$category     .= ' ';
						}
					}

					$category = substr( $category, 0, -1 );
					?>

					<li class="Category__item Category__item--videos Category__item--blogLike" data-category="<?= esc_attr( $category ); ?>" data-href="<?php the_permalink(); ?>">
						<a href="<?php the_permalink(); ?>" class="Category__item__thumbnail">
							<img src="https://i.ytimg.com/vi/<?php echo esc_attr( get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) ); ?>/hqdefault.jpg" alt="<?php _e( 'Videos', 'urlslab' ); ?>">
						</a>
							<h3 class="Category__item__title item-title" data-title><a href="<?php the_permalink(); ?>"><?= esc_html( wp_trim_words( get_the_title(), 7 ) ); ?></a></h3>
							<div class="Category__item__excerpt item-excerpt">
								<a href="<?php the_permalink(); ?>" data-excerpt>
									<?= esc_html( wp_trim_words( do_shortcode( '[urlslab-video attribute="description" id="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_shortcode_id', true ) . '" videoid="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) . '"]' ), 20 ) ); ?>
								</a>
							</div>

							<div class="Category__item__duration"><?= esc_html( duration_to_time( do_shortcode( '[urlslab-video attribute="duration" id="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_shortcode_id', true ) . '" videoid="' . get_post_meta( get_the_ID(), 'mb_videos_mb_videos_video_id', true ) . '"]' ) ) ); ?> </div>
					</li>

					<?php
						$category = '';
					?>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>

</div>
