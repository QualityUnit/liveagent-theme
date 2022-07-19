const getchecklistItemItemStatus = ( properties ) => {
	// Getting data from properties
	const { quChecklistsData } = properties;
	if ( quChecklistsData ) {
		const allChecklists = Object.keys( quChecklistsData );

		if ( allChecklists.length > 0 ) {
			allChecklists.map( ( checklist ) => {
				Object.entries( quChecklistsData[ checklist ] ).map(
					( [ key, values ] ) => {
						const { isChecked, isOpen } = values;

						const checklistItem = document.querySelector(
							`.qu-ChecklistItem[data-checklistitem="${ key }"]`
						);

						if ( checklistItem && isChecked ) {
							checklistItem.classList.add( 'checked' );
							checklistItem.querySelector(
								'input.qu-ChecklistItem__checkbox'
							).checked = true;
						}
						if ( checklistItem && ! isOpen ) {
							checklistItem.classList.remove( 'open' );
						}
						return true;
					}
				);
				return true;
			} );
		}
	}
};

export default getchecklistItemItemStatus;
