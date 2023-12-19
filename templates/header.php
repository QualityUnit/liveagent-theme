<?php
if ( is_front_page() ) {
	$is_announcement_hidden   = true; // To display the announcement bar, set it to false and vice versa
	$announcement_bar_classes = 'Announcement__bar Ai__whisper__assistent';

	if ( ! $is_announcement_hidden ) {
		?>
			<div class="Announcement__bars__slider">
				<div class="negative <?= esc_attr( $announcement_bar_classes ); ?>">
					<div class="wrapper">
						<div class="Announcement__bar__col__left urlslab-skip-all">
							<h2><?php _e( 'AI Whisper Assistant', 'ms' ); ?><small><?php _e( '/Private beta', 'ms' ); ?></small></h2>
							<p><?php _e( 'Suggests the responses to your agent\'s needs', 'ms' ); ?></p>
						</div>
						<div class="Announcement__bar__col__right">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/ai-announcement-bar-img-right.png" alt="">
						</div>
					</div>
					<button class="Announcement__bar__close">X</button>
				</div>
			</div>
		<?php
		set_custom_source( 'AnnouncementBar', 'js' );
	}
}

header_banners(
	'pricing',
	array(
		array(
			'title'    => __( 'Turn Clicks into Cash', 'ms' ),
			'subtitle' => __( 'Earn Effortlessly with Post Affiliate Pro!', 'ms' ),
			'class'    => 'PAP',
			'image'    => 'AnnouncementBar-PAP.png',
			'bg'       => 'AnnouncementBar-PAP_bg.jpg',
			'url'      => __( 'https://www.postaffiliatepro.com/', 'ms' ),
		),
		array(
			'title'    => __( 'Unleash the Website Wizard', 'ms' ),
			'subtitle' => __( 'Experience the power of the URLsLab plugin!', 'ms' ),
			'class'    => 'URLslab',
			'image'    => 'AnnouncementBar-Urlslab.png',
			'bg'       => 'AnnouncementBar-Urlslab_bg.jpg',
			'url'      => __( 'https://www.urlslab.com/', 'ms' ),
		),
	)
)
?>


<header class="Header urlslab-skip-keywords urlslab-skip-fragment urlslab-skip-all">
	<div class="wrapper">
		<div class="Header__logo">
			<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
				<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" width="121" height="30" alt="<?php bloginfo( 'name' ); ?>" class="urlslab-skip-lazy">
			</a>
		</div>

		<div class="Header__items">
			<div class="Header__mobileNavigation">
				<i class="fontello-bars-solid"></i>
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

				<div class="Header__navigation__buttons">
					<a href="<?php _e( '/demo/', 'ms' ); ?>" class="Button Button--outline">
						<span><?php _e( 'Demo', 'ms' ); ?></span>
					</a>
					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full">
						<span><?php _e( 'Free Trial', 'ms' ); ?></span>
					</a>
				</div>

				<a href="<?php _e( '/login/', 'ms' ); ?>" class="Button Button--login">
					<span><?php _e( 'Login', 'ms' ); ?></span>
					<span class="tooltip"><?php _e( 'Login', 'ms' ); ?></span>
				</a>
			</div>

			<div class="Header__flags urlslab-skip-all">
				<?php
				if ( is_active_sidebar( 'header_flags' ) ) :
					dynamic_sidebar( 'header_flags' );
				endif;
				?>
			</div>
		</div>

	</div>
</header>
