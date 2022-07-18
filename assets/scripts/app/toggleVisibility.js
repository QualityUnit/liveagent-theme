const activators = document.querySelectorAll( '[data-target]' );
const targets = document.querySelectorAll( `[data-targetId]` );

let isPaused = false;

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
			isPaused = true;

			thisTarget.classList.remove( 'hidden' );
			thisActivator.classList.add( 'active' );
			setTimeout( () => {
				thisTarget.classList.add( 'visible' );
			}, 0 );
		} );
	} );
}

const switcher = document.querySelector( '.Block--switcher' );
if ( switcher ) {
	( function autoSwitch( interval = 5000 ) {
		if ( ! isPaused ) {
			const notCheckedInput = switcher.querySelector( '.switcher__input:not(:checked)' );
			const isActive = switcher.querySelector( '.visible[data-targetid]' );
			const isHidden = switcher.querySelector( '.hidden[data-targetid]' );

			notCheckedInput.checked = true;

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
}

