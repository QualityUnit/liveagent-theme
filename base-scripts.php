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
			}
		});
	}
</script>

<!-- Google Tag Manager - No Cookies -->
<script>
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MR5X6FD');
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
