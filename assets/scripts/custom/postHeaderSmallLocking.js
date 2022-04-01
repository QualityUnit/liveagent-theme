/* global IntersectionObserver */

const postHeader = document.querySelector( '.Post__header' );
const postHeaderSmall = document.querySelector( '.Post__header__small' );

if ( postHeaderSmall && 'IntersectionObserver' in window ) {
	const postHeaderObserver = new IntersectionObserver(
		( [ entry ] ) => {
			if ( entry.isIntersecting ) {
				postHeaderSmall.classList.remove( 'visible' );
				return;
			}
			if ( entry.boundingClientRect.top < 0 ) {
				postHeaderSmall.classList.add( 'visible' );
			}
		},
		{
			rootMargin: '-92px 0px 0px 0px',
		}
	);

	postHeaderObserver.observe( postHeader );
}
