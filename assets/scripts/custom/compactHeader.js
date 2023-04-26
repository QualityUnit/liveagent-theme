const query = document.querySelector.bind( document );
const queryAll = document.querySelectorAll.bind( document );
const clStickyMain = 'compact-header';
const clStickyActive = clStickyMain + '--sticky';
const clMobileActive = 'compact-header--active';
const elSticky = query( '.' + clStickyMain );
const elBody = query( 'body' );
const elHeader = query( '.Header' );
const elToggle = query( '.js-compact-header__toggle' );
const elClose = query( '.js-compact-header__close' );
const elApply = query( '.js-compact-header__apply' );
//disable sticky header
let stickyDisable = false;
const elStickyMain = query( '.' + clStickyMain );
const elStickyBottom = query( '.compact-header__bottom' );
if ( elStickyMain.classList.contains( 'compact-header--lvl-1' ) && ! elStickyBottom ) {
	stickyDisable = true;
}
//scroll bar on single pages
let elHeaderScrollBar = null;
if ( elBody.classList.contains( 'single' ) && ! elBody.classList.contains( 'about' ) ) {
	elHeaderScrollBar = document.createElement( 'div' );
	elHeaderScrollBar.classList.add( 'compact-header__scrollbar' );
}
//TOC
const elTOC = query( '.compact-header__toc' );
const tocHeaderItems = ( () => {
	if ( queryAll( '.compact-header__toc .FilterMenu__item--h3' ).length > 0 ) {
		return queryAll( '.Content > h2[id], .Content > h3[id]' );
	}
	return queryAll( '.Content > h2[id]' );
} )();
const tocTitle = query( '.compact-header__toc .FilterMenu__title' );
const tocItems = queryAll( '.compact-header__toc a.FilterMenu__item' );
const threshold = 96; // about height of regular <p> paragraph to delay the highlight of toc item
const mql = window.matchMedia( '(min-width: 1380px)' );

