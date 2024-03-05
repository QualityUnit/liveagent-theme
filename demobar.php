<?php
	set_custom_source( 'components/DemoBar', 'css' );
	set_custom_source( 'demobar', 'js', array( 'app_js' ) );
?>

<div id="demobar" class="DemoBar hidden">
	<div class="DemoBar__wrapper wrapper">
		<span class="DemoBar__close" id="demobar-close">
			<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/icon-close-circular.svg' ); ?>" alt="Close" />
		</span>
			<div class="DemoBar__image">
				<img src="<?= esc_url( get_template_directory_uri() . '/assets/images/schedule_demo_panel.png' ); ?>" alt="<?php _e( 'Schedule a demo', 'demobar' ); ?>" />
			</div>
			<div class="DemoBar__text">
				<strong class="DemoBar__title h2">
					<?php _e( 'Schedule a one-on-one call', 'demobar' ); ?>
				</strong>
				<ul class="checklist">
					<li>
						<?php _e( 'How to achieve your business goals with LiveAgent', 'demobar' ); ?>
					</li>
					<li>
						<?php _e( 'Tour of the LiveAgent so you can get an idea of how it works', 'demobar' ); ?>
					</li>
					<li>
						<?php _e( 'Answers to any questions you may have about LiveAgent', 'demobar' ); ?>
					</li>
				</ul>
				<a href="<?php _e( '/demo/', 'ms' ); ?>" onclick="ga( 'send', 'event', 'Demo bar Button', 'start', 'Schedule a demo' )" class="DemoBar__button Button Button--dark">
					<span><?php _e( 'Schedule a demo', 'ms' ); ?></span>
				</a>
		</div>
	</div>
</div>
