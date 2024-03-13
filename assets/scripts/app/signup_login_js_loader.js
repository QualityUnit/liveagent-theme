const signuplogin = () => {
	const jquerySrc = document.querySelectorAll( 'script[data-src*="jquery.min.js"], script[data-src*="jquery.js"]' );
	const scriptList = [ ...document.querySelectorAll( 'script[data-src]:not(#jquery-js)' ) ];
	const regex = /.+crm\.js.+|.+login\.js.+/gi;

	function waitForLoad( element ) {
		return new Promise( ( resolve ) => {
			element.onload = resolve( { ok: true } );
		} );
	}

	function checkForJqueryLib() {
		return scriptList.filter( ( script ) => {
			return ! script.dataset.src?.match( regex ) && ! script.getAttribute( 'src' ) && script.id.toLowerCase().includes( 'alphanum' );
		} );
	}

	async function loadScripts() {
		const jqueryLib = checkForJqueryLib();

		// if jquery lib available, load it first and after load run scripts loading again
		if ( jqueryLib.length ) {
			const script = jqueryLib[ 0 ];
			script.src = script.dataset.src;
			const response = await waitForLoad( script );
			const { ok } = response;

			if ( ok ) {
				setTimeout( () => {
					loadScripts();
				}, 50 );
			}

			return;
		}

		// load scripts with not defined src attribute, will skip jquery lib loaded before
		scriptList.forEach( ( script ) => {
			if ( ! script.src ) {
				script.src = script.dataset.src;
			}
		} );
	}

	async function runLoadScript() {
		// wait for jQuery, when not loaded before
		if ( ! window.jQuery && jquerySrc.length ) {
			const script = jquerySrc[ 0 ];
			script.src = script.dataset.src;
			const response = await waitForLoad( script );
			const { ok } = response;

			if ( ok ) {
				setTimeout( () => {
					loadScripts();
					removeLoadListeners();
				}, 50 );
			}
			return;
		}

		// jquery loaded, continue to load other scripts
		loadScripts();
		removeLoadListeners();
	}

	if ( document.querySelectorAll( 'script[data-src]' ).length ) {
		// standard inputs
		document.querySelectorAll( '[data-id="signup"] input:not([type="hidden"])' )
			.forEach( ( input ) => input.addEventListener( 'focus', runLoadScript ) );

		// custom select
		document.querySelectorAll( '[data-id="signup"] .FilterMenu.isSingleSelect' )
			.forEach( ( input ) => input.addEventListener( 'openedFilterMenu', runLoadScript ) );

		// submit button
		document.querySelectorAll( '[data-id="signup"] button[data-id=createButtonmain]' )
			.forEach( ( input ) => input.addEventListener( 'click', runLoadScript ) );
	}

	// Adds class to parent grey section to change background
	const signUp = document.querySelector( '.Signup__form' );
	if ( signUp ) {
		const signUpSection = signUp.closest( '.Block--background' );
		if ( signUpSection ) {
			signUpSection.classList.add( 'Block--elements' );
		}
	}

	function removeLoadListeners() {
		document.querySelectorAll( '[data-id="signup"] input:not([type="hidden"])' )
			.forEach( ( input ) => input.removeEventListener( 'focus', runLoadScript ) );

		document.querySelectorAll( '[data-id="signup"] .FilterMenu.isSingleSelect' )
			.forEach( ( input ) => input.removeEventListener( 'openedFilterMenu', runLoadScript ) );

		document.querySelectorAll( '[data-id="signup"] button[data-id=createButtonmain]' )
			.forEach( ( input ) => input.removeEventListener( 'openedFilterMenu', runLoadScript ) );
	}
};

// load script early to allow crm scripts load even the user focus input before the whole page is fully loaded on 'load' event
window.addEventListener( 'DOMContentLoaded', () => {
	signuplogin();
} );
