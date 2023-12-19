
/* Awards switching */
const awardsYears = document.querySelectorAll( '.Awards__switcher--year' );

if ( awardsYears.length > 0 ) {
	awardsYears.forEach( ( year ) => {
		year.addEventListener( 'click', () => {
			const yearActive = document.querySelector(
				'.Awards__switcher--year.active'
			);
			const yearContainerActive = document.querySelector(
				'.Awards__container.active'
			);

			const thisYear = year;
			const thisYearRef = year.dataset.year;

			yearActive.classList.remove( 'active' );
			thisYear.classList.add( 'active' );
			yearContainerActive.classList.remove( 'active' );
			document
				.querySelector(
					`.Awards__container[data-year='${ thisYearRef }']`
				)
				.classList.add( 'active' );
		} );
	} );
}
