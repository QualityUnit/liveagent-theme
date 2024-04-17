<?php
function header_banners( $page, $banners_array ) {
	// $banners_array = array=(array(title, subtitle, image, class, url), array(title, subtitle, image, class, url))
	if ( wp_head_content( $page ) ) {
		set_source( false, 'components/AnnouncementBar', 'css' );
		?>
		<style type="text/css">
				@media (min-width: 768px) {
					body .announcement--active {
					padding-top: 10.625em !important;
					}
					body .announcement--active .Header {
					top: 7.5em;
					-webkit-animation: top 0.3s ease;
							animation: top 0.3s ease;
					}
					body .announcement--active .Header .sub-menu {
					top: 12em;
					}
				}
		</style>
		<div class="Announcement__bars__slider">
		<?php
		foreach ( $banners_array as $index => $banner ) {
			?>
			<a class="Announcement__bar <?= esc_attr( $banner['class'] . ( 0 === $index ? ' active' : '' ) ); ?>" href="<?= esc_url_raw( $banner['url'] ); ?>" target="_blank" style="background: url(<?= esc_attr( $banner['bg'] ? ( get_template_directory_uri() . '/assets/images/' . $banner['bg'] . ')' ) : 'linear-gradient(87deg, rgba(254, 181, 109, 0.30) -2.57%, rgba(255, 172, 90, 0.30) -2.55%, rgba(169, 188, 255, 0.30) 103.31%)' ); ?>">
				<div class="wrapper">
					<div class="Announcement__bar__col__left">
						<h2><?= esc_html( $banner['title'] ); ?>
						<!-- added icon after title	-->
						<?php if ( isset( $banner['icon-class'] ) ) { ?>
							<svg class="icon icon-<?= esc_html( $banner['icon-class'] ); ?>">
								<use xlink:href="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icons.svg#<?= esc_attr( $banner['icon-class'] ); ?>"></use>
							</svg>
						<?php } ?>
						</h2>
						<p><?= esc_html( $banner['subtitle'] ); ?></p>
					</div>
					<div class="Announcement__bar__col__right">
						<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/<?= esc_attr( $banner['image'] ); ?>" alt="">
					</div>
				</div>
			</a>
			<?php
		}
		?>
			<button class="Announcement__bar__close"><img src="<?= esc_url( get_template_directory_uri() . '/assets/images/icon-close.svg?ver=?' . THEME_VERSION ); ?>"</button>
		</div>
		<?php
		set_custom_source( 'AnnouncementBar', 'js' );
	}
}
?>
