<?php // @codingStandardsIgnoreLine
	set_custom_source( 'pages/Category', 'css' );
	set_custom_source( 'pages/Research', 'css' );
	set_custom_source( 'filter', 'js' );
$page_header_title = __( 'Customer service Benchmark Report', 'ms' );
$page_header_args = array(
	'type' => 'lvl-1',
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_research.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title' => $page_header_title,
	'text' => the_archive_description(),
);
?>
<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<div class="Research wrapper">
		<div class="Content Research--content">

			<div class="Research--categories">
					<?php
						$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_research_categories' ) ), SORT_REGULAR );
						$counter    = 0;
					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category ) {
							?>
						<div class="<?php echo esc_attr( $category->slug ); ?> Research--category">

							<h2 class="Research--category__title">
								<span class="Research--category__image">
								<?php // @codingStandardsIgnoreStart
									echo preg_replace( '/\<a.+\>(.+)\<\/a>/', '$1', $category->category_description );
									// @codingStandardsIgnoreEnd
								?>
								</span>
								<?php echo esc_html( $category->name ); ?>
							</h2>

							<ul class="Research--post__blocks">
									<?php
									$query_research_posts = new WP_Query(
										array(
											'ms_research_categories' => $category->slug,
											// @codingStandardsIgnoreLine
											'posts_per_page' => 500,
											'post_type' => 'ms_research',
											'orderby'   => 'menu_order',
											'order'     => 'ASC',
										)
									);

									while ( $query_research_posts->have_posts() ) :
										++$counter;
										$color = $counter;
										if ( $counter % 9 == 0 ) { // @codingStandardsIgnoreLine
													$color = 9;
										}
										if ( $counter % 9 > 0 ) {
											$color = $counter % 9;
										}
										$query_research_posts->the_post();
										?>
										<li class="Research--post__block Research--color-<?php echo esc_html( $color ); ?>">
											<a class="Research--post__block__inn" href="<?php the_permalink(); ?>">
												<span class="Research--post__counter">
												<?php
												echo esc_html( $counter < 10 ? ( '0' . $counter ) : $counter );
												?>
													</span>
												<h3 class="Research--post__block--title">
													<?php echo esc_html( str_replace( '^', '', get_the_title() ) ); ?>
												</h3>
											</a>
										</li>

										<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
							</ul>
						</div>
							<?php
						}
					}
					?>
			</div>
		</div>

	</div>
