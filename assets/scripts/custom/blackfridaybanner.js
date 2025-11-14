const blackfridayPopup = document.querySelector( '#blackfridaybanner' );
if ( blackfridayPopup ) {
	const blackfridayPopupLink = document.querySelector( '.BlackFridayBanner__link' );
	const blackfridayPopupUrl = blackfridayPopupLink ? blackfridayPopupLink.getAttribute( 'href' ) : '/black-friday/';

	// Close button handler
	document
		.querySelector( '.BlackFridayBanner__close' )
		.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			event.stopPropagation(); // Prevent link click
			blackfridayPopup.classList.add( 'hide' );
			blackfridayPopup.classList.remove( 'show' );
			setTimeout( () => {
				blackfridayPopup.classList.remove( 'visible' );
			}, 500 );
			sessionStorage.setItem( 'blackfridayPopup', 'yes' );
		} );

	// Link click handler
	if ( blackfridayPopupLink ) {
		blackfridayPopupLink.addEventListener( 'click', ( event ) => {
			// Allow normal link behavior, don't set session storage
			// Banner should remain visible when user returns
		} );
	}

	if ( ! sessionStorage.getItem( 'blackfridayPopup' ) ) {
		// Wait for banner image to load before showing banner
		const bannerImage = blackfridayPopup.querySelector( '.BlackFridayBanner__image img' );
		
		const showBanner = () => {
			setTimeout( () => {
				blackfridayPopup.classList.add( 'visible' );
				blackfridayPopup.classList.remove( 'hidden' );
			}, 500 );

			setTimeout( () => {
				blackfridayPopup.classList.add( 'show' );
			}, 1000 );
		};

		if ( bannerImage ) {
			if ( bannerImage.complete ) {
				// Image already loaded
				showBanner();
			} else {
				// Wait for image to load
				bannerImage.addEventListener( 'load', showBanner );
			}
		} else {
			// Fallback if no image found
			showBanner();
		}
	}
}
