const pricingTitles = document.querySelectorAll( '.ComparePlans .elementor-post__title' );

if ( pricingTitles.length ) {
	pricingTitles.forEach( ( title ) => {
		title.addEventListener( 'click', () => {
			title.classList.toggle( 'inactive' );
		} );
	} );
}
