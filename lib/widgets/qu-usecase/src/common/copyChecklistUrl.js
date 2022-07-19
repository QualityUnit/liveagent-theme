const copyChecklistUrl = () => {
	const checklistCopyBtns = document.querySelectorAll(
		'.qu-ChecklistItem__header__copy'
	);
	if ( checklistCopyBtns.length > 0 ) {
		const copiedText = document.querySelector( '[data-copied]' ).dataset
			.copied;
		checklistCopyBtns.forEach( ( btn ) => {
			btn.addEventListener( 'click', ( event ) => {
				event.preventDefault();
				const thisCopy = btn;
				const copyText = thisCopy.dataset.text;
				const textArea = document.createElement( 'textarea' );
				textArea.value = copyText;
				document.body.appendChild( textArea );
				textArea.select();

				document.execCommand( 'copy' );
				document.body.removeChild( textArea );

				const copyCheck = document.createElement( 'div' );
				copyCheck.classList.add( 'TextCopiedMessage' );
				copyCheck.innerText = copiedText;

				thisCopy
					.closest( '.qu-ChecklistItem' )
					.insertAdjacentElement( 'afterbegin', copyCheck );
				setTimeout( () => {
					copyCheck.classList.add( 'active' );
				}, 0 );

				setTimeout( () => {
					copyCheck.classList.remove( 'active' );
					copyCheck.remove();
				}, 2000 );
			} );
		} );
	}
};

export default copyChecklistUrl;
