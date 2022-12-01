window.addEventListener( 'load', () => {
	const activators = document.querySelectorAll( '[data-target]' );
	const closers = document.querySelectorAll( `[data-close-target]` );

	const hideVisible = ( target ) => {
		const activatorElem = document.querySelector( `[data-target="${ target }"]` );
		const closeTarget = document.querySelectorAll( `[data-targetId="${ target }"]` );

		if ( activatorElem && activatorElem.classList.contains( 'active' ) ) {
			setTimeout( () => {
				activatorElem.classList.remove( 'active' );
			}, 10 );
		}
		closeTarget.forEach( ( targetElement ) => {
			let hidedelay = targetElement.dataset.hideDelay;
			if ( ! hidedelay ) {
				hidedelay = 10;
			}
			targetElement.classList.remove( 'visible' );

			targetElement.addEventListener( 'transitionend', () => {
				if ( activatorElem && ! activatorElem.classList.contains( 'active' ) ) {
					setTimeout( () => {
						targetElement.classList.add( 'hidden' );
					}, hidedelay );
				}
			} );
		} );
	};

	if ( activators.length > 0 ) {
		activators.forEach( ( elem ) => {
			const activator = elem;

			activator.addEventListener( 'click', ( event ) => {
				event.stopPropagation();
				const thisActivator = activator;
				const thisTarget = document.querySelectorAll(
					`[data-targetId="${ thisActivator.dataset.target }"]`
				);

				if ( ! thisActivator.classList.contains( 'active' ) ) {
					thisTarget.forEach( ( target ) => {
						target.classList.remove( 'hidden' );
						setTimeout( () => {
							thisActivator.classList.add( 'active' );
							target.classList.add( 'visible' );
						}, 10 );
					} );
				}
				hideVisible( thisActivator.dataset.target );
			} );
		} );
	}

	if ( closers.length > 0 ) {
		closers.forEach( ( closeBtn ) => {
			closeBtn.addEventListener( 'click', () => {
				const target = closeBtn.dataset.closeTarget;
				hideVisible( target );
			} );
		} );
	}
} );

