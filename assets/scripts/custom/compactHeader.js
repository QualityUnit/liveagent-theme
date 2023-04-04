const clSticky = 'compact-header';
const clStickyActive = clSticky + '--sticky';
const clMobileActive = 'compact-header--active';
const elSticky = document.querySelector( '.' + clSticky );
const elBody = document.querySelector( 'body' );
const elHeader = document.querySelector( '.Header' );
const elToggle = document.querySelector( '.js-compact-header__toggle' );
const elClose = document.querySelector( '.js-compact-header__close' );
const elApply = document.querySelector( '.js-compact-header__apply' );
//scroll bar on single pages
let elHeaderScrollBar = null;
if ( elBody.classList.contains( 'single' ) && ! elBody.classList.contains( 'about' ) ) {
	elHeaderScrollBar = document.createElement( 'div' );
	elHeaderScrollBar.classList.add( 'compact-header__scrollbar' );
}

function fnStickyHeader() {
	if ( elSticky && elHeader ) {
		if ( ( elHeader.offsetHeight + elSticky.offsetHeight ) <= document.documentElement.scrollTop ) {
			elSticky.classList.add( clStickyActive );
		} else {
			elSticky.classList.remove( clStickyActive );
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
function fnHeaderScrollBarPositon() {
	if ( elHeaderScrollBar ) {
		if ( window.innerWidth <= 767 ) {
			elHeader.append( elHeaderScrollBar );
		} else {
			elSticky.append( elHeaderScrollBar );
		}
	}
}
function fnFilterSelect() {
	const clFilterMain = 'FilterMenu';
	const clFilterTitle = 'FilterMenu__title';
	const clFilterItems = 'FilterMenu__items';
	const clFilterItem = 'FilterMenu__item-title';
	const elFilterItem = document.querySelectorAll( '.' + clFilterItem );

	if ( elFilterItem ) {
		elFilterItem.forEach( ( item ) => {
			const elFilterMain = item.closest( '.' + clFilterMain );
			const elFilterItems = item.closest( '.' + clFilterItems );
			const elFilterTitle = elFilterMain.querySelector( '.' + clFilterTitle );
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
}

fnStickyHeaderActions();
fnHeaderScrollBar();
fnHeaderScrollBarPositon();
fnFilterSelect();
window.addEventListener( 'scroll', function() {
	fnStickyHeader();
	fnHeaderScrollBar();
}, true );
window.addEventListener( 'resize', function() {
	fnHeaderScrollBarPositon();
}, true );
