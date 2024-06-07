/* global getCookie setCookie */

function shouldShowPopup() {
	return getCookie( 'popupClosed' ) === null;
}

const exitPopup = document.getElementById( 'exitPopup' );

if ( exitPopup ) {
	document.addEventListener( 'mouseleave', function( event ) {
		if ( event.clientY < 0 && shouldShowPopup() ) {
			exitPopup.style.display = 'block';
		}
	} );

	document.getElementById( 'popupClose' ).addEventListener( 'click', function() {
		document.getElementById( 'exitPopup' ).style.display = 'none';
		setCookie( 'popupClosed', 'true', 14 ); // Set cookie for 14 days
	} );
}

