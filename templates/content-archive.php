<?php
	set_source( false, 'pages/blog' );
	set_source( false, 'components/BlogTopPost' );
	set_custom_source( 'blogLazyLoad', 'js', array( 'app_js' ) );

	$page_header_title = single_term_title( '', false );
	$page_header_args  = array(
		'type'  => 'lvl-1',
		'image' => array(
			'src' => get_template_directory_uri() . '/assets/images/compact_header_blog.png?ver=' . THEME_VERSION,
			'alt' => $page_header_title,
		),
		'title' => $page_header_title,
		'text'  => term_description(),
	);
	if ( has_nav_menu( 'blog_filter_navigation' ) ) :
		$menu_locations          = get_nav_menu_locations();
		$menu_id                 = $menu_locations['blog_filter_navigation'];
		$archive_nav             = wp_get_nav_menu_items( $menu_id );
		$filter_items            = array(
			array(
				'type'  => 'link',
				'name'  => 'category',
				'title' => __( 'Category', 'ms' ),
			),
		);
		$filter_items_categories = array();
		foreach ( $archive_nav as $item ) :
			$current = get_queried_object_id() == $item->object_id;
			$active  = false;
			if ( $current ) :
				$filter_items[0]['active'] = $item->title;
				$active                    = true;
			endif;
			$filter_items_categories[] = array(
				'href'   => $item->url,
				'title'  => $item->title,
				'active' => $active,
			);
		endforeach;
		$filter_items[0]['items']   = $filter_items_categories;
		$page_header_args['filter'] = $filter_items;
	endif;
	?>

	<?php

	if ( is_author() ) {

		$author_info = array(
			'name'    => get_the_author_meta( 'display_name' ),
			'img'     => get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 360 ) ),
			'text'    => get_the_author_meta( 'description' ),
			'link'    => get_author_posts_url( get_the_author_meta( 'ID' ) ),
			'website' => get_the_author_meta( 'user_url' ),
			'socials' => array(),
		);

		$social_network_keys = array( 'twitter', 'linkedin' );
		$user_id             = get_the_author_meta( 'ID' );

		foreach ( $social_network_keys as $key ) {
			$value = get_user_meta( $user_id, $key, true );
			if ( ! empty( $value ) ) {

				$author_info['socials'][] = array(
					'social_name' => $key,
					'social_link' => $value,
				);
			}
		}

		$page_header_args['author'] = $author_info;
	}
	?>
 <div id="blog" class="Blog" itemscope itemtype="http://schema.org/Blog">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="blog__top__post">
			<?php
			if ( ! is_author() ) {
				$current_category = get_queried_object();
				$show_top_args = array(
					'posts_per_page'      => 1,
					'ignore_sticky_posts' => 1,
					'post__in'            => get_option( 'sticky_posts' ),
					'orderby'             => 'date',
					'no_found_rows'       => true,
				);

				if ( $current_category instanceof WP_Term ) {
					$show_top_args['cat'] = $current_category->term_id;
				}

				$show_top_posts = new WP_Query( $show_top_args );

				while ( $show_top_posts->have_posts() ) :
					$show_top_posts->the_post();
					?>
				<div class="blog__top__post__item" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="blog__top__post__inn slide__inn" itemprop="url">
					<div class="blog__top__post__inn--main">
						<div class="blog__top__post__image">
							<div class="Blog__item__tag-top post__tag-star">
								<?php _e( 'TOP POST', 'ms' ); ?>
							</div>
							<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( '' ) ); ?>"></meta>
							<img data-src="<?= esc_url( get_the_post_thumbnail_url( '', 'box_archive_thumbnail' ) ); ?>" alt="<?= esc_attr( get_the_title() ); ?>" />
						</div>
						<div class="blog__top__post__content Blog__item__content">
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
							<h3 class="blog__top__post__title Blog__slider__title" itemprop="name">
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
					<svg width="100%" height="100%" preserveAspectRatio="xMidYMax meet" class="blog__top__post__inn--mask" viewBox="0 0 1120 336"
						xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
						<path
							d="M64 76.998c0-8.836 7.163-16 16-16h1088c8.84 0 16 7.17 16 16.006v104.994c0 8.837-7.63 15.744-15.23 20.26-9.38 5.58-15.77 15.932-15.77 26.74 0 10.808 6.39 21.16 15.77 26.74 7.6 4.516 15.23 11.423 15.23 20.26v104.994c0 8.836-7.16 16.006-16 16.006H80c-8.837 0-16-7.163-16-16v-105c0-8.837 7.629-15.744 15.225-20.26C88.611 250.158 95 239.806 95 228.998c0-10.808-6.389-21.16-15.775-26.74C71.629 197.742 64 190.835 64 181.998v-105Z"
							style="fill:#fff" transform="translate(-64 -60.998)" /></svg>
				</a>
			</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
		<?php } ?>
	</div>
	<div class="Blog__container wrapper">
			<ul class="Blog__items">
				<?php
					global $wp_query;

					/* Gets currenty category ID */
					$categories = get_the_category();

					// Get category ID
				if ( isset( $categories[1] ) ) {
					$category_id = $categories[1]->cat_ID;
				}

					$this_category      = get_queried_object();
					$sticky_posts       = get_option( 'sticky_posts' );

					// Get posts in current category
				$category_posts = array();
				if ( $this_category instanceof WP_Term ) {
					$category_posts = get_posts(
						array(
							'category' => $this_category->term_id,
							'fields' => 'ids',
						)
					);
				}

					// Get sticky posts in current category
					$category_sticky_posts = array_intersect( $sticky_posts, $category_posts );

					// Sort sticky posts by date
					rsort( $category_sticky_posts );

					// Get newest sticky post
					$newest_sticky_post = array_shift( $category_sticky_posts );

					// Query args
					$query_args = array(
						'posts_per_page' => 9,
						'post_status'    => 'publish',
						'orderby'        => 'date',
						'no_found_rows'  => true,
					);

					// If author page, query posts by author
					if ( is_author() ) {
						$user_id              = get_the_author_meta( 'ID' );
						$query_args['author'] = $user_id;

					} else {

						// If category page, query posts by category
						$query_args['ignore_sticky_posts'] = true;
						if ( $newest_sticky_post ) {
							$query_args['post__not_in'] = array( $newest_sticky_post );
						}
					}
					// If category has parent, query posts by parent category
					if ( ( $this_category && isset( $this_category->parent ) ) && 0 != $this_category->parent ) {
						$query_args['cat'] = $this_category->term_id;
					}

					/* Query Other Posts */
					$show_other_posts = new WP_Query( $query_args );
					$original_query   = $wp_query;
					$wp_query       = $show_other_posts; // @codingStandardsIgnoreLine

					// Loop through posts
					while ( $show_other_posts->have_posts() ) :
						$show_other_posts->the_post();

						// if post is sticky in current category, skip it
						if ( in_array( get_the_ID(), $category_sticky_posts ) ) {
							continue;
						}
						?>
						<li itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'Blog__item' ); ?>>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">
						<div class="Blog__item__thumbnail">
							<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( '' ) ); ?>"></meta>
							<img style="opacity: 0; transition: opacity 0.2s;" data-src="<?= esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?= esc_attr( get_the_title() ); ?>" />
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
			<div class="Blog__items__loading invisible"><?php _e( 'Loading', 'ms' ); ?><span>.</span><span>.</span><span>.</span></div>
	</div>
</div>
