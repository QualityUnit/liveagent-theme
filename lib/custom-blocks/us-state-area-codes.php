<?php
require get_template_directory() . '/functions/us-states.php';

if ( isset( $args ) ) {
	$state = $args['state'];
}
$state_slug = $us_states[ $state ]['slug'];
$area_codes = $us_states[ $state ]['area_codes'];

?>
<div>
  <h4 class="state" itemprop="name"><a class="item-title" href="../../usa/<?= $state_slug; // @codingStandardsIgnoreLine ?>"><?= esc_html( $state ); ?></a></h4>
  <ul class="area-codes flex flex-wrap">
	<?php
	foreach ( $area_codes as $area_code ) {
		?>
	  <li class="area-code mr-xs">
        <a class="item-excerpt" href="../../codes/us_<?= $area_code; // @codingStandardsIgnoreLine ?>"><?= esc_html( $area_code ); ?></a>
	  </li>
		<?php
	}
	?>
</ul>
</div>
