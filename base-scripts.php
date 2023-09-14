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

	const mobile = window.matchMedia('(max-width: 768px)');

	const acceptButton = document.querySelector( ".Medovnicky__button--yes" );
	const trialButton = document.querySelector( ".createTrialButton" );

	acceptButton.addEventListener( "click", () => {
		const demobarNow = document.querySelector('#demobar');

		if( demobar ) {
			demobarNow.classList.add( 'visible' );

			setTimeout( () => {
				demobarNow.classList.add( 'show' );
			}, 5000 );
		}

		gtmWithCookie();
		consentGranted();
		grafana();
		postAffiliate();
		if ( typeof createButton == 'function' ) {
			createButton();
		}
		<?php if ( ! is_page( array( 'request-demo', 'demo', 'trial', 'free-account' ) ) ) { ?>
		if ( typeof offlineContactForm == 'function' ) {
			offlineContactForm();
		}
		<?php } ?>
	});

	if ( trialButton !== null ) {
		trialButton.addEventListener( "click", () => {
			if ( ! getCookieFrontend( "cookieLaw" ) ) {
				setCookie( 'cookieLaw', 'yes', 14 );
				document.querySelector( '.Medovnicky' ).classList.add( 'hide' );

				gtmWithCookie();
				consentGranted();
				grafana();
				postAffiliate();
			}
		});
	}
</script>

<script>
	function loadGoogle() {
		const body  = document.body;
		const gtag1 = document.createElement('script');
		gtag1.async = true;
		gtag1.src = "https://www.googletagmanager.com/gtag/js?id=G-T9HBB9KMVK";

		body.insertAdjacentElement('beforeend', gtag1);
	}

	if ( ! mobile.matches ) {
		loadGoogle()
	}

	if ( mobile.matches && getCookieFrontend( "cookieLaw" ) ) {
		loadGoogle()
	}
</script>

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

	gtag('set', 'linker', {
		'accept_incoming': true,
		'domains': [
			'liveagent.com',
			'ladesk.com',
			'liveagent.fr',
			'liveagent.de',
			'liveagent.hu',
			'liveagent.com.br',
			'liveagent.sk',
			'liveagent.es',
			'live-agent.cn',
			'live-agent.nl',
			'live-agent.it',
			'live-agent.pl',
			'live-agent.cz',
			'liveagent.vn',
			'liveagent.no',
			'liveagent.dk',
			'liveagent.gr',
			'liveagent.ro',
			'liveagent.bg',
			'liveagent.se',
			'liveagent.jp',
			'liveagent.fi',
			'liveagent.ae',
			'liveagent.ph',
			'liveagent.si',
			'liveagent.lv',
			'liveagent.lt',
			'liveagent.hr',
			'liveagent.ee',
			'liveagent.local',
			'ru.liveagent.com',
			'support.liveagent.com',
			'ladesk.com'
		]
	})

	gtag('config', 'G-T9HBB9KMVK', {
		'linker': {
			'domains': [
				'liveagent.com',
				'ladesk.com',
				'liveagent.fr',
				'liveagent.de',
				'liveagent.hu',
				'liveagent.com.br',
				'liveagent.sk',
				'liveagent.es',
				'live-agent.cn',
				'live-agent.nl',
				'live-agent.it',
				'live-agent.pl',
				'live-agent.cz',
				'liveagent.vn',
				'liveagent.no',
				'liveagent.dk',
				'liveagent.gr',
				'liveagent.ro',
				'liveagent.bg',
				'liveagent.se',
				'liveagent.jp',
				'liveagent.fi',
				'liveagent.ae',
				'liveagent.ph',
				'liveagent.si',
				'liveagent.lv',
				'liveagent.lt',
				'liveagent.hr',
				'liveagent.ee',
				'liveagent.local',
				'ru.liveagent.com',
				'support.liveagent.com',
				'ladesk.com'
			]
		}
	})

	function consentGranted() {
		gtag('consent', 'update', {
			'ad_storage': 'granted',
			'analytics_storage': 'granted'
		})
	}
</script>

<!-- Post Affiliate Pro -->
<script type="text/javascript">
	function postAffiliate() {
		(function(d,t) {
			var script = d.createElement(t); script.id= 'pap_x2s6df8d'; script.async = true;
			script.src = '//pap.qualityunit.com/scripts/m3j58hy8fd';
			script.onload = script.onreadystatechange = function() {
				var rs = this.readyState; if (rs && (rs != 'complete') && (rs != 'loaded')) return;
				PostAffTracker.setAccountId('default1');
				if ( !getCookieFrontend( "cookieLaw" ) ) {
					try {
						PostAffTracker.disableTrackingMethod('C');
						PostAffTracker.track();
					} catch (e) {}
				}
				if ( getCookieFrontend( "cookieLaw" ) ) {
					try {
						PostAffTracker.enableTrackingMethods();
						PostAffTracker.track();
					} catch (e) {}
				}
			}
			var placeholder = document.getElementById('papPlaceholder');
			placeholder.parentNode.insertBefore(script, placeholder);
		})(document, 'script');
	}

	if ( ! mobile.matches ) {
		postAffiliate()
	}

	if ( mobile.matches && getCookieFrontend( "cookieLaw" ) ) {
		postAffiliate()
	}
