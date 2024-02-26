/* Youtube video lightbox modal, used ie. in See it in Action headline homepage */
/* Usage (important parameters data-ytid Youtube ID, data-lightbox="youtube"):
  <a href="#" data-ytid="3zYfDwqNj0U" data-lightbox="youtube" class="Button--inaction">
    <strong>See it in Action</strong>
  </a>
*/
const videoVertical = document.querySelectorAll(
	'[class*="Block--video__vertical"] [data-ytid]'
);

if ( videoVertical.length > 0 ) {
	videoVertical.forEach( ( video ) => {
		const playBtn = document.createElement( 'span' );

		Object.assign( playBtn, {
			className: 'playBtn',
		} );
		playBtn.dataset.ytid = video.dataset.ytid;
		video.closest( '.elementor-widget-container' ).insertAdjacentElement( 'afterbegin', playBtn );
	} );
}

// Removing preinserted data-ytid attribute from URLslab due to iFrame conflict - we don't want to insert iFrame to replace image
const blockVideos = document.querySelectorAll( '[class*="Block--video"] .youtube_urlslab_loader[data-ytid], .GutenbergVideo .youtube_urlslab_loader[data-ytid]' );

if ( blockVideos.length ) {
	blockVideos.forEach( ( video ) => {
		const dataVideo = video.dataset.ytid;

		if ( video.closest( '.elementor-widget-video, .wp-block-embed' ) ) {
			video.closest( '.elementor-widget-video, .wp-block-embed' ).dataset.ytid = dataVideo;
			video.removeAttribute( 'data-ytid' );
		}
	} );
}

const modalVideo = document.querySelectorAll(
	'[data-lightbox="youtube"], [class*="Block--video"] [data-ytid], .GutenbergVideo [data-ytid]'
);

function loadYouTubeModal( yt, target ) {
	const videoID = yt.dataset.ytid;
	const iframe = document.createElement( 'iframe' );

	Object.assign( iframe, {
		className: 'youtube__inmodal',
		title: yt.getAttribute( 'title' ),
		src: `https://www.youtube.com/embed/${ videoID }?feature=oembed&autoplay=1&playsinline=1&rel=0`,
		width: '100%',
		height: '100%',
		frameborder: '0',
		allow: 'accelerometer; mute; autoplay; gyroscope; fullscreen',
	} );

	target.insertAdjacentElement( 'beforeend', iframe );
}

function removeYouTubeModal( event, target ) {
	const body = document.querySelector( 'body' );

	event.stopPropagation();
	if ( target ) {
		target.classList.remove( 'active' );
		setTimeout( () => {
			target.remove();
		}, 500 );
	}
	body.classList.remove( 'lb-disable-scrolling' );
}

if ( modalVideo.length > 0 ) {
	const body = document.querySelector( 'body' );
	modalVideo.forEach( ( videoLink ) => {
		videoLink.addEventListener( 'click', ( event ) => {
			const modalConst = document.createElement( 'div' );
			modalConst.classList.add( 'lightbox', 'lightbox-youtube' );
			event.preventDefault();
			modalConst.innerHTML +=
				'<span class="lightbox__close">&times;</span>';
			modalConst.innerHTML += '<div class="youtube__inn"></div>';
			const modalInn = modalConst.querySelector( '.youtube__inn' );
			modalInn.innerHTML += '<div class="youtube__wrapper"></div>';

			loadYouTubeModal(
				videoLink,
				modalInn.querySelector( '.youtube__wrapper' )
			);

			if ( body.querySelector( '.lightbox' ) === null ) {
				body.appendChild( modalConst );
			}

			body.classList.add( 'lb-disable-scrolling' );
			modalConst.style.display = 'block';

			setTimeout( () => {
				modalConst.classList.add( 'active' );
				modalConst.style.visibility = 'visible';
			}, 100 );
		} );
	} );

	document.addEventListener( 'click', ( event ) => {
		const modalConst = document.querySelector( '.lightbox-youtube' );
		if (
			event.target.classList.contains( 'lightbox__close' ) &&
			event.target.parentElement.classList.contains( 'lightbox-youtube' )
		) {
			removeYouTubeModal( event, modalConst );
		}
	} );

	document.addEventListener( 'keyup', ( e ) => {
		const modalConst = document.querySelector( '.lightbox-youtube' );
		if ( e.key === 'Escape' ) {
			removeYouTubeModal( e, modalConst );
		}
	} );
}
