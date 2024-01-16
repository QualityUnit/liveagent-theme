<?php
set_custom_source( 'components/AreaCodes-CallcenterBanner', 'css' );
?>

<div class="AreaCodes__CallcenterBanner wrapper__wide">
	<div class="wrapper">
		<div class="AreaCodes__CallcenterBanner__img">
			<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/areacodes_banner_callcenter_img.png?ver=' . THEME_VERSION ); ?>" alt="Call Center Powered by LiveAgent" />
		</div>
		<div class="AreaCodes__CallcenterBanner__text">
			<div class="h1 AreaCodes__CallcenterBanner__text--title"><?php _e( 'Call center<br />powered by LiveAgent', 'areacodes' ); ?></div>
			<p><?php _e( 'LiveAgent is the first-ever help desk and live chat software to hit the market. It’s been around since 2003, helping businesses provide impeccable support to their customers.', 'areacodes' ); ?></p>

			<div class="Buttons">
				<a href="<?php _e( '/trial', 'ms' ); ?>" class="Button Button--knockout">
					<span>
						<?php _e( 'Try 14-days free trial', 'ms' ); ?>
					</span>
				</a>
				<a href="<?php _e( '/demo', 'ms' ); ?>" class="Button Button--outline Button--outline__white">
					<span>
						<?php _e( 'Schedule a Demo', 'ms' ); ?>
					</span>
				</a>
			</div>
		</div>
	</div>
</div>
