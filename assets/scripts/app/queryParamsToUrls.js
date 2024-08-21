// adds all query params from incoming URL to urls on page
( () => {
	const queryParams = new URL( window.location ).searchParams;

	const allUrls = document.querySelectorAll( 'a[href]' );

	allUrls.forEach( ( url ) => {
		const currentHref = url.getAttribute( 'href' );

		if ( currentHref === '#' || currentHref === '#0' || currentHref === '' ) {
			return;
		}

		const currentUrl = new URL( url.href );

		queryParams.forEach( ( value, key ) => {
			currentUrl.searchParams.set( key, value );
		} );
		if ( currentUrl.hostname.includes( 'liveagent' ) || currentUrl.hostname.includes( 'live-agent' ) ) {
			url.href = currentUrl.toString();
		}
	} );
} )();
