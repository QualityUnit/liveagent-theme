const FilterMenus = document.querySelectorAll( '.FilterMenu' );

if ( FilterMenus.length > 0 ) {
	FilterMenus.forEach( ( filtermenu ) => {
		const menuTitle = filtermenu.querySelector( '.FilterMenu__title' );
		const menuItems = filtermenu.querySelector( '.FilterMenu__items' );

		const hideMenu = () => {
			if ( menuItems.classList.contains( 'visible' ) ) {
				menuItems.classList.remove( 'visible' );
				menuTitle.classList.remove( 'active' );
				setTimeout( () => {
					menuItems.classList.remove( 'active' );
				}, 200 );
			}
		};

		menuTitle.addEventListener( 'click', () => {
			if ( ! menuItems.classList.contains( 'active' ) ) {
				menuTitle.classList.add( 'active' );
				menuItems.classList.add( 'active' );
				setTimeout( () => {
					menuItems.classList.add( 'visible' );
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
