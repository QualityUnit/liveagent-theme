const comparePlansTableTitles = document.querySelectorAll( '.ComparePlans .elementor-post__title' );
const comparePlansTitle = document.querySelector( '.ComparePlans__sectionTitle' );
const comparePlansHeader = document.querySelector( '.ComparePlans__header' );
const comparePlansTables = document.querySelectorAll( '.ComparePlans table' );
const comparePlansRows = document.querySelectorAll( '.ComparePlans table tr' );

const setOddEven = () => {
	if ( comparePlansRows.length ) {
		comparePlansRows.forEach( ( row ) => {
			row.classList.remove( 'even' );
		} );
	}

	comparePlansTables.forEach( ( table ) => {
		const visibleRows = table.querySelectorAll( 'tr:not(.hidden)' );

		if ( visibleRows.length ) {
			visibleRows.forEach( ( element, index ) => {
				const item = element;
				if ( index % 2 !== 0 ) { //We start at 0 not 1 so even is with modulus
					item.classList.add( 'even' );
				}
			} );
		}
	} );
};

// const comparePlansTableTitlesObserver = new IntersectionObserver(
// 	( [ title ] ) => {
// 		if ( title.isIntersecting ) {
// 			title.target.classList.remove( 'is-sticky' );
// 			return;
// 		}
// 		if ( title.boundingClientRect.top < 0 ) {
// 			title.target.classList.add( 'is-sticky' );
// 		}
// 	},
// 	{ rootMargin: '0px 0px -1000px 0px', threshold: 1 }
// );

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
				// document.querySelectorAll( '.elementor-post.ms_pricing' ).forEach( ( table ) => {
				// 	comparePlansTableTitlesObserver.observe( table );
				// } );
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
	const compareSwitcher = document.querySelector( '[data-switcher="compare"]' );
	const compareSwitcherLabels = compareSwitcher.querySelectorAll( 'label' );
	setOddEven();

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

	if ( matchingRows.length ) {
		compareSwitcher.addEventListener( 'click', () => {
			compareSwitcherLabels.forEach( ( label ) => {
				label.classList.toggle( 'active' );
			} );
			matchingRows.forEach( ( row ) => {
				row.classList.toggle( 'hidden' );
			} );
			setOddEven();
		} );
	}
	if ( ! matchingRows.length ) {
		compareSwitcher.classList.add( 'inactive' );
	}
}
