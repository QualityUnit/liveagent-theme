const comparePlansTableTitles = document.querySelectorAll( '.ComparePlans .elementor-post__title' );
const comparePlansTitle = document.querySelector( '.ComparePlans__sectionTitle' );
const comparePlansHeader = document.querySelector( '.ComparePlans__header' );
const comparePlansRows = document.querySelectorAll( '.ComparePlans table tr' );

// Setting tables header class when sticky to hide icons
if ( comparePlansHeader ) {
	const headerObserver = new IntersectionObserver(
		( [ entry ] ) => {
			if ( entry.isIntersecting ) {
				comparePlansHeader.classList.remove( 'is-sticky' );
				return;
			}
			if ( entry.boundingClientRect.top < 0 ) {
				comparePlansHeader.classList.add( 'is-sticky' );
			}
		},
		{ rootMargin: '-92px 0px 0px 0px' }
	);

	headerObserver.observe( comparePlansTitle );
}

// Toggling visibility of table below main title
if ( comparePlansTableTitles.length ) {
	comparePlansTableTitles.forEach( ( title ) => {
		title.addEventListener( 'click', () => {
			title.classList.toggle( 'inactive' );
		} );
	} );
}

// Finding differences in values in pricing table rows
if ( comparePlansRows.length ) {
	const matchingRows = [];

	comparePlansRows.forEach( ( row ) => {
		// Selecting cells except first description one
		const cells = row.querySelectorAll( 'td:not(:first-of-type' );
		const firstValueCell = cells.item( 0 ).innerText;

		// Filtering array of nodes with different values
		const matching = [ ...cells ].filter( ( cell ) => cell.innerText !== firstValueCell );

		// If returns td cells with same content in all cells, push the row to the array
		if ( ! matching.length ) {
			matchingRows.push( row );
		}
	} );
}
