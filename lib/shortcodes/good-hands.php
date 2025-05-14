<?php

// Hiding old shortcode block
function ms_good_hands( $atts ) {
	return;
}

function ms_good_hands_redesign( $atts ) {
	$atts = shortcode_atts(
		array(
			'clients'       => 0,
			'partnerwithus' => 'false',
		),
		$atts,
		'good-hands-redesign'
	);

	ob_start();
	?>

	<section class="GoodHands hidden
	<?= esc_attr( 'false' === $atts['partnerwithus'] ? '' : 'partnerWithUs' ); ?> ">
		<div class="wrapper">
			<div class="GoodHands__text">
				<h3><?php 'false' === $atts['partnerwithus'] ? _e( 'You will be<br/>in Good Hands!', 'ms' ) : _e( 'Join the LiveAgent family!', 'ms' ); ?></h3>
				<p><?php 'false' === $atts['partnerwithus'] ? _e( 'Join our community of happy clients and provide excellent customer support with LiveAgent.', 'ms' ) : _e( 'Become a LiveAgent partner, enrich your local market, and have fun doing it !', 'ms' ); ?></p>

				<div class="Buttons">
					<?php
					if ( 'false' === $atts['partnerwithus'] ) {
						?>

					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--medium Button--full">
						<span><?php _e( 'Start 30-days free trial', 'ms' ); ?></span>
					</a>
					<a href="<?php _e( '/demo/', 'ms' ); ?>" onclick="ga( 'send', 'event', 'Demo bar Button', 'start', 'Schedule a demo' )" class="Button Button--medium Button--outline">
						<span><?php _e( 'Schedule a demo', 'ms' ); ?></span>
					</a>
					<?php } else { ?>
						<script type="text/javascript" data-wpfc-render="false">
							(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
							'//support.qualityunit.com/scripts/track.js',
							function(e){ LiveAgent.createButton('96eda9c4', e); });
							</script>
					<?php } ?>
				</div>
			</div>

			<div class="GoodHands__image">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/' . ( 'false' === $atts['partnerwithus'] ? 'goodhands_image.png' : 'partner_with_us_bottom.png' ) . '?ver=' . THEME_VERSION ); ?>" alt="<?php _e( 'Schedule a demo', 'ms' ); ?>" />
			</div>
		</div>
	</section>

	<script>

		function showGoodHands() {
			const goodhands = document.querySelector('.GoodHands');
			goodhands.classList.remove('hidden');
		}

		window.addEventListener('load', () => {
			showGoodHands();
			window.removeEventListener('load', showGoodHands);
		});
	</script>

	<?php
	return ob_get_clean();
}
add_shortcode( 'good-hands', 'ms_good_hands' );
add_shortcode( 'good-hands-redesign', 'ms_good_hands_redesign' );
