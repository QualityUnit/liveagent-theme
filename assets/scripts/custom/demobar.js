/* global setCookie, getCookie */

const demobar = document.querySelector( '#demobar' );
if ( demobar ) {
	const demobarButton = document.querySelector( '.DemoBar__button' );
	const demobarUrl = demobarButton.getAttribute( 'href' );

	document
		.querySelector( '.DemoBar__close' )
		.addEventListener( 'click', () => {
			demobar.classList.add( 'hide' );
			demobar.classList.remove( 'show' );
			setTimeout( () => {
				demobar.classList.remove( 'visible' );
			}, 500 );
			setCookie( 'demobar', 'yes', 14 );
		} );

	demobarButton.addEventListener( 'click', ( event ) => {
		event.preventDefault();
		setCookie( 'demobar', 'yes', 14 );

		setTimeout( () => {
			window.location.pathname = demobarUrl;
		}, 10 );
	} );

	if ( ! getCookie( 'demobar' ) && getCookie( 'cookieLaw' ) ) {
		window.addEventListener( 'load', () => {
			setTimeout( () => {
				demobar.classList.add( 'visible' );
			}, 500 );
		} );

		setTimeout( () => {
			demobar.classList.add( 'show' );
		}, 5000 );
	}
}
