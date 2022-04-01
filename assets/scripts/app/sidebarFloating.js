/* global IntersectionObserver, ResizeObserver */

const categorySidebar = document.querySelector(
	'.Category__sidebar:not(#notFloating)'
);
const categoryContent = document.querySelector( '.Category__content' );
const windowHeight = window.innerHeight;

const lockSidebar = () => {
	if ( categorySidebar && 'IntersectionObserver' in window ) {
		const headerHeight = document
			.querySelector( 'header.Header' )
			.getBoundingClientRect().height;
		const categorySidebarContentHeight = categorySidebar
			.querySelector( '.Category__sidebar__items' )
			.getBoundingClientRect().height;

		const lockSidebarObserver = new IntersectionObserver(
			( [ content ] ) => {
				if ( content.isIntersecting ) {
					categorySidebar.classList.add( 'fixed' );
					if ( categorySidebarContentHeight + 120 > windowHeight ) {
						categorySidebar.classList.add( 'overflow' );
					}
				}
				if ( ! content.isIntersecting ) {
					categorySidebar.classList.remove( 'fixed', 'overflow' );
				}
			},
			{
				rootMargin: `0px 0px -${
					100 - ( headerHeight / windowHeight ) * 100
				}% 0px`,
			}
		);

		lockSidebarObserver.observe( categoryContent );

		const unlockSidebarObserverOnFooter = new IntersectionObserver(
			( [ footer ] ) => {
				if ( footer.isIntersecting ) {
					categorySidebar.classList.add( 'scrolledOut' );
					setTimeout( () => {
						categorySidebar.classList.remove(
							'fixed',
							'overflow',
							'scrolledOut'
						);
						categorySidebar.dataset.wasIntersecting = true;
					}, 200 );
				}

				if (
					! footer.isIntersecting &&
					categorySidebar.dataset.wasIntersecting
				) {
					categorySidebar.classList.add( 'fixed' );
					if ( categorySidebarContentHeight + 120 > windowHeight ) {
						categorySidebar.classList.add( 'overflow' );
					}
					categorySidebar.dataset.wasIntersecting = false;
				}
			}
		);

		unlockSidebarObserverOnFooter.observe(
			document.querySelector( '.Newsletter' )
		);
	}
};

const resizeWatcher = new ResizeObserver( ( [ entry ] ) => {
	if ( entry.borderBoxSize ) {
		lockSidebar();
	}
} );

resizeWatcher.observe( document.body );

window.addEventListener( 'load', () => {
	lockSidebar();
} );
