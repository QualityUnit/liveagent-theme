<?php // @codingStandardsIgnoreLine
	set_source( 'about', 'pages/Directory', 'css' );
	set_source( 'about', 'pages/About', 'css' );
	$header_category = get_the_terms( $post->ID, 'ms_about_categories' );
if ( ! empty( $header_category ) ) {
	$header_category = array_shift( $header_category );
	$header_category = $header_category->slug;
}
?>

<div class="Post about" itemscope itemtype="http://schema.org/AboutPage">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>

	<div class="Post__header about">
		<div class="wrapper__wide"></div>
	</div>

	<div class="wrapper__wide Post__container">
		<div class="Post__sidebar">
				<ul class="Post__sidebar__links">
					<?php $categories = get_categories( array( 'taxonomy' => 'ms_about_categories' ) ); ?>

					<?php 
					if ( ! empty( $categories ) ) {
						foreach ( $categories as $category ) { 
							if ( $category->slug !== 'photos' ) { // @codingStandardsIgnoreLine
								?>
						<div id="<?= esc_attr( $category->slug ); ?>" class="Archive__container__content__item">
							<div class="Post__sidebar__title h4"><?= esc_html( $category->name ); ?></div>
								<ul>
									<?php
									$query_glossary_posts = new WP_Query(
										array(
											'ms_about_categories' => $category->slug,
										// @codingStandardsIgnoreLine
										'posts_per_page' => 500,
											'orderby'    => 'date',
											'order'      => 'ASC',
										)
									);
									while ( $query_glossary_posts->have_posts() ) :
										$query_glossary_posts->the_post();
										?>
										<li class="Post__sidebar__link">
											<span class="Post__sidebar__link-icon">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail();
											}
											?>
												</span>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
										</li>
										<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</ul>
						</div>
								<?php 
							} 
						}
					} else {
						?>
						<div class="Archive__container__content__item">
								<ul>
								<?php
								$query_glossary_posts = new WP_Query(
									array(
										'post_type'      => 'ms_about',
										// @codingStandardsIgnoreLine
										'posts_per_page' => 500,
										'orderby'        => 'date',
										'order'          => 'ASC',
									)
								);
								while ( $query_glossary_posts->have_posts() ) :
									$query_glossary_posts->the_post();
									?>
										<li class="Post__sidebar__link">
											<span class="Post__sidebar__link-icon">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail();
											}
											?>
												</span>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
										</li>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</ul>
						</div>
					<?php } ?>
				</ul>

		</div>

		<div class="Post__content">
			<div class="Post__logo Post__logo--about">
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_about-us.svg" alt="<?php _e( 'About us', 'ms' ); ?>">
			</div>
			<h1 itemprop="name" class="Post__main-title"><?php the_title(); ?></h1>

			<div class="Content" itemprop="text" >
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
