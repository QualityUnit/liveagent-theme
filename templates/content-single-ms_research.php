<?php // @codingStandardsIgnoreLine
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'research_post', 'js' );
$page_title       = str_replace( '^', '', get_the_title() );
$page_header_args = array(
	'image'        => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_research.png?ver=' . THEME_VERSION,
		'alt' => $page_title,
	),
	'title'        => $page_title,
	'text'         => do_shortcode( '[urlslab-generator id="6"]' ),
	'research_nav' => true,
	'toc'          => true,
);
?>
<div class="Post Research Post--sidebar-right" itemscope itemtype="http://schema.org/Article" data-id="<?= esc_attr( get_the_ID() ); ?>">

	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">
		<div class="Post__content">
			<div class="Content" itemprop="articleBody">

				<?php the_content(); ?>

				<div class="Research--toc__wrapper">
					<div class="Research--toc">
						<div class="Research--toc__title h4"><?php _e( 'Table of content', 'ms' ); ?></div>
						<div class="Research--toc__categories">
							<?php $categories = get_categories( array( 'taxonomy' => 'ms_research_categories' ) ); ?>
							<?php
							$counter = 0;
							foreach ( $categories as $category ) {
								?>
								<div class="<?php echo esc_attr( $category->slug ); ?> Research--toc__category">
									<div class="Research--toc__category__title h5">
									<span class="Research--toc__category__image">
										<?php
										// @codingStandardsIgnoreLine
										echo preg_replace( '/\<a.+\>(.+)\<\/a>/', '$1', $category->category_description );
										?>
									</span>
										<?php echo esc_html( $category->name ); ?>
									</div>
									<ul class="Research--toc__posts">
										<?php
										$query_research_posts = new WP_Query(
											array(
												'ms_research_categories' => $category->slug,
										        // @codingStandardsIgnoreLine
										        'posts_per_page' => 500,
												'orderby' => 'menu_order',
												'order'   => 'ASC',
											)
										);

										while ( $query_research_posts->have_posts() ) :
											$query_research_posts->the_post();
											++$counter;
											$color = $counter;
									        if ( $counter % 9 == 0 ) { // @codingStandardsIgnoreLine
												$color = 9;
											}
											if ( $counter % 9 > 0 ) {
												$color = $counter % 9;
											}
											?>
											<li class="Research--toc__post Research--color-<?php echo esc_html( $color ); ?>">
												<a class="Research--toc__post__title" href="<?php the_permalink(); ?>">
													<span class="Research--toc__counter">
														<?php
														echo esc_html( $counter < 10 ? ( '0' . $counter ) : $counter );
														?>
													</span>
													<?php echo esc_html( str_replace( '^', '', get_the_title() ) ); ?>
												</a>
											</li>

										<?php endwhile; ?>
										<?php wp_reset_postdata(); ?>
									</ul>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
