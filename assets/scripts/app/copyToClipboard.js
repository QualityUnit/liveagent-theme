/* Copy to clipboard */
if ( document.querySelectorAll( '.Copy ' ).length > 0 ) {
	document.querySelectorAll( '.Copy ' ).forEach( ( item ) => {
		item.querySelector( '.Button--copy' ).addEventListener(
			'click',
			() => {
				const thisCopy = item;
				const copyText = thisCopy.querySelector(
					'.textarea-pseudo'
				).innerText;
				const defaultText = thisCopy.querySelector(
					'.Button--copy span'
				).textContent;

				const textArea = document.createElement( 'textarea' );
				textArea.value = copyText;
				document.body.appendChild( textArea );
				textArea.select();

				document.execCommand( 'copy' );
				document.body.removeChild( textArea );

				thisCopy.querySelector( '.Button--copy span' ).textContent =
          'Copied!';

				setTimeout( () => {
					thisCopy.querySelector(
						'.Button--copy span'
					).textContent = defaultText;
				}, 5000 );
			}
		);
	} );
}
