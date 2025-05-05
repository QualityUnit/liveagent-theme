<?php // @codingStandardsIgnoreLine
set_custom_source( 'pages/Migrations', 'css' );
set_source( 'migrations', 'filter', 'js' );

$query_args = array(
	'post_type'      => 'ms_migrations',
	'posts_per_page' => - 1,
	'fields'         => 'ids',
);

$migrations_posts = new WP_Query( $query_args );
wp_reset_query();
$page_header_title       = __( 'Migration', 'ms' );
$page_header_description = __( 'Get to know all LiveAgent features, that are part of the complex multi-channel help desk software. Described in one place and in depth.', 'ms' );
$page_header_args        = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_migrations.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'text'   => $page_header_description,
	'search' => array( 'type' => 'academy' ),
	'mobile_filter' => false,
	'count_posts'  => count( $migrations_posts->posts ),
);
?>

<div id="category" class="Category">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Category__container">
		<div class="Category__content">
			<ul class="Category__content__items list">
				<?php
				while ( have_posts() === true ) :
					the_post();

					// Custom link for items
					$custom_link        = get_post_meta( get_the_ID(), 'mb_custom_url', true );
					$item_url           = $custom_link ? $custom_link : get_the_permalink();
					$first_letter_title = substr( get_the_title(), 0, 1 );
					?>
					<li>
						<div class="Category__item">
							<div class="Category__item__image">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'archive_thumbnail' );
								} else {
									?>
									<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/migrations-featured.svg"
											 alt="<?php esc_attr_e( 'Features', 'ms' ); ?>">
									<span><?= esc_html( $first_letter_title ); ?></span>
								<?php } ?>
							</div>
							<h3 class="Category__item__title item-title">
								<a href="<?= esc_url( $item_url ); ?>"><?php the_title(); ?></a>
							</h3>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
