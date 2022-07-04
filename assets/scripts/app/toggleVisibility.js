const activators = document.querySelectorAll( '[data-target]' );
const targets = document.querySelectorAll( `[data-targetId]` );

let isPauzed = false;

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
			isPauzed = true;

			thisTarget.classList.remove( 'hidden' );
			thisActivator.classList.add( 'active' );
			setTimeout( () => {
				thisTarget.classList.add( 'visible' );
			}, 0 );
		} );
	} );
}

const switcher = document.querySelector( '.Block--switcher' );
( function autoSwitch( interval = 3000 ) {
	if ( ! isPauzed ) {
		const isActive = switcher.querySelector( '.visible[data-targetid]' );
		const isHidden = switcher.querySelector( '.hidden[data-targetid]' );

		isActive.classList.remove( 'visible' );
		isActive.classList.add( 'hidden' );

		isHidden.classList.remove( 'hidden' );

		setTimeout( () => {
			isHidden.classList.add( 'visible' );
		}, 200 );

		setTimeout( () => {
			autoSwitch();
		}, interval );
	}
}() );

