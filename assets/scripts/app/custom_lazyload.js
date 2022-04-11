/* global IntersectionObserver, Image, getComputedStyle */

/* To lazy load background images,
		add class .lazybg to the element (even if background is in pseudo)
*/

const customLazyLoad = () => {
	const media = document.querySelectorAll(
		'img[data-lasrc], img[data-lasrcset], video[data-lasrc], .lazybg'
	);

	const eventType = ( element ) => {
		const elemType = element.tagName;
		if ( elemType === 'VIDEO' ) {
			return 'loadeddata';
		}
		return 'load';
	};

	const loadBg = ( loadedElem, mediaObject ) => {
		const target = mediaObject;
		// Will get url from matched element
		const url = loadedElem.match( /http.+.(jpg|png|svg)/g );
		// Create shadow image to check for load event
		const image = new Image();
		image.src = url;
		// If image loaded, set opacity to 1 and after transition, remove class handling transition
		image.onload = () => {
			target.style.opacity = null;
			target.addEventListener( 'transitionend', () => {
				target.classList.remove( 'lazybg-loading' );
			} );
		};
	};

	const lazyBgcheck = ( element ) => {
		const mediaObject = element;
		mediaObject.style.opacity = '0';
		mediaObject.classList.remove( 'lazybg' );
		mediaObject.classList.add( 'lazybg-loading' );
		setTimeout( () => {
			const loaded = window.getComputedStyle( mediaObject )
				.backgroundImage;
			const loadedBefore = getComputedStyle( mediaObject, ':before' )
				.backgroundImage;
			const loadedAfter = getComputedStyle( mediaObject, ':after' )
				.backgroundImage;
			if ( loaded !== ( null || undefined || 'none' ) ) {
				loadBg( loaded, mediaObject );
			} else if ( loadedBefore !== ( null || undefined || 'none' ) ) {
				loadBg( loadedBefore, mediaObject );
			} else if ( loadedAfter !== ( null || undefined || 'none' ) ) {
				loadBg( loadedAfter, mediaObject );
			}
		}, 0 );
	};

	if ( 'IntersectionObserver' in window && media.length > 0 ) {
		const mediaObserver = new IntersectionObserver( ( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					const datasrc = entry.target.getAttribute( 'data-lasrc' );
					const datasrcset = entry.target.getAttribute( 'data-lasrcset' );
					const lazyBg = entry.target.classList.contains( 'lazybg' );
					const mediaObject = entry.target;

					if ( datasrcset !== null ) {
						mediaObject.setAttribute( 'srcset', datasrcset );
						mediaObject.removeAttribute( 'data-lasrcset' );
						mediaObject.addEventListener(
							eventType( mediaObject ),
							() => {
								const e = mediaObject;
								e.style.opacity = '1';
							}
						);
					}

					if ( datasrc !== null ) {
						mediaObject.setAttribute( 'src', datasrc );
						mediaObject.removeAttribute( 'data-lasrc' );
						mediaObject.addEventListener(
							eventType( mediaObject ),
							() => {
								const e = mediaObject;
								e.style.opacity = '1';
							}
						);
					}

					if ( lazyBg !== false ) {
						lazyBgcheck( mediaObject );
					}

					mediaObserver.unobserve( mediaObject );
				}
			} );
		} );

		media.forEach( ( mediaObject ) => {
			mediaObserver.observe( mediaObject );
		} );
	}
};

( () => {
	customLazyLoad();
} )();
