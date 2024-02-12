<?php
	set_custom_source( 'filter', 'js' );
	$page_header_title = __( 'Alternatives', 'alternatives' );
	$page_header_args  = array(
		'type'   => 'lvl-1',
		'image'  => array(
			'src' => get_template_directory_uri() . '/assets/images/alternatives-header_img.png?ver=' . THEME_VERSION,
			'alt' => $page_header_title,
		),
		'title'  => $page_header_title,
		'text'   => __( 'If you are just getting started with help desk software or customer service in general, you might have a problem with all those new words. We have put together complete list of customer service terminology.', 'alternatives' ),
		'search' => array( 'type' => 'alternative' ),
	);
	?>
<div id="archive" class="Archive" itemscope itemtype="https://schema.org/DefinedTermSet">
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>
	<?php echo do_shortcode( '[alternatives]' ); ?>

	<div class="wrapper__wide">
		<?php 
		echo do_shortcode( '[web_calc]' ); 
		?>
		<?php echo do_shortcode( '[urlslab-faq]' ); ?>
	</div>

</div>
<?php echo do_shortcode( '[good-hands-redesign]' ); ?>
