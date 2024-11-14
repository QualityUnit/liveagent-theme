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
		'ad_user_data': 'granted',
		'analytics_storage': 'granted'
	})

	gtag('consent', 'default', {
		'ad_user_data': 'denied',
		'analytics_storage': 'denied',
		'region': ['AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'IS', 'LI', 'NO']
	})

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

	function consentGranted() {
		gtag('consent', 'update', {
			'ad_user_data': 'granted',
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

<!-- LiveAgent - Chat Button -->
<script>
	function loadChatBot( { chatbotId, workspaceId, btnTarget } ) {
		const chatBotButton = document.querySelector( btnTarget );
		try {
			chatBotButton.classList.remove('hidden');
		} catch (error) {
		}

		(function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document,
			'https://app.flowhunt.io/fh-chat-widget.js?v=1.0.20',
			function(e){
				const chatbotManager = FHChatbot.initChatbot({
					showChatButton: false, // important to not show chat button on page load
					chatbotId: chatbotId,
					workspaceId: workspaceId,
					welcomeMessage: 'Hi, I\'m LiveAgent support Bot. How can I help you?',
					inputPlaceholder: '<?= esc_html( __( 'Ask me any question…' ) ); ?>',
					suggestedUserMessages: [],
					urlSuffix: '?utm_medium=chatbot&utm_source=flowhunt',
					maxWindowWidth: '500px',
				});
				chatBotButton.addEventListener('click', () => {
					chatbotManager.openChat();
				});
			});
	}
</script>

<?php
if (
		! is_page( array( 'request-demo', 'demo', 'trial', 'thank-you', 'redeem-code', 'free-account', 'tom', 'typing-test', 'tipptest', 'prueba-de-tipeo', 'test-de-saisie', 'test-di-digitazione', 'teste-de-digitacao', 'typetest', 'gepelesi-teszt', 'test-pisania', 'test-na-umenie-nabirat-tekst', 'dazi-ceshi' ) )
		&& ! is_post_type_archive( array( 'ms_glossary', 'ms_templates', 'ms_academy', 'ms_directory' ) )
		&& ! is_single( array( 'facebook', 'liveagent-huawei', 'twitter', 'viber', 'instagram' ) )
		&& ! is_singular( array( 'ms_glossary', 'ms_templates', 'ms_academy', 'ms_directory', 'ms_about', 'post' ) )
		&& ! is_category( array( 'blog', 'news', 'reviews', 'growth', 'support', 'live-chat', 'help-desk-software' ) )
		&& ! is_search()
	) {
	include_once get_template_directory() . '/contactus-box.php';
} elseif (
		! is_page( array( 'request-demo', 'demo', 'trial', 'thank-you', 'free-account' ) )
	) {
	?>

	<button class="ContactUs__chatBotOnly hidden" id="chatBotOnly" rel="nofollow noopener external">
		<img class="ContactUs__icon" src="<?= esc_url( get_template_directory_uri() . '/assets/images/contact/chatbot.svg' ); ?>" />
	</button>

	<script type="text/javascript" id="fh-chatbot-script">
		const chatBtnOptions = {
			<?php if ( is_post_type_archive( array( 'ms_directory' ) ) || is_singular( array( 'ms_directory' ) ) ) { ?>
				chatbotId: '43655338-f1ff-4273-8e9c-6f0d38c48dd2',
				workspaceId: '4d1adbc8-edfa-48c1-b93a-a8096d28f5e7',
				maxWindowWidth: '700px',
			<?php } else { ?>
			chatbotId: 'ee7cb389-4f00-441f-a287-07a43f72f1e3',
			workspaceId: '4d1adbc8-edfa-48c1-b93a-a8096d28f5e7',
			<?php } ?>
			btnTarget: '#chatBotOnly'
		};
		acceptButton.addEventListener( "click", () => {
			loadChatBot(chatBtnOptions);
		});

		if ( getCookieFrontend( "cookieLaw" ) ) {
			loadChatBot(chatBtnOptions);
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
