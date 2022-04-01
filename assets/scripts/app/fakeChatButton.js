/* global getCookie, navigator */

const fakeChatBtn = document.querySelector( '.fakeChatButton' );
const cookieModal = document.querySelector( '.Kolaciky' );
const maxTouchDevice = window.matchMedia( '(max-width: 1366px)' );
const isTouch = () => {
	return (
		'ontouchstart' in window ||
		navigator.maxTouchPoints > 0 ||
		navigator.msMaxTouchPoints > 0
	);
};

if ( fakeChatBtn && ! getCookie( 'cookieLaw' ) ) {
	fakeChatBtn.classList.remove( 'hidden' );
	fakeChatBtn.addEventListener( 'click', () => {
		cookieModal.classList.add( 'shakeX' );

		if ( isTouch && maxTouchDevice.matches ) {
			fakeChatBtn.classList.add( 'hover' );
		}

		cookieModal.addEventListener( 'animationend', () => {
			cookieModal.classList.remove( 'shakeX' );
			if ( isTouch ) {
				setTimeout( () => {
					fakeChatBtn.classList.remove( 'hover' );
				}, 1000 );
			}
		} );
	} );
}
