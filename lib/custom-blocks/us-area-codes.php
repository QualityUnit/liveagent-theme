<?php
set_source( 'ms_ac_countries', 'filter', 'js' );
require get_template_directory() . '/functions/us-states.php';
?>
	<h3><?php _e( 'List of USA area codes' ); ?></h3>
	<div class="compact-header__search">
			<div class="searchField">
				<svg class="searchField__icon icon-search">
					<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#search' ) ?>"></use>
				</svg>
				<input type="search" class="search<?= esc_attr( $search_class ); ?>" placeholder="<?php _e( 'Search', 'ms' ); ?>" maxlength="50">
				<span class="search-reset">
		<svg class="search-reset__icon icon-close">
			<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ) ?>"></use>
		</svg>
	</span>
			</div>
		</div>
	<table class="AreaCodes__table list">
		<thead class="AreaCodes__table--head">
			<tr class="AreaCodes__table--row">
				<th class="AreaCodes__table--state"><?php _e( 'State', 'areacodes' ); ?></th>
				<th class="AreaCodes__table--areacodes"><?php _e( 'Area codes', 'areacodes' ); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $us_states as $state => $values ) {
			?>
			<tr class="AreaCodes__table--row">
				<td class="AreaCodes__table--state">
					<h4 class="state" itemprop="name"><a class="item-title" href="../../usa/<?= $values['slug']; // @codingStandardsIgnoreLine ?>"><?= esc_html( $state ); ?></a></h4>
				</td>
				<td class="AreaCodes__table--areacodes">
					<ul class="area-codes flex flex-wrap">
						<?php
						foreach ( $values['area_codes'] as $area_code ) {
							?>
								<li class="area-code mr-xs">
									<a class="item-excerpt" href="../../codes/us_<?= $area_code; // @codingStandardsIgnoreLine ?>"><?= esc_html( $area_code ); ?></a>
								</li>
								<?php
						}
						?>
						</ul>
				</td>
			<?php
		}
		?>
		</tbody>
	</table>
