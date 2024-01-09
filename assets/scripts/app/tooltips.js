/* global Popper */
/* Tooltips */
document.addEventListener( 'DOMContentLoaded', () => {
	tooltips( [ 'Tooltip', 'ComparePlans__tooltip' ] );

	function tooltips( classList = [] ) {
		classList.forEach( ( className ) => {
			if ( document.querySelectorAll( '.' + className ).length > 0 && typeof Popper !== 'undefined' ) {
				document.querySelectorAll( '.' + className ).forEach( ( trigger ) => {
					const classText = className + '__text';
					const tooltip = trigger.querySelector( '.' + classText );
					if ( tooltip ) {
						let defaultPlacement = 'bottom';
						const arrow = document.createElement( 'span' );
						arrow.setAttribute( 'data-popper-arrow', '' );
						tooltip.appendChild( arrow );

						if ( tooltip.classList.contains( classText + '--top' ) ) {
							defaultPlacement = 'top';
						}

						const popperInstance = Popper.createPopper( trigger, tooltip, {
							placement: defaultPlacement,
							modifiers: [
								{
									name: 'offset',
									options: {
										offset: [ 0, 6 ],
									},
								},
							],
						} );

						function show() {
							tooltip.setAttribute( 'data-show', '' );
							popperInstance.setOptions( ( options ) => ( {
								...options,
								modifiers: [
									...options.modifiers,
									{ name: 'eventListeners', enabled: true },
								],
							} ) );
							popperInstance.update();
						}

						function hide() {
							tooltip.removeAttribute( 'data-show' );
							popperInstance.setOptions( ( options ) => ( {
								...options,
								modifiers: [
									...options.modifiers,
									{ name: 'eventListeners', enabled: false },
								],
							} ) );
						}

						const showEvents = [ 'mouseenter', 'focus' ];
						const hideEvents = [ 'mouseleave', 'blur' ];

						showEvents.forEach( ( event ) => {
							trigger.addEventListener( event, show );
						} );

						hideEvents.forEach( ( event ) => {
							trigger.addEventListener( event, hide );
						} );
					}
				} );
			}
		} );
	}
} );
