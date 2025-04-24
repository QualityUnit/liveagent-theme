<?php // @codingStandardsIgnoreLine
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
	'count' => count( $migrations_posts->posts ),
);
?>

<div class="Migrations">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Migrations__container">
		<div class="Migrations__content">
			<ul class="Migrations__content__items">
				<?php
				while ( have_posts() === true ) :
					the_post();

					// Custom link for items
					$custom_link = get_post_meta( get_the_ID(), 'mb_custom_url', true );
					$item_url    = $custom_link ? $custom_link : get_the_permalink();
					?>
					<li>
						<div class="Migrations__item">
							<div class="Migrations__item__image">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'archive_thumbnail' );
								} else {
									?>
									<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-custom-post_type.svg"
											 alt="<?php esc_attr_e( 'Features', 'ms' ); ?>">
								<?php } ?>
								<h3 class="Migrations__item__title"><a
										href="<?= esc_url( $item_url ); ?>"><?php the_title(); ?></a></h3>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
