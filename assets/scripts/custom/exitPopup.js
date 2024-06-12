/* global getCookie setCookie */

function shouldShowPopup() {
	return getCookie( 'exitPopupClose' ) === null;
}

const exitPopup = document.getElementById( 'exitPopup' );

if ( exitPopup ) {
	document.body.addEventListener( 'mouseout', function( event ) {
		const from = event.relatedTarget || event.toElement;
		if ( ! from || from.nodeName === 'HTML' ) {
			if ( shouldShowPopup() ) {
				exitPopup.classList.add( 'visible' );
				exitPopup.classList.remove( 'hidden' );
			}
		}
	} );

	document.getElementById( 'exitPopupClose' ).addEventListener( 'click', function() {
		exitPopup.classList.remove( 'visible' );
		exitPopup.classList.add( 'hidden' );
		setCookie( 'exitPopupClose', 'true', 14 ); // Set cookie for 14 days
	} );

	// Pridáme poslucháčov udalostí na tlačidlá v popupu
	const popupButtons = document.querySelectorAll( '.ExitPopupButton' );
	popupButtons.forEach( function( button ) {
		button.addEventListener( 'click', function() {
			setCookie( 'exitPopupClose', 'true', 14 ); // Set cookie for 14 days
		} );
	} );
}
