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

		if( demobarNow ) {
			demobarNow.classList.add( 'visible' );

			setTimeout( () => {
				demobarNow.classList.add( 'show' );
			}, 5000 );
		}

		consentGranted();
		grafana();
		postAffiliate();
		loadCapterra();

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

				consentGranted();
				grafana();
				postAffiliate();
				loadCapterra();
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

	// Default cookie permission for the rest of the world
	gtag('consent', 'default', {
		'ad_storage': 'granted',
		'ad_user_data': 'granted',
		'ad_personalization': 'granted',
		'analytics_storage': 'granted',
		'functionality_storage': 'granted',
	});

	// ✅ Override settings: Block cookies for EU countries
	gtag('consent', 'default', {
		'ad_storage': 'denied',
		'ad_user_data': 'denied',
		'ad_personalization': 'denied',
		'analytics_storage': 'denied',
		'functionality_storage': 'denied',
		'region': ['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'IS', 'LI', 'NO']
	});

	gtag('config', 'G-T9HBB9KMVK', {
		'allow_enhanced_conversions': true,
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

	gtag('config', 'AW-966671101', {
		'allow_enhanced_conversions': true,
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

	// After consent is granted, all cookies and tracking are enabled
	function consentGranted() {
		gtag('consent', 'update', {
			'ad_storage': 'granted',  // Advertising cookies (Google Ads)
			'ad_user_data': 'granted', // Data for Google Ads
			'ad_personalization': 'granted', // Personalized ads
			'analytics_storage': 'granted', // Google Analytics cookies
			'functionality_storage': 'granted', // Functional cookies
		})
		
		// Grant consent for Capterra tracking after script is loaded
		setTimeout(() => {
			if (window.ct && window.ct.grantConsent) {
				window.ct.grantConsent();
			}
		}, 100);
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

		// _paq.push(['enableLinkTracking']);
		_paq.push(['trackPageView']);
		_paq.push(['enableCrossDomainLinking']);
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


<?php
if (
		! is_page( array( 'pricing', 'request-demo', 'demo', 'trial', 'thank-you', 'redeem-code', 'free-account', 'tom', 'typing-test', 'tipptest', 'prueba-de-tipeo', 'test-de-saisie', 'test-di-digitazione', 'teste-de-digitacao', 'typetest', 'gepelesi-teszt', 'test-pisania', 'test-na-umenie-nabirat-tekst', 'dazi-ceshi' ) )
		&& ! is_post_type_archive( array( 'ms_glossary', 'ms_templates', 'ms_academy', 'ms_directory', 'ms_checklists', 'ms_reviews', 'ms_awards' ) )
		&& ! is_single( array( 'facebook', 'liveagent-huawei', 'twitter', 'viber', 'instagram' ) )
		&& ! is_singular( array( 'ms_glossary', 'ms_templates', 'ms_academy', 'ms_directory', 'ms_about', 'ms_checklists', 'ms_reviews', 'ms_awards', 'post' ) )
		&& ! is_category( array( 'blog', 'news', 'reviews', 'growth', 'support', 'live-chat', 'help-desk-software' ) )
		&& ! is_search()
		&& ! check_parent_child_slug( array( 'business', 'industry' ) )
		&& ! is_tax( 'ms_reviews_categories' )

	) {
	include_once get_template_directory() . '/contactus-box.php';
} elseif ( is_page( 'pricing' ) ) {
	?>
	<!-- Start of LiveAgent integration script: Chat button: LA - Pricing -->
	<script type="text/javascript">
		(function(d, src, c) {
			var t = d.scripts[d.scripts.length - 1], s = d.createElement('script');
			s.id = 'la_x2s6df8d';
			s.defer = true;
			s.src = src;
			s.onload = s.onreadystatechange = function() {
				var rs = this.readyState;
				if (rs && rs !== 'complete' && rs !== 'loaded') return;
				c(this);
			};
			t.parentElement.insertBefore(s, t.nextSibling);
		})(document, 'https://support.ladesk.com/scripts/track.js',
			function(e) { LiveAgent.createButton('kri1tmbp', e); });
	</script>
	<!-- End of LiveAgent integration script -->
	<?php
} elseif ( ! is_page( array( 'request-demo', 'demo', 'trial', 'thank-you', 'free-account' ) ) ) {
	?>
	<!-- Start of LiveAgent integration script: Chat button: LA - Website multiwidget - chatbot -->
	<script type="text/javascript">
		(function(d, src, c) {
			var t = d.scripts[d.scripts.length - 1], s = d.createElement('script');
			s.id = 'la_x2s6df8d';
			s.defer = true;
			s.src = src;
			s.onload = s.onreadystatechange = function() {
				var rs = this.readyState;
				if (rs && rs !== 'complete' && rs !== 'loaded') return;
				c(this);
			};
			t.parentElement.insertBefore(s, t.nextSibling);
		})(document, 'https://support.ladesk.com/scripts/track.js',
			function(e) { LiveAgent.createButton('lc71ooi3', e); });
	</script>
	<!-- End of LiveAgent integration script -->
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

document.addEventListener( 'DOMContentLoaded', ( e ) => {
	if ( document.querySelector( '.Content .yoast-table-of-contents' ) ) {
		const heights = { placeholderHeight: 0, stickyHeaderHeight: 0 };
		let checked = false;

		function updateHeights() {
			const placeholder = document.querySelector( '.compact-header__placeholder' );
			const stickyHeader = document.querySelector( '.compact-header__placeholder .compact-header--sticky' );
			if ( placeholder ) {
				heights.placeholderHeight = placeholder.offsetHeight;
			}
			if ( stickyHeader ) {
				heights.stickyHeaderHeight = stickyHeader.offsetHeight;
			}
		}

		function checkScroll() {
			if ( ! checked && window.scrollY >= heights.placeholderHeight * 2 ) {
				updateHeights();
				checked = true;
				window.removeEventListener( 'scroll', checkScroll );
			}
		}

		function handleLinkClick( event ) {
			event.preventDefault();
			const targetId = this.getAttribute( 'href' ).substring( 1 );
			const targetElement = document.getElementById( targetId );

			if ( targetElement ) {
				const { placeholderHeight, stickyHeaderHeight } = heights;
				const defaultSubHeaderHeight = 73;
				const offset = stickyHeaderHeight || defaultSubHeaderHeight;
				const targetPosition = targetElement.offsetTop + placeholderHeight - offset;

				window.scrollTo( { top: targetPosition, behavior: 'smooth' } );
			}
		}

		updateHeights();
		window.addEventListener( 'scroll', checkScroll );
		document.querySelectorAll( '.yoast-table-of-contents li a' ).forEach( ( link ) => link.addEventListener( 'click', handleLinkClick ) );
	}
} );
</script>

<?php if ( is_page( 'trial' ) ) { ?>
	<!--Start of LiveAgent integration script: CrozDesk Conversion Tracking-->
	<script type='text/javascript'>
		(function() {
			var cdx = document.createElement("script");  cdx.type = "text/javascript";  cdx.async = true;
			cdx.src = "https://trk.crozdesk.com/JJ2ye4YXFVAt3ozNznyx";
			var s = document.getElementsByTagName("script")[0];  s.parentNode.insertBefore(cdx,s);
		})();
	</script>
	<!--End of LiveAgent integration script-->
<?php } ?>

<script>
	(function(d,t) {
		var script = d.createElement(t);
		script.id = 'fh_tracking';
		script.async = true;
		script.src = 'https://app.flowhunt.io/fh_trk.min.js';

		script.onload = script.onreadystatechange = function() {
			var rs = this.readyState;
			if (rs && (rs != 'complete') && (rs != 'loaded')) return;

			if (window.FHTrck) {
				window.FHTrck.init({
					workspace_id: '4d1adbc8-edfa-48c1-b93a-a8096d28f5e7',
					customer_id: '3600902407',
					cookiesEnabled: getCookieFrontend("cookieLaw") ? true : false,
					appendSessionToLinks: true,
				});
			}
		};
		document.body.insertBefore(script, document.body.lastChild);
	})(document, 'script');
</script>

<!-- Capterra Tracking -->
<script type="text/javascript">
	function loadCapterra() {
		(function(l,o,w,n,g){
			window._gz=function(e,t){window._ct={vid:e,vkey:t,
			uc:true,hasDoNotTrackIPs:false};window.ct};
			n=l.createElement(o);g=l.getElementsByTagName(o)[0];
			n["async"]=1;
			n.src=w;g.parentNode.insertBefore(n,g)})(
			document,"script",
			"https://tr.capterra.com/static/wp.js");
			window._gz('fe449882-d667-41be-9d89-9653a963c094', 
			'ca1d7fde1191b65d701f8444dee12e71');
	}
</script>
