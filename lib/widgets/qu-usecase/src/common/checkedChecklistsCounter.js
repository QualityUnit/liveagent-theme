const checkedChecklistsCounter = () => {
	const progressSpinner = document.getElementById( 'circleProgressSpinner' );

	if ( progressSpinner ) {
		let progress = 0;

		const checkedChecklists = document.querySelectorAll(
			'.qu-Checklist:not(#checklistFakeHeader) .qu-ChecklistItem.checked'
		);
		const checklistsCounter = document.getElementById(
			'checklistsCounter'
		);
		const checklistsCounterTotal = checklistsCounter.dataset.total;

		const setProgress = ( checked ) => {
			progress = ( checked / checklistsCounterTotal ) * 100;
			progressSpinner.style.background = `conic-gradient(var(--primary-color) ${ progress }%,var(--button-outline-color) ${ progress }%)`;
		};
		setProgress( 0 );
		if ( checkedChecklists.length > 0 ) {
			const checkedChecklistsCount = checkedChecklists.length;
			setProgress( checkedChecklistsCount );
			checklistsCounter.dataset.checked = checkedChecklistsCount;
		}
	}
};

window.addEventListener( 'load', () => {
	setTimeout( () => {
		checkedChecklistsCounter();
	}, 10 );
} );

export default checkedChecklistsCounter;
