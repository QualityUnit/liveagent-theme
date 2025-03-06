const FilterMenus = document.querySelectorAll( '.FilterMenu, .DropDownMenu' );

if ( FilterMenus.length > 0 ) {
	FilterMenus.forEach( ( filtermenu ) => {
		const clScrollbarVisible = 'scrollbar-visible';
		const mainClass = filtermenu.classList.contains( 'DropDownMenu' ) ? 'DropDownMenu' : 'FilterMenu';
		const menuTitle = filtermenu.querySelector( `.${ mainClass }__title` );
		const menuItems = filtermenu.querySelector( `.${ mainClass }__items` );
		const menuItemsInn = filtermenu.querySelector( `.${ mainClass }__items--inn` );

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
			if ( ! event.target.closest( `.${ mainClass }__item` ) ) {
				event.stopPropagation();
				hideMenu();
			}
		} );

		if ( isSingleSelect ) {
			const updateTitle = ( title ) => {
				if ( title ) {
					// inner span with ellipsis
					const innerSpan = menuTitle.querySelector( 'span' );
					if ( innerSpan ) {
						innerSpan.textContent = title;
						return;
					}
					menuTitle.textContent = title;
				}
			};

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
