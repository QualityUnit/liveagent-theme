( () => {
	const queryParams = new URL( window.location ).searchParams;

	const blacklist = [ 'p', 'a' ];

	const currentHostname = window.location.hostname;
	const allUrls = document.querySelectorAll( 'a[href]' );

	allUrls.forEach( ( url ) => {
		const currentHref = url.getAttribute( 'href' );

		if ( currentHref === '#' || currentHref === '#0' || currentHref === '' ) {
			return;
		}

		const currentUrl = new URL( url.href );

		if ( ! currentHostname.includes( 'admin' ) ) {
			queryParams.forEach( ( value, key ) => {
				if ( ! blacklist.includes( key ) ) {
					currentUrl.searchParams.set( key, value );
				}
			} );
		}

		if ( currentUrl.hostname.includes( 'liveagent' ) || currentUrl.hostname.includes( 'live-agent' ) ) {
			url.href = currentUrl.toString();
		}
	} );
} )();
