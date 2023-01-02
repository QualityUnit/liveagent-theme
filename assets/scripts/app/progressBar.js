const progressBars = document.querySelectorAll( '.progressBar__inn' );

if ( progressBars.length && 'IntersectionObserver' in window ) {
	const progressBarObserver = new IntersectionObserver(
		( entries ) => {
			entries.forEach(
				( entry ) => {
					if ( entry.isIntersecting ) {
						progressBars.forEach( ( progressBar ) => {
							progressBar.classList.add( 'visible' );
						} );
						progressBarObserver.unobserve( entry.target );
					}
				}
			);
		}
	);

	progressBars.forEach(
		( progressBar ) => {
			progressBarObserver.observe( progressBar );
		}
	);
}
