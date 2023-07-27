<?php
if ( is_front_page() ) { ?>
		<div class="Announcement__bar Ai__whisper__assistent">
			<div class="wrapper">
				<div class="Announcement__bar__col__left">
					<h2><?php _e( 'AI Whisper Assistant', 'ms' ); ?><small><?php _e( '/Private beta', 'ms' ); ?></small></h2>
					<p><?php _e( 'Suggests the responses to your agents need', 'ms' ); ?></p>
				</div>
				<div class="Announcement__bar__col__right">
					<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/ai-announcement-bar-img-right.png" alt="">
				</div>
			</div>
			<button class="Announcement__bar__close">X</button>
		</div>
	<?php
}
?>

<header class="Header urlslab-skip-keywords urlslab-skip-fragment urlslab-skip-all">
	<div class="wrapper">
		<div class="Header__logo">
			<a href="<?= esc_url( home_url( '/', 'relative' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Logo'])">
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
					<a href="<?php _e( '/demo/', 'ms' ); ?>" class="Button Button--outline" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Demo'])">
						<span><?php _e( 'Demo', 'ms' ); ?></span>
					</a>
					<a href="<?php _e( '/trial/', 'ms' ); ?>" class="Button Button--full" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Free Trial'])">
						<span><?php _e( 'Free Trial', 'ms' ); ?></span>
					</a>
				</div>

				<a href="<?php _e( '/login/', 'ms' ); ?>" class="Button Button--login" onclick="_paq.push(['trackEvent', 'Activity', 'Header', 'Login'])">
					<span><?php _e( 'Login', 'ms' ); ?></span>
					<span class="tooltip"><?php _e( 'Login', 'ms' ); ?></span>
				</a>
			</div>

			<div class="Header__flags">
				<?php
				if ( is_active_sidebar( 'header_flags' ) ) :
					dynamic_sidebar( 'header_flags' );
				endif;
				?>
			</div>
		</div>

	</div>
</header>
<script>

	document.addEventListener("DOMContentLoaded", function() {

		const body = document.body;

		const appElement = document.getElementById("app");

		if (body.classList.contains("home")) {

			appElement.classList.add("announcement--active");
		}


		const AppContainer = document.querySelector('#app');
		const closeButton = document.querySelector(".Announcement__bar__close");

		closeButton.addEventListener("click", function() {
			AppContainer.classList.remove("announcement--active");
		});

	});
	function removeAnnouncement() {
		const AppContainer = document.querySelector('#app');
		const scrollHeight = window.scrollY;

		if (scrollHeight >= 800) {
			AppContainer.classList.remove('announcement--active');
		}
	}
	window.addEventListener('scroll', removeAnnouncement);


</script>


