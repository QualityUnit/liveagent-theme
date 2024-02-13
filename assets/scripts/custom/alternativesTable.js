const tables = document.querySelectorAll( 'body.alternatives.single table' );

if ( tables.length ) {
	const hasTooltip = new RegExp( /(.+?)<i>(.+?)<\/i>/gi );

	tables.forEach( ( table ) => {
		const tr = table.querySelectorAll( 'tr' );

		//sets class and rating CSS variable
		const ratings = tr[ 1 ].querySelectorAll( 'td:not(:empty):not(:first-of-type)' );
		tr[ 1 ].classList.add( 'stars' );

		ratings.forEach( ( rating ) => {
			if ( ! isNaN( Number( rating.textContent ) ) ) {
				rating.style.setProperty( '--rating', rating.textContent );
			}
		} );

		//Sets check or crossover for Y or N vals
		for ( let i = 1; i <= tr.length; i++ ) {
			const headers = tr[ 0 ].querySelectorAll( 'td:not(:first-of-type)' );
			const vals = tr[ i ].querySelectorAll( 'td:not(:first-of-type)' );
			const firstColumnCells = tr[ i ].querySelectorAll( 'td:first-of-type:not(:empty)' );

			if ( vals.length ) {
				vals.forEach( ( val, index ) => {
					if ( val.textContent === 'y' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-check' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-check">
								<use xlink:href="/app/themes/liveagent/assets/images/icons.svg#check"></use>
							</svg>`
						);
					}
					if ( val.textContent === 'n' ) {
						val.textContent = null;
						val.classList.add( 'icn-after-close' );
						val.insertAdjacentHTML( 'afterbegin', `
							<svg class="icon icon-close">
								<use xlink:href="/app/themes/liveagent/assets/images/icons.svg#close"></use>
							</svg>`
						);
					}

					val.insertAdjacentHTML( 'afterbegin', `<div class="mobile--only AlternativeName">${ headers[ index ].textContent }</div>` );
				} );
			}

			if ( firstColumnCells.length ) {
				firstColumnCells.forEach( ( cell ) => {
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
		}
	} );
}
