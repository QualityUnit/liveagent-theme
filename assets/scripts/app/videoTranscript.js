const videoTranscripts = document.querySelectorAll( '.urlslab-video-transcript-inn' );

if ( videoTranscripts.length ) {
	videoTranscripts.forEach( ( transcript ) => {
		const activator = transcript.querySelector( '[data-activator]' );
		const deactivator = transcript.querySelector( '[data-deactivator]' );

		const toggleActive = () => {
			transcript.classList.toggle( 'active' );
		};

		activator.addEventListener( 'click', () => {
			toggleActive();
			activator.removeEventListener( 'click', toggleActive, false );
		} );

		deactivator.addEventListener( 'click', () => {
			toggleActive();
			deactivator.removeEventListener( 'click', toggleActive, false );
		}, false
		);
	} );
}
