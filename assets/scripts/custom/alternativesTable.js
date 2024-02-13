const tables = document.querySelectorAll( 'body.alternatives.single table' );

if ( tables.length > 0 ) {
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
		for ( let i = 0; i <= tr.length; i++ ) {
			const vals = tr[ i ].querySelectorAll( 'td:not(:empty):not(:first-of-type)' );
			vals.forEach( ( val ) => {
				if ( val.textContent === 'y' ) {
					val.textContent = null;
					val.classList.add( 'icn-after-check' );
					val.insertAdjacentHTML( 'afterbegin', `
            <svg class="icon icon-check">
              <use xlink:href="/app/themes/liveagent/assets/images/icons.svg#check"></use>
            </svg>`
					);
					return;
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
			} );
		}
	} );
}
