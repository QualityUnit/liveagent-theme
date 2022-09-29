<?php // @codingStandardsIgnoreLine
	set_custom_source( 'pages/Reviews', 'css' );
	set_custom_source( 'pages/post', 'css' );
	set_custom_source( 'blogLazyLoad', 'js', array( 'app_js' ) );

	$subpage = get_queried_object();

	$main_page = get_posts(
		array(
			'name'      => 'how-we-review',
			'post_type' => 'ms_reviews',
		)
	);

	if ( $main_page ) {
		$main_page_id  = $main_page[0]->ID;
		$translated_id = apply_filters( 'wpml_object_id', $main_page_id, 'ms_reviews' );

		$mainpost     = get_post( $translated_id );
		$post_title   = $mainpost->post_title;
		$post_content = $mainpost->post_content;
	}
	?>
<div id="blog" class="Blog" itemscope itemtype="http://schema.org/Blog">
	<?php 
	// Main page level 1
	if ( ! isset( $subpage->slug ) ) {
			require_once get_template_directory() . '/templates/content-archive-ms_reviews-categories.php';
		?>
	<div class="wrapper mt-xxl">
		<?= do_shortcode( '[split-title title="' . $post_title . '"]' ); ?>
		<div class="Content">
			<?php
				$content = apply_filters( 'the_content', $post_content );
				echo $content // @codingStandardsIgnoreLine;
			?>
		</div>
	</div>
		<?php
	}

	// Category page level 2
	if ( isset( $subpage->slug ) ) {
		?>
		<div class="Reviews__header Reviews__header-level2">
			<div class="wrapper text-align-center">
				<div class="Post__content__breadcrumbs ma-bottom">
					<ul>
						<li><a href="<?php _e( '/reviews/', 'ms' ); ?>"><?php _e( 'Reviews', 'ms' ); ?></a></li>
						<li><?= esc_html( $subpage->name ); ?></li>
					</ul>
				</div>
				<h2 class="FullHeadline__title">
					<?= esc_html( $subpage->name ); ?>
				</h2>
				<h3 class="FullHeadline__subtitle">
					<?= esc_html( $subpage->description ); ?>
				</h3>
				<?php require_once get_template_directory() . '/templates/content-archive-ms_reviews-sorting.php'; ?>
			</div>
		</div>
		<?php require_once get_template_directory() . '/templates/content-archive-ms_reviews-posts.php'; ?>

		<div class="wrapper">
			<div class="Reviews__categoryAbout">
				<img 
					class="Reviews__categoryAbout--bulb"
					src="<?= esc_url( get_template_directory_uri() . '/assets/images/reviews_bulb_big.svg' ); ?>"
					alt="<?= esc_html( get_term_meta( $subpage->term_id, 'description_title', true ) ); ?>"
				/>
				<div class="Reviews__categoryAbout--description">
					<h2 class="Reviews__categoryAbout--title"><?= esc_html( get_term_meta( $subpage->term_id, 'category_description_title', true ) ); ?></h2>
					<p class="Reviews__categoryAbout--text">
						<?= esc_html( get_term_meta( $subpage->term_id, 'category_description', true ) ); ?>
					</p>
					<span class="learn-more">
						<a href="<?= esc_url( get_term_meta( $subpage->term_id, 'category_learn_more_url', true ) ); ?>"
						>
							<?= esc_html( get_term_meta( $subpage->term_id, 'category_learn_more', true ) ); ?>
						</a>
					</span>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>
