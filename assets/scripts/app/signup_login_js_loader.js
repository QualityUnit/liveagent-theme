const signuplogin = () => {
	const jquerySrc = document.querySelectorAll( 'script[data-src*="jquery.min.js"], script[data-src*="jquery.js"]' );
	const scriptList = [ ...document.querySelectorAll( 'script[data-src]:not(#jquery-js)' ) ];
	const regex = /.+crm\.js.+|.+login\.js.+/gi;

	function waitForLoad( element ) {
		return new Promise( ( resolve ) => {
			element.onload = resolve( { ok: true, name: element.id } );
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
					const { ok, name } = response;

					if ( ok && name?.toLowerCase().includes( 'alphanum' ) ) {
						setTimeout( () => {
							scriptList.filter( ( executor ) => {
								const dataSrc = executor.getAttribute( 'data-src' );
								executor.src = dataSrc;
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

	function runLoadScript( element ) {
		const type = element.closest( '[data-id="signup"]' ).dataset.type;
		sessionStorage.setItem( 'crmType', type );
		loadScripts( element );
	}
	if ( document.querySelectorAll( 'script[data-src]' ).length ) {
		const scriptParent = document.querySelectorAll(
			'[data-id="signup"] input:not([type="hidden"])'
		);

		scriptParent.forEach( ( input ) => {
			input.addEventListener( 'focus', async ( event ) => {
				if ( ! window.jQuery ) {
					jquerySrc[ 0 ].src = jquerySrc[ 0 ].dataset.src;
				}
				const response = await waitForLoad( jquerySrc[ 0 ] );

				if ( response.ok ) {
					setTimeout( () => {
						runLoadScript( event.target );
					}, 50 );
				}
			} );
		} );

		scriptParent.forEach( ( input ) => {
			input.removeEventListener( 'focus', loadScripts );
		} );

		// load scripts also on selections event, not only inputs
		const scriptParentSelections = document.querySelectorAll(
			'[data-id="signup"] .FilterMenu.isSingleSelect'
		);

		scriptParentSelections.forEach( ( input ) => {
			input.addEventListener( 'openedFilterMenu', ( event ) => {
				runLoadScript( event.target );
			} );
		} );

		scriptParentSelections.forEach( ( input ) => {
			input.removeEventListener( 'openedFilterMenu', loadScripts );
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
