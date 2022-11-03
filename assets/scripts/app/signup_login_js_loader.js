const signuplogin = () => {
	const scriptList = [ ...document.querySelectorAll( 'script[data-src]' ) ];
	const regex = /.+crm.js.+|.+login.js.+/gi;

	function loadScripts() {
		scriptList.map( ( element ) => {
			const script = element;

			const datasrc = script.getAttribute( 'data-src' );
			if ( ! datasrc.match( regex ) ) {
				script.setAttribute( 'src', datasrc );
				script.addEventListener( 'load', () => {
					setTimeout( () => {
						scriptList.filter( ( executor ) => {
							const src = executor.getAttribute( 'data-src' );
							if ( src.match( regex ) ) {
								executor.setAttribute( 'src', src );
							}
							return true;
						} );
					}, 50 );
				} );
			}
			return true;
		} );
	}

	if ( document.querySelectorAll( 'script[data-src]' ).length ) {
		const scriptParent = document.querySelectorAll(
			'[data-id="signup"] input:not([type="hidden"])'
		);

		scriptParent.forEach( ( input ) => {
			input.addEventListener( 'focus', () => {
				loadScripts();
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
