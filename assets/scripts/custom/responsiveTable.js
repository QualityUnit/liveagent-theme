const tables = document.querySelectorAll( 'figure.wp-block-table table' );

if ( tables.length ) {
	const hasTooltip = new RegExp( /(.+?)<i>(.+?)<\/i>/gi );

	tables.forEach( ( table ) => {
		const tr = table.querySelectorAll( 'tr' );
		const colspanRows = table.querySelectorAll( 'tbody tr td[colspan]:first-child' );

		if ( colspanRows?.length ) {
			table.classList.add( 'hasColspanGroups' );
		}

		//sets class and rating CSS variable for Alternative table
		const ratings = tr[ 1 ].querySelectorAll( 'td:not(:empty):not(:first-of-type)' );
		tr[ 1 ].classList.add( 'stars' );

		ratings.forEach( ( rating ) => {
			if ( ! isNaN( Number( rating.textContent ) ) ) {
				rating.style.setProperty( '--rating', rating.textContent );
			}
		} );

		//Sets check or crossover for Y or N vals
		for ( let i = 0; i <= tr.length; i++ ) {
			const headers = tr[ 0 ].querySelectorAll( 'th' );
			const vals = tr[ i + 1 ] && tr[ i + 1 ].querySelectorAll( 'td' );
			const allCells = tr[ i ] && tr[ i ].querySelectorAll( 'td, th' );

			if ( allCells?.length ) {
				allCells.forEach( ( cell ) => {
					const text = cell.textContent;

					if ( hasTooltip.test( text ) ) {
						const infoIcon = `<svg class="icon icon-info-circle">
							<use xlink:href="/app/themes/liveagent/assets/images/icons.svg#info-circle"></use>
							</svg>`;
						cell.classList.add( 'hasTooltip' );
						cell.innerHTML = text.replaceAll( hasTooltip, `$1<div class="ComparePlans__tooltip">${ infoIcon }<span class="ComparePlans__tooltip__text">$2</span></div>` );
					}
				} );
			}

			if ( vals?.length ) {
				vals.forEach( ( val, index ) => {
					if ( val.textContent === 'y' || val.textContent === 'Yes' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-check' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-check">
								<use xlink:href="/app/themes/liveagent/assets/images/icons.svg#check"></use>
							</svg>`
						);
					}
					if ( val.textContent === 'n' || val.textContent === 'No' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-close' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-close">
								<use xlink:href="/app/themes/liveagent/assets/images/icons.svg#close"></use>
							</svg>`
						);
					}

					if ( headers[ index ].innerHTML ) {
						val.insertAdjacentHTML( 'afterbegin', `<div class="tablet--only MobileHeader">${ headers[ index ].innerHTML }</div>` );
					}

					if ( ! headers[ index ].innerHTML ) {
						val.classList.add( 'MobileHeader__top' );
					}
				} );
			}
		}

		// Adds Class to odd tr with td[colspan] + tr for background
		for ( let i = 0; i <= colspanRows.length; i++ ) {
			if ( i % 2 === 1 ) {
				const isOddGroup = colspanRows[ i ]?.closest( 'tr' );
				isOddGroup.classList.add( 'oddGroup' );
				isOddGroup.nextElementSibling.classList.add( 'oddGroup' );
			}
		}
	} );
}
