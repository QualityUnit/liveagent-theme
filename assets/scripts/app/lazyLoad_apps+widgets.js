const lazyResources = document.querySelectorAll( '[data-widget]' );

if ( lazyResources.length && 'IntersectionObserver' in window ) {
	const lazyResourceObserver = new IntersectionObserver(
		( entries ) => {
			entries.forEach(
				( entry ) => {
					if ( entry.isIntersecting ) {
						const hrefs = entry.target.querySelectorAll( '[data-href]' );
						const srcs = entry.target.querySelectorAll( '[data-src]' );
						const resource = entry.target;

						if ( hrefs.length ) {
							hrefs.forEach( ( datahref ) => {
								const href = datahref.getAttribute( 'data-href' );
								datahref.setAttribute( 'href', href );
								datahref.removeAttribute( 'data-href' );
							} );
						}

						if ( srcs.length ) {
							srcs.forEach( ( datasrc ) => {
								const src = datasrc.getAttribute( 'data-src' );
								datasrc.setAttribute( 'src', src );
								datasrc.removeAttribute( 'data-src' );
							} );
						}

						lazyResourceObserver.unobserve( resource );
					}
				}
			);
		}
	);

	lazyResources.forEach(
		( lazyResource ) => {
			lazyResourceObserver.observe( lazyResource );
		}
	);
}
