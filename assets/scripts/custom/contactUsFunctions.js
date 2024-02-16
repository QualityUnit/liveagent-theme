function contactUsWhatsApp() {
	const text = 'Hi! I am contacting you from ' + window.location.href + ', and I am contacting you about...';
	const number = '17862041375';
	const whatsappLink = 'https://wa.me/' + number + '?text=' + encodeURIComponent( text );
	window.open( whatsappLink, '_blank' );
}

function contactUsMessenger() {
	const facebookLink = 'https://m.me/LiveAgent/';
	window.open( facebookLink, '_blank' );
}
