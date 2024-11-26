const elCountdown = document.querySelectorAll( '.Countdown' );

elCountdown.forEach( ( element ) => {
	const el = element;
	const countDownDate = el.getAttribute( 'data-endtime' );

	if ( countDownDate !== null ) {
		// Start an interval that updates the countdown every second
		const interval = setInterval( function() {
			// Convert the date to an ISO 8601 compatible format for Safari
			const endTime = new Date( countDownDate.replace( ' ', 'T' ) ).getTime() / 1000;

			// Get the current time in seconds
			const now = new Date().getTime() / 1000;

			// Calculate the remaining time
			const timeLeft = endTime - now;

			// Calculate days, hours, minutes, and seconds
			let days = Math.floor( timeLeft / 86400 );
			let hours = Math.floor( ( timeLeft % 86400 ) / 3600 );
			let minutes = Math.floor( ( timeLeft % 3600 ) / 60 );
			let seconds = Math.floor( timeLeft % 60 );

			// Add a leading zero to single-digit values
			days = days < 10 ? '0' + days : days;
			hours = hours < 10 ? '0' + hours : hours;
			minutes = minutes < 10 ? '0' + minutes : minutes;
			seconds = seconds < 10 ? '0' + seconds : seconds;

			// If the countdown has ended, set all values to "00" and stop the interval
			if ( timeLeft <= 0 ) {
				days = '00';
				hours = '00';
				minutes = '00';
				seconds = '00';
				clearInterval( interval );
			}

			// Update the countdown display elements, if they exist
			if ( el.querySelector( '[data-days]' ) ) {
				el.querySelector( '[data-days]' ).innerHTML = days;
			}
			if ( el.querySelector( '[data-hours]' ) ) {
				el.querySelector( '[data-hours]' ).innerHTML = hours;
			}
			if ( el.querySelector( '[data-minutes]' ) ) {
				el.querySelector( '[data-minutes]' ).innerHTML = minutes;
			}
			if ( el.querySelector( '[data-seconds]' ) ) {
				el.querySelector( '[data-seconds]' ).innerHTML = seconds;
			}
		}, 1000 ); // Repeat every 1000ms (1 second)
	}
} );
