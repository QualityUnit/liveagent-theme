<?php

function ms_small_photo_slider( $atts ) {
	$atts = shortcode_atts(
		array(
			'posts'     => '15',
			'perpage'   => '3',
			'posttype'  => 'about',
			'taxonomy'  => 'photos',
			'zoomin'    => 'Zoom in',
			'showtitle' => 'false',
		),
		$atts,
		'small_photo_slider'
	);
	ob_start();
	?>

	<div class="SmallPhoto__slider slider splide">
			<div class="splide__arrows nice__arrows">
				<button class="splide__arrow splide__arrow--prev">
					<svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" />
					</svg>
				</button>
				<button class="splide__arrow splide__arrow--next">
					<svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" />
					</svg>
				</button>
			</div>
			<div class="splide__track">
				<ul class="splide__list">
				<?php
				$query_small_photos = new WP_Query(
					array(
						'post_type'           => 'ms_' . $atts['posttype'],
						'ms_about_categories' => $atts['taxonomy'],
						'posts_per_page'      => $atts['posts'],
						'orderby'             => 'date',
						'order'               => 'ASC',
					)
				);

				if ( $query_small_photos->have_posts() ) :
					while ( $query_small_photos->have_posts() ) :
						$query_small_photos->the_post();
						?>

					<li class="splide__slide">
						<div class="slide__inn">
							<a class="SmallPhoto__slider__photo <?= esc_html( $atts['showtitle'] !== 'false' ? '' : 'notitle' ); /* @codingStandardsIgnoreLine */ ?>" href="<?php the_post_thumbnail_url(); ?>" data-lightbox="gallery">
								<span class="SmallPhoto__slider__zoomin">
									<svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.0086 13.2075H14.06L13.7238 12.8834C14.9005 11.5146 15.6089 9.73756 15.6089 7.80446C15.6089 3.494 12.1149 0 7.80446 0C3.494 0 0 3.494 0 7.80446C0 12.1149 3.494 15.6089 7.80446 15.6089C9.73756 15.6089 11.5146 14.9005 12.8834 13.7238L13.2075 14.06V15.0086L19.211 21L21 19.211L15.0086 13.2075V13.2075ZM7.80446 13.2075C4.81475 13.2075 2.40137 10.7942 2.40137 7.80446C2.40137 4.81475 4.81475 2.40137 7.80446 2.40137C10.7942 2.40137 13.2075 4.81475 13.2075 7.80446C13.2075 10.7942 10.7942 13.2075 7.80446 13.2075Z" />
									</svg>
									<?= esc_html( $atts['zoomin'] ); ?>
								</span>
								<img style="opacity: 0; transition: opacity 0.5s ease 0s;" data-lasrc="<?php the_post_thumbnail_url( 'person_thumbnail' ); ?>" alt="<?php the_title(); ?>" />
								<?php if ( $atts['showtitle'] !== 'false' ) {/* @codingStandardsIgnoreLine */?>
									<span class="SmallPhoto__slider__desc"><?php the_title(); ?></span>
									<?php
								}
								?>
							</a>
						</div>
					</li>

							<?php 
			endwhile; 
					?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				</ul>
			</div>
	</div>
	<?php
	set_custom_source( 'common/splide' );
	set_custom_source( 'components/SmallPhotoSlider' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'slider', 'js' );

	return ob_get_clean();
}
add_shortcode( 'small_photo_slider', 'ms_small_photo_slider' );
