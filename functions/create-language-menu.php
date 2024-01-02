<?php

function create_language_menu( $region, $atts, $lang_urls, $lang_flags, $lang_codes, $lang_names, $lang_active ) {
	$flags = get_template_directory_uri() . '/assets/images/flags.svg?ver=' . THEME_VERSION . '#';
	?>
	<ul>
		<?php
		for ( $i = $atts[ $region . '_from' ]; $i < $atts[ $region . '_to' ]; $i++ ) {
			?>
			<li class="Header__flags--item Header__flags--item-<?= esc_html( $lang_codes[ $i ] ) ?>" data-region="<?= esc_attr( $region ) ?>" lang="<?= esc_attr( $lang_codes[ $i ] ) ?>">
				<?php
				if ( ! $lang_active[ $i ] ) {
					?>
					<a class="Header__flags--item-link urlslab-skip-lazy" href="<?= esc_url( $lang_urls[ $i ] ); ?>">
						<svg class="Header__flags--item-flag" aria-label="<?= esc_attr( $lang_codes[ $i ] ) ?>"><use xlink:href="<?= esc_url( $flags ); ?>flag-<?= esc_html( $lang_flags[ $i ] ) ?>"></use></svg>
						<?= esc_html( $lang_names[ $i ] ) ?>
					</a>
					<?php
				} else {
					?>
					<span class="Header__flags--item-link active urlslab-skip-lazy">
						<svg class="Header__flags--item-flag" aria-label="<?= esc_attr( $lang_codes[ $i ] ) ?>"><use xlink:href="<?= esc_url( $flags ); ?>flag-<?= esc_html( $lang_flags[ $i ] ) ?>"></use></svg>
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
