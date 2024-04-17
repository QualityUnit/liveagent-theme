<?php // @codingStandardsIgnoreLine
set_source( false, 'pages/Archive', 'css', false, false );

$page_header_title = __( 'Customer Service Directory', 'ms' );
$page_header_text  = __( 'Here at LiveAgent, we often get requests for help from customers of other companies. Although we at LiveAgent do not provide support for their services you can find a list of customer support contacts here. ', 'ms' );
if ( is_tax( 'ms_directory_categories' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text  = term_description();
endif;
$page_header_args = array(
	'type'  => 'lvl-1',
	'image' => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_directory.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title' => $page_header_title,
	'text'  => $page_header_text,
);
?>
<div id="archive" class="Archive Archive--glossary" itemscope itemtype="https://schema.org/DefinedTermSet">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<div class="Archive__filter">
		<div class="wrapper">
			<div class="Archive__filter__item">
				<ul class="flex">
					<?php $categories = get_categories( array( 'taxonomy' => 'ms_directory_categories' ) ); ?>
					<?php foreach ( $categories as $category ) { ?>
						<li style="display: inline-block"><a href="#<?= esc_attr( $category->slug ); ?>" title="<?= esc_attr( $category->name ); ?>"><?= esc_html( $category->name ); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="wrapper Archive__container Archive__container--glossary">
		<div class="Archive__container__content list">
			<?php $categories = get_categories( array( 'taxonomy' => 'ms_directory_categories' ) ); ?>
			<?php foreach ( $categories as $category ) { ?>
				<div id="<?= esc_attr( $category->slug ); ?>" class="Archive__container__content__item flex">
					<h2 class="Archive__container__content__item__title"><?= esc_html( $category->name ); ?></h2>
					<div class="Archive__container__content__item__content">
						<ul>
							<?php
							$query_glossary_posts = new WP_Query(
								array(
									'ms_directory_categories' => $category->slug,
									// @codingStandardsIgnoreLine
									'posts_per_page' => 500,
									'orderby'        => 'title',
									'order'          => 'ASC',
								)
							);
							while ( $query_glossary_posts->have_posts() ) :
								$query_glossary_posts->the_post();
								?>
								<?php
								if ( get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true ) ) {
									$post_title = get_post_meta( get_the_ID(), 'mb_directory_mb_directory_company-name', true );
								} else {
									$post_title = get_the_title();
								}
								?>
								<li style="display: inline-block" itemscope itemtype="https://schema.org/DefinedTerm"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $post_title ); ?> <?php _e( 'customer support contacts', 'ms' ); ?>" itemprop="url"><span itemprop="name"><?php echo esc_html( $post_title ); ?></span></a></li>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</ul>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
