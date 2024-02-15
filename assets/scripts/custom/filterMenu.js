const FilterMenus = document.querySelectorAll( '.FilterMenu' );

if ( FilterMenus.length > 0 ) {
	FilterMenus.forEach( ( filtermenu ) => {
		const clScrollbarVisible = 'scrollbar-visible';
		const menuTitle = filtermenu.querySelector( '.FilterMenu__title' );
		const menuItems = filtermenu.querySelector( '.FilterMenu__items' );
		const menuItemsInn = filtermenu.querySelector( '.FilterMenu__items--inn' );
		const isSingleSelect = filtermenu.classList.contains( 'isSingleSelect' );

		const hideMenu = () => {
			if ( menuItems.classList.contains( 'visible' ) ) {
				filtermenu.classList.remove( 'active' );
				menuItems.classList.remove( 'visible' );
				menuTitle.classList.remove( 'active' );
				setTimeout( () => {
					menuItems.classList.remove( 'active' );
					menuItems.classList.remove( clScrollbarVisible );
				}, 200 );

				filtermenu.dispatchEvent( closingEvent );
			}
		};

		const scrollbarVisible = ( element ) => {
			return element.scrollHeight > element.clientHeight;
		};

		const updateTitle = ( title ) => {
			if ( title ) {
				menuTitle.textContent = title;
			}
		};

		menuTitle.addEventListener( 'click', () => {
			if ( ! menuItems.classList.contains( 'active' ) ) {
				filtermenu.classList.add( 'active' );
				menuTitle.classList.add( 'active' );
				menuItems.classList.add( 'active' );
				setTimeout( () => {
					menuItems.classList.add( 'visible' );
					if ( scrollbarVisible( menuItemsInn ) ) {
						menuItems.classList.add( clScrollbarVisible );
					}
				}, 200 );
				filtermenu.dispatchEvent( openingEvent );
			}
			hideMenu();
		} );

		document.addEventListener( 'click', ( event ) => {
			if ( ! event.target.closest( '.FilterMenu__item' ) ) {
				event.stopPropagation();
				hideMenu();
			}
		} );

		if ( isSingleSelect ) {
			const items = menuItems.querySelectorAll( 'input.filter-item' );
			items.forEach( ( item ) => {
				item.addEventListener( 'change', ( event ) => {
					updateTitle( event.target.dataset.title );
					hideMenu();
				} );
			} );
		}
	} );

	const closingEvent = new CustomEvent( 'closedFilterMenu' );
	const openingEvent = new CustomEvent( 'openedFilterMenu' );
}
