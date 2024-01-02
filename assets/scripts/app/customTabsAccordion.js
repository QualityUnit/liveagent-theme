
// Custom tabs and accordion, replacing Elementor one
if ( document.querySelectorAll( '.elementor-tab-title' ).length > 0 ) {
	const tabItems = document.querySelectorAll( '.elementor-tab-title' );
	const firstItemRef = tabItems.item( 0 ).getAttribute( 'aria-controls' );
	const parent = tabItems
		.item( 0 )
		.closest( '.elementor-widget-container' );

	tabItems.forEach( ( element ) => {
		const elemReference = element.getAttribute( 'aria-controls' );
		const elemContent = document.querySelector( `#${ elemReference }` );

		if (
			parent.querySelectorAll( '.elementor-accordion-item' ).length >
      0
		) {
			elemContent.dataset.height = `${ elemContent.clientHeight }px`;
			elemContent.style.height = '0px';
			elemContent.style.paddingBottom = '0px';
		}
		element.addEventListener( 'click', ( event ) => {
			const nonActive = document.querySelectorAll(
				`[aria-controls=${ elemReference }], #${ elemReference }`
			);

			event.preventDefault();

			if (
				parent.querySelector(
					'[data-active="elementor-active"].elementor-tab-content'
				) !== null
			) {
				const activeElem = parent.querySelectorAll(
					'[data-active="elementor-active"]'
				);

				if (
					parent.querySelectorAll( '.elementor-accordion-item' )
						.length > 0
				) {
					parent.querySelector(
						'[data-active="elementor-active"].elementor-tab-content'
					).style.height = '0px';
				}
				activeElem.forEach( ( elementorItem ) => {
					elementorItem.dataset.active = '';
				} );
			}

			nonActive.forEach( ( elementorItem ) => {
				elementorItem.dataset.active = 'elementor-active';
			} );

			if (
				parent.querySelectorAll( '.elementor-accordion-item' )
					.length > 0
			) {
				elemContent.style.height = elemContent.dataset.height;
			}
		} );
	} );

	document.querySelectorAll(
		`[aria-controls=${ firstItemRef }], #${ firstItemRef }`
	).forEach( ( item ) => {
		item.dataset.active = 'elementor-active';
		// eslint-disable-next-line no-param-reassign
		item.style.height = 'auto';
	} );
}
