window.addEventListener( 'DOMContentLoaded', () => {
	const activators = document.querySelectorAll( '[data-target]' );
	const closers = document.querySelectorAll( `[data-close-target]` );

	// Define a function to toggle the visibility of target elements
	const toggleVisibility = ( target ) => {
		const targetElements = document.querySelectorAll( `[data-targetId="${ target }"]` );
		const activator = document.querySelector( `[data-target="${ target }"]` );
		const isActive = activator.classList.contains( 'active' );

		// Iterate over each target element to toggle its visibility
		targetElements.forEach( ( targetElement ) => {
			if ( isActive ) {
				// If active hide the element
				targetElement.classList.remove( 'visible' );
				setTimeout( () => {
					targetElement.classList.add( 'hidden' );
				}, 10 );
			} else {
				// If not active show the element
				targetElement.classList.remove( 'hidden' );
				setTimeout( () => {
					targetElement.classList.add( 'visible' );
				}, 10 ); // Delay for the show transition
			}
		} );

		// Toggle the class on the activator
		activator.classList.toggle( 'active' );
	};

	// Attach click event listeners to each activator
	activators.forEach( ( activator ) => {
		activator.addEventListener( 'click', ( event ) => {
			event.stopPropagation();
			const target = activator.dataset.target;
			toggleVisibility( target );
		} );
	} );

	// Close the visible elements when clicking outside
	document.body.addEventListener( 'click', ( event ) => {
		if ( ! event.target.closest( '[data-close-target], [data-target]' ) ) {
			activators.forEach( ( activator ) => {
				const target = activator.dataset.target;
				if ( activator.classList.contains( 'active' ) ) {
					toggleVisibility( target );
				}
			} );
		}
	} );

	// Close the visible elements when pressing the 'ESC' key
	document.addEventListener( 'keyup', ( e ) => {
		if ( e.key === 'Escape' ) {
			activators.forEach( ( activator ) => {
				const target = activator.dataset.target;
				if ( activator.classList.contains( 'active' ) ) {
					toggleVisibility( target ); // Toggle visibility if the activator is active
				}
			} );
		}
	} );

	// Attach click event listeners to each close button
	closers.forEach( ( closeBtn ) => {
		closeBtn.addEventListener( 'click', () => {
			const target = closeBtn.dataset.closeTarget;
			toggleVisibility( target );
		} );
	} );
} );
