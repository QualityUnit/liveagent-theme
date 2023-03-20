
const clSticky = 'compact-header__bottom';
const clStickyActive = clSticky + '--sticky';
const elSticky = document.querySelector( '.' + clSticky );
const elHeader = document.querySelector( '.Header' );

window.onscroll = function() {
	fnStickyHeader();
};

function fnStickyHeader() {
	if ( elSticky !== null && elHeader !== null ) {
		if ( ( document.documentElement.scrollTop + elHeader.offsetHeight ) >= elSticky.offsetTop ) {
			elSticky.classList.add( clStickyActive );
		} else {
			elSticky.classList.remove( clStickyActive );
		}
	}
}
