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
if ( elBody.classList.contains( 'single' ) ) {
	elHeaderScrollBar = document.createElement( 'div' );
	elHeaderScrollBar.classList.add( 'compact-header__scrollbar' );
	elSticky.append( elHeaderScrollBar );
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

fnStickyHeaderActions();
fnHeaderScrollBar();
window.onscroll = function() {
	fnStickyHeader();
	fnHeaderScrollBar();
};
