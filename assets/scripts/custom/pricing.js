const mainHeaderHeight = document.querySelector( '.Header' ).clientHeight;

/* Expand table */
document
	.querySelectorAll( '.ComparePlans__section .ComparePlans__table-title' )
	.forEach( ( element ) => {
		element.addEventListener( 'click', () => {
			element.classList.toggle( 'ComparePlans__open' );

			function hideCompareTableRows( el ) {
				const nextUntil = [];
				let until = true;
				let value;

				// eslint-disable-next-line no-param-reassign
				while ( ( el = el.nextElementSibling ) ) {
					if (
						until &&
						el &&
						! el.matches( '.ComparePlans__view' )
					) {
						nextUntil.push( el );
					} else {
						until = false;
					}
				}
				if ( value !== true ) {
					nextUntil.forEach( ( item ) => {
						item.classList.toggle( 'ComparePlans__open' );
					} );
					value = true;
				}
			}

			hideCompareTableRows( element );
		} );
	} );

/* Currency switcher */
if ( document.querySelector( '#switch-id' ) !== null ) {
	document.querySelector( '#switch-id' ).addEventListener( 'change', () => {
		const switchUSD = document.querySelector(
			'.Pricing__header__currency-switcher-title-usd'
		);
		const switchEUR = document.querySelector(
			'.Pricing__header__currency-switcher-title-eur'
		);

		if ( document.querySelector( '#switch-id' ).matches( ':checked' ) ) {
			document.querySelectorAll( '.price-usd' ).forEach( ( element ) => {
				element.classList.remove( 'price-show' );
				element.classList.add( 'price-hide' );
			} );
			document.querySelectorAll( '.price-eur' ).forEach( ( element ) => {
				element.classList.remove( 'price-hide' );
				element.classList.add( 'price-show' );
			} );
			switchEUR.classList.remove( 'shadow-price-title' );
			switchUSD.classList.add( 'shadow-price-title' );
		} else {
			document.querySelectorAll( '.price-usd' ).forEach( ( element ) => {
				element.classList.remove( 'price-hide' );
				element.classList.add( 'price-show' );
			} );
			document.querySelectorAll( '.price-eur' ).forEach( ( element ) => {
				element.classList.remove( 'price-show' );
				element.classList.add( 'price-hide' );
			} );
			switchUSD.classList.remove( 'shadow-price-title' );
			switchEUR.classList.add( 'shadow-price-title' );
		}
	} );
}

/* Differences switcher */
if ( document.querySelector( '#switch-id-differences' ) !== null ) {
	const switchDiff = document.querySelector( '#switch-id-differences' );
	const visibleRows = document.querySelectorAll(
		'.ComparePlans__table-row:not(.ComparePlans__same-item)'
	);

	switchDiff.addEventListener( 'change', () => {
		if ( switchDiff.matches( ':checked' ) ) {
			document
				.querySelectorAll( '.ComparePlans__same-item' )
				.forEach( ( i ) => {
					const item = i;
					item.classList.add( 'ComparePlans__differences--hide' );
					item.classList.remove( 'ComparePlans__differences--show' );
				} );
			document
				.querySelectorAll(
					'.ComparePlans__header__switcher__title--differences'
				)
				.forEach( ( i ) => {
					const item = i;
					item.classList.remove( 'shadow-price-title' );
				} );
			document
				.querySelectorAll(
					'.ComparePlans__header__switcher__title--all'
				)
				.forEach( ( i ) => {
					const item = i;
					item.classList.add( 'shadow-price-title' );
				} );
			visibleRows.forEach( ( element, index ) => {
				const item = element;
				if ( index % 2 === 0 ) {
					item.classList.add( 'even' );
				}

				if ( index % 2 !== 0 ) {
					item.classList.add( 'odd' );
				}
			} );
		} else {
			document
				.querySelectorAll( '.ComparePlans__same-item' )
				.forEach( ( i ) => {
					const item = i;
					item.classList.remove( 'ComparePlans__differences--hide' );
					item.classList.add( 'ComparePlans__differences--show' );
				} );
			document
				.querySelectorAll(
					'.ComparePlans__header__switcher__title--differences'
				)
				.forEach( ( i ) => {
					const item = i;
					item.classList.add( 'shadow-price-title' );
				} );
			document
				.querySelectorAll(
					'.ComparePlans__header__switcher__title--all'
				)
				.forEach( ( i ) => {
					const item = i;
					item.classList.remove( 'shadow-price-title' );
				} );
			visibleRows.forEach( ( element ) => {
				const item = element;
				item.classList.remove( 'even' );
				item.classList.remove( 'odd' );
			} );
		}
	} );
}

/* Show all */
if (
	document.querySelector( '#ComparePlans__show-all-integrations' ) !== null
) {
	document
		.querySelector( '#ComparePlans__show-all-integrations' )
		.addEventListener( 'click', () => {
			document
				.querySelectorAll( '.ComparePlans__integrations--all' )
				.forEach( ( i ) => {
					const item = i;
					item.classList.toggle( 'ComparePlans__integrations--show' );
					item.classList.toggle( 'ComparePlans__integrations--hide' );
				} );
			document
				.querySelectorAll( '.ComparePlans__integrations--short' )
				.forEach( ( i ) => {
					const item = i;
					item.classList.toggle( 'ComparePlans__integrations--hide' );
					item.classList.toggle( 'ComparePlans__integrations--show' );
				} );
			document
				.querySelector( '.ComparePlans__button--show-all' )
				.classList.toggle( 'popular' );
		} );
}

/* Sticky header */
function sticky( stickyTable ) {
	if ( stickyTable !== null ) {
		const stickyTop = stickyTable.getBoundingClientRect();

		if ( window.matchMedia( '(max-width: 1180px)' ).matches ) {
			const header = document.querySelector(
				'#ComparePlans__table-head-wrap--mobile'
			);
			const posTop = stickyTop.top + mainHeaderHeight;

			window.addEventListener( 'scroll', () => {
				if ( window.scrollY >= posTop ) {
					header.classList.add( 'fixed' );
				} else {
					header.classList.remove( 'fixed' );
				}
			} );
		}

		if ( window.matchMedia( '(min-width: 1180px)' ).matches ) {
			const header = document.querySelector(
				'#ComparePlans__table-head-wrap'
			);
			const posTop = stickyTop.top + window.pageYOffset + 80;

			window.addEventListener( 'scroll', () => {
				if ( window.scrollY >= posTop ) {
					header.classList.add( 'ComparePlans__fixed' );
					document
						.querySelectorAll( '.ComparePlans__header__icon' )
						.forEach( ( element ) => {
							const icon = element;
							icon.classList.add(
								'ComparePlans__header-image--hide'
							);
							icon.classList.remove(
								'ComparePlans__header-image--show'
							);
						} );
				} else {
					header.classList.remove( 'ComparePlans__fixed' );
					document
						.querySelectorAll( '.ComparePlans__header__icon' )
						.forEach( ( element ) => {
							const icon = element;
							icon.classList.remove(
								'ComparePlans__header-image--hide'
							);
							icon.classList.add(
								'ComparePlans__header-image--show'
							);
						} );
				}
			} );
		}
	}
}

sticky( document.querySelector( '#ComparePlans__table' ) );
