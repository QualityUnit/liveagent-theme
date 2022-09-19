/* global IntersectionObserver */

const progressBars = document.querySelectorAll( '.progressBar__inn' );

if ( progressBars.length ) {
	progressBars.forEach( ( progressBar ) => {
		progressBar.classList.add( 'visible' );
	} );

	if ( 'IntersectionObserver' in window ) {
		const progressBarObserver = new IntersectionObserver(
			( entries ) => {
				entries.forEach(
					( entry ) => {
						if ( entry.isIntersecting ) {
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
}
