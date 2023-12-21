
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

			const TrialButtonObserver = new IntersectionObserver(
				( [ entry ] ) => {
					if ( entry.isIntersecting ) {
						showTrialStickyButton();
					}
				},
				{
					rootMargin: `0px 0px -100% 0px`,
				}
			);

			TrialButtonObserver.observe( document.querySelector( '.AppContainer > *:first-child' ) );

			closeTrialStickyButton();
		}
	} );
}
