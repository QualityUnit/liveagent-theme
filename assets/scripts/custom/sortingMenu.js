const SortingMenus = document.querySelectorAll( '[data-sort]' );

if ( SortingMenus.length ) {
	// Function to sort items in list by preselected value from sorting menu
	const sortBy = ( sortByValue, SortingList, SortingListItems ) => {
		if ( SortingList.dataset.sortedby !== sortByValue ) {
			SortingListItems.sort( ( a, b ) => {
				return b.dataset[ sortByValue ] - a.dataset[ sortByValue ];
			} );

			SortingList.innerHTML = '';
			SortingList.dataset.sortedby = sortByValue;
			SortingListItems.forEach( ( item, index ) => {
				const order = item.querySelector( '[data-order]' );
				if ( order ) {
					order.innerText = index + 1;
				}
				SortingList.insertAdjacentElement( 'beforeend', item );
			} );
		}
	};

	const hideSortMenu = ( menuTitle, menuItems, newMenuTitle = menuTitle.innerText ) => {
		if ( menuItems.classList.contains( 'visible' ) ) {
			menuItems.classList.remove( 'visible' );
			menuTitle.classList.remove( 'active' );
			menuTitle.innerText = newMenuTitle;
			setTimeout( () => {
				menuItems.classList.remove( 'active' );
			}, 200 );
		}
	};

	SortingMenus.forEach( ( sortingmenu ) => {
		const menuTitle = sortingmenu.querySelector( '[data-title]' );
		const menuItems = sortingmenu.querySelector( '[data-items]' );
		const menuItemsList = sortingmenu.querySelectorAll( 'input[type=radio]' );
		const menuItemActive = sortingmenu.querySelector( 'input[type=radio]:checked' );
		const menuItemsStrings = [];

		const SortingList = document.querySelector( `[data-sortingList="${ sortingmenu.dataset.sort }"]` );
		// Gets HTMLCollection
		let SortingListItems = SortingList.children;

		if ( SortingListItems.length ) {
			SortingListItems = Array.from( SortingListItems ); // Making array from htmlcollection
			sortBy( menuItemActive.value, SortingList, SortingListItems ); // Initial sorting after page load
		}

		menuItemsList.forEach( ( menuitem ) => {
			menuItemsStrings.push( menuitem.dataset.sortby ); // Making array of menu items text strings

			menuitem.addEventListener( 'change', () => {
				if ( menuitem.checked ) {
					const newMenuTitle = menuitem.dataset.sortby;
					sortBy( menuitem.value, SortingList, SortingListItems );
					hideSortMenu( menuTitle, menuItems, newMenuTitle );
				}
			} );
		} );

		// Sorting list of menu items from longest to shortest string

		if ( window.matchMedia( '(min-width: 768px)' ).matches ) {
			menuItemsStrings.sort( ( a, b ) => {
				return b.length - a.length;
			} );

			menuTitle.style.minWidth = `${ menuItemsStrings[ 0 ].length + 4 }ch`; // Setting width of Sorting menu by longest item
		}

		menuTitle.addEventListener( 'click', () => {
			if ( ! menuItems.classList.contains( 'active' ) ) {
				menuTitle.classList.add( 'active' );
				menuItems.classList.add( 'active' );
				setTimeout( () => {
					menuItems.classList.add( 'visible' );
				}, 200 );
			}
			hideSortMenu( menuTitle, menuItems );
		} );

		document.addEventListener( 'click', ( event ) => {
			if ( ! event.target.closest( '.FilterMenu__item' ) ) {
				event.stopPropagation();
				hideSortMenu( menuTitle, menuItems );
			}
		} );
	} );
}
