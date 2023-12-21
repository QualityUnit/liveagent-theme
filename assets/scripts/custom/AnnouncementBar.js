
const announcementBarSliders = document.querySelectorAll( '.Announcement__bars__slider' );
const announcementBars = document.querySelectorAll( '.Announcement__bars__slider .Announcement__bar' );
const appContainer = document.getElementById( 'app' );
const announcementClosed = sessionStorage.getItem( 'announcementClosed' );

if ( announcementClosed === 'true' ) {
	announcementBarSliders.forEach( ( slider ) => slider.remove() );
}

if ( announcementClosed !== 'true' ) {
	appContainer.insertAdjacentHTML( 'afterbegin', '<div class="observerPoint pos-absolute w-100" style="top: 800px;"></div>' );

	function showAnnouncementBar() {
		appContainer.classList.add( 'announcement--active' );
	}

	function hideAnnouncementBar() {
		appContainer.classList.remove( 'announcement--active' );
		appContainer.classList.add( 'announcement--hidden' );
		sessionStorage.setItem( 'announcementClosed', 'true' );
	}

	function initializeAnnouncementBar() {
		const scrollHeight = window.scrollY;
		const closeButton = document.querySelector( '.Announcement__bar__close' );

		if ( scrollHeight >= 800 ) {
			appContainer.classList.remove( 'announcement--hidden' );
			appContainer.classList.add( 'announcement--active' );
		}

		closeButton.addEventListener( 'click', function() {
			hideAnnouncementBar();
		} );
	}

	function toggleAnnouncementBar( hide ) {
		if ( hide ) {
			appContainer.classList.remove( 'announcement--active' );
			appContainer.classList.add( 'announcement--hidden' );
			return false;
		}
		appContainer.classList.add( 'announcement--active' );
		appContainer.classList.remove( 'announcement--hidden' );
	}

	document.addEventListener( 'DOMContentLoaded', function() {
		if ( ! announcementClosed ) {
			showAnnouncementBar();
		}
		initializeAnnouncementBar();
	} );

	const AnnouncementBarObserver = new IntersectionObserver(
		( [ entry ] ) => {
			if ( entry.isIntersecting ) {
				toggleAnnouncementBar( false );
			}
			if ( ! entry.isIntersecting ) {
				toggleAnnouncementBar( true );
			}
		}
	);

	AnnouncementBarObserver.observe( document.querySelector( '.observerPoint' ) );

	if ( announcementBars.length > 1 ) {
		let counter = 0;

		setInterval( () => {
			counter = counter + 1;

			if ( counter === announcementBars.length ) {
				announcementBars.item( 0 ).classList.add( 'active' );
				announcementBars.item( counter - 1 ).classList.remove( 'active' );
				counter = 0;
				return false;
			}

			announcementBars.item( counter ).classList.add( 'active' );
			announcementBars.item( counter - 1 ).classList.remove( 'active' );
		}, 8000 );
	}
}
