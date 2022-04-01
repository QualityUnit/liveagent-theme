<?php // @codingStandardsIgnoreLine
	set_source( 'checklists', 'pages/Checklists', 'css' );
	set_source( 'checklists', 'circleProgressBar', 'js' );
	set_source( 'checklists', 'postHeaderSmallLocking', 'js' );

	$current_id = apply_filters( 'wpml_object_id', $post->ID, 'ms_checklists' );
	$categories = get_the_terms( $current_id, 'ms_checklists_categories' );
if ( $categories ) {
	$category_id   = $categories[0]->term_id;
	$category_name = $categories[0]->name;
	$category_slug = $categories[0]->slug;
};
	$posttitle          = get_the_title();
	$posttitle_filtered = str_replace( '^', '', get_the_title() );
?>

<div class="Post Checklists">
	<div class="Post__header">
		<div class="wrapper__wide">
			<div class="Post__header__image">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="Post__header__text">
				<div class="Post__content__breadcrumbs Post__header__breadcrumbs">
					<ul >
						<li><a href="<?php _e( '/checklists/', 'ms' ); ?>"><?php _e( 'All checklists', 'ms' ); ?></a></li>
						<li><a href="<?php _e( '/checklists/', 'ms' ); ?>#<?= esc_html( $category_slug ) ?>"><?= esc_html( $category_name ); ?></a></li>
						<li><?= esc_html( $posttitle_filtered ); ?></li>
					</ul>
				</div>
				<h1 class="Post__header__title">
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
	</div>
	<?php require_once get_template_directory() . '/lib/custom-blocks/checklist-post-header-small.php'; ?>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar__wrapper">
			<div class="Post__sidebar">
					<?php if ( $categories ) { ?>
					<div class="Post__sidebar__title"><strong><?php _e( 'Other', 'ms' ); ?> <?= esc_html( $category_name ); ?> <?php _e( 'checklists', 'ms' ); ?></strong></div>

					<ul class="Post__sidebar__links">
						<?php
						$query_glossary_posts = new WP_Query(
							array(
								'post_type'      => 'ms_checklists',
								// @codingStandardsIgnoreLine
								'posts_per_page' => 500,
								'orderby'        => 'date',
								'order'          => 'ASC',
								'tax_query'      => array( // @codingStandardsIgnoreLine
									array(
										'taxonomy' => 'ms_checklists_categories',
										'field'    => 'term_id',
										'terms'    => $category_id,
									),
								),
							)
						);
						while ( $query_glossary_posts->have_posts() ) :
							$query_glossary_posts->the_post();
							if ( strcasecmp( $posttitle, get_the_title() ) ) {
								?>
								<li class="Post__sidebar__link">
									<span class="Post__sidebar__link-icon">
											<img class="searchField__icon" src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon-checklist.svg" alt="<?= esc_attr( str_replace( '^', '', get_the_title() ) ) ?>" />
									</span>
									<a href="<?php the_permalink(); ?>" title="<?= esc_attr( str_replace( '^', '', get_the_title() ) ) ?>">
										<?php
										if ( get_post_meta( get_the_ID(), 'mb_checklists_mb_checklists_sidebar_title', true ) ) {
											echo esc_html( get_post_meta( get_the_ID(), 'mb_checklists_mb_checklists_sidebar_title', true ) );
										} else {
											echo esc_html( str_replace( '^', '', get_the_title() ) );
										}
										?>
									</a>
								</li>
								<?php
							}
							endwhile;
						?>
							<?php wp_reset_postdata(); ?>
						</ul>
					<?php } ?>
			</div>
		</div>

		<div class="Signup__sidebar-wrapper">
			<?= do_shortcode( '[signup-sidebar]' ); ?>
		</div>

		<div class="Post__content">
			<div class="Content">
				<div id="checklistFakeHeader" class="Checklist__fakeHeader qu-Checklist Post__m__negative hidden">
					<div class="qu-ChecklistItem open">
						<div class="qu-ChecklistItem__header">
							<label class="qu-ChecklistItem__header--text"></label>
							<button class="qu-ChecklistItem__header__copy Button Button--outline Button--small" data-text=""><svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><path d="M16.667 6.5h-7.5A2.667 2.667 0 0 0 6.5 9.167v7.5a2.667 2.667 0 0 0 2.667 2.666h7.5a2.667 2.667 0 0 0 2.666-2.666v-7.5A2.667 2.667 0 0 0 16.667 6.5Zm0 2c.368 0 .666.298.666.667v7.5a.666.666 0 0 1-.666.666h-7.5a.666.666 0 0 1-.667-.666v-7.5c0-.369.298-.667.667-.667h7.5Z"></path><path d="M4.167 11.5h-.833a.668.668 0 0 1-.667-.667v-7.5a.665.665 0 0 1 .667-.666h7.5a.667.667 0 0 1 .666.666v.834a1.001 1.001 0 0 0 2 0v-.834c0-.707-.281-1.385-.781-1.885a2.662 2.662 0 0 0-1.885-.781h-7.5A2.666 2.666 0 0 0 .667 3.333v7.5A2.666 2.666 0 0 0 3.334 13.5h.833a1 1 0 0 0 0-2Z"></path></svg><span class="desktop--only">Copy link</span></button>
							<div class="qu-ChecklistItem__header__arrow"></div>
						</div>
					</div>
				</div>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
