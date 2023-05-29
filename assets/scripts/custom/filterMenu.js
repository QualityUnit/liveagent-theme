const FilterMenus = document.querySelectorAll( '.FilterMenu' );

if ( FilterMenus.length > 0 ) {
	FilterMenus.forEach( ( filtermenu ) => {
		const clScrollbarVisible = 'scrollbar-visible';
		const menuTitle = filtermenu.querySelector( '.FilterMenu__title' );
		const menuItems = filtermenu.querySelector( '.FilterMenu__items' );
		const menuItemsInn = filtermenu.querySelector( '.FilterMenu__items--inn' );

		const hideMenu = () => {
			if ( menuItems.classList.contains( 'visible' ) ) {
				menuItems.classList.remove( 'visible' );
				menuTitle.classList.remove( 'active' );
				setTimeout( () => {
					menuItems.classList.remove( 'active' );
					menuItems.classList.remove( clScrollbarVisible );
				}, 200 );
			}
		};

		const scrollbarVisible = ( element ) => {
			return element.scrollHeight > element.clientHeight;
		};

		menuTitle.addEventListener( 'click', () => {
			if ( ! menuItems.classList.contains( 'active' ) ) {
				menuTitle.classList.add( 'active' );
				menuItems.classList.add( 'active' );
				setTimeout( () => {
					menuItems.classList.add( 'visible' );
					if ( scrollbarVisible( menuItemsInn ) ) {
						menuItems.classList.add( clScrollbarVisible );
					}
				}, 200 );
			}
			hideMenu();
		} );

		document.addEventListener( 'click', ( event ) => {
			if ( ! event.target.closest( '.FilterMenu__item' ) ) {
				event.stopPropagation();
				hideMenu();
			}
		} );
	} );
}
