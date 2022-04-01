const activators = document.querySelectorAll( '[data-target]' );
const targets = document.querySelectorAll( `[data-targetId]` );

if ( activators.length > 0 ) {
	activators.forEach( ( elem ) => {
		const activator = elem;

		const hideVisible = () => {
			targets.forEach( ( targetElement ) => {
				targetElement.classList.remove( 'visible' );
				targetElement.classList.add( 'hidden' );
			} );
		};

		activator.addEventListener( 'click', ( event ) => {
			event.stopPropagation();
			const thisActivator = event.target;
			const thisTarget = document.querySelector(
				`[data-targetId="${ thisActivator.dataset.target }"]`
			);

			hideVisible();

			thisTarget.classList.remove( 'hidden' );
			thisActivator.classList.add( 'active' );
			setTimeout( () => {
				thisTarget.classList.add( 'visible' );
			}, 0 );
		} );
	} );
}
