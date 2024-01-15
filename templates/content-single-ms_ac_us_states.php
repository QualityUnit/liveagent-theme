<?php // @codingStandardsIgnoreLine
set_custom_source( 'pages/AreaCodes', 'css' );
require get_template_directory() . '/functions/us-states.php';
$state        = get_the_title();
$capital_city = $us_states[ $state ]['major_city'];
$gmt_zone     = $us_states[ $state ]['gmt_timezone_info'];
$gmt_diff     = $us_states[ $state ]['gmt_timezone_diff'];

$state_args = array(
	'state' => $state,
);

$flag_path = get_template_directory_uri() . '/assets/us_states_flags/flags/' . str_replace( ' ', '_', $state ) . '.svg';

$page_header_logo = array(
	'src' => $flag_path . '?ver=' . THEME_VERSION,
	'alt' => $state,
);

$page_header_args = array(
	'image'             => array(
		'src' => get_template_directory_uri() . '/assets/images/compact_header_glossary.png?ver=' . THEME_VERSION,
		'alt' => $state,
	),
	'titlelogo'         => $page_header_logo,
	'title'             => $state,
	'areacode_info'     => array(
		__( 'State', 'areacodes' )      => $state,
		__( 'Major city', 'areacodes' ) => $capital_city,
		__( 'Time zone', 'areacodes' )  => $gmt_zone,
	),
	'areacode_gmt_diff' => $gmt_diff,
	'toc'               => true,
	'cta_button'        => get_cta_button_data(),
);

?>
<div class="Post Post--sidebar-right" itemscope itempro="location" itemtype="https://schema.org/Place">
	<meta itemprop="url" content="<?= esc_url( get_permalink() ); ?>">
	<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="LiveAgent"></span>
	<?php get_template_part( 'lib/custom-blocks/compact-header', null, $page_header_args ); ?>

	<div class="wrapper Post__container">
		<div class="Post__sidebar">
			<div class="Signup__sidebar-wrapper">
				<?= do_shortcode( '[signup-sidebar js-sticky="true"]' ); ?>
			</div>
		</div>
		<div class="Post__content">

			<div class="Content" itemprop="articleBody">
				<div style="position: relative; width: 100%; height: 0; padding-bottom: 40%; overflow: hidden"><iframe frameborder="0" style="border:0; position: absolute; top: 0; left: 0;	margin: 0 !important;	width: 100% !important;	height: 100% !important;" scrolling="no" src="https://maps.google.com/maps?hl=en&amp;q='<?= esc_attr( get_the_title() ); ?>&amp;t=&amp;z=5&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>

				<?= do_shortcode( '[urlslab-generator id="7" country_name="' . get_the_title() . '"]' ); ?>

				<?php the_content(); ?>

				<?php get_template_part( 'lib/custom-blocks/us-state-area-codes', null, $state_args ); ?>

				<h3><?php _e( 'Area code and other parts of a phone number', 'areacodes' ); ?></h3>
				<p>
					<?php _e( 'You`ve gone through the different area codes in the United States, but what do these numbers really mean? Phone numbers in the United States typically consist of 11 digits — the 1-digit country code, a 3-digit area code and a 7-digit telephone number. The 7-digit telephone number is further comprised of a 3-digit central office or exchange code and a 4-digit subscriber number. The country code of USA is +1. It is unique for every country. Area codes are of two types — local and toll-free. 800, 844, 855, 866, 877, and 888 are the different toll-free codes. All the remaining area codes represent the geopgraphic region to which a phone number belongs. The central office code denotes the telephone exchange to which the phone number is mapped. The last four digits, the subscriber number, is unique to each telephone line in the area served by the associated central exchange. These four digits are typically used by businesses to provide vanity numbers that offer great top-of-the-mind recall.', 'areacodes' ); ?>
				</p>
			</div>
		</div>
	</div>
</div>
