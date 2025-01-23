<?php
function ms_alternatives() {
	$alternatives_posts = get_posts(
		array(
			'post_type'        => 'ms_alternatives',
			'fields'           => 'ids',
			'numberposts'      => -1,
			'order'            => 'ASC',
			'orderby'          => 'title',
			'suppress_filters' => false,
		)
	);
	set_source( false, 'shortcodes/AlternativesList' );

	ob_start();
	?>

	<ul class="Alternatives__list list">
		<?php
		foreach ( $alternatives_posts as $alternative_id ) {
			$excerpt = get_the_excerpt( $alternative_id );
			$additional_class = ( strlen( $excerpt ) > 0 ) ? 'hasExcerpt' : '';
			?>
				<li class="Alternative">
					<a class="Alternative__inn" href="<?= esc_url( get_the_permalink( $alternative_id ) ); ?>">
						<svg class="Alternative__icon <?= esc_attr( $additional_class ); ?>"
						xmlns="http://www.w3.org/2000/svg" xml:space="preserve" fill-rule="evenodd"  viewBox="0 0 17 16"><path fill="url(#a)" d="M9.743 15.664c.02.002.04.003.061.003h5A.667.667 0 0 0 15.47 15V7a1.667 1.667 0 0 0-1.666-1.667H10.47V2A1.667 1.667 0 0 0 8.804.333h-6a1.67 1.67 0 0 0-1.179.488A1.67 1.67 0 0 0 1.137 2v13c0 .368.299.667.667.667h7.875a.685.685 0 0 0 .064-.003Zm-.606-1.331V2a.334.334 0 0 0-.333-.333h-6A.335.335 0 0 0 2.47 2v12.333h2.667V13a.667.667 0 0 1 1.333 0v1.333h2.667Zm1.333 0V6.667h3.334a.334.334 0 0 1 .333.333v7.333H10.47Z"/><path fill="url(#b)" fill-rule="nonzero" d="M3.369 13.496a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm2.5 7.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm2.5 10a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm0-2.5a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Z"/><path fill="url(#c)" fill-rule="nonzero" d="M8.658 5.854a.501.501 0 0 0-.709-.708.498.498 0 0 0 .002.706.5.5 0 0 0 .707.002Z"/><path fill="url(#d)" fill-rule="nonzero" d="M8.369 3.496a.499.499 0 0 1-.419-.849.5.5 0 1 1 .419.849Zm4.435 9.004a.5.5 0 1 0-.002.998.5.5 0 0 0 .002-.998Zm0-2.5a.5.5 0 1 0-.002.998.5.5 0 0 0 .002-.998Zm0-2.5a.5.5 0 1 0-.002.998.5.5 0 0 0 .002-.998Zm-2 5a.5.5 0 1 0-.002.998.5.5 0 0 0 .002-.998Zm0-2.5a.5.5 0 1 0-.002.998.5.5 0 0 0 .002-.998Zm0-2.5a.5.5 0 1 0-.002.998.5.5 0 0 0 .002-.998Z"/><defs><linearGradient id="a" x1="0" x2="1" y1="0" y2="0" gradientTransform="matrix(13 0 0 13 1.804 8)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#ffbd39"/><stop offset="1" stop-color="#fa9531"/><stop offset="1" stop-color="#fa9531"/></linearGradient><linearGradient id="b" x1="0" x2="1" y1="0" y2="0" gradientTransform="matrix(6 0 0 6 2.804 8)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#ffbd39"/><stop offset="1" stop-color="#fa9531"/><stop offset="1" stop-color="#fa9531"/></linearGradient><linearGradient id="c" x1="0" x2="1" y1="0" y2="0" gradientTransform="scale(.99686) rotate(-45 11.074 -6.692)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#ffbd39"/><stop offset="1" stop-color="#fa9531"/><stop offset="1" stop-color="#fa9531"/></linearGradient><linearGradient id="d" x1="0" x2="1" y1="0" y2="0" gradientTransform="translate(7.804 8) scale(5.49989)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#ffbd39"/><stop offset="1" stop-color="#fa9531"/><stop offset="1" stop-color="#fa9531"/></linearGradient></defs></svg>

						<div class="Alternative__content">
							<h5 class="Alternative__title item-title"><?= esc_html( get_the_title( $alternative_id ) ); ?></h5>
							<p class="Alternative__excerpt item-excerpt"><?= esc_html( wp_trim_words( get_the_excerpt( $alternative_id ), 10 ) ); ?></p>
						</div>

						<svg class="Alternative__arrow" viewBox="0 0 13 22" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.93934 0.93934C1.52513 0.353553 2.47487 0.353553 3.06066 0.93934L12.0339 9.91255C12.6197 10.4983 12.6197 11.4481 12.0339 12.0339L3.06066 21.0071C2.47487 21.5929 1.52513 21.5929 0.93934 21.0071C0.353553 20.4213 0.353553 19.4716 0.93934 18.8858L8.85189 10.9732L0.93934 3.06066C0.353553 2.47487 0.353553 1.52513 0.93934 0.93934Z" />
						</svg>
					</a>
				</li>
			<?php
		}
		?>
	</ul>

	<?php
	return ob_get_clean();
}
add_shortcode( 'alternatives', 'ms_alternatives' );
