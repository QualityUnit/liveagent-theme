<?php

//if ( ICL_LANGUAGE_CODE === 'en' ) {
//    header_banners(
//        array(
//            'pricing',
//        ),
//        array(
//            array(
//                'title' => __( 'Turn Clicks into Cash', 'ms' ),
//                'subtitle' => __( 'Earn Effortlessly with Post Affiliate Pro!', 'ms' ),
//                'class' => 'PAP',
//                'image' => 'AnnouncementBar-PAP.png',
//                'bg' => 'AnnouncementBar-PAP_bg.jpg',
//                'url' => __( 'https://www.postaffiliatepro.com/', 'ms' ),
//            ),
//            // array(
//            //  'title'    => __( 'Unleash the Website Wizard', 'ms' ),
//            //  'subtitle' => __( 'Experience the power of the URLsLab plugin!', 'ms' ),
//            //  'class'    => 'URLslab',
//            //  'image'    => 'AnnouncementBar-Urlslab.png',
//            //  'bg'       => 'AnnouncementBar-Urlslab_bg.jpg',
//            //  'url'      => __( 'https://www.urlslab.com/', 'ms' ),
//            // ),
//        )
//    );
//
//  header_banners(
//      array(
//          'home',
//      ),
//      array(
//          array(
//              'title' => __( 'AI Answer Assistant', 'ms' ),
//              'subtitle' => __( 'Suggests the responses to your agents need', 'ms' ),
//              'class' => 'Ai__whisper__assistent',
//              'image' => 'ai-announcement-bar-img-right.png',
//              'bg' => 'announcementBar-ai-whisper-assistant-bg.jpg',
//              'url' => __( '/features/ai-assistant/', 'ms' ),
//              'icon-class' => '', // Here insert icon class from our WordPress icons - icon after title
//          ),
//
//                  array(
//                      'title'    => __( 'AI Assistant', 'ms' ),
//                      'subtitle' => __( 'Unlock the future of support with LiveAgent’s AI Assistant!', 'ms' ),
//                      'class'    => 'ai-assistant',
//                      'image'    => 'announcementBar-ai-assistant.png',
//                      'bg'       => 'announcementBar-ai-assistant-bg.jpg',
//                      'url'      => __( '/ai-assist/', 'ms' ),
//                      'icon-class'       => 'pencil-with-stars', // Here insert icon class from our WordPress icons - icon after title
//                  ),
//      )
//  );
//}
//?>


<header class="Header urlslab-skip-keywords urlslab-skip-fragment">
	<div class="wrapper">
		<div class="Header__logo urlslab-skip-lazy">
			<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" width="121" height="30" alt="<?php bloginfo( 'name' ); ?>" class="urlslab-skip-lazy">
			</a>
		</div>

		<div class="Header__items">
			<div class="Header__mobile__hamburger">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
			</div>

			<div class="Header__navigation">
				<?php
				if ( has_nav_menu( 'header_navigation' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'header_navigation',
							'menu_class'     => 'nav',
						)
					);
				endif;
				?>
				<?php
				if ( has_nav_menu( 'header_navigation_mobile' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'header_navigation_mobile',
							'menu_class'     => 'nav',
						)
					);
				endif;
				?>
				<div class="Header__flags__mobile">
					<?php
					if ( is_active_sidebar( 'header_flags_mobile' ) ) :
						dynamic_sidebar( 'header_flags_mobile' );
					endif;
					?>
				</div>
				<div class="Header__navigation__buttons__mobile">
					<a href="<?php _e( '/demo/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Demo', 'ms' ); ?></span>
					</a>
					<a href="<?php _e( '/login/', 'ms' ); ?>" class="Button Button--login">
						<span><?php _e( 'Login', 'ms' ); ?></span>
						<span class="tooltip"><?php _e( 'Login', 'ms' ); ?></span>
					</a>
				</div>
			</div>

			<div class="Header__navigation__buttons">
				<a href="<?php _e( '/demo/', 'ms' ); ?>" class="Button Button--small Button--outline">
					<span><?php _e( 'Demo', 'ms' ); ?></span>
				</a>
				<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--small Button--full">
					<span><?php _e( 'Free Trial', 'ms' ); ?></span>
				</a>
				<a href="<?php _e( '/login/', 'ms' ); ?>" class="Button Button--login">
					<span><?php _e( 'Login', 'ms' ); ?></span>
					<span class="tooltip"><?php _e( 'Login', 'ms' ); ?></span>
				</a>
			</div>

			<!-- URLSLAB-SKIP-REPLACE-START -->
			<div class="Header__flags">
				<?php
				if ( is_active_sidebar( 'header_flags' ) ) :
					dynamic_sidebar( 'header_flags' );
				endif;
				?>
			</div>
			<!-- URLSLAB-SKIP-REPLACE-END -->
		</div>

	</div>
</header>
