<?php // @codingStandardsIgnoreLine
set_custom_source( 'pages/AreaCodes', 'css' );
set_custom_source( 'filter', 'js' );

$page_header_title = __( 'Area Codes', 'ms' );
$page_header_text  = __(
	'Find out which software in any category is the best option for your business. You are just getting started with help desk software or customer service in general, you might have a problem with all those new words. We have put together complete list of customer service terminology.',
	'ms' 
);
if ( is_tax( 'ms_areacodes_regions' ) ) :
	$page_header_title = single_term_title( '', false );
	$page_header_text  = term_description();
endif;
$page_header_args = array(
	'type'   => 'lvl-1',
	'image'  => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_areacodes_countries.png?ver=' . THEME_VERSION,
		'alt' => $page_header_title,
	),
	'title'  => $page_header_title,
	'text'   => $page_header_text,
	'search' => array(
		'type' => 'academy',
	),
);
?>
<div id="archive" class="Archive AreaCodes" itemscope itemtype="https://schema.org/ItemList">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper">
		<div class="AreaCodes__list list">
			<?php $regions = get_categories( array( 'taxonomy' => 'ms_areacodes_regions' ) ); ?>
			<?php foreach ( $regions as $region ) { ?>
				<div id="<?= esc_attr( $region->slug ); ?>" class="AreaCodes__Region">
					<h2 class="AreaCodes__Region--name" ><?= esc_html( $region->name ); ?></h2>
					<ul class="Country__list">
						<?php
						$query_regions_posts = new WP_Query(
							array(
								'ms_areacodes_regions' => $region->slug,
								'post_type'            => 'ms_ac_countries',
								'posts_per_page'       => -1,
								'orderby'              => 'title',
								'order'                => 'ASC',
							)
						);
						while ( $query_regions_posts->have_posts() ) :
							$query_regions_posts->the_post();
							$assets_path = get_template_directory_uri() . '/assets/';
							$flag_path   = $assets_path . 'country_flags/' . get_post_meta( get_the_ID() )['iso_code'][0] . '.svg';
							?>
							<li class="Country" itemscope itempro="location" itemtype="https://schema.org/Place">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">
									<img class="Country__flag" src="<?= esc_url( $flag_path ); ?>" alt="<?php esc_attr( get_the_title() ); ?>" />
									<span class="item-title" itemprop="name"><?php the_title(); ?></span>
									<img class="Country__arrow" src="<?= esc_url( $assets_path . 'images/arrow_right_white.svg' ); ?>" alt="Go to Country" />
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