</script>

<!-- Grafana -->
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

	if ( ! mobile.matches ) {
		if ( getCookieFrontend( "cookieLaw" ) ) {
			grafana()
		} else {
			grafana(false)
		}
	}

	if ( mobile.matches && getCookieFrontend( "cookieLaw" ) ) {
		grafana()
	}
</script>

<!-- Google Tag Manager - Accepted Cookies -->
<script>
	function gtmWithCookie() {
		(function (w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-W7CTJXF');
	}
	if ( getCookieFrontend( "cookieLaw" ) ) {
		gtmWithCookie()
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
	require_once get_template_directory() . '/contactus-box.php';
} elseif (
		! is_page( array( 'request-demo', 'demo', 'trial', 'free-account' ) )
	) {
	?>
	<script type="text/javascript">
		function offlineContactForm() {
			(function (d, src, c) {
				var t = d.scripts[d.scripts.length - 1], s = d.createElement('script');
				s.id = 'la_x2s6df8d';
				s.defer = true;
				s.src = src;
				s.onload = s.onreadystatechange = function () {
					var rs = this.readyState;
					if (rs && (rs != 'complete') && (rs != 'loaded')) {
						return;
					}
					c(this);
				};
				t.parentElement.insertBefore(s, t.nextSibling);
			})(document, 'https://support.qualityunit.com/scripts/track.js', function (e) {
				LiveAgent.createButton('mwkja3no', e);
			});
		}

		if ( getCookieFrontend( "cookieLaw" ) ) {
			offlineContactForm()
		}
	</script>
	<?php
}
?>

<script>
	const gtmChatButton = document.querySelector( ".ContactUs__menu--link.chat" );
	const gtmNewsletterButton = document.querySelector( ".Newsletter__form button" );

	if ( gtmChatButton !== null ) {
		gtmChatButton.addEventListener( "click", () => {
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				'event': 'live_chat_contact'
			});
		});
	}

	if ( gtmNewsletterButton !== null ) {
		gtmNewsletterButton.addEventListener( "click", () => {
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				'event': 'newsletter_subscription'
			});
		});
	}
</script>
<script id="announcement-bar-scripts">

	const announcementBar = document.querySelector(".Announcement__bar");
	const isHidden = announcementBar.classList.contains("hidden");
	if (!isHidden)  {

		function showAnnouncementBar() {
			const appContainer = document.getElementById("app");
			const announcementBar = document.querySelector(".Announcement__bar");
			announcementBar.style.display = "block";
			appContainer.classList.add("announcement--active");
		}

		function hideAnnouncementBar() {
			const appContainer = document.getElementById("app");
			appContainer.classList.remove("announcement--active");
			appContainer.classList.add("announcement--hidden");
			appContainer.classList.add("announcement--closed");
			sessionStorage.setItem("announcementClosed", "true");
		}

		function initializeAnnouncementBar() {
			const appContainer = document.getElementById("app");
			const scrollHeight = window.scrollY;

			if (scrollHeight >= 800) {
				appContainer.classList.remove("announcement--hidden");
				appContainer.classList.add("announcement--active");
			}

			const closeButton = document.querySelector(".Announcement__bar__close");
			closeButton.addEventListener("click", function() {
				hideAnnouncementBar();
			});
		}

		function toggleAnnouncementBar() {
			const appContainer = document.getElementById("app");
			const scrollHeight = window.scrollY;

			const announcementClosed = sessionStorage.getItem("announcementClosed");
			if (announcementClosed === "true") {
				appContainer.classList.add("announcement--hidden");
			} else if (scrollHeight >= 800) {
				appContainer.classList.remove("announcement--active");
				appContainer.classList.add("announcement--hidden");
			} else if (!appContainer.classList.contains("announcement--closed")) {
				if (appContainer.classList.contains("announcement--hidden")) {
					appContainer.classList.add("announcement--active");
					appContainer.classList.remove("announcement--hidden");
				}
			}
		}

	}

	document.addEventListener("DOMContentLoaded", function() {
		const announcementClosed = sessionStorage.getItem("announcementClosed");
		if (!announcementClosed) {
			showAnnouncementBar();
		}
	});

	document.addEventListener("DOMContentLoaded", initializeAnnouncementBar);
	window.addEventListener("scroll", toggleAnnouncementBar);
</script>
