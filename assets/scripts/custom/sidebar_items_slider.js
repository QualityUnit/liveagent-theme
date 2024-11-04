/* global Splide */

const query = document.querySelector.bind( document );
const queryAll = document.querySelectorAll.bind( document );
const sidebarSlider = query( '.SidebarItemsSlider' );
const sidebarSliderItems = queryAll( '.SidebarItemsSlider__item' );
const sidebarSliderSlider = query( '.SidebarItemsSlider__slider' );
const sidebarSliderShow = 4;
const sidebarSliderMargin = 2;
let slider = null;

const mql = window.matchMedia( '(min-width: 1024px)' );

function activateSidebars() {
	//let isScrolling;
	if ( sidebarSlider !== null ) {
		// Limiting size and adding dynamic scrolling if more than defined number of items are in menu
		if ( sidebarSliderItems.length > sidebarSliderShow ) {
			sidebarSliderItems.forEach( ( item ) => {
				const sliderItem = item;
				sliderItem.classList.add( 'splide__slide' );
			} );

			if ( sidebarSliderSlider !== null ) {
				let sidebarSliderItemsEightHeight = 0;

				for ( let sidebarSliderItem = 0; sidebarSliderItem < sidebarSliderShow; sidebarSliderItem += 1 ) {
					sidebarSliderItemsEightHeight += sidebarSliderItems[ sidebarSliderItem ].clientHeight;
				}

				slider = new Splide( sidebarSliderSlider, {
					direction: 'ttb',
					height: sidebarSliderItemsEightHeight + ( sidebarSliderMargin * 2 ),
					autoWidth: true,
					autoHeight: true,
					arrowPath: 'M40,30H0l20-20L40,30z',
					perMove: sidebarSliderShow,
					speed: 400,
					pagination: false,
					arrows: true,
					trimspace: false,
				} ).mount();

				const track = query( '.SidebarItemsSlider .splide__track' );
				window.addEventListener( 'load', () => {
					setTimeout( () => {
						track.style.height = `${ track.clientHeight + sidebarSliderMargin }px`;
					}, 100 );
				} );

				mql.addEventListener( 'change', ( event ) => {
					if ( event.matches ) {
						setTimeout( () => {
							track.style.height = `${
								track.clientHeight + sidebarSliderMargin
							}px`;
						}, 100 );
					}
				} );

				slider.on( 'active', () => {
					const arrowPrev = query(
						'.SidebarItemsSlider .splide__arrow--prev'
					);
					const arrowNext = query(
						'.SidebarItemsSlider .splide__arrow--next'
					);

					if ( arrowPrev.disabled === true ) {
						query( '.SidebarItemsSlider .splide__arrows' ).classList.add(
							'is-first'
						);
						query( '.SidebarItemsSlider .splide__arrows' ).classList.remove(
							'is-last'
						);
					}

					slider.on( 'moved', () => {
						if ( arrowNext.disabled === true ) {
							query(
								'.SidebarItemsSlider .splide__arrows'
							).classList.remove( 'is-first' );
							query(
								'.SidebarItemsSlider .splide__arrows'
							).classList.add( 'is-last' );
						}

						if ( arrowPrev.disabled === true ) {
							query(
								'.SidebarItemsSlider .splide__arrows'
							).classList.add( 'is-first' );
							query(
								'.SidebarItemsSlider .splide__arrows'
							).classList.remove( 'is-last' );
						}

						if (
							arrowPrev.disabled === false &&
							arrowNext.disabled === false
						) {
							query(
								'.SidebarItemsSlider .splide__arrows'
							).classList.remove( 'is-first' );
							query(
								'.SidebarItemsSlider .splide__arrows'
							).classList.remove( 'is-last' );
						}
					} );
				} );
			}
		}
	}
}

// Handles case when user visits with required screen/window size
if ( mql.matches ) {
	activateSidebars();
}

// Handles case when user changes orientation of device from portrait > landscape, ie. iPad Pro
mql.addEventListener( 'change', ( event ) => {
	if ( event.matches ) {
		activateSidebars();
	}
} );
