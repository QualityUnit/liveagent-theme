
const announcementBars = document.querySelectorAll( '.Announcement__bars__slider .Announcement__bar' );
const appContainer = document.getElementById( 'app' );

function showAnnouncementBar() {
	appContainer.classList.add( 'announcement--active' );
}

function hideAnnouncementBar() {
	appContainer.classList.remove( 'announcement--active' );
	appContainer.classList.add( 'announcement--hidden' );
	appContainer.classList.add( 'announcement--closed' );
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

function toggleAnnouncementBar() {
	const scrollHeight = window.scrollY;

	const announcementClosed = sessionStorage.getItem( 'announcementClosed' );
	if ( announcementClosed === 'true' ) {
		appContainer.classList.add( 'announcement--hidden' );
	} else if ( scrollHeight >= 800 ) {
		appContainer.classList.remove( 'announcement--active' );
		appContainer.classList.add( 'announcement--hidden' );
	} else if ( ! appContainer.classList.contains( 'announcement--closed' ) ) {
		if ( appContainer.classList.contains( 'announcement--hidden' ) ) {
			appContainer.classList.add( 'announcement--active' );
			appContainer.classList.remove( 'announcement--hidden' );
		}
	}
}

document.addEventListener( 'DOMContentLoaded', function() {
	const announcementClosed = sessionStorage.getItem( 'announcementClosed' );
	if ( ! announcementClosed ) {
		showAnnouncementBar();
	}
	initializeAnnouncementBar();
} );

window.addEventListener( 'scroll', toggleAnnouncementBar );

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
