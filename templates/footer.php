<?php
wp_enqueue_style( 'footer', get_template_directory_uri() . '/assets/dist/layouts/Footer' . isrtl() . wpenv() . '.css', false, THEME_VERSION );

if ( empty( preg_grep( '/^(login|trial|free-account|demo|request-for-proposal)$/', get_body_class() ) ) ) {
	echo do_shortcode( '[good-hands-redesign]' );
	$footer_bg = get_template_directory_uri() . '/assets/images/footer-bg.svg';
	?>

<footer class="Footer urlslab-skip-keywords urlslab-skip-fragment" data-scrollsidebars="true" style="background-image: url(<?= esc_url( $footer_bg ); ?>)">
	<div class="Footer__top">
		<div class="wrapper">
			<div class="Footer__top__row">
				<div class="Footer__top__column">
					<?php
					if ( is_active_sidebar( 'footer_column_1' ) ) :
						dynamic_sidebar( 'footer_column_1' );
					endif;
					?>
				</div>

				<div class="Footer__top__column">
					<?php
					if ( is_active_sidebar( 'footer_column_2' ) ) :
						dynamic_sidebar( 'footer_column_2' );
					endif;
					?>
				</div>

				<div class="Footer__top__column">
					<?php
					if ( is_active_sidebar( 'footer_column_3' ) ) :
						dynamic_sidebar( 'footer_column_3' );
					endif;
					?>
				</div>

				<div class="Footer__top__column">
					<?php
					if ( is_active_sidebar( 'footer_column_4' ) ) :
						dynamic_sidebar( 'footer_column_4' );
					endif;
					?>
				</div>

				<div class="Footer__top__column">
					<?php
					if ( is_active_sidebar( 'footer_column_5' ) ) :
						dynamic_sidebar( 'footer_column_5' );
					endif;
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="Footer__middle">
		<div class="wrapper">
			<div class="Footer__middle__row">
				<div class="Footer__middle__contacts">
					<div class="Footer__middle__title h5"><?php _e( 'Sales contacts', 'ms' ); ?></div>
					<ul>
						<li class="Footer__middle__contacts__phone"><a href="tel:<?php _e( '+421 2 33 456 826', 'ms' ); ?>" title="<?php _e( 'LiveAgent\'s phone number', 'ms' ); ?>"><?php _e( '+421 2 33 456 826', 'ms' ); ?></a></li>
						<li class="Footer__middle__contacts__phone"><a href="tel:<?php _e( '+1-888-257-8754', 'ms' ); ?>" title="<?php _e( 'LiveAgent\'s phone number', 'ms' ); ?>"><?php _e( '+1-888-257-8754', 'ms' ); ?></a></li>
						<li class="Footer__middle__contacts__whatsapp"><a href="https://wa.me/17862041375?text=Hi! I am contacting you from <?php the_permalink(); ?>, and I am contacting you about..." title="<?php _e( 'LiveAgent\'s WhatsApp', 'ms' ); ?>"><?php _e( '+1-786-204-1375', 'ms' ); ?></a></li>
						<li class="Footer__middle__contacts__calendar"><a href="<?php _e( '/demo/', 'ms' ); ?>" title="<?php _e( 'LiveAgent\'s demo', 'ms' ); ?>"><?php _e( 'Schedule a demo', 'ms' ); ?></a></li>
					</ul>
				</div>

				<div class="Footer__middle__social">
					<div class="Footer__middle__title h5"><?php _e( 'Socials', 'ms' ); ?></div>
					<ul>
						<?php if ( get_option( 'ms_theme_ms_footer_instagram_link' ) ) { ?>
							<li>
								<a href="<?php _e( 'https://www.instagram.com/liveagent/', 'ms' ); ?>" rel="noopener" target="_blank" title="<?php _e( 'LiveAgent\'s Instagram', 'ms' ); ?>">
									<svg>
										<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#social-instagram' ); ?>"></use>
									</svg>
								</a>
							</li>
						<?php } ?>
						<?php if ( get_option( 'ms_theme_ms_footer_facebook_link' ) ) { ?>
							<li>
								<a href="<?php _e( 'https://www.facebook.com/LiveAgent/', 'ms' ); ?>" rel="noopener" target="_blank" title="<?php _e( 'LiveAgent\'s Facebook', 'ms' ); ?>">
									<svg>
										<use xlink:href="
										<?=
										esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#social-facebook' )
										?>
										"></use>
									</svg>
								</a>
							</li>
						<?php } ?>
						<?php if ( get_option( 'ms_theme_ms_footer_twitter_link' ) ) { ?>
							<li>
								<a href="<?php _e( 'https://twitter.com/LiveAgent', 'ms' ); ?>" rel="noopener" target="_blank" title="<?php _e( 'LiveAgent\'s Twitter', 'ms' ); ?>">
									<svg>
										<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#social-twitter' ); ?>"></use>
									</svg>
								</a>
							</li>
						<?php } ?>
						<?php if ( get_option( 'ms_theme_ms_footer_linkedin_link' ) ) { ?>
							<li>
								<a href="<?php _e( 'https://www.linkedin.com/company/liveagent/', 'ms' ); ?>" rel="noopener" target="_blank" title="<?php _e( 'LiveAgent\'s LinkedIn', 'ms' ); ?>">
									<svg>
										<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#social-linkedin' ); ?>"></use>
									</svg>
								</a>
							</li>
						<?php } ?>
						<?php if ( get_option( 'ms_theme_ms_footer_youtube_link' ) ) { ?>
							<li>
								<a href="<?php _e( 'https://www.youtube.com/channel/UCSG5TrYcDozs6jkLf66taBg', 'ms' ); ?>" rel="noopener" target="_blank" title="<?php _e( 'LiveAgent\'s YouTube', 'ms' ); ?>">
									<svg>
										<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#social-youtube' ); ?>"></use>
									</svg>
								</a>
							</li>
						<?php } ?>
						<li>
							<a href="https://wa.me/17862041375?text=Hi! I am contacting you from <?php the_permalink(); ?>, and I am contacting you about..." rel="noopener" target="_blank" title="<?php _e( 'LiveAgent\'s WhatsApp', 'ms' ); ?>">
								<svg>
									<use xlink:href="<?= esc_url( get_template_directory_uri() . '/assets/images/icons.svg?ver=' . THEME_VERSION . '#social-whatsapp' ); ?>"></use>
								</svg>
							</a>
						</li>
					</ul>
				</div>

				<div class="Footer__middle__newsletter">
					<div class="Footer__middle__title h5"><?php _e( 'Subscribe to our newsletter', 'ms' ); ?></div>
					<?= do_shortcode( '[newsletterform]' ); ?>
					<div class="Footer__middle__newsletter__text">
						<p><?php _e( 'Get the latest news about LiveAgent updates and discounts', 'ms' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="Footer__bottom">
		<div class="wrapper">
			<div class="Footer__bottom__row">
				<div class="Footer__bottom__copyright">
					<p><?php _e( '© 2004-', 'ms' ); ?><?= esc_html( gmdate( 'Y' ) ); ?> <?php _e( 'Quality Unit, LLC. All rights reserved.', 'ms' ); ?></p>
				</div>
				<div class="Footer__bottom__navigation">
					<?php
					if ( has_nav_menu( 'footer_bottom_navigation' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'footer_bottom_navigation',
								'menu_class'     => 'nav',
							)
						);
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php } ?>

<div id="loader" class="invisible urlslab-skip-keywords urlslab-skip-fragment">
	<div class="loaderIn">

		<div class="BuildingApp">
				<div class="BuildingApp__progress">
					<div class="BuildingApp__progress__header">
							<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/icon_logo_liveagent.jpg" alt="<?php bloginfo( 'name' ); ?>" class="BuildingApp__progress__header__logo">
							<div class="BuildingApp__progress__header__title h2 loader-label"><?php _e( 'Building Your LiveAgent...', 'ms' ); ?></div>
						<div class="BuildingApp__progress__header__action__wrapper">
							<div class="BuildingApp__progress__header__percentage percentage">0%</div>
							<div data-id="redirectButtonPanel" style="display:none"></div>
						</div>
						<div id="progress-1" class="progress__bar__container">
							<div class="progress__bar"></div>
							<div class="progress__ball"></div>
						</div>
					</div>

					<p class="BuildingApp__progress__wrap__text"><?php _e( 'We appreciate your recent sign up for a LiveAgent. <br>A message will be sent to your email address containing login details, right after your account is installed.', 'ms' ); ?></p>
				</div>

			<?= do_shortcode( '[laIntroductionVideos]' ); ?>

		</div>
	</div>
</div>

<div class="Medovnicky urlslab-skip-all">
	<div class="wrapper">
		<p><?php _e( 'Our website uses cookies. By continuing we assume your permission to deploy cookies as detailed in our', 'ms' ); ?> <a href="<?php _e( '/privacy-policy/', 'ms' ); ?>"><?php _e( 'privacy and cookies policy', 'ms' ); ?></a><?php _e( '.', 'ms' ); ?></p>

		<div class="Medovnicky__buttons">
			<a href="#" class="Medovnicky__button Medovnicky__button--no Medovnicky__button--more Button Button--outline">
				<span><?php _e( 'Decline', 'ms' ); ?></span>
			</a>
			<a href="#" class="Medovnicky__button Medovnicky__button--yes Button Button--full">
				<span><?php _e( 'Accept', 'ms' ); ?></span>
			</a>
		</div>
	</div>
</div>

<?php
function show_demo_bar() {
	$disabled_urls = array(
		/* EN */'/demo',
		'/trial',
		'/login',
		'/pricing',
		'/about',
		'/new-york-office',
		'/blog',
		'/directory',
		'/academy',
		'/templates',
		'/request-for-proposal',
		'/partner-with-us',
		'/affiliate-program',
		'/typing-test',
		'/customer-support-glossary',
		'/terms-and-conditions',
		'/privacy-policy',
		'/security-privacy-policy',
		'/bug-bounty-program',
		/* DE */ '/testversion/',
		'/preise/',
		'/ueber-uns/',
		'/buero-in-new-york/',
		'/verzeichnis/',
		'/akademie/',
		'/email-vorlagen/',
		'/anfrage-stellen/',
		'/moechten-sie-partner-werden/',
		'/affiliateprogramm/',
		'/tipptest/',
		'/glossar/',
		'/geschaeftsbedingungen/',
		'/sicherheits-und-datenschutzrichtlinien/',
		'/bug-bounty-programm/',
		/* FR */ '/essai/',
		'/identifiant/',
		'/prix/',
		'/a-propos-de-nous/',
		'/bureau-de-new-york/',
		'/repertoire/',
		'/education/',
		'/modeles-email/',
		'/demande-doffre/',
		'/devenir-partenaire/',
		'/programme-daffiliation/',
		'/test-de-saisie/',
		'/glossaire-de-l-assistance-client/',
		'/termes-conditions/',
		'/politique-de-confidentialite/',
		'/politique-de-securite-et-de-confidentialite/',
		'/programme-prime-bug/',
		/* IT */ '/prova/',
		'/prezzi/',
		'/chi-siamo/',
		'/ufficio-di-new-york/',
		'/accademia/',
		'/template-email/',
		'/richiesta-di-proposta/',
		'/collabora-con-noi/',
		'/programma-di-affiliazione/',
		'/test-di-digitazione/',
		'/glossario/',
		'/termini-condizioni/',
		'/informativa-privacy/',
		'/informativa-sulla-privacy/',
		'/programma-bug-bounty/',
		/* NL */ '/proef/',
		'/prijzen/',
		'/over/',
		'/kantoor-in-new-york/',
		'/adresboek/',
		'/academie/',
		'/email-sjablonen/',
		'/verzoek-om-voorstel/',
		'/wilt-u-samenwerken/',
		'/partner-programma/',
		'/typetest/',
		'/klantenondersteuning-woordenlijst/',
		'/algemene-voorwaarden/',
		'/veiligheid-privacy-beleid/',
		'/bug-bounty-programma/',
		/* ES */ '/prueba/',
		'/iniciar-sesion/',
		'/tarifas/',
		'/sobre-nosotros/',
		'/oficina-de-nueva-york/',
		'/directorio/',
		'/academia/',
		'/plantillas-correo-electronico/',
		'/solicitud-de-propuesta/',
		'/quiere-asociarse/',
		'/programa-de-afiliados/',
		'/prueba-de-tipeo/',
		'/glosario/',
		'/terminos-y-condiciones/',
		'/politica-de-privacidad/',
		'/politica-de-privacidad-y-de-seguridad/',
		'/programa-bug-bounty/',
		/* PT */ '/demonstracao/',
		'/teste-gratuito/',
		'/precos/',
		'/sobre-nos/',
		'/escritorio-em-nova-york/',
		'/diretorio/',
		'/academia/',
		'/modelos-de-e-mail/',
		'/solicitacao-de-proposta/',
		'/quer-ser-parceiro/',
		'/programa-de-afiliados/',
		'/teste-de-digitacao/',
		'/glossario/',
		'/termos-e-condicoes/',
		'/politica-de-privacidade/',
		'/politica-de-privacidade-e-seguranca/',
		'/programa-caca-aos-bugs/',
		/* RU */ '/demonstraciya/',
		'/oznakomitelniy-period/',
		'/vkhod/',
		'/tsenovaya-politika/',
		'/kompania/',
		'/ofis-v-nyu-yorke/',
		'/katalog/',
		'/akademija/',
		'/shablony-elektronnoj-pochty/',
		'/zapros-predlozheniya/',
		'/khotite-sotrudnichat/',
		'/partnerskaya-programma/',
		'/test-na-umenie-nabirat-tekst/',
		'/glossarij/',
		'/polozheniya-i-usloviya/',
		'/politika-konfidencialnosti/',
		'/politika-konfidencialnosti-i-bezopasnosti/',
		'/programma-bag-baunti/',
		/* CN */ '/yan-shi/',
		'/mian-fei-shi-yong/',
		'/login/',
		'/dingjia/',
		'/guanyuwomen/',
		'/niuyue-bangongshi/',
		'/mu-lu/',
		'/xuehui/',
		'/dianzi-youjian-muban/',
		'/xuqiu-jianyi-shu/',
		'/yu-women-hezuo/',
		'/jiameng-jihua/',
		'/dazi-ceshi/',
		'/kehu-zhichi-biaodan/',
		'/tiaojian-he-tiaokuan/',
		'/yinsi-zhengce/',
		'/anquan-yinsi-zhengce/',
		'/lou-dong-bao-gao-jiang-li/',
		/* PL */ '/wersja-probna/',
		'/zaloguj-sie/',
		'/cennik/',
		'/o-nas/',
		'/biuro-w-nowym-jorku/',
		'/katalog/',
		'/akademia/',
		'/szablony-e-maili/',
		'/prosba-o-propozycje/',
		'/rozpocznij-wspolprace/',
		'/program-partnerski/',
		'/test-pisania/',
		'/slowniczek/',
		'/regulamin/',
		'/polityka-prywatnosci/',
		'/polityka-bezpieczenstwa-i-prywatnosci/',
		'/program-bug-bounty/',
		/* HU */ '/proba/',
		'/belepes/',
		'/arazas/',
		'/rolunk/',
		'/new-york-iroda/',
		'/konyvtar/',
		'/akademia/',
		'/email-sablonok/',
		'/ajanlatkeres/',
		'/tarsuljon-velunk/',
		'/partnerprogram/',
		'/gepelesi-teszt/',
		'/szojegyzek/',
		'/altalanos-szerzodesi-feltetelek/',
		'/adatvedelmi-szabalyzat/',
		'/biztonsagi-adatvedelmi-politika/',
		'/bug-bounty-program/',
		/* SK */ '/ukazka-softveru/',
		'/skusobna-verzia/',
		'/prihlasenie/',
		'/cennik/',
		'/o-nas/',
		'/adresar/',
		'/akademia/',
		'/sablony/',
		'/test-pisania/',
		'/slovnik-zakaznickej-podpory/',
	);

	foreach ( $disabled_urls as $url ) {
		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			if ( strpos( esc_url_raw( $_SERVER['REQUEST_URI'] ), $url ) !== false ) {
				return false;
			}
		}
	}

	return true;
}

if ( show_demo_bar() !== false ) {
	include_once get_template_directory() . '/demobar.php';
}
?>

<div class="trial__sticky__button">
	<a href="<?= esc_url( '/trial/' ); ?>"><?= esc_html( 'Start Free Trial', 'ms' ); ?></a>
	<span class="trial__sticky__button--close">x</span>
</div>
