/* global Splide */

const query = document.querySelector.bind( document );
const queryAll = document.querySelectorAll.bind( document );

const headerFaq = query( '.Content h2#faq' );
const tocFaq = query( '.SidebarTOC__item a[href*=faq]' );
const sidebarTOC = query( '.SidebarTOC' );
const signupSidebar = query( '.Signup__sidebar' );

if (
	headerFaq !== null &&
	tocFaq === null &&
	window.innerWidth > 1380 &&
	sidebarTOC !== null
) {
	const faqItem =
		'<li class="SidebarTOC__item SidebarTOC__item--h2"><a href="#faq">FAQ</a></li>';
	document
		.querySelector( '.SidebarTOC__content' )
		.insertAdjacentHTML( 'beforeend', faqItem );
}

const headerItems = ( () => {
	if ( queryAll( '.SidebarTOC__item--h3' ).length > 0 ) {
		return queryAll( '.Content > h2[id], .Content > h3[id]' );
	}
	return queryAll( '.Content > h2[id]' );
} )();

const tocItems = queryAll( '.SidebarTOC__item a' );
const treshold = 96; // about height of regular <p> paragraph to delay the highlight of toc item
const headerHeight = query( '.Header' ).clientHeight + treshold;
const shareIcons = query( '.BlogPost__share-sidebar' );
const scrollSidebarsElement = queryAll( '[data-scrollsidebars]' );

const tocSlider = query( '.SidebarTOC__slider' );
let slider = null;

const mql = window.matchMedia( '(min-width: 1380px)' );

function tocRemoveActive() {
	tocItems.forEach( ( element ) => {
		element.classList.remove( 'active' );
	} );
}

function loadImg( element ) {
	if ( element.tagName === 'IMG' && element.parentElement.tagName === 'PICTURE' && ! element.hasAttribute( 'laprocessing' ) ) {
		element.setAttribute( 'laprocessing', 'y' );
		element.parentElement.childNodes.forEach( ( childNode ) => {
			loadImg( childNode );
		} );
		element.removeAttribute( 'laprocessing' );
	}

	if ( element.hasAttribute( 'data-srcset' ) ) {
		element.setAttribute( 'srcset', element.getAttribute( 'data-srcset' ) );
		element.removeAttribute( 'data-srcset' );
	}

	if ( element.hasAttribute( 'data-src' ) ) {
		element.setAttribute( 'src', element.getAttribute( 'data-src' ) );
		element.removeAttribute( 'data-src' );
	}
	element.style.opacity = '1';
}

function activateSidebars() {
	let isScrolling;
	if ( sidebarTOC !== null ) {
		window.addEventListener( 'load', () => {
			if ( queryAll( '[data-src]:not(script)' ) !== null ) {
				const unloaded = document.querySelectorAll( '[data-src]:not(script)' );
				unloaded.forEach( ( elem ) => {
					const el = elem;
					loadImg( el );
				} );
			}
		} );

		tocItems.forEach( ( element, index ) => {
			const el = element;
			el.dataset.number = index;

			el.addEventListener( 'click', ( ) => {
				tocRemoveActive();
				el.classList.add( 'active' );

				setTimeout( () => {
					window.scrollBy( 0, -treshold );
				}, 1000 );
			} );
		} );

		// Limiting TOC size and adding dynamic scrolling if more than 8 items are in TOC
		if ( tocItems.length > 8 ) {
			tocItems.forEach( ( item ) => {
				const sliderItem = item;
				sliderItem.parentElement.classList.add( 'splide__slide' );
			} );

			if ( tocSlider !== null ) {
				let tocItemsEightHeight = 0;

				for ( let tocItem = 0; tocItem <= 8; tocItem += 1 ) {
					tocItemsEightHeight += tocItems[ tocItem ].clientHeight;
				}

				slider = new Splide( tocSlider, {
					direction: 'ttb',
					height: tocItemsEightHeight + 16,
					autoWidth: true,
					arrowPath: 'M40,30H0l20-20L40,30z',
					// perPage: 8,
					perMove: 8,
					speed: 400,
					pagination: false,
					arrows: true,
					trimspace: false,
				} ).mount();

				const track = query( '.SidebarTOC .splide__track' );
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
						'.SidebarTOC .splide__arrow--prev'
					);
					const arrowNext = query(
						'.SidebarTOC .splide__arrow--next'
					);

					if ( arrowPrev.disabled === true ) {
						query( '.SidebarTOC .splide__arrows' ).classList.add(
							'is-first'
						);
						query( '.SidebarTOC .splide__arrows' ).classList.remove(
							'is-last'
						);
					}

					slider.on( 'moved', () => {
						if ( arrowNext.disabled === true ) {
							query(
								'.SidebarTOC .splide__arrows'
							).classList.remove( 'is-first' );
							query(
								'.SidebarTOC .splide__arrows'
							).classList.add( 'is-last' );
						}

						if ( arrowPrev.disabled === true ) {
							query(
								'.SidebarTOC .splide__arrows'
							).classList.add( 'is-first' );
							query(
								'.SidebarTOC .splide__arrows'
							).classList.remove( 'is-last' );
						}

						if (
							arrowPrev.disabled === false &&
							arrowNext.disabled === false
						) {
							query(
								'.SidebarTOC .splide__arrows'
							).classList.remove( 'is-first' );
							query(
								'.SidebarTOC .splide__arrows'
							).classList.remove( 'is-last' );
						}
					} );
				} );
			}
		}
	}

	window.addEventListener(
		'scroll',
		() => {
			window.clearTimeout( isScrolling );

			if ( shareIcons !== null ) {
				shareIcons.classList.add( 'inactive' );

				shareIcons.classList.remove( 'scrolled' );
				scrollSidebarsElement.forEach( ( scrollOutElem ) => {
					if (
						scrollOutElem.getBoundingClientRect().top - 217 <
					window.innerHeight
					) {
						shareIcons.classList.add( 'scrolled' );
					}
				} );
			}

			if ( sidebarTOC !== null ) {
				headerItems.forEach( ( element ) => {
					if ( element.getBoundingClientRect().top <= headerHeight ) {
						const elemHref = element.getAttribute( 'id' );
						const activateItem = query(
							`.SidebarTOC a[href*=${ elemHref }`
						);

						tocRemoveActive();
						activateItem.classList.add( 'active' );
					}
				} );

				sidebarTOC.classList.remove( 'scrolled' );

				if ( signupSidebar ) {
					signupSidebar.classList.remove( 'scrolled' );
				}

				scrollSidebarsElement.forEach( ( scrollOutElem ) => {
					if (
						scrollOutElem.getBoundingClientRect().top - 217 <
						window.innerHeight
					) {
						sidebarTOC.classList.add( 'scrolled' );
						if ( signupSidebar ) {
							signupSidebar.classList.add( 'scrolled' );
						}
					}
				} );
			}

			// Set a timeout to run after scrolling ends
			isScrolling = setTimeout( () => {
				if ( shareIcons !== null ) {
					shareIcons.classList.remove( 'inactive' );
				}

				if ( tocItems.length > 8 ) {
					const activeHref = query( '.SidebarTOC a.active' );
					const firstTitle = query( '.Content h2:first-of-type' );
					const firstTitlePos = firstTitle.getBoundingClientRect()
						.top;

					if ( firstTitlePos < headerHeight && activeHref !== null ) {
						slider.go( activeHref.dataset.number, true );
					}
					if ( firstTitlePos > headerHeight && activeHref !== null ) {
						activeHref.classList.remove( 'active' );
						slider.go( 0 );
					}
				}
			}, 750 );
		},
		false
	);
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
