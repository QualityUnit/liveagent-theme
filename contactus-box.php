<?php
	$icons     = get_template_directory_uri() . '/assets/images/contact/';
	require_once get_template_directory() . '/chat-button.php';
?>

<div class="ContactUs__form hidden" data-targetId="contactUsForm">
	<button class="ContactUs__menu--close" data-close-target="contactUsForm" type="button">
		<svg class="icon-close"><use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ); ?>"></use></svg>
	</button>
	<script type="text/javascript">
		function showContactForm() {
			(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.defer=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document, 'https://support.qualityunit.com/scripts/track.js', function(e){ LiveAgent.createForm('99c3idgr', e); });
		}

		if ( getCookieFrontend( "cookieLaw" ) ) {
			showContactForm()
		}
	</script>
</div>

<div class="ContactUs">
	<button class="ContactUs__button flex flex-align-center" data-target="contactUsMenu" type="button">
		<span><?php _e( 'Contact Us', 'ms' ); ?></span>
		<div class="ContactUs__button--icon__wrap">
			<svg class="ContactUs__button--icon" viewBox="0 0 55 55" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"><path class="ContactUs__button--icon__path" d="M55 27.5C55 12.322 42.678 0 27.5 0S0 12.322 0 27.5 12.322 55 27.5 55 55 42.678 55 27.5ZM28.554 38.07c-2.029 2.392-4.317 5.096-7.282 5.096 1.145-1.56 1.925-3.432 2.497-5.357-7.229-1.196-12.638-5.512-12.638-10.713 0-2.549 1.768-7.594 7.593-7.594 4.733 0 8.165 3.797 8.165 8.114 0 3.276-1.56 4.473-2.444 4.473-1.04 0-1.56-.729-1.56-2.185v-7.593H20.7v.676c-.624-.624-1.56-.936-2.652-.936-4.213 0-4.889 4.213-4.889 5.565 0 1.82.936 5.617 4.889 5.617 1.3 0 2.34-.416 3.172-1.3.676 1.508 1.768 2.236 3.225 2.236 1.872 0 4.525-1.56 4.525-6.605 0-7.385-6.71-10.298-8.946-10.298C32.246 13.417 44 19.502 44 27.044c0 5.877-6.813 10.661-15.446 11.026ZM15.499 27.616c0-1.092.52-3.433 2.549-3.433 1.716 0 2.548 1.092 2.548 3.329 0 2.392-.832 3.588-2.548 3.588-1.717.052-2.549-1.144-2.549-3.484Z"/>
				<defs>
						<linearGradient id="Gradient">
								<stop offset="0%" stop-color="#ffbd39" ></stop>
								<stop offset="100%" stop-color="#fa9531" ></stop>
						</linearGradient>
				</defs>
			</svg>
		</div>
	</button>

	<nav class="ContactUs__menu--wrap hidden" data-targetId="contactUsMenu" data-hide-delay="500">
		<button class="ContactUs__menu--close" data-close-target="contactUsMenu" type="button">
			<svg class="icon-close"><use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#close' ); ?>"></use></svg>
		</button>

		<ul class="ContactUs__menu">
			<?php
			if ( is_page() ) {
				global $post;
				$phone = '+421 2 33 456 826';
				$current_id = apply_filters( 'wpml_object_id', $post->ID, 'page', false, 'en' );

				if ( $current_id ) {
					$en_slug = get_post_field( 'post_name', get_post( $current_id ) );
				}
				if ( ICL_LANGUAGE_CODE === 'en' || ICL_LANGUAGE_CODE === 'zh-hans' || ICL_LANGUAGE_CODE === 'ar' || ICL_LANGUAGE_CODE === 'ja' || ICL_LANGUAGE_CODE === 'tl' || ICL_LANGUAGE_CODE === 'vi' ) {
					$phone = '+1-888-257-8754';
				}
				if ( ICL_LANGUAGE_CODE === 'es' || ICL_LANGUAGE_CODE === 'pt-br' ) {
					$phone = '+34 886 000 035';
				}
				if ( 'pricing' === $en_slug ) {
					?>
			<li class="ContactUs__menu--item">
				<a href="tel:<?= esc_attr( preg_replace( '/(\s|-)/', '', $phone ) ); ?>" class="ContactUs__menu--link green" data-close-target="contactUsMenu">
					<?= esc_html( $phone ); ?>
					<img class="ContactUs__icon" src="<?= esc_url( $icons ); ?>phone.svg" />
				</a>
			</li>
					<?php
				}
			}
			?>
			<li class="ContactUs__menu--item">
				<div class="ContactUs__menu--link fakeChatButton no-icon hidden">
					<span class="fakeChatButton__text"><?php _e( 'Contact form', 'ms' ); ?></span>
					<img class="ContactUs__icon" src="<?= esc_url( $icons ); ?>form.svg" />
					<span class="fakeChatButton__msg"><?php _e( 'Please accept our cookies before sending contact form.', 'ms' ); ?></span>
				</div>
				<span class="ContactUs__menu--link ContactUs__menu--link__form red" data-target="contactUsForm" data-close-target="contactUsMenu">
					<?php _e( 'Contact form', 'ms' ); ?>
					<img class="ContactUs__icon" src="<?= esc_url( $icons ); ?>form.svg" />
				</span>
			</li>
			<li class="ContactUs__menu--item">
				<a href="http://m.me/LiveAgent/" class="ContactUs__menu--link violet" data-close-target="contactUsMenu">
					Messenger
					<img class="ContactUs__icon" src="<?= esc_url( $icons ); ?>messenger.svg" />
				</a>
			</li>
			<li class="ContactUs__menu--item">
				<a href="https://wa.me/17862041375?text=Hi! I am contacting you from <?php the_permalink(); ?>, can you help me?"  class="ContactUs__menu--link green" data-close-target="contactUsMenu">
					Whatsapp
					<img class="ContactUs__icon" src="<?= esc_url( $icons ); ?>whatsapp.svg" />
				</a>
			</li>
			<li class="ContactUs__menu--item">
				<div class="ContactUs__menu--link fakeChatButton hidden">
					<span class="fakeChatButton__text"><?php _e( 'Live Chat', 'ms' ); ?></span>
					<div class="ContactUs__icon fakeChatButton__icon"></div>
					<span class="fakeChatButton__msg"><?php _e( 'Please accept our cookies before we start a chat.', 'ms' ); ?></span>
				</div>
				<span class="ContactUs__menu--link chat orange" id="chatBtn" data-close-target="contactUsMenu">
					<?php _e( 'Chat', 'ms' ); ?>
				</span>
			</li>
		</ul>
	</nav>
</div>
