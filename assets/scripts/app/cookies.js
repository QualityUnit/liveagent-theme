/* Cookie Bar */
const setCookie = ( name, value, days ) => {
	let expires = '';
	if ( days ) {
		const date = new Date();
		// eslint-disable-next-line no-mixed-operators
		date.setTime( date.getTime() + days * 24 * 60 * 60 * 1000 );
		expires = `; expires=${ date.toUTCString() }`;
	}
	document.cookie = `${ name }=${ value || '' }${ expires }; path=/`;
};

const getCookie = ( name ) => {
	const nameEq = `${ name }=`;
	const ca = document.cookie.split( ';' );
	for ( let i = 0; i < ca.length; i += 1 ) {
		let c = ca[ i ];
		while ( c.charAt( 0 ) === ' ' ) {
			c = c.substring( 1, c.length );
		}
		if ( c.indexOf( nameEq ) === 0 ) {
			return c.substring( nameEq.length, c.length );
		}
	}
	return null;
};

if ( document.querySelector( '.Medovnicky' ) !== null ) {
	document
		.querySelector( '.Medovnicky__button--yes' )
		.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			setCookie( 'cookieLaw', 'yes', 14 );
			document.querySelector( '.Medovnicky' ).classList.add( 'hide' );
			document.querySelectorAll( '.fakeChatButton' ).forEach( ( fakeChatBtn ) => {
				fakeChatBtn.classList.add( 'hidden' );
			} );
		} );

	document
		.querySelector( '.Medovnicky__button--no' )
		.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			document.querySelector( '.Medovnicky' ).classList.add( 'hide' );
		} );

	if ( ! getCookie( 'cookieLaw' ) ) {
		document.addEventListener( 'touchstart', () => {
			document.querySelector( '.Medovnicky' ).classList.add( 'show' );
		} );

		document.addEventListener( 'mousemove', () => {
			document.querySelector( '.Medovnicky' ).classList.add( 'show' );
		} );
	}
}
