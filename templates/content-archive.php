<?php
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'components/SliderCutted', 'css' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'slider', 'js' );
	set_custom_source( 'blogLazyLoad', 'js', array( 'app_js' ) );
?>
<div id="blog" class="Blog" itemscope itemtype="http://schema.org/Blog">
	<div class="Blog__header Block--background-glass">
		<div class="wrapper wrapper__extended">
			<h1 class="Blog__header__title"><?php single_cat_title(); ?></h1>

			<div class="Blog__header__navigation">
				<?php
				if ( has_nav_menu( 'blog_filter_navigation' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'blog_filter_navigation',
							'menu_class'     => 'nav',
						)
					);
				endif;
				?>
			</div>
		</div>
	</div>
	<div class="Blog__top SliderCutted slider splide">
			<div class="splide__arrows nice__arrows">
				<button class="splide__arrow splide__arrow--prev">
					<svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
					<title>Go to previous slide</title>
					<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" />
					</svg>
				</button>
				<button class="splide__arrow splide__arrow--next">
					<svg viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
					<title>Go to next slide</title>
					<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" />
					</svg>
				</button>
			</div>
			<div class="splide__track">
				<ul class="splide__list">
					<?php

					/* Query Sticky Posts */
					$show_top_posts = new WP_Query(
						array(
							'posts_per_page'      => 3,
							'ignore_sticky_posts' => 1,
							'post__in'            => get_option( 'sticky_posts' ),
							'orderby'             => 'date',
							'no_found_rows'       => true,
						)
					);

					while ( $show_top_posts->have_posts() ) :
						$show_top_posts->the_post();
						?>
					<li class="SliderCutted__slide splide__slide" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="SliderCutted__inn slide__inn" itemprop="url">
							<div class="SliderCutted__inn--main">
								<div class="SliderCutted__image">
									<div class="Blog__item__tag-top post__tag-star">
										<?php _e( 'TOP POST', 'ms' ); ?>
									</div>
									<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( '' ) ); ?>"></meta>
									<img data-lasrc="<?= esc_url( get_the_post_thumbnail_url( '', 'box_archive_thumbnail' ) ); ?>" alt="<?= esc_attr( get_the_title() ); ?>" />
								</div>
								<div class="SliderCutted__content Blog__item__content">
									<div class="Blog__item__meta">
										<div class="Blog__item__meta__categories">
											<?php
											/* translators: %s: don't modify */
											$cats = get_the_taxonomies( 0, array( 'template' => __( '<span class="hidden">%s:</span><span>%l</span>' ) ) )['category'];
											$cats = str_replace( 'and', '', $cats );
											$cats = preg_replace( '/\<a(.+?)\<\/a>/', '<span$1</span>', $cats );
											echo wp_kses_post( $cats );
											?>
										</div>

										<div class="Blog__item__meta__date">
											<svg viewBox="0 0 11 12" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M8.556 5.4H2.444v1.2h6.112V5.4Zm1.222-4.2h-.611V0H7.944v1.2H3.056V0H1.833v1.2h-.61c-.68 0-1.217.54-1.217 1.2L0 10.8c0 .66.544 1.2 1.222 1.2h8.556C10.45 12 11 11.46 11 10.8V2.4c0-.66-.55-1.2-1.222-1.2Zm0 9.6H1.222V4.2h8.556v6.6Zm-3.056-3H2.444V9h4.278V7.8Z" />
												</svg>
												<span itemprop="datePublished" content="<?= esc_attr( get_the_time( 'Y-m-d' ) ); ?>">
											<?php
												the_time( 'F j, Y' );
											?>
											</span>
										</div>
									</div>
									<h3 class="SliderCutted__title Blog__slider__title" itemprop="name">
										<?php the_title(); ?>
									</h3>
									<p itemprop="abstract"><?= esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
										<span class="learn-more">
											<?php _e( 'Learn More', 'ms' ); ?>
											<svg width="15" height="13" xmlns="http://www.w3.org/2000/svg">
												<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" />
												</svg>
										</span>
									</p>
								</div>
							</div>
							<svg width="100%" height="100%" preserveAspectRatio="xMidYMax meet" class="SliderCutted__inn--mask" viewBox="0 0 1120 336"
								xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
								<path
									d="M64 76.998c0-8.836 7.163-16 16-16h1088c8.84 0 16 7.17 16 16.006v104.994c0 8.837-7.63 15.744-15.23 20.26-9.38 5.58-15.77 15.932-15.77 26.74 0 10.808 6.39 21.16 15.77 26.74 7.6 4.516 15.23 11.423 15.23 20.26v104.994c0 8.836-7.16 16.006-16 16.006H80c-8.837 0-16-7.163-16-16v-105c0-8.837 7.629-15.744 15.225-20.26C88.611 250.158 95 239.806 95 228.998c0-10.808-6.389-21.16-15.775-26.74C71.629 197.742 64 190.835 64 181.998v-105Z"
									style="fill:#fff" transform="translate(-64 -60.998)" /></svg>
						</a>
					</li>
						<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</div>
	<div class="Blog__container wrapper">
			<ul class="Blog__items">
				<?php
					global $wp_query;

					/* Gets currenty category ID */
					$categories = get_the_category();
				if ( isset( $categories[1] ) ) {
					$category_id = $categories[1]->cat_ID;
				}

				$this_category = get_queried_object();

				$query_args = array(
					'ignore_sticky_posts' => true,
					'posts_per_page'      => 9,
					'post_status'         => 'publish',
					'orderby'             => 'date',
					'no_found_rows'       => true,
				);

        if ( 0 != $this_category->parent ) { // @codingStandardsIgnoreLine
					$query_args = array(
						'ignore_sticky_posts' => true,
						'posts_per_page'      => 9,
						'post_status'         => 'publish',
						'orderby'             => 'date',
						'cat'                 => ( isset( $categories[1] ) ? $category_id : '' ),
						'no_found_rows'       => true,
					);
				}

					/* Query Other Posts */
				$show_other_posts = new WP_Query( $query_args );
				$original_query   = $wp_query;
				$wp_query       = $show_other_posts; // @codingStandardsIgnoreLine

				while ( $show_other_posts->have_posts() ) :
					$show_other_posts->the_post();
					?>
				<li itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'Blog__item' ); ?>>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">
						<div class="Blog__item__thumbnail">
							<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( '' ) ); ?>"></meta>
							<img style="opacity: 0; transition: opacity 0.2s;" data-lasrc="<?= esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?= esc_attr( get_the_title() ); ?>" />
						</div>
						<div class="Blog__item__content">
							<div class="Blog__item__meta">
								<div class="Blog__item__meta__categories">
									<?php
									/* translators: %s: don't modify */
										$cats = get_the_taxonomies( 0, array( 'template' => __( '<span class="hidden">%s:</span><span>%l</span>' ) ) )['category'];
										$cats = str_replace( ',', '', $cats );
										$cats = str_replace( 'and', '', $cats );
										$cats = preg_replace( '/\<a(.+?)\<\/a>/', '<span$1</span>', $cats );
										echo wp_kses_post( $cats );
									?>
								</div>

								<div class="Blog__item__meta__date">
									<svg viewBox="0 0 11 12" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M8.556 5.4H2.444v1.2h6.112V5.4Zm1.222-4.2h-.611V0H7.944v1.2H3.056V0H1.833v1.2h-.61c-.68 0-1.217.54-1.217 1.2L0 10.8c0 .66.544 1.2 1.222 1.2h8.556C10.45 12 11 11.46 11 10.8V2.4c0-.66-.55-1.2-1.222-1.2Zm0 9.6H1.222V4.2h8.556v6.6Zm-3.056-3H2.444V9h4.278V7.8Z" />
										</svg>
										<span itemprop="datePublished" content="<?= esc_attr( get_the_time( 'Y-m-d' ) ); ?>">
									<?php
										the_time( 'F j, Y' );
									?>
									</span>
								</div>
							</div>

							<h3 class="Blog__item__title" itemprop="name">
									<?php the_title(); ?>
							</h3>
							<p itemprop="abstract">
								<?= esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?>

								<span class="learn-more">
									<?php _e( 'Learn More', 'ms' ); ?>
									<svg width="15" height="13" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z" />
										</svg>
								</span>
							</p>
						</div>
				</a>
				</li>
				<?php endwhile; ?>
				<?php
				$wp_query = $original_query; // @codingStandardsIgnoreLine
				wp_reset_postdata();
				?>
			</ul>
			<div class="Blog__items__loading hidden"><?php _e( 'Loading', 'ms' ); ?><span>.</span><span>.</span><span>.</span></div>
	</div>
</div>
