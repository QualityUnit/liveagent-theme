
/* Trial sticky button at the bottom of the page */

const trialStickyButton = document.querySelector( '.trial__sticky__button' );
const contactUs = document.querySelector( '.ContactUs' );

if ( trialStickyButton !== null ) {
	window.addEventListener( 'load', function() {
		if ( window.matchMedia( '(max-width: 1024px)' ).matches ) {
			const trialStickyButtonClosedValue = sessionStorage.getItem( 'trialStickyButtonClosed' );
			let isClosed = trialStickyButtonClosedValue === 'true';

			function showTrialStickyButton() {
				if ( trialStickyButton && contactUs && ! isClosed ) {
					trialStickyButton.classList.add( 'active' );
					contactUs.classList.add( 'active' );
				}
			}

			function closeTrialStickyButton() {
				const closeButton = document.querySelector( '.trial__sticky__button--close' );

				if ( closeButton && trialStickyButton && contactUs ) {
					closeButton.addEventListener( 'click', function() {
						trialStickyButton.classList.remove( 'active' );
						contactUs.classList.remove( 'active' );
						sessionStorage.setItem( 'trialStickyButtonClosed', 'true' );
						isClosed = true;
					} );
				}
			}

			setTimeout( showTrialStickyButton, 7000 );

			closeTrialStickyButton();
		}
	} );
}
