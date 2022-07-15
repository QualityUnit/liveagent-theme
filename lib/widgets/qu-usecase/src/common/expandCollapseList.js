/* global localStorage */
const expandCollapseList = ( properties ) => {
	const { quChecklistsDBName, quChecklistsData } = properties;
	const actionBtn = document.querySelectorAll( '.qu-Checklist__expander' );

	actionBtn.forEach( ( btn ) => {
		const { action } = btn.dataset;

		const checklistWrappers = document.querySelectorAll( '.qu-Checklist' );
		checklistWrappers.forEach( ( wrapper ) => {
			const expandAll = document.querySelectorAll(
				'[data-action="openAll"]'
			);
			const closeAll = document.querySelectorAll(
				'[data-action="closeAll"]'
			);
			const checklistItems = wrapper.querySelectorAll(
				'.qu-ChecklistItem'
			);
			const checklistItemsOpen = wrapper.querySelectorAll(
				'.qu-ChecklistItem.open'
			);

			const checklistId = wrapper.dataset.list;
			let checkListData = quChecklistsData[ checklistId ];

			if ( ! checkListData ) {
				expandAll.forEach( ( expandItem ) => {
					expandItem.classList.add( 'inactive' );
				} );
			}

			if ( checkListData ) {
				closeAll.forEach( ( closeItem ) => {
					closeItem.classList.add( 'inactive' );
				} );
				expandAll.forEach( ( expandItem ) => {
					expandItem.classList.remove( 'inactive' );
				} );
			}
			window.addEventListener( 'load', () => {
				if ( checklistItems.length === checklistItemsOpen.length ) {
					closeAll.forEach( ( closeItem ) => {
						closeItem.classList.remove( 'inactive' );
					} );
					expandAll.forEach( ( expandItem ) => {
						expandItem.classList.add( 'inactive' );
					} );
				}
			} );

			btn.addEventListener( 'click', () => {
				checkListData = quChecklistsData[ checklistId ];

				if ( action === 'closeAll' ) {
					closeAll.forEach( ( closeElem ) => {
						closeElem.classList.add( 'inactive' );
					} );
					expandAll.forEach( ( expandElem ) => {
						expandElem.classList.remove( 'inactive' );
					} );

					if ( ! checkListData ) {
						Object.assign( quChecklistsData, {
							[ checklistId ]: {},
						} );
					}

					checklistItems.forEach( ( checklistItem ) => {
						const checklistItemId =
							checklistItem.dataset.checklistitem;
						const itemChecked = () => {
							const newList =
								quChecklistsData[ checklistId ][
									checklistItemId
								];
							return newList ? newList.isChecked : false;
						};

						Object.assign( quChecklistsData[ checklistId ], {
							[ checklistItemId ]: {
								isChecked: itemChecked(),
								isOpen: false,
							},
						} );

						checklistItem.classList.remove( 'open' );
					} );
				}

				if ( action === 'openAll' ) {
					closeAll.forEach( ( closeElem ) => {
						closeElem.classList.remove( 'inactive' );
					} );
					expandAll.forEach( ( expandElem ) => {
						expandElem.classList.add( 'inactive' );
					} );

					checklistItems.forEach( ( checklistItem ) => {
						const checklistItemId =
							checklistItem.dataset.checklistitem;
						const itemChecked = () => {
							const newList =
								quChecklistsData[ checklistId ][
									checklistItemId
								];
							return newList ? newList.isChecked : false;
						};

						Object.assign( quChecklistsData[ checklistId ], {
							[ checklistItemId ]: {
								isChecked: itemChecked(),
								isOpen: true,
							},
						} );

						checklistItem.classList.add( 'open' );
					} );
				}

				if ( checkListData ) {
					Object.entries( checkListData ).map(
						( [ key, values ] ) => {
							const { isOpen } = values;

							const checklistItem = document.querySelector(
								`.qu-ChecklistItem[data-checklistitem="${ key }"]`
							);

							if ( action === 'openAll' ) {
								if ( checklistItem && ! isOpen ) {
									Object.assign( checkListData[ key ], {
										isOpen: true,
									} );
									checklistItem.classList.add( 'open' );
								}
							}

							if ( action === 'closeAll' ) {
								if ( checklistItem && isOpen ) {
									Object.assign( checkListData[ key ], {
										isOpen: false,
									} );
									checklistItem.classList.remove( 'open' );
								}
							}
							return true;
						}
					);
				}

				// Save back as string to local storage
				localStorage.setItem(
					quChecklistsDBName,
					JSON.stringify( quChecklistsData )
				);
			} );
		} );
	} );
};

export default expandCollapseList;
