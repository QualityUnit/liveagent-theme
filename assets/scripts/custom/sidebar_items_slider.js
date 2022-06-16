/* global Splide */

const query = document.querySelector.bind( document );
const queryAll = document.querySelectorAll.bind( document );

const sidebarSlider = query( '.SidebarItemsSlider' );

const sidebarSliderItems = queryAll( '.SidebarItemsSlider__item' );
//const content = query( '.Content' );
//const treshold = 96; // about height of regular <p> paragraph to delay the highlight of item
//const headerHeight = query( '.Header' ).clientHeight + treshold;
//const footer = query( '.Footer' );

const sidebarSliderSlider = query( '.SidebarItemsSlider__slider' );
let slider = null;

const mql = window.matchMedia( '(min-width: 1024px)' );

// function sidebarsSliderRemoveActive() {
// 	sidebarSliderItems.forEach( ( element ) => {
// 		element.classList.remove( 'active' );
// 	} );
// }

function activateSidebars() {
	//let isScrolling;
	if ( sidebarSlider !== null ) {
		window.addEventListener( 'load', () => {
			if ( queryAll( '[data-lasrc]' ) !== null ) {
				const unloaded = document.querySelectorAll( '[data-lasrc]' );
				unloaded.forEach( ( elem ) => {
					const el = elem;
					const datasrc = el.getAttribute( 'data-lasrc' );
					el.setAttribute( 'src', datasrc );
					el.style.opacity = '1';
				} );
			}
		} );
		// sidebarSliderItems.forEach( ( element, index ) => {
		// 	const el = element;
		// 	el.dataset.number = index;
		//
		// 	el.addEventListener( 'click', ( e ) => {
		// 		e.preventDefault();
		// 		const elemHref = el.getAttribute( 'href' );
		// 		const toPosition = document
		// 			.querySelector( elemHref )
		// 			.getBoundingClientRect().top;
		//
		// 		sidebarsSliderRemoveActive();
		// 		el.classList.add( 'active' );
		//
		// 		window.scroll( {
		// 			top:
		// 				toPosition +
		// 				document.documentElement.scrollTop -
		// 				treshold,
		// 			behavior: 'smooth',
		// 		} );
		//
		// 		if ( content.classList.contains( 'BlogPost__content' ) ) {
		// 			window.scroll( {
		// 				top: toPosition - headerHeight + treshold,
		// 				behavior: 'smooth',
		// 			} );
		// 		}
		// 	} );
		// } );

		// Limiting TOC size and adding dynamic scrolling if more than 8 items are in TOC
		if ( sidebarSliderItems.length > 8 ) {
			sidebarSliderItems.forEach( ( item ) => {
				const sliderItem = item;
				sliderItem.classList.add( 'splide__slide' );
			} );

			if ( sidebarSliderSlider !== null ) {
				let sidebarSliderItemsEightHeight = 0;

				for ( let sidebarSliderItem = 0; sidebarSliderItem <= 8; sidebarSliderItem += 1 ) {
					sidebarSliderItemsEightHeight += sidebarSliderItems[ sidebarSliderItem ].clientHeight;
				}

				slider = new Splide( sidebarSliderSlider, {
					direction: 'ttb',
					height: sidebarSliderItemsEightHeight + 16,
					autoWidth: true,
					arrowPath: 'M40,30H0l20-20L40,30z',
					// perPage: 8,
					perMove: 8,
					speed: 400,
					pagination: false,
					arrows: true,
					trimspace: false,
				} ).mount();

				const track = query( '.SidebarItemsSlider .splide__track' );
				window.addEventListener( 'load', () => {
					setTimeout( () => {
						track.style.height = `${ track.clientHeight + 8 }px`;
					}, 100 );
				} );

				mql.addEventListener( 'change', ( event ) => {
					if ( event.matches ) {
						setTimeout( () => {
							track.style.height = `${
								track.clientHeight + 8
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

	// window.addEventListener(
	// 	'scroll',
	// 	() => {
	// 		window.clearTimeout( isScrolling );
	//
	// 		if ( sidebarSlider !== null ) {
	// 			sidebarSlider.classList.remove( 'scrolled' );
	// 			if (
	// 				footer.getBoundingClientRect().top - 217 <
	// 				window.innerHeight
	// 			) {
	// 				sidebarSlider.classList.add( 'scrolled' );
	// 			}
	// 		}
	// 	},
	// 	false
	// );
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
