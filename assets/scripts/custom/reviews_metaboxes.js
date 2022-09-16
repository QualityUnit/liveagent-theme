window.addEventListener( 'load', () => {
	setTimeout( () => {
		const reviewMetaboxes = document.querySelector( '.post-type-ms_reviews .edit-post-layout__metaboxes' );
		const editHeader = document.querySelector( '.post-type-ms_reviews .edit-post-header' );
		const showReviewsbutton = document.createElement( 'button' );
		showReviewsbutton.classList.add( 'showMetaboxes' );
		showReviewsbutton.innerText = 'Show/hide Reviews Fields';

		if ( reviewMetaboxes ) {
			editHeader.insertAdjacentElement( 'afterbegin', showReviewsbutton );
			showReviewsbutton.addEventListener( 'click', ( ) => {
				reviewMetaboxes.classList.toggle( 'visible' );
			} );
		}
	}, 0 );
} );
