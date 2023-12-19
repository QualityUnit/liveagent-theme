
/* Glossary */
if ( document.querySelector( '.Archive__container--glossary' ) !== null ) {
	document.querySelectorAll( '.Archive__filter ul li a' ).forEach( ( element ) => {
		const link = element.getAttribute( 'href' );

		element.addEventListener( 'click', ( event ) => {
			const scrollToPos =
        document.querySelector( link ).getBoundingClientRect().top +
        window.pageYOffset;
			event.preventDefault();
			if ( window.matchMedia( '(min-width: 1180px)' ).matches ) {
				window.scroll( {
					top: scrollToPos - 215,
					behavior: 'smooth',
				} );
			} else {
				window.scroll( {
					top: scrollToPos - 115,
					behavior: 'smooth',
				} );
			}
		} );
	} );
}
