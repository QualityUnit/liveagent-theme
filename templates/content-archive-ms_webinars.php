<?php // @codingStandardsIgnoreLine
set_source( 'webinars', 'pages/Webinars' );

$categories        = array_unique( get_categories( array( 'taxonomy' => 'ms_webinars_years' ) ), SORT_REGULAR );
$page_header_title = __( 'Webinars', 'ms' );
$page_header_text  = __( 'Welcome to the LiveAgent customer service webinar! Our specialists will guide you through our multi-channel help desk solution, which includes ticketing software, live chat, a built-in call center, and much more. We will help you with the setup and configuration of your account, as well as answer your most requested questions. Get to know LiveAgent’s customer care software with us and improve your customer service like many businesses around the world.', 'ms' );

$page_header_args = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_webinars.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'text'   => $page_header_text,
);
?>

<div id="webinars" class="Webinars">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Webinars__container">
		<?php

		$query_webinars_posts = new WP_Query(
			array(
				'post_type' => 'ms_webinars',
				'posts_per_page' => 9,
				'orderby' => 'date',
				'order' => 'ASC',
			)
		);

		?>

			<ul class="Webinars__items">
				<?php
				while ( $query_webinars_posts->have_posts() ) :
					$query_webinars_posts->the_post();
					?>

					<li <?php post_class( 'Webinars__item' ); ?>>

							<div class="Webinars__item--thumbnail">
								<?php the_post_thumbnail( 'box_archive_thumbnail' ); ?>
							</div>

							<div class="Webinars__item--content">
								<h3 class="Webinars__item--heading"><?php the_title(); ?></h3>
								<p class="Webinars__item--excerpt"><?= esc_html( get_the_excerpt() ); ?></p>
								<div class="Webinars__item--footer">
									<a href="<?= esc_url( get_post_meta( get_the_ID(), 'mb_webinars_mb_webinars_youtube_link', true ) ); ?>" class="Webinars__item--link"><img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/play_button.svg"><?= esc_html__( 'Play webinar', 'ms' ); ?></a>
									<span class="Webinars__item--duration"><?= esc_html( get_the_date() ); ?></span>
								</div>
							</div>

					</li>

				<?php endwhile; ?>
				<?php
				wp_reset_postdata();
				?>
			</ul>
	</div>
	<div class="Webinars__items__loading invisible"><?php _e( 'Loading', 'ms' ); ?><span>.</span><span>.</span><span>.</span></div>
</div>
