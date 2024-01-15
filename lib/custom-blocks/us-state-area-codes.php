<?php
require get_template_directory() . '/functions/us-states.php';

if ( isset( $args ) ) {
	$state = $args['state'];
}
$state_slug = $us_states[ $state ]['slug'];
$area_codes = $us_states[ $state ]['area_codes'];

?>
<table class="AreaCodes__table">
	<thead class="AreaCodes__table--head">
		<tr class="AreaCodes__table--row">
			<th class="AreaCodes__table--state"><?php _e( 'State', 'areacodes' ); ?></th>
			<th class="AreaCodes__table--areacodes"><?php _e( 'Area codes', 'areacodes' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr class="AreaCodes__table--row">
			<td class="AreaCodes__table--state">
				<h4 class="state" itemprop="name"><a class="item-title" href="../../usa/<?= $state_slug; // @codingStandardsIgnoreLine ?>"><?= esc_html( $state ); ?></a></h4>
			</td>
			<td class="AreaCodes__table--areacodes">
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
			</td>
		</tr>
	</tbody>
</table>
