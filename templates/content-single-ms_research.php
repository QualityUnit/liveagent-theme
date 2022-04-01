<?php // @codingStandardsIgnoreLine
	set_custom_source( 'pages/Research', 'css' );
	set_custom_source( 'common/splide', 'css' );
	set_custom_source( 'splide', 'js' );
	set_custom_source( 'sidebar_toc', 'js' );
	set_custom_source( 'research_post', 'js' );
?>

<div class="Research" itemscope itemtype="http://schema.org/Article">
	<div class="BlogPost__header Research__header">
		<div class="Research__thumbnail">
			<meta itemprop="image" content="<?= esc_url( get_the_post_thumbnail_url( $post, 'blog_post_thumbnail' ) ); ?>"></meta>
			<?php the_post_thumbnail( 'blog_post_thumbnail' ); ?>
		</div>
		<div class="Research__intro">
			<h1 data-id="<?php echo get_the_ID(); ?>" class="Research__title" itemprop="name">
				<?php
					$pagetitle = explode( '^', get_the_title() );
				if ( isset( $pagetitle[1] ) ) {
					?>
						<?php echo esc_html( $pagetitle[0] ) . ' '; ?>
						<span class="highlight-gradient"><?php echo esc_html( $pagetitle[1] ); ?></span>
						<?php echo esc_html( ' ' . $pagetitle[2] ); ?>
						<?php
				} else {
						the_title();
				}
				?>
			</h1>
		</div>
	</div>

	<?php if ( sidebar_toc() !== false ) { ?>
		<div class="SidebarTOC-wrapper Research__sidebar__wrapper">
			<div class="SidebarTOC">
				<strong class="SidebarTOC__title"><?php _e( 'Contents', 'ms' ); ?></strong>
				<div class="SidebarTOC__slider slider splide">
					<div class="splide__track">
						<ul class="SidebarTOC__content splide__list">
							<?php echo wp_kses_post( sidebar_toc() ); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="Content Research--content" itemprop="articleBody">
		<div class="Research--wrapper Research--wrapper__navigation">
			<nav class="Research--navigation">

			<div class="Research--navigation__title"><?php _e( 'Navigation', 'ms' ); ?></div>
					<div class="Research--navigation__posts">

					<div class="Research--navigation__selected h4" data-id="<?php echo get_the_ID(); ?>"> <?php echo esc_html( str_replace( '^', '', get_the_title() ) ); ?> </div>

							<div class="Research--navigation__menu hidden">
								<ul class="Research--navigation__menu__inn">
									<?php $categories = array_unique( get_categories( array( 'taxonomy' => 'ms_research_categories' ) ), SORT_REGULAR ); ?>
									<?php
									$counter = 0;
									foreach ( $categories as $category ) {
											$query_research_posts = new WP_Query(
												array(
													'ms_research_categories' => $category->slug,
													// @codingStandardsIgnoreLine
													'posts_per_page' => 500,
													'fields'  => 'ids',
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
												<li data-id="<?php echo get_the_ID(); ?>" data-color="<?php echo esc_attr( $color ); ?>" class="Research--navigation__post Research--color-<?php echo esc_html( $color ); ?>">
													<a class="Research--navigation__post__title" href="<?php the_permalink(); ?>">
															<span class="Research--navigation__counter">
															<?php
															echo esc_html( $counter < 10 ? ( '0' . $counter ) : $counter );
															?>
														</span>
															<?php echo esc_html( str_replace( '^', '', get_the_title() ) ); ?>
													</a>
												</li>
												<?php endwhile; ?>
											<?php wp_reset_postdata(); ?>
										<?php } ?>
								</ul>
							</div>
					</div>
			</nav>
		</div>

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
