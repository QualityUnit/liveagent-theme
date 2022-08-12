const elCountdown = document.querySelectorAll( '.el-countdown' );

elCountdown.forEach( ( element ) => {
	const el = element;
	const countDownDate = el.getAttribute( 'data-endtime' );

	if ( countDownDate !== null ) {
		const timer = setInterval( function() {
			let endTime = new Date( countDownDate );
			endTime = ( Date.parse( endTime ) / 1000 );

			let now = new Date();
			now = ( Date.parse( now ) / 1000 );

			const timeLeft = endTime - now;

			let days = Math.floor( timeLeft / 86400 );
			let hours = Math.floor( ( timeLeft - ( days * 86400 ) ) / 3600 );
			let minutes = Math.floor( ( timeLeft - ( days * 86400 ) - ( hours * 3600 ) ) / 60 );
			let seconds = Math.floor( ( timeLeft - ( days * 86400 ) - ( hours * 3600 ) - ( minutes * 60 ) ) );

			if ( days < '10' ) {
				days = '0' + days;
			}
			if ( hours < '10' ) {
				hours = '0' + hours;
			}
			if ( minutes < '10' ) {
				minutes = '0' + minutes;
			}
			if ( seconds < '10' ) {
				seconds = '0' + seconds;
			}

			if ( timeLeft <= 0 ) {
				days = '00';
				hours = '00';
				minutes = '00';
				seconds = '00';
			}

			el.querySelector( '.el-countdown__digits--days' ).innerHTML = days;
			el.querySelector( '.el-countdown__digits--hours' ).innerHTML = hours;
			el.querySelector( '.el-countdown__digits--minutes' ).innerHTML = minutes;
			el.querySelector( '.el-countdown__digits--seconds' ).innerHTML = seconds;
		}, 1000 );
	}
} );
