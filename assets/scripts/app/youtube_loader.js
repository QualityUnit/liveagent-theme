const youtubeVideo = document.querySelectorAll( '.youtube__loader' );

function loadYouTube( yt ) {
	if ( ! yt.closest( '.Block--video' ) ) {
		const videoID = yt.dataset.ytid;
		const iframe = document.createElement( 'iframe' );

		Object.assign( iframe, {
			className: 'youtube__loader--embed',
			title: yt.getAttribute( 'title' ),
			src: `https://www.youtube.com/embed/${ videoID }?feature=oembed&autoplay=1&playsinline=1&rel=0`,
			width: 560,
			height: 315,
			frameborder: '0',
			allow: 'accelerometer; autoplay; gyroscope; fullscreen',
		} );

		yt.insertAdjacentElement( 'afterbegin', iframe );
		setTimeout( () => {
			yt.classList.add( 'active' );
		}, 200 );
	}
}

if ( youtubeVideo !== null ) {
	youtubeVideo.forEach( ( element ) => {
		const yt = element;

		yt.addEventListener( 'click', () => {
			loadYouTube( yt );
		} );

		yt.removeEventListener( 'click', loadYouTube );
	} );
}
