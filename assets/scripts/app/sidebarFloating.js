const categorySidebar = document.querySelector(
	'.Category__sidebar:not(#notFloating)'
);

/* Prevent to show footer over content while sidebar is changing from float to static
*/
const setContainerHeight = () => {
	const sidebarHeight = categorySidebar.getBoundingClientRect().height;
	const containerElement = document.querySelector( '.Category__container' );
	containerElement.style.minHeight = sidebarHeight + 'px';

	setTimeout( () => {
		containerElement.style.minHeight = null;
	}, 300 );
};

const lockSidebar = () => {
	if ( categorySidebar && 'IntersectionObserver' in window ) {
		function getActualHeight( e ) {
			return e.getBoundingClientRect().height;
		}
		const bottomObserverPoint = document.querySelector( '.Footer' );
		const categoryContent = document.querySelector( '.Category__content' );
		const categoryContentItemsHeight = document.querySelector(
			'.Category__content__items'
		).getBoundingClientRect().height;
		const windowHeight = window.innerHeight;

		categorySidebar.dataset.wasIntersecting = false;
		const headerHeight = document
			.querySelector( 'header.Header' )
			.getBoundingClientRect().height;
		const categorySidebarContentHeight = categorySidebar
			.querySelector( '.Category__sidebar__items' )
			.getBoundingClientRect().height;

		const lockSidebarObserver = new IntersectionObserver(
			( [ content ] ) => {
				if ( content.isIntersecting ) {
					if ( getActualHeight( categoryContent ) > categorySidebarContentHeight ) {
						categorySidebar.classList.add( 'fixed' );
						if ( categorySidebarContentHeight + 120 > windowHeight ) {
							categorySidebar.classList.add( 'overflow' );
						}
					}
				}
				if ( ! content.isIntersecting ) {
					categorySidebar.classList.remove( 'fixed', 'overflow' );
				}
			},
			{
				rootMargin: `0px 0px -${
					// eslint-disable-next-line no-mixed-operators
					100 - ( headerHeight / windowHeight ) * 100
				}% 0px`,
			}
		);

		lockSidebarObserver.unobserve(
			categoryContent
		);
		if ( categoryContentItemsHeight > windowHeight ) {
			lockSidebarObserver.observe( categoryContent );
		}

		const unlockSidebarObserverOnFooter = new IntersectionObserver(
			( [ entry ] ) => {
				if ( entry.isIntersecting && categorySidebar.dataset.wasIntersecting !== 'true' ) {
					entry.target.dataset.isIntersecting = true;
					if ( getActualHeight( categoryContent ) > categorySidebarContentHeight ) {
						categorySidebar.classList.add( 'scrolledOut' );
					}
					setTimeout( () => {
						categorySidebar.classList.remove(
							'fixed',
							'overflow',
							'scrolledOut'
						);
						categorySidebar.dataset.wasIntersecting = true;
					}, 0 );
				}

				if (
					! entry.isIntersecting && categorySidebar.dataset.wasIntersecting === 'true'
				) {
					if ( getActualHeight( categoryContent ) > categorySidebarContentHeight ) {
						entry.target.dataset.isIntersecting = false;
						categorySidebar.classList.add( 'fixed' );
						if ( categorySidebarContentHeight + 120 > windowHeight ) {
							categorySidebar.classList.add( 'overflow' );
						}
						categorySidebar.dataset.wasIntersecting = false;
					}
				}
			}
		);

		unlockSidebarObserverOnFooter.unobserve(
			bottomObserverPoint
		);
		if ( categoryContentItemsHeight > windowHeight ) {
			unlockSidebarObserverOnFooter.observe(
				bottomObserverPoint
			);
		}
	}
};

const resizeWatcher = new ResizeObserver( ( [ entry ] ) => {
	if ( entry.borderBoxSize ) {
		lockSidebar();
	}
} );

resizeWatcher.observe( document.body );

if ( categorySidebar ) {
	const categorySidebarLabels = categorySidebar
		.querySelectorAll( '.Category__sidebar__items label' );
	categorySidebarLabels.forEach( ( sidebarItem ) => {
		sidebarItem.addEventListener( 'click', () => {
			lockSidebar();
			setContainerHeight();
		} );
	} );
}

window.addEventListener( 'load', () => {
	lockSidebar();
} );
