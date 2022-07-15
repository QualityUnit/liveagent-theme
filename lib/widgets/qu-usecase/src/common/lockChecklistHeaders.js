// Using common debounce function to stop events and run only after some delay, to not overhead
const debounce = ( func, wait, immediate ) => {
	let timeout;
	return () => {
		const context = this;
		const later = () => {
			timeout = null;
			if ( ! immediate ) func.apply( context );
		};
		const callNow = immediate && ! timeout;
		clearTimeout( timeout );
		timeout = setTimeout( later, wait );
		if ( callNow ) func.apply( context );
	};
};

const lockChecklistHeaders = () => {
	// Get all open checklist items
	const checklistsOpen = document.querySelectorAll(
		'.qu-Checklist:not(.Checklist__fakeHeader) .qu-ChecklistItem.open'
	);

	// We get the height of main LA header to calculate intersection area later
	const headerHeight = document
		.querySelector( 'header.Header' )
		.getBoundingClientRect().height;

	// Fake header element where we insert data from intersecting checklist item
	const fakeHeaderWrapper = document.querySelector( '#checklistFakeHeader' );

	if ( checklistsOpen.length > 0 && fakeHeaderWrapper ) {
		const fakeHeader = fakeHeaderWrapper.querySelector(
			'.qu-ChecklistItem'
		);
		const fakeHeaderLabel = document.querySelector(
			'#checklistFakeHeader label'
		);
		// Height of main header + small post header + fakeheader to calculate margin for footer intersection area
		const allHeadersHeight =
			headerHeight + fakeHeader.getBoundingClientRect().height; // Last value for threshold of scroll event delay
		const totalItems = checklistsOpen.length;
		const firstOpenItem = checklistsOpen.item( 0 );

		fakeHeaderWrapper.style.width = `${
			firstOpenItem.getBoundingClientRect().width
		}px`;

		fakeHeaderWrapper.dataset.list = firstOpenItem.closest(
			'.qu-Checklist'
		).dataset.list;

		const fakeHeaderCopyBtn = document.querySelector(
			'#checklistFakeHeader .qu-ChecklistItem__header__copy'
		);

		// Intersecting observer for opened checklist items
		const lockChecklistItemHeaderObserver = ( entries ) => {
			entries.forEach( ( entry ) => {
				if (
					entry.getBoundingClientRect().top <= headerHeight &&
					! entry.getBoundingClientRect().bottom <= allHeadersHeight
				) {
					const item = entry;
					const headerLabel = entry.querySelector(
						'.qu-ChecklistItem__header--text'
					);
					const headerText = headerLabel.innerText;
					const itemCopyText = entry.querySelector(
						'.qu-ChecklistItem__header__copy'
					).dataset.text;
					const itemFooter = item.querySelector(
						'.qu-ChecklistItem__footer'
					);
					// We want checked status of checklist item, header text, header Copy button data and checklist header ID
					if ( item.classList.contains( 'checked' ) ) {
						fakeHeader.classList.add( 'checked' );
					}
					if ( ! item.classList.contains( 'checked' ) ) {
						fakeHeader.classList.remove( 'checked' );
					}

					fakeHeader.dataset.checklistitem =
						headerLabel.dataset.checklistitem;
					fakeHeaderLabel.dataset.checklistitem =
						headerLabel.dataset.checklistitem;
					fakeHeaderLabel.innerText = headerText;
					fakeHeaderCopyBtn.dataset.text = itemCopyText;

					if ( itemFooter ) {
						if (
							itemFooter.getBoundingClientRect().top >=
								allHeadersHeight &&
							item.getBoundingClientRect().top <= allHeadersHeight
						) {
							if (
								fakeHeaderWrapper.classList.contains( 'hidden' )
							) {
								fakeHeaderWrapper.classList.remove( 'hidden' );
								setTimeout( () => {
									fakeHeader.classList.add( 'visible' );
								}, 1 );
							}
						}

						if (
							itemFooter.getBoundingClientRect().top <
								allHeadersHeight &&
							item.getBoundingClientRect().bottom >
								allHeadersHeight
						) {
							if ( fakeHeader.classList.contains( 'visible' ) ) {
								fakeHeader.classList.remove( 'visible' );
								setTimeout( () => {
									fakeHeaderWrapper.classList.add( 'hidden' );
								}, 100 );
							}
						}
					}
				}
			} );

			// Observes when first open checklist is below of viewport so it hides the fake header
			if (
				firstOpenItem.getBoundingClientRect().top >= headerHeight ||
				( checklistsOpen.item( totalItems - 1 ).getBoundingClientRect()
					.bottom <= allHeadersHeight &&
					checklistsOpen
						.item( totalItems - 1 )
						.getBoundingClientRect().bottom > 0 )
			) {
				fakeHeader.classList.remove( 'visible' );
				setTimeout( () => {
					fakeHeaderWrapper.classList.add( 'hidden' );
				}, 100 );
			}
		};

		window.addEventListener(
			'scroll',
			debounce(
				() => lockChecklistItemHeaderObserver( checklistsOpen ),
				4,
				false
			),
			false
		);
	}

	if ( ! checklistsOpen ) {
		fakeHeaderWrapper.classList.remove( 'visible' );
		fakeHeaderWrapper.classList.add( 'hidden' );
	}
};

// Run the function on load

window.addEventListener( 'load', () => {
	lockChecklistHeaders();
} );

// Using resize event listener instead of modern ResizeObserver as it makes content bouncing in our case
window.addEventListener(
	'resize',
	debounce( () => lockChecklistHeaders(), 200, false ),
	false
);

export default lockChecklistHeaders;
