/* global IntersectionObserver */
/* eslint radix: ["error", "as-needed"] */
/* eslint no-unused-vars: "off" */

const measureChecklistPosition = () => {
	let progress = 0;
	let lastentry = 1;
	const itemThreshold = 100;

	const checklists = document.querySelectorAll(
		'.qu-Checklist:not(#checklistFakeHeader) .qu-ChecklistItem'
	);
	const checklistsCounter = document.getElementById( 'checklistsCounter' );
	const checklistsCounterTotal = checklistsCounter.dataset.total;

	const firstItem = checklists.item( 0 );
	const firstItemTop = firstItem.getBoundingClientRect().top + window.scrollY;

	const setProgress = ( item ) => {
		progress = ( item / checklistsCounterTotal ) * 100;
		document.getElementById(
			'circleProgressSpinner'
		).style.background = `conic-gradient(var(--primary-color) ${ progress }%,var(--button-outline-color) ${ progress }%)`;
	};

	checklists.forEach( ( elem, i ) => {
		const checklistItem = elem;
		checklistItem.dataset.order = i + 1;
	} );

	if ( 'IntersectionObserver' in window && checklists.length > 0 ) {
		const checklistsObserver = new IntersectionObserver( ( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					const checklistItem = entry.target.dataset.order;

					setProgress( checklistItem );
					checklistsCounter.dataset.atchecklist = checklistItem;
				}
				if ( ! entry.isIntersecting ) {
					lastentry = parseInt( entry.target.dataset.order );
					if (
						lastentry === 1 &&
						entry.boundingClientRect.y >=
							firstItemTop - itemThreshold
					) {
						setProgress( 0 );
						checklistsCounter.dataset.atchecklist = 0;
					}
				}
			} );
		} );

		checklists.forEach( ( checklistItem ) => {
			checklistsObserver.observe( checklistItem );
			setTimeout( () => {
				if ( lastentry === 1 ) {
					checklistsCounter.dataset.atchecklist = 0;
					setProgress( 0 );
				}
			}, 0 );
		} );
	}
};

// measureChecklistPosition();
