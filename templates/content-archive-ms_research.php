<?php // @codingStandardsIgnoreLine
	set_source( 'research', 'pages/Category', 'css' );
	set_source( 'research', 'pages/Research', 'css' );
	set_source( 'research', 'filter', 'js' );
?>

	<div class="Research">
		<div class="BlogPost__header Research__header">
			<div class="Research__thumbnail">
				<img style="opacity: 0; transition: opacity .5s" data-lasrc="<?php echo esc_url( wp_upload_dir()['baseurl'] . '/2021/08/research_archive_illustration.svg' ); ?>" alt="Research archive illustration" />
			</div>
			<div class="Research__intro">
				<h1 class="Research__title"><?php _e( 'Customer service <span class="highlight-gradient">Benchmark</span> Report', 'ms' ); ?></h1>
			</div>
		</div>

		<div class="Content Research--content">
			<div class="Research--wrapper">

				<?php echo do_shortcode( '[breadcrumb]' ); ?>
				<p>
					<?php _e( 'Product quality and price competitiveness are no longer the most important factors consumers consider when making purchases. In fact, good customer service and memorable experiences are the biggest drivers of customer <a href="/blog/effective-customer-engagement-strategies-to-improve-retention/">retention</a>.', 'ms' ); ?>
				</p>

				<p class="highlight">
					<?php _e( "If businesses want to survive and stand out in today's hyper-saturated market, they must meet consumers expectations. Modern customers expect a seamless shopping experience and high-quality, speedy service. If these expectations aren't met, consumers are willing to <a href='/blog/churn-rate-101-what-is-it-how-it-is-calculated-and-how-to-reduce-it/'>churn</a> away from brands they've been loyal to for years.", 'ms' ); ?>
				</p>

				<p>
					<?php _e( "To meet consumer demands and expectations, you must apply a customer-centric approach to all aspects of your business. The best way to do this is by measuring customer service metrics, providing agent training, having a clear company mission, and implementing new technologies such as <a href='/blog/best-contact-center-software/'>customer service</a> and <a href='/blog/liveagent-recognized-as-the-best-crm-software/'>customer relationship management systems</a>. In fact, several studies have shown that an organized and well-informed customer support team can significantly affect a business' reputation, customer loyalty, and revenue stream.", 'ms' ); ?>
				</p>
			</div>

			<div class="Research--categories">
					<?php
						$categories = array_unique( get_categories( array( 'taxonomy' => 'ms_research_categories' ) ), SORT_REGULAR );
						$counter    = 0;
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
											'fields'     => 'ids',
											'orderby'    => 'menu_order',
											'order'      => 'ASC',
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
					<?php } ?>
			</div>
		</div>

	</div>
