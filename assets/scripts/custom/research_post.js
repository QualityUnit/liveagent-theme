( () => {
	// Handles Copy to clipboard button in research graphical block
	const researchCopyBtns = document.querySelectorAll(
		'.Research--block__button__copy '
	);
	if ( researchCopyBtns.length > 0 ) {
		const copiedText = document.querySelector( '[data-copied]' ).dataset
			.copied;
		researchCopyBtns.forEach( ( btn ) => {
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
					.closest( '.Research--block, .Statistics--block' )
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

	// Toggles Research post top navigation
	const navigationMenu = document.querySelector(
		'.Research--navigation__menu'
	);
	const navigationItems = document.querySelectorAll(
		'.Research--navigation__post'
	);
	const researchTitle = document.querySelector( '.Research__title' );
	const researchSelected = document.querySelector(
		'.Research--navigation__selected'
	);

	function hideNavigation() {
		navigationMenu.classList.remove( 'active' );
		researchSelected.classList.remove( 'menu-active' );
		setTimeout( () => {
			navigationMenu.classList.add( 'hidden' );
		}, 200 );
	}

	if ( navigationItems.length > 0 ) {
		researchSelected.addEventListener( 'click', ( event ) => {
			event.stopPropagation();
			if ( ! navigationMenu.classList.contains( 'active' ) ) {
				navigationMenu.classList.remove( 'hidden' );
				researchSelected.classList.add( 'menu-active' );
				setTimeout( () => {
					navigationMenu.classList.add( 'active' );
				}, 0 );
			}

			if ( navigationMenu.classList.contains( 'active' ) ) {
				hideNavigation();
			}
		} );

		document
			.querySelector( 'body' )
			.addEventListener( 'click', ( event ) => {
				if (
					! event.target.classList.contains(
						'.Research--navigation__posts'
					)
				) {
					hideNavigation();
				}
			} );

		if ( researchTitle ) {
			const researchTitleId = document.querySelector( '.Research__title' )
				.dataset.id;

			const filteredItem = [ ...navigationItems ].filter(
				( item ) => item.dataset.id === researchTitleId
			);
			filteredItem[ 0 ].classList.add( 'hidden' );
			const filteredItemNumber = filteredItem[ 0 ]
				.querySelector( '.Research--navigation__counter' )
				.innerText.replace( ' ', '' );
			const filteredItemColor = filteredItem[ 0 ].dataset.color;

			researchTitle.insertAdjacentHTML(
				'afterbegin',
				`<span class="Research__title__number outline-text">${ filteredItemNumber }</span>`
			);
			researchSelected.insertAdjacentHTML(
				'afterbegin',
				`<span class="Research--post__counter">${ filteredItemNumber }</span>`
			);
			document
				.querySelector( '.Research' )
				.classList.add( `Research--color-${ filteredItemColor }` );
		}
	}
} )();
