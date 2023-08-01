const signuplogin = () => {
	const scriptList = [ ...document.querySelectorAll( 'script[data-src]' ) ];
	const regex = /.+crm\.js.+|.+login\.js.+/gi;

	function waitForLoad( element ) {
		return new Promise( ( resolve ) => {
			element.onload = resolve( { ok: true } );
		} );
	}

	function loadScripts( ) {
		scriptList.map( ( element ) => {
			const script = element;

			const datasrc = script.getAttribute( 'data-src' );
			if ( ! datasrc.match( regex ) ) {
				script.src = datasrc;

				async function isLoaded() {
					const response = await waitForLoad( script );

					if ( response.ok ) {
						setTimeout( () => {
							scriptList.filter( ( executor ) => {
								const dataSrc = executor.getAttribute( 'data-src' );
								if ( dataSrc.match( regex ) ) {
									executor.src = dataSrc;
								}
								return true;
							} );
						}, 50 );
					}
				}

				isLoaded();
			}
			return true;
		} );
	}

	if ( document.querySelectorAll( 'script[data-src]' ).length ) {
		const scriptParent = document.querySelectorAll(
			'[data-id="signup"] input:not([type="hidden"])'
		);

		scriptParent.forEach( ( input ) => {
			input.addEventListener( 'focus', ( event ) => {
				const type = event.target.closest( '[data-id="signup"]' ).dataset.type;
				sessionStorage.setItem( 'crmType', type );
				loadScripts( );
			} );
		} );

		scriptParent.forEach( ( input ) => {
			input.removeEventListener( 'focus', loadScripts );
		} );
	}

	// Adds class to parent grey section to change background
	const signUp = document.querySelector( '.Signup__form' );
	if ( signUp ) {
		const signUpSection = signUp.closest( '.Block--background' );
		if ( signUpSection ) {
			signUpSection.classList.add( 'Block--elements' );
		}
	}
};

window.addEventListener( 'load', () => {
	signuplogin();
} );

window.removeEventListener( 'load', signuplogin );
