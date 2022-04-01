const niceFaqSidebarItems = document.querySelectorAll(
	'.NiceFaq__sidebar--item'
);
const niceFaqMainItems = document.querySelectorAll( '.NiceFaq__item' );

if ( niceFaqSidebarItems.length > 0 ) {
	niceFaqSidebarItems.forEach( ( item ) => {
		const sidebarItem = item;

		sidebarItem.addEventListener( 'click', ( event ) => {
			const thisItem = event.target;
			const targetMainItem = document.querySelector(
				`.${ thisItem.dataset.item }`
			);

			[ niceFaqMainItems, niceFaqSidebarItems ].map( ( arrayItems ) => {
				arrayItems.forEach( ( arrayItem ) =>
					arrayItem.classList.remove( 'active' )
				);
				return false;
			} );

			[ thisItem, targetMainItem ].map( ( activeItem ) =>
				activeItem.classList.add( 'active' )
			);
		} );
	} );
}
