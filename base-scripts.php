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

	const acceptButton = document.querySelector( ".Medovnicky__button--yes" );
	const trialButton = document.querySelector( "#createButtonmain" );

	const mobile = window.matchMedia('(max-width: 768px)');


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
		<?php if ( ! is_page( array( 'request-demo', 'demo', 'trial', 'free-account' ) ) ) { ?>
		offlineContactForm();
		<?php } ?>
		twitterTracking();
		postAffiliate();
	});

	if ( trialButton !== null ) {
		trialButton.addEventListener( "click", () => {
			if ( ! getCookieFrontend( "cookieLaw" ) ) {
				setCookie( 'cookieLaw', 'yes', 14 );
				document.querySelector( '.Medovnicky' ).classList.add( 'hide' );

				postAffiliate();
				consentGranted();
				grafana();
				gtm();
				twitterTracking();
			}
		});
	}
</script>

<script>
	function loadGoogle() {
		const body  = document.body;
		const gtag1 = document.createElement('script');
		const gtag2 = document.createElement('script');
		gtag1.async = true;
		gtag2.async = true;
		gtag1.src = "https://www.googletagmanager.com/gtag/js?id=AW-966671101";
		gtag2.src = "https://www.googletagmanager.com/gtag/js?id=UA-132128640-1";

		body.insertAdjacentElement('beforeend', gtag1);
		body.insertAdjacentElement('beforeend', gtag2);
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

	gtag('config', 'AW-966671101', {
		'linker': {
			'domains': ['liveagent.com', 'liveagent.fr', 'liveagent.de', 'liveagent.hu', 'liveagent.com.br', 'liveagent.sk', 'liveagent.es', 'live-agent.cn', 'live-agent.nl', 'live-agent.it', 'live-agent.pl', 'ru.liveagent.com', 'live-agent.cz', 'liveagent.vn', 'liveagent.no', 'liveagent.dk', 'liveagent.gr', 'liveagent.ro', 'liveagent.bg', 'liveagent.se', 'liveagent.jp', 'liveagent.fi', 'liveagent.ae', 'liveagent.ph', 'liveagent.si', 'liveagent.lv', 'liveagent.lt', 'liveagent.hr', 'liveagent.ee', 'support.liveagent.com', 'ladesk.com', 'liveagent.local', '*.ladesk.com']
		}
	})

	gtag('config', 'UA-132128640-1', {
		'linker': {
			'domains': ['liveagent.com', 'liveagent.fr', 'liveagent.de', 'liveagent.hu', 'liveagent.com.br', 'liveagent.sk', 'liveagent.es', 'live-agent.cn', 'live-agent.nl', 'live-agent.it', 'live-agent.pl', 'ru.liveagent.com', 'live-agent.cz', 'liveagent.vn', 'liveagent.no', 'liveagent.dk', 'liveagent.gr', 'liveagent.ro', 'liveagent.bg', 'liveagent.se', 'liveagent.jp', 'liveagent.fi', 'liveagent.ae', 'liveagent.ph', 'liveagent.si', 'liveagent.lv', 'liveagent.lt', 'liveagent.hr', 'liveagent.ee', 'support.liveagent.com', 'ladesk.com', 'liveagent.local', '*.ladesk.com']
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


<!-- Twitter Ads Tracking -->
<script>
	function twitterTracking() {
		!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
		},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
			a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
		twq('config','ocrty');
	}
	if ( getCookieFrontend( "cookieLaw" ) ) {
		twitterTracking()
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
			placeholder.parentNode.removeChild(placeholder);
		})(document, 'script');
	}

	if ( ! mobile.matches ) {
		postAffiliate()
	}

	if ( mobile.matches && getCookieFrontend( "cookieLaw" ) ) {
		postAffiliate()
	}
</script>

<!-- Dreamdata.io -->
<script>
	function dreamdata() {
	!function(){window.analytics||(window.analytics=[]),window.analytics.methods=["identify","track","trackLink","trackForm","trackClick","trackSubmit","page","pageview","ab","alias","ready","group","on","once","off"],window.analytics.factory=function(a){return function(){var t=Array.prototype.slice.call(arguments);return t.unshift(a),window.analytics.push(t),window.analytics}};for(var a=0;a<window.analytics.methods.length;a++){var t=window.analytics.methods[a];window.analytics[t]=window.analytics.factory(t)}analytics.load=function(a){if(!document.getElementById("dreamdata-analytics")){window.__DD_TEMP_ANALYTICS__=window.analytics;var t=document.createElement("script");t.async=!0,t.id="dreamdata-analytics",t.type="text/javascript",t.src="https://cdn.dreamdata.cloud/scripts/analytics/v1/dreamdata.min.js",t.addEventListener("load",function(t){if(analytics&&analytics.initialize)for(analytics.initialize({"Dreamdata.io":{apiKey:a}});window.__DD_TEMP_ANALYTICS__.length>0;){var i=window.__DD_TEMP_ANALYTICS__.shift(),n=i.shift();analytics[n]&&analytics[n].apply(analytics,i)}},!1);var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(t,i)}},analytics.load("dbe2aa1b-ed0a-4045-b83e-b86e284ff7ec"),analytics.page()}();
	}

	if ( getCookieFrontend( "cookieLaw" ) ) {
		dreamdata();
	}
</script>

<?php
if ( WP_ENV === 'production' ) {
	?>
	<script type="module" defer>
		import { onCLS, onFCP, onFID, onINP, onLCP, onTTFB } from 'https://unpkg.com/web-vitals@3.1.1/dist/web-vitals.js?module';

		function sendToGoogleAnalytics( { name, delta, id } ) {
			gtag('event', name, {
				event_category: 'Web Vitals',
				event_label: id,
				value: Math.round( name === 'CLS' ? delta * 1000 : delta ),
				non_interaction: true,
			});
		}

		onCLS( sendToGoogleAnalytics );
		onFCP( sendToGoogleAnalytics );
		onFID( sendToGoogleAnalytics );
		onINP( sendToGoogleAnalytics );
		onLCP( sendToGoogleAnalytics );
		onTTFB( sendToGoogleAnalytics );
	</script>
	<?php
}
?>
