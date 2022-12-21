const stickies = document.querySelectorAll( '[data-stickyFrom]' );

if ( stickies.length && 'IntersectionObserver' in window ) {
	const mql = window.matchMedia( '(min-width: 320px)' );

	const handleSticky = () => {
		const headerHeight = document
			.querySelector( 'header.Header' )
			.getBoundingClientRect().height;
		const windowHeight = window.innerHeight;

		const stickyObserver = new IntersectionObserver(
			( [ entry ] ) => {
				const stickyParent = entry.target;
				const stickyChild = stickyParent.firstElementChild;
				const stickyPos = stickyChild.getBoundingClientRect();
				stickyParent.style.height = `${ stickyPos.height }px`;

				if ( entry.isIntersecting || entry.boundingClientRect.top < 0 ) {
					stickyParent.dataset.isSticky = true;
					stickyChild.dataset.isSticky = true;
					stickyChild.style.cssText = `position: fixed; left: ${ stickyPos.x }px; width: ${ stickyPos.width }px`;
					return;
				}

				if ( ! entry.isIntersecting ) {
					delete stickyParent.dataset.isSticky;
					delete stickyChild.dataset.isSticky;
					stickyChild.style = null;
				}
			},
			{
				rootMargin: `0px 0px -${
					// eslint-disable-next-line no-mixed-operators
					100 - ( headerHeight / windowHeight ) * 100
				}% 0px`,
			}
		);

		stickies.forEach( ( sticky ) => {
			stickyObserver.observe( sticky );
		} );
	};

	if ( mql.matches ) {
		handleSticky();
	}

	// Handles case when user changes orientation of device from portrait > landscape, ie. iPad Pro
	mql.addEventListener( 'change', ( ) => {
		handleSticky();
	} );
}
