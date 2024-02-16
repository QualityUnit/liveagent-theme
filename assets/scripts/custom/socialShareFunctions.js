/* eslint-disable no-unused-vars */

function shareOnFacebook( element ) {
	const permalink = element.getAttribute( 'data-permalink' );
	const shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent( permalink );
	window.open( shareUrl, '_blank' );
}
function shareOnTwitter( element ) {
	const permalink = element.getAttribute( 'data-permalink' );
	const shareUrl = 'https://twitter.com/share?url=' + encodeURIComponent( permalink );
	window.open( shareUrl, '_blank' );
}

function shareOnLinkedin( element ) {
	const permalink = element.getAttribute( 'data-permalink' );
	const shareUrl = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent( permalink );
	window.open( shareUrl, '_blank' );
}
