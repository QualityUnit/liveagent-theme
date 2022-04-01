<?php if ( is_page() ) { ?>
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php
		if ( get_post_meta( get_the_ID(), 'mb_page_mb_page_newsletter', true ) === 'on' ) {
			echo '';
		} else {
			?>
		<div class="Newsletter Box Box--gray">
			<div class="wrapper">
				<div class="Newsletter__text">
					<div class="h3"><?php _e( 'Subscribe to our newsletter', 'ms' ); ?></div>
					<p><?php _e( 'Be the first to receive exclusive offers and the latest news on our products and services directly in your inbox.', 'ms' ); ?></p>
				</div>

				<?= do_shortcode( '[newsletterform]' ); ?>
			</div>
		</div>
			<?php
		} endwhile;
} else {
	?>
	<div class="Newsletter Box Box--gray">
		<div class="wrapper">
			<div class="Newsletter__text">
				<div class="h3"><?php _e( 'Subscribe to our newsletter', 'ms' ); ?></div>
				<p><?php _e( 'Be the first to receive exclusive offers and the latest news on our products and services directly in your inbox.', 'ms' ); ?></p>
			</div>

			<?= do_shortcode( '[newsletterform]' ); ?>
		</div>
	</div>
<?php } ?>

<footer class="Footer">
	<div class="Footer__top">
		<div class="wrapper">
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

	<div class="Footer__middle">
		<div class="wrapper">
			<div class="Footer__middle__title">
				<p><?php _e( 'Stay in Touch', 'ms' ); ?></p>
			</div>

			<div class="Footer__middle__number">
				<ul>
					<li><a href="tel:<?php _e( '+421 2 33 456 826', 'ms' ); ?>"><?php _e( '+421 2 33 456 826', 'ms' ); ?></a></li>
					<li><a href="tel:<?php _e( '+1-888-257-8754', 'ms' ); ?>"><?php _e( '+1-888-257-8754', 'ms' ); ?></a></li>
				</ul>
			</div>

			<div class="Footer__middle__social">
				<ul>
					<?php if ( get_option( 'ms_theme_ms_footer_instagram_link' ) ) { ?>
						<li>
							<a href="<?php _e( 'https://www.instagram.com/liveagent/', 'ms' ); ?>" target="_blank" title="<?php _e( 'Instagram', 'ms' ); ?>"><i class="fontello-instagram-brands"></i></a>
						</li>
					<?php } ?>
					<?php if ( get_option( 'ms_theme_ms_footer_facebook_link' ) ) { ?>
						<li>
							<a href="<?php _e( 'https://www.facebook.com/LiveAgent/', 'ms' ); ?>" target="_blank" title="<?php _e( 'Facebook', 'ms' ); ?>"><i class="fontello-facebook-square-brands"></i></a>
						</li>
					<?php } ?>
					<?php if ( get_option( 'ms_theme_ms_footer_twitter_link' ) ) { ?>
						<li>
							<a href="<?php _e( 'https://twitter.com/LiveAgent', 'ms' ); ?>" target="_blank" title="<?php _e( 'Twitter', 'ms' ); ?>"><i class="fontello-twitter-square-brands"></i></a>
						</li>
					<?php } ?>
					<?php if ( get_option( 'ms_theme_ms_footer_linkedin_link' ) ) { ?>
						<li>
							<a href="<?php _e( 'https://www.linkedin.com/company/liveagent/', 'ms' ); ?>" target="_blank" title="<?php _e( 'LinkedIn', 'ms' ); ?>"><i class="fontello-linkedin-brands"></i></a>
						</li>
					<?php } ?>
					<?php if ( get_option( 'ms_theme_ms_footer_youtube_link' ) ) { ?>
						<li>
							<a href="<?php _e( 'https://www.youtube.com/channel/UCSG5TrYcDozs6jkLf66taBg', 'ms' ); ?>" target="_blank" title="<?php _e( 'YouTube', 'ms' ); ?>"><i class="fontello-youtube-square-brands"></i></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="Footer__bottom">
		<div class="wrapper">
			<div class="Footer__bottom__copyright">
				<p><?php _e( '© 2004-', 'ms' ); ?><?= esc_html( gmdate( 'Y' ) ) ?> <?php _e( 'Quality Unit, LLC. All rights reserved.', 'ms' ); ?></p>
			</div>

			<div class="Footer__bottom__right">
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

<div id="loader" class="invisible">
	<div class="loaderIn">

		<div class="BuildingApp">
			<img src="<?= esc_url( get_template_directory_uri() ); ?>/assets/images/logo_liveagent.svg" alt="<?php bloginfo( 'name' ); ?>" class="BuildingApp__logo">

			<div id="BuildingHeader" class="BuildingApp__title BuildingApp--desktop h2"><?php _e( 'Building Your LiveAgent...', 'ms' ); ?></div>
			<p id="BuildingText" class="BuildingApp__text BuildingApp--desktop"><?php _e( 'We appreciate your recent sign up for a LiveAgent. <br>A message will be sent to your email address containing login details, right after your account is installed. <br>If you wait for a while, after installation is complete you will be able to access your account directly from here.', 'ms' ); ?></p>

			<div id="BuildingHeader" class="BuildingApp__title BuildingApp--mobile h2"><?php _e( 'We are currently building your LiveAgent dashboard...', 'ms' ); ?></div>
			<p id="BuildingText" class="BuildingApp__text BuildingApp--mobile"><?php _e( 'After the process is over, we will send the login details to your mailbox.', 'ms' ); ?></p>

			<div id="BuildingSubheader" class="BuildingApp__subtitle h4"><?php _e( 'Installation status', 'ms' ); ?></div>

			<div class="progressHeart" id="progressHeart">
				<span class="percentage">0%</span>
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 100 100">
					<path fill-opacity="0" stroke-width="1" stroke="#f4f4f4"
						d="M81.495,13.923c-11.368-5.261-26.234-0.311-31.489,11.032C44.74,13.612,29.879,8.657,18.511,13.923  C6.402,19.539,0.613,33.883,10.175,50.804c6.792,12.04,18.826,21.111,39.831,37.379c20.993-16.268,33.033-25.344,39.819-37.379  C99.387,33.883,93.598,19.539,81.495,13.923z">
					</path>
					<path id="heart-1" fill-opacity="0" stroke-width="3" stroke="#ED6A5A"
						d="M81.495,13.923c-11.368-5.261-26.234-0.311-31.489,11.032C44.74,13.612,29.879,8.657,18.511,13.923  C6.402,19.539,0.613,33.883,10.175,50.804c6.792,12.04,18.826,21.111,39.831,37.379c20.993-16.268,33.033-25.344,39.819-37.379  C99.387,33.883,93.598,19.539,81.495,13.923z">
					</path>
				</svg>
			</div>
		</div>

		<div id="redirectButtonPanel" style="display:none"></div>

		<div class="loading-bar">
			<div class="progress-bar">
				<div class="progress-stripes">////////////////////////</div>
			</div>
		</div>

		<div class="loading-info">
			<span class="loader-label"><?php _e( 'Loading...', 'ms' ); ?></span>
		</div>
	</div>
</div>

<div class="Kolaciky">
	<div class="wrapper">
		<p><?php _e( 'Our website uses cookies. By continuing we assume your permission to deploy cookies as detailed in our', 'ms' ); ?> <a href="<?php _e( '/privacy-policy/', 'ms' ); ?>"><?php _e( 'privacy and cookies policy', 'ms' ); ?></a><?php _e( '.', 'ms' ); ?></p>

		<div class="Kolaciky__buttons">
			<a href="<?php _e( '/privacy-policy/', 'ms' ); ?>" class="Kolaciky__button Kolaciky__button--more Button Button--outline">
				<span><?php _e( 'More Information', 'ms' ); ?></span>
			</a>
			<a href="#" class="Kolaciky__button Kolaciky__button--no Kolaciky__button--more Button Button--outline">
				<span><?php _e( 'Decline', 'ms' ); ?></span>
			</a>
			<a href="#" class="Kolaciky__button Kolaciky__button--yes Button Button--full">
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
	?>
	<div id="demobar" class="DemoBar__wrapper wrapper">
	<div class="DemoBar">
		<div class="DemoBar__close" id="demobar-close">&times;</div>
		<div class="DemoBar__main">
			<div class="DemoBar__title h3">
				<?php _e( '<strong>Schedule a one-on-one call</strong> and discover how LiveAgent can benefit your business.', 'ms' ); ?>
			</div>
			<div class="DemoBar__dates">
				<svg class=DemoBar__dates--icon" height="24" viewBox="0 0 25 24" width="25" xmlns="http://www.w3.org/2000/svg"><path d="m14.9678 17.7c1.3807 0 2.5-1.1193 2.5-2.5s-1.1193-2.5-2.5-2.5-2.5 1.1193-2.5 2.5 1.1193 2.5 2.5 2.5z" fill="#1ac65f"/><g fill="#fff"><path d="m16.4678 1v2h-8.00003v-2h-2v2h-1c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14.00003c1.1 0 2-.9 2-2v-14c0-1.1-.9-2-2-2h-1v-2zm3 18h-14.00003v-11h14.00003z"/><path d="m10.7676 14.2h-2.00002v2h2.00002z"/><path d="m10.7676 9.29999h-2.00002v2.00001h2.00002z"/><path d="m15.9678 9.29999h-2v2.00001h2z"/></g></svg>
				<p class="DemoBar__dates--text"><?php _e( 'We’re available on multiple dates', 'ms' ); ?></p>
			</div>
		</div>
		<a href="<?php _e( '/demo/', 'ms' ); ?>" onclick="ga( 'send', 'event', 'Demo bar Button', 'start', 'Schedule a demo' )" class="DemoBar__button Button Button--full">
			<span><?php _e( 'Schedule a demo', 'ms' ); ?></span>
		</a>
	</div>
</div>
<?php } ?>
