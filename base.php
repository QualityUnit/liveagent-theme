<?php
	use QualityUnit\Wrapper;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<?php get_template_part( 'lib/pagesources' ); ?>
	<body <?php body_class(); ?>>
		<div id="app">
			<?php
				do_action( 'get_header' );
				get_template_part( 'templates/header' );
			?>

			<div class="AppContainer" data-copied="<?php _e( 'Copied!', 'ms' ); ?>">
				<?php require Wrapper\template_path(); ?>
			</div>

			<?php
				do_action( 'get_footer' );
				get_template_part( 'templates/footer' );
			?>

			<div id="papPlaceholder"></div>
			<div class="fakeChatButton hidden">
				<span class="fakeChatButton__msg"><?php _e( 'Please accept our cookies before we start a chat.', 'ms' ); ?></span>
			</div>
		</div>

		<?php wp_footer(); ?>
		<script>
			const getCookieFrontend = ( name ) => {
				const nameEq = `${name}=`
				const ca = document.cookie.split( ";" )
				for ( let i = 0; i < ca.length; i += 1 ) {
					let c = ca[ i ]
					while ( c.charAt( 0 ) === " " ) {
						c = c.substring( 1, c.length )
					}
					if ( c.indexOf( nameEq ) === 0 ) {
						return c.substring( nameEq.length, c.length )
					}
				}
				return null
			}

			const acceptButton = document.querySelector( ".Kolaciky__button--yes" )
			const trialButton = document.querySelector( "#createButtonmain" )

			acceptButton.addEventListener( "click", () => {
				const demobarNow = document.querySelector('#demobar');

				if( demobar ) {
					demobarNow.classList.add( 'visible' );

					setTimeout( () => {
						demobarNow.classList.add( 'show' );
					}, 5000 );
				}

				consentGranted();
				grafana();
				gtm();
				buttonWrap();
				if ( typeof createButton == 'function' ) {
					createButton();
				}
				postAffiliate();
			});

			if ( trialButton !== null ) {
				trialButton.addEventListener( "click", () => {
					setCookie( 'cookieLaw', 'yes', 14 );
					document.querySelector( '.Kolaciky' ).classList.add( 'hide' );

					consentGranted();
					grafana();
					gtm();
					postAffiliate();
				});
			}
		</script>

		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132128640-1"></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-T9HBB9KMVK"></script>
		<script>
			window.dataLayer = window.dataLayer || []
			function gtag() { dataLayer.push(arguments) }
			gtag('js', new Date())

			gtag('consent', 'default', {
				'ad_storage': 'granted',
				'analytics_storage': 'granted'
			})

			gtag('consent', 'default', {
				'ad_storage': 'denied',
				'analytics_storage': 'denied',
				'region': ['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'IS', 'LI', 'NO']
			})

			gtag('config', 'UA-132128640-1', {
				'linker': {
						'domains': ['liveagent.com', 'liveagent.fr', 'liveagent.de', 'liveagent.hu', 'liveagent.com.br', 'liveagent.sk', 'liveagent.es', 'live-agent.cn', 'live-agent.nl', 'live-agent.it', 'live-agent.pl', 'live-agent.ru', 'live-agent.cz', 'liveagent.vn', 'liveagent.no', 'liveagent.dk', 'liveagent.gr', 'liveagent.ro', 'liveagent.bg', 'liveagent.se', 'liveagent.jp', 'liveagent.fi', 'liveagent.ae', 'liveagent.ph', 'liveagent.si', 'liveagent.lv', 'liveagent.lt', 'liveagent.hr', 'liveagent.ee', 'support.liveagent.com', 'ladesk.com', 'liveagent.local', '*.ladesk.com']
					}
			})

			gtag('config', 'G-T9HBB9KMVK', {
				'linker': {
					'domains': ['liveagent.com', 'liveagent.fr', 'liveagent.de', 'liveagent.hu', 'liveagent.com.br', 'liveagent.sk', 'liveagent.es', 'live-agent.cn', 'live-agent.nl', 'live-agent.it', 'live-agent.pl', 'live-agent.ru', 'live-agent.cz', 'liveagent.vn', 'liveagent.no', 'liveagent.dk', 'liveagent.gr', 'liveagent.ro', 'liveagent.bg', 'liveagent.se', 'liveagent.jp', 'liveagent.fi', 'liveagent.ae', 'liveagent.ph', 'liveagent.si', 'liveagent.lv', 'liveagent.lt', 'liveagent.hr', 'liveagent.ee', 'support.liveagent.com', 'ladesk.com', 'liveagent.local', '*.ladesk.com']
				}
			})

			function consentGranted() {
				gtag('consent', 'update', {
					'ad_storage': 'granted',
					'analytics_storage': 'granted'
				})
			}
		</script>

		<script>
			function grafana(cookie = true) {
				var _paq = window._paq || [];
				window._paq = _paq;

				if (cookie === false) {
					_paq.push(["disableCookies"]);
				}

				_paq.push(['enableLinkTracking']);
				_paq.push(['trackPageView']);
				_paq.push(['enableCrossDomainLinking']);
				window.onerror = function (msg, url, lineNo, columnNo, error) {
					var stackT = "";
					if (typeof(error) != 'undefined' && typeof(error.stack) != 'undefined') {
						stackT = error.stack.replace(/\n/g, ' ').substring(0, 1000);
					}
					_paq.push(['trackEvent', 'error', 'js', msg + "::" + url + "::" + lineNo + "::" + stackT, navigator.userAgent]);
				};
				(function() {
					_paq.push(['setSiteId', 'LA-web']);
					var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
					g.type='text/javascript'; g.async=true; g.defer=true; g.src='//analytics.qualityunit.com/i.js'; s.parentNode.insertBefore(g,s);
				})();
			}

			if ( getCookieFrontend( "cookieLaw" ) ) {
				grafana()
			} else {
				grafana(false)
			}
		</script>

		<!-- Google Tag Manager - Accepted Cookies -->
		<script>
			function gtm() {
				(function (w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-W7CTJXF');
			}
			if ( getCookieFrontend( "cookieLaw" ) ) {
				gtm()
			}
		</script>

		<script type="text/javascript">
			function buttonWrap() {
				setTimeout( function() {
					if ( document.querySelector( ".circleChatButtonWrap" ) != null ) {
						document.querySelectorAll( ".circleChatButtonWrap" ).forEach( ( e ) => {
							e.addEventListener( "click", () => {
								_paq.push( [ "trackEvent", "Activity", "Chat Button", "Click to Chat Button" ] )
								ga( "send", "event", "Chat Button", "start", "Click to Chat Button" )

							} )
						} )
					}
				}, 1500 )
			}
			if ( getCookieFrontend( "cookieLaw" ) ) {
				buttonWrap()
			}
		</script>

		<!-- LiveAgent - Chat Button -->
		<?php
		if (
				! is_page( array( 'request-demo', 'demo', 'trial', 'free-account', 'andrej', 'johngordon', 'michaela', 'tom', 'typing-test', 'tipptest', 'prueba-de-tipeo', 'test-de-saisie', 'test-di-digitazione', 'teste-de-digitacao', 'typetest', 'gepelesi-teszt', 'test-pisania', 'test-na-umenie-nabirat-tekst', 'dazi-ceshi' ) )
				&& ! is_post_type_archive( array( 'ms_glossary', 'ms_templates', 'ms_academy', 'ms_directory' ) )
				&& ! is_single( array( 'facebook', 'liveagent-huawei', 'twitter', 'viber', 'instagram' ) )
				&& ! is_singular( array( 'ms_glossary', 'ms_templates', 'ms_academy', 'ms_directory', 'ms_about', 'post' ) )
				&& ! is_category( array( 'blog', 'news', 'reviews', 'growth', 'support', 'live-chat', 'help-desk-software' ) )
				&& ! is_search()
			) {
			?>
			<script type="text/javascript">
			function createButton() {
				function getParameterByName( name ) {
					name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

					const regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
					const results = regex.exec(location.search);

					return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
				}

				const source = getParameterByName('utm_source');
				const brandingLinks = ['branding', 'chat', 'contactform', 'knowledge_base', 'textlink'];
				let timeout = 250;

				if ( brandingLinks.includes( source ) ) {
					timeout = 30000;
				}

				if ( window.innerWidth < 768 ) {
					timeout = 5000;
				}

				setTimeout( function() {
					(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
					'//support.qualityunit.com/scripts/track.js',
					function(e){
					<?php if ( ICL_LANGUAGE_CODE === 'de' ) { ?>
							LiveAgent.createButton('a8xw4r0d', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'fr' ) { ?>
							LiveAgent.createButton('ojy731wl', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'es' ) { ?>
							LiveAgent.createButton('ryv7oyvn', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'pt-br' ) { ?>
							LiveAgent.createButton('y7aecte9', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'hu' ) { ?>
							LiveAgent.createButton('9hrzq40p', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'nl' ) { ?>
							LiveAgent.createButton('o1zypcx0', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'pl' ) { ?>
							LiveAgent.createButton('keus4mm5', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'it' ) { ?>
							LiveAgent.createButton('28bwor7y', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'ru' ) { ?>
							LiveAgent.createButton('k88ai80o', e);
						<?php } elseif ( ICL_LANGUAGE_CODE === 'zh-hans' ) { ?>
							LiveAgent.createButton('49v7ehwf', e);
						<?php } else { ?>
							LiveAgent.createButton('443a9d07', e);
						<?php } ?>
					});
				}, timeout );
			}
				if ( getCookieFrontend( "cookieLaw" ) ) {
					createButton()
				}
			</script>
		<?php } ?>

		<!-- Post Affiliate Pro -->
		<script type="text/javascript">
			function postAffiliate() {
				(function(d,t) {
					var script = d.createElement(t); script.id= 'pap_x2s6df8d'; script.async = true;
					script.src = '//pap.qualityunit.com/scripts/m3j58hy8fd';
					script.onload = script.onreadystatechange = function() {
						var rs = this.readyState; if (rs && (rs != 'complete') && (rs != 'loaded')) return;
						PostAffTracker.setAccountId('default1');
						try { PostAffTracker.track(); } catch (e) {}
					}
					var placeholder = document.getElementById('papPlaceholder');
					placeholder.parentNode.insertBefore(script, placeholder);
					placeholder.parentNode.removeChild(placeholder);
				})(document, 'script');
			}
			if ( getCookieFrontend( "cookieLaw" ) ) {
				postAffiliate()
			}
		</script>
	</body>
</html>
