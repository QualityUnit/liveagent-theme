
const clSticky = 'compact-header__bottom';
const clStickyActive = clSticky + '--sticky';
const clMobileActive = 'compact-header--active';
const elSticky = document.querySelector( '.' + clSticky );
const elBody = document.querySelector( 'body' );
const elHeader = document.querySelector( '.Header' );
const elToggle = document.querySelector( '.js-compact-header__toggle' );
const elClose = document.querySelector( '.js-compact-header__close' );
const elApply = document.querySelector( '.js-compact-header__apply' );

function fnStickyHeader() {
	if ( elSticky !== null && elHeader !== null ) {
		if ( ( document.documentElement.scrollTop + elHeader.offsetHeight ) >= elSticky.offsetTop ) {
			elSticky.classList.add( clStickyActive );
		} else {
			elSticky.classList.remove( clStickyActive );
		}
	}
}

function fnMobileShow() {
	elBody.classList.add( clMobileActive );
}

function fnMobileHide() {
	elSticky.classList.remove( clMobileActive );
}

window.onscroll = function() {
	fnStickyHeader();
};

[ elToggle, elClose, elApply ].forEach( ( item ) => {
	item.addEventListener( 'click', () => {
		elBody.classList.toggle( clMobileActive );
	} );
} );
