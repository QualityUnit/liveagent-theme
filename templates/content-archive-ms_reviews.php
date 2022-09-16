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
	<div class="wrapper">
		<h2>
			<?= $post_title // @codingStandardsIgnoreLine ?>
		</h2>
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
		// require_once get_template_directory() . '/templates/content-archive-ms_reviews-sorting.php';
		?>
		<div class="Reviews__header Reviews__header-level2 FullHeadline">
			<div class="wrapper text-align-center">
				<h2 class="FullHeadline__title">
					<?= esc_html( $subpage->name ); ?>
				</h2>
				<h3 class="FullHeadline__subtitle">
					<?= esc_html( $subpage->description ); ?>
				</h3>
			</div>
		</div>
		<div class="wrapper__wide flex-direction-column">
			<?php require_once get_template_directory() . '/templates/content-archive-ms_reviews-posts.php'; ?>
		</div>
		<?php
	}
	?>
</div>
