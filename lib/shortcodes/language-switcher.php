<?php

function ms_languages( $atts ) {
	$regions = array(
		'europe'  => __( 'Europe', 'ms' ),
		'asia'    => __( 'Asia', 'ms' ),
		'mideast' => __( 'Middle East', 'ms' ),
		'america' => __( 'America', 'ms' ),
	);

	$atts = shortcode_atts(
		array(
			'europe_from'  => '0',
			'europe_to'    => '22',
			'asia_from'    => '23',
			'asia_to'      => '27',
			'mideast_from' => '22',
			'mideast_to'   => '23',
			'america_from' => '27',
			'america_to'   => '29',
		),
		$atts,
		'languages'
	);


	$languages = icl_get_languages();
	foreach ( $languages as $lang ) {
			$lang_codes[]  = $lang['language_code'];
			$lang_flags[]  = strtolower( preg_replace( '/.+?_/', '', $lang['default_locale'] ) );
			$lang_urls[]   = $lang['url'];
			$lang_names[]  = $lang['native_name'];
			$lang_active[] = $lang['active'];
	}
	function create_menu( $region, $atts, $lang_urls, $lang_flags, $lang_codes, $lang_names, $lang_active ) {
		?>
		<ul>
			<?php
			for ( $i = $atts[ $region . '_from' ]; $i < $atts[ $region . '_to' ]; $i++ ) {
				?>
			<li class="Header__flags--item Header__flags--item-<?= esc_html( $lang_codes[ $i ] ) ?>" data-region="<?= esc_attr( $region ) ?>" lang="<?= esc_attr( $lang_codes[ $i ] ) ?>">
				<?php
				if ( ! $lang_active[ $i ] ) {
					?>
				<a class="Header__flags--item-link" href="<?= esc_url( $lang_urls[ $i ] ); ?>">
					<svg class="Header__flags--item-flag" aria-label="<?= esc_attr( $lang_codes[ $i ] ) ?>"><use xlink:href="#flag-<?= esc_html( $lang_flags[ $i ] ) ?>"></use></svg>
					<?= esc_html( $lang_names[ $i ] ) ?>
				</a>
					<?php
				} else {
					?>
				<span class="Header__flags--item-link active">
					<svg class="Header__flags--item-flag" aria-label="<?= esc_attr( $lang_codes[ $i ] ) ?>"><use xlink:href="#flag-<?= esc_html( $lang_flags[ $i ] ) ?>"></use></svg>
					<?= esc_html( $lang_names[ $i ] ) ?>
				</span>
					<?php
				}
				?>
			</li>
				<?php
			}
			?>
		</ul>
		<?php
	}
	ob_start();
	?>
<div class="Header__flags--main">
	<?= file_get_contents( get_template_directory_uri() . '/assets/images/flags.svg' ); //@codingStandardsIgnoreLine ?>
	<ul>
		<?php
		foreach ( $languages as $lang ) {
			if ( $lang['active'] ) {
				$lang_flag = strtolower( preg_replace( '/.+?_/', '', $lang['default_locale'] ) );
				echo '<li class="Header__flags--item Header__flags--item-active Header__flags--item-' . esc_html( $lang['language_code'] ) . '" lang="' . esc_attr( $lang['language_code'] ) . '"><span id="languageSwitcher-toggle" class="Header__flags--item-toggle"><svg class="Header__flags--item-flag" aria-label="' . esc_attr( $lang['language_code'] ) . '"><use xlink:href="#flag-' . esc_html( $lang_flag ) . '"></use></svg></span>';
			}
		}
		?>

		<div class="Header__flags--mainmenu">
		<?php
		foreach ( $regions as $region => $name ) {
			if ( ! empty( $atts[ $region . '_from' ] || $atts[ $region . '_to' ] ) ) {
				?>
					<input class="input--region hidden" name="regions" type="radio" id="<?= esc_attr( $region ) ?>" />
					<?php
			}
		}
		?>
			<div class="Header__flags--region-switchers">
				<?php
				foreach ( $regions as $region => $name ) {
					if ( ! empty( $atts[ $region . '_from' ] || $atts[ $region . '_to' ] ) ) {
						?>
				<label class="Header__flags--region-switcher" for="<?= esc_attr( $region ) ?>"><?= esc_html( $name ) ?></label>
						<?php
					}
				}
				?>
			</div>
			<div class="Header__flags--regions">
				<?php

				foreach ( $regions as $region => $name ) {
					if ( ! empty( $atts[ $region . '_from' ] || $atts[ $region . '_to' ] ) ) {
						?>
					<div class="Header__flags--region Header__flags--region-<?= esc_html( $region ) ?>">
						<div class="Header__flags--region-title h4"><?= esc_html( $name ) ?></div>
							<?php
								create_menu( $region, $atts, $lang_urls, $lang_flags, $lang_codes, $lang_names, $lang_active );
							?>
					</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		</li>
		<!-- END OF LANGUAGE MENU -->
	</ul>
</div>
	<?php
		return ob_get_clean();
}
add_shortcode( 'languages', 'ms_languages' );
