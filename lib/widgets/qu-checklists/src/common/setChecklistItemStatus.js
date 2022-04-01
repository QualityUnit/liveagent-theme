/* global localStorage */

import lockChecklistHeaders from './lockChecklistHeaders';
import checkedChecklistsCounter from './checkedChecklistsCounter';

const setChecklistItemStatus = ( properties ) => {
	// Getting data from properties
	const {
		quChecklistsDBName,
		quChecklistsData,
		checkListLabels,
	} = properties;

	// We do not check for headers as whole function is called in if condition in frontend.js
	const checklistHeaders = document.querySelectorAll(
		'.qu-ChecklistItem__header__pseudo'
	);

	const stayOnPosition = ( thisChecklistItem, label ) => {
		const itemTop = thisChecklistItem.getBoundingClientRect().top;
		const itemHeight = thisChecklistItem.getBoundingClientRect().height;
		const origPos = window.scrollY;
		thisChecklistItem.classList.remove( 'open' );
		if (
			label.classList.contains( 'qu-ChecklistItem__footer--checkbox' )
		) {
			window.scrollTo( 0, origPos - itemTop - itemHeight );
		}
	};

	// For each label check/uncheck the checklist
	checkListLabels.forEach( ( label ) => {
		label.addEventListener( 'click', () => {
			// Get ID of the post (we call it a list) from data attribute of first label from the nodelist
			const currentListId = label.closest( '.qu-Checklist' ).dataset.list;

			// Get data for current post/list from parsed local storage
			const currentListData = quChecklistsData[ currentListId ];

			// On click on label, get it's data-checklist attribute to pair it with a checklist parent
			const checklistItemId = label.dataset.checklistitem;
			const thisChecklistItem = label.closest( '.qu-ChecklistItem' );
			const thisChecklistItems = document.querySelectorAll(
				`.qu-ChecklistItem[data-checklistitem="${ checklistItemId }"]`
			);

			// If is checked, assign class to main checklist parent
			thisChecklistItems.forEach( ( item ) => {
				item.classList.toggle( 'checked' );
			} );
			checkedChecklistsCounter();

			// If no checklist status for current page is saved, make one on click
			if ( ! currentListData ) {
				Object.assign( quChecklistsData, {
					[ currentListId ]: {
						[ checklistItemId ]: {
							isChecked: true,
							isOpen: false,
						},
					},
				} );
				stayOnPosition( thisChecklistItem, label );
			}
			// If already stored some checklist status for current page, assign new value
			if ( currentListData ) {
				const itemOpen = () => {
					const newList =
						quChecklistsData[ currentListId ][ checklistItemId ];
					return newList ? newList.isOpen : false;
				};
				const itemChecked = () => {
					const newList =
						quChecklistsData[ currentListId ][ checklistItemId ];
					return newList ? newList.isChecked : false;
				};

				Object.assign( currentListData, {
					[ checklistItemId ]: {
						isChecked: ! itemChecked(),
						isOpen: itemOpen(),
					},
				} );
				if ( itemChecked() ) {
					stayOnPosition( thisChecklistItem, label );
				}
			}

			// Save back as string to local storage
			localStorage.setItem(
				quChecklistsDBName,
				JSON.stringify( quChecklistsData )
			);
		} );
	} );

	/*-------------------------------*/
	/* Setting the open or closed status of the checklist */
	/*-------------------------------*/

	checklistHeaders.forEach( ( header ) => {
		header.addEventListener( 'click', () => {
			// Get ID of the post (we call it a list) from data attribute of first label from the nodelist
			const currentChecklist = header.closest( '.qu-Checklist' );
			const currentListId = currentChecklist.dataset.list;

			// Get data for current post/list from parsed local storage
			const currentListData = quChecklistsData[ currentListId ];

			const thisChecklistItem = header.closest( '.qu-ChecklistItem' );
			const checklistItemId = thisChecklistItem.dataset.checklistitem;

			thisChecklistItem.classList.toggle( 'open' );
			lockChecklistHeaders();

			// If no checklist Open status for current page is saved, make one on click
			if ( ! currentListData ) {
				Object.assign( quChecklistsData, {
					[ currentListId ]: {
						[ checklistItemId ]: {
							isChecked: false,
							isOpen: false,
						},
					},
				} );

				currentChecklist
					.querySelectorAll( '[data-action="openAll"]' )
					.forEach( ( expander ) => {
						expander.classList.remove( 'inactive' );
					} );
			}
			// If already stored some checklist status for current page, assign new value
			if ( currentListData ) {
				const itemOpen = () => {
					const newList =
						quChecklistsData[ currentListId ][ checklistItemId ];
					return newList ? newList.isOpen : true;
				};
				const itemChecked = () => {
					const newList =
						quChecklistsData[ currentListId ][ checklistItemId ];
					return newList ? newList.isChecked : false;
				};

				Object.assign( currentListData, {
					[ checklistItemId ]: {
						isChecked: itemChecked(),
						isOpen: ! itemOpen(),
					},
				} );
			}

			// Save back as string to local storage
			localStorage.setItem(
				quChecklistsDBName,
				JSON.stringify( quChecklistsData )
			);
		} );
	} );
};

export default setChecklistItemStatus;
