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

if ( comparePlansRows.length ) {
	const matchingRows = [];
	const compareSwitcher = document.querySelector( '[data-switcher="compare"]' );

	if ( compareSwitcher ) {
		const compareSwitcherLabels = compareSwitcher.querySelectorAll( 'label' );
		let cells;
		setOddEven();

		comparePlansRows.forEach( ( row ) => {
			// Checking if the row has the class .ComparePlans.enterprise
			const isEnterpriseRow = row.closest( '.ComparePlans.enterprise' );

			cells = isEnterpriseRow
				? row.querySelectorAll( 'td:nth-of-type(4), td:nth-of-type(6)' )
				: row.querySelectorAll( 'td:not(:first-of-type):not(:last-of-type)' );

			const firstValueCell = cells.item( 0 ).innerText;

			// Filtering array of nodes with different values
			const matching = [ ...cells ].filter( ( cell ) => cell.innerText !== firstValueCell );

			// If all cells have the same content, push the row to the array
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
	} else {
		setOddEven();
	}
}

// Toggle expand/collapse functionality for sections with data-expand attribute
document.addEventListener( 'DOMContentLoaded', function() {
	const toggleButton = document.querySelector( '.ExpandButton' );
	const section = document.querySelector( '[data-expand]' );
	const buttonText = toggleButton.querySelector( 'span:not(.hidden-text)' ); // Prvý viditeľný span
	const hiddenText = toggleButton.querySelector( '.hidden-text' );

	if ( toggleButton && section && buttonText && hiddenText ) {
		const expandText = buttonText.textContent;
		const collapseText = hiddenText.textContent;

		const initialState = section.getAttribute( 'data-expand' );
		if ( initialState === 'expanded' ) {
			buttonText.textContent = collapseText;
		}

		toggleButton.addEventListener( 'click', function( e ) {
			e.preventDefault();

			const current = section.getAttribute( 'data-expand' );
			const isExpanding = current === 'collapsed';

			section.setAttribute( 'data-expand', isExpanding ? 'expanded' : 'collapsed' );

			buttonText.textContent = isExpanding ? collapseText : expandText;
		} );
	}
} );
