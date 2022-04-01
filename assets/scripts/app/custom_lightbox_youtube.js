/* Youtube video lightbox modal, used ie. in See it in Action headline homepage */
/* Usage (important parameters data-ytid Youtube ID, data-lightbox="youtube"):
  <a href="#" data-ytid="3zYfDwqNj0U" data-lightbox="youtube" class="Button--inaction">
    <strong>See it in Action</strong>
  </a>
*/
const modalVideo = document.querySelectorAll(
	'[data-lightbox="youtube"], [class*="Block--video"] [data-ytid]'
);
const body = document.querySelector( 'body' );

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
	event.stopPropagation();
	target.classList.remove( 'active' );
	body.classList.remove( 'lb-disable-scrolling' );

	setTimeout( () => {
		target.remove();
	}, 500 );
}

if ( modalVideo.length > 0 ) {
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