function fnHeaderHeight() {
	if ( elHeader && elSticky ) {
		const heightHeader = elHeader.offsetHeight;
		const heightSticky = elSticky.offsetHeight;
		return heightHeader + heightSticky;
	}
	return false;
}
function fnStickyHeader() {
	if ( false === stickyDisable ) {
		if ( elSticky && fnHeaderHeight() ) {
			if ( fnHeaderHeight() <= document.documentElement.scrollTop ) {
				elSticky.classList.add( clStickyActive );
			} else {
				elSticky.classList.remove( clStickyActive );
			}
		}
	}
}
function fnStickyHeaderActions() {
	if ( elToggle && elClose && elApply ) {
		[ elToggle, elClose, elApply ].forEach( ( item ) => {
			item.addEventListener( 'click', () => {
				elBody.classList.toggle( clMobileActive );
			} );
		} );
	}
}
function getScrollPercent() {
	const h = document.documentElement,
		b = document.body,
		st = 'scrollTop',
		sh = 'scrollHeight',
		val = ( h[ st ] || b[ st ] ) / ( ( h[ sh ] || b[ sh ] ) - h.clientHeight ) * 100;
	return val + '%';
}
function fnHeaderScrollBar() {
	if ( elHeaderScrollBar ) {
		if ( ! elHeaderScrollBar.hasChildNodes() ) {
			const elChild = document.createElement( 'div' );
			elHeaderScrollBar.appendChild( elChild );
		}
		const el = elHeaderScrollBar.firstChild;
		el.style.width = getScrollPercent();
	}
}
function fnHeaderScrollBarPosition() {
	if ( elHeaderScrollBar ) {
		if ( window.innerWidth <= 767 ) {
			elHeader.append( elHeaderScrollBar );
		} else {
			elSticky.append( elHeaderScrollBar );
		}
	}
}
/*function fnFilterSelect() {
	const clFilterMain = 'FilterMenu';
	const clFilterTitle = 'FilterMenu__title';
	const clFilterItems = 'FilterMenu__items';
	const clFilterItem = 'FilterMenu__item-title';
	const elFilterItem = queryAll( '.' + clFilterItem );

	if ( elFilterItem ) {
		elFilterItem.forEach( ( item ) => {
			const elFilterMain = item.closest( '.' + clFilterMain );
			const elFilterItems = item.closest( '.' + clFilterItems );
			const elFilterTitle = elFilterMain.querySelector.bind( '.' + clFilterTitle );
			const textItem = item.textContent;
			const hideMenu = () => {
				if ( elFilterItems.classList.contains( 'visible' ) ) {
					elFilterItems.classList.remove( 'visible' );
					elFilterTitle.classList.remove( 'active' );
					setTimeout( () => {
						elFilterItems.classList.remove( 'active' );
					}, 200 );
				}
			};
			if ( elFilterTitle ) {
				item.addEventListener( 'click', () => {
					elFilterTitle.textContent = textItem;
					hideMenu();
				} );
			}
		} );
	}
}*/
function fnFilterSelect() {
	const clFilterMain = 'FilterMenu';
	const clFilterTitle = 'FilterMenu__title';
	const clFilterItems = 'FilterMenu__items';
	const clFilterItem = 'FilterMenu__item';
	const clFilterItemTitle = 'FilterMenu__item-title';
	const elFilterMain = queryAll( '.' + clFilterMain );

	if ( elFilterMain ) {
		elFilterMain.forEach( ( filterMain ) => {
			const elFilterTitle = filterMain.querySelector( '.' + clFilterTitle );
			const elFilterItems = filterMain.querySelector( '.' + clFilterItems );
			const elFilterItem = filterMain.querySelectorAll( '.' + clFilterItem );
			elFilterItem.forEach( ( item ) => {
				const elFilterItemTitle = item.querySelector( '.' + clFilterItemTitle );
				if ( elFilterTitle && elFilterItemTitle ) {
					const textItem = elFilterItemTitle.textContent;
					item.addEventListener( 'click', () => {
						elFilterTitle.textContent = textItem;
						if ( elFilterItems.classList.contains( 'visible' ) ) {
							elFilterItems.classList.remove( 'visible' );
							if ( elFilterTitle.classList.contains( 'active' ) ) {
								elFilterTitle.classList.remove( 'active' );
							}
							setTimeout( () => {
								elFilterItems.classList.remove( 'active' );
							}, 200 );
						}
					} );
				}
			} );
		} );
	}
}
function tocRemoveActive() {
	tocItems.forEach( ( element ) => {
		element.classList.remove( 'active' );
	} );
}
function tocActivate() {
	let isScrolling;
	if ( elTOC !== null ) {
		tocItems.forEach( ( element, index ) => {
			const el = element;
			el.dataset.number = index;

			el.addEventListener( 'click', ( ) => {
				tocRemoveActive();
				el.classList.add( 'active' );

				// setTimeout( () => {
				// 	window.scrollBy( 0, -164 );
				// }, 1000 );
			} );
		} );
	}

	window.addEventListener(
		'scroll',
		() => {
			window.clearTimeout( isScrolling );
			if ( elTOC !== null && fnHeaderHeight() ) {
				tocHeaderItems.forEach( ( element ) => {
					if ( element.getBoundingClientRect().top <= ( fnHeaderHeight() + threshold ) ) {
						const elemHref = element.getAttribute( 'id' );
						const activateItem = query(
							`.compact-header__toc a[href*=${ elemHref }`
						);

						tocRemoveActive();
						activateItem.classList.add( 'active' );
						tocTitle.textContent = activateItem.textContent;
					}
				} );
			}
		},
		false
	);
}

fnStickyHeaderActions();
fnHeaderScrollBar();
fnHeaderScrollBarPosition();
fnFilterSelect();
window.addEventListener( 'scroll', function() {
	fnStickyHeader();
	fnHeaderScrollBar();
}, true );
window.addEventListener( 'resize', function() {
	fnHeaderScrollBarPosition();
}, true );
// Handles TOC in case when user visits with required screen/window size
if ( mql.matches ) {
	tocActivate();
}
// Handles TOC in case when user changes orientation of device from portrait > landscape, ie. iPad Pro
mql.addEventListener( 'change', ( event ) => {
	if ( event.matches ) {
		tocActivate();
	}
} );
