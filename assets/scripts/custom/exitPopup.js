/* global getCookie setCookie */

function shouldShowPopup() {
	return getCookie( 'exitPopupClose' ) === null;
}

const exitPopup = document.getElementById( 'exitPopup' );

if ( exitPopup ) {
	document.addEventListener( 'mouseleave', function( event ) {
		if ( event.clientY < 0 && shouldShowPopup() ) {
			exitPopup.style.display = 'block';
		}
	} );

	document.getElementById( 'exitPopupClose' ).addEventListener( 'click', function() {
		document.getElementById( 'exitPopup' ).style.display = 'none';
		setCookie( 'exitPopupClose', 'true', 14 ); // Set cookie for 14 days
	} );
}

