/* global Splide */

const query = document.querySelector.bind( document );
const queryAll = document.querySelectorAll.bind( document );

const headerFaq = query( '.Content h2#faq' );
const tocFaq = query( '.SidebarTOC__item a[href*=faq]' );
const sidebarTOC = query( '.SidebarTOC' );
const signupSidebar = query( '.Signup__sidebar' );
const tocSlider = query( '.SidebarTOC__slider' );
const tocItems = queryAll( '.SidebarTOC__item a' );
const shareIcons = query( '.BlogPost__share-sidebar' );
const scrollSidebarsElement = queryAll( '[data-scrollsidebars]' );
const headerHeight = query( '.Header' ).clientHeight + 96; // include threshold
const mql = window.matchMedia( '(min-width: 1380px)' );
let slider = null;

// Define headerItems based on the TOC structure
const headerItems = ( () => {
	if ( queryAll( '.SidebarTOC__item--h3' ).length > 0 ) {
		return queryAll( '.Content > h2[id], .Content > h3[id]' );
	}
	return queryAll( '.Content > h2[id]' );
} )();

// Function to remove 'active' class from TOC items
const tocRemoveActive = () => {
	tocItems.forEach( ( item ) => item.classList.remove( 'active' ) );
};

// Function to add FAQ to TOC if it's not there
const addFaqToToc = () => {
	if ( headerFaq && ! tocFaq && window.innerWidth > 1380 && sidebarTOC ) {
		const faqItem = '<li class="SidebarTOC__item SidebarTOC__item--h2"><a href="#faq">FAQ</a></li>';
		query( '.SidebarTOC__content' ).insertAdjacentHTML( 'beforeend', faqItem );
	}
};

// Function to initialize the Splide slider if TOC has more than 8 items
const initializeTocSlider = () => {
	if ( tocItems.length > 8 && tocSlider ) {
		window.addEventListener( 'load', () => {
			tocItems.forEach( ( item ) => item.parentElement.classList.add( 'splide__slide' ) );

			const tocItemsEightHeight = Array.from( tocItems )
				.slice( 0, 8 )
				.reduce( ( acc, item ) => acc + item.clientHeight, 0 );

			// Initialize the slider
			slider = new Splide( tocSlider, {
				direction: 'ttb',
				height: tocItemsEightHeight + 16, // Výška slidera
				autoWidth: true,
				arrowPath: 'M40,30H0l20-20L40,30z',
				perMove: 8,
				speed: 400,
				pagination: false,
				arrows: true,
				trimspace: false,
			} ).mount();

			// Handle slider arrows
			slider.on( 'active', () => handleSliderArrows() );

			// Set track height to match the slider height
			const track = query( '.SidebarTOC .splide__track' );
			setTimeout( () => {
				track.style.height = `${ track.clientHeight + 8 }px`;
			}, 100 );
		} );
	}
};

// Handle slider arrow visibility
const handleSliderArrows = () => {
	const arrowPrev = query( '.SidebarTOC .splide__arrow--prev' );
	const arrowNext = query( '.SidebarTOC .splide__arrow--next' );
	const arrowWrapper = query( '.SidebarTOC .splide__arrows' );

	slider.on( 'moved', () => {
		if ( arrowNext.disabled ) {
			arrowWrapper.classList.add( 'is-last' );
		} else {
			arrowWrapper.classList.remove( 'is-last' );
		}

		if ( arrowPrev.disabled ) {
			arrowWrapper.classList.add( 'is-first' );
		} else {
			arrowWrapper.classList.remove( 'is-first' );
		}
	} );
};

// Activate sidebars with scroll interaction and TOC
const activateSidebars = () => {
	if ( sidebarTOC ) {
		tocItems.forEach( ( element, index ) => {
			element.dataset.number = index;

			element.addEventListener( 'click', () => {
				tocRemoveActive();
				element.classList.add( 'active' );
				setTimeout( () => {
					window.scrollBy( 0, -96 );
				}, 1000 );
			} );
		} );

		// Initialize TOC slider if needed
		initializeTocSlider();
	}
};

// Debounced scroll event handler for scroll sidebars and TOC
const handleScroll = () => {
	let isScrolling;
	const firstTitle = query( '.Content h2:first-of-type' ); // Correctly defined here for all uses

	window.addEventListener( 'scroll', () => {
		clearTimeout( isScrolling );

		// Share icons scroll management
		if ( shareIcons ) {
			shareIcons.classList.add( 'inactive' );
			scrollSidebarsElement.forEach( ( el ) => {
				if ( el.getBoundingClientRect().top - 217 < window.innerHeight ) {
					shareIcons.classList.add( 'scrolled' );
				}
			} );
		}

		// TOC active item management
		if ( sidebarTOC ) {
			headerItems.forEach( ( element ) => {
				if ( element.getBoundingClientRect().top <= headerHeight ) {
					const elemHref = element.getAttribute( 'id' );
					const activateItem = query( `.SidebarTOC a[href*=${ elemHref }]` );
					tocRemoveActive();
					activateItem.classList.add( 'active' );
				}
			} );

			// Sidebar scroll behavior
			scrollSidebarsElement.forEach( ( el ) => {
				if ( el.getBoundingClientRect().top - 217 < window.innerHeight ) {
					sidebarTOC.classList.add( 'scrolled' );
					if ( signupSidebar ) {
						signupSidebar.classList.add( 'scrolled' );
					}
				}
			} );
		}

		// Timeout to manage scroll end logic
		isScrolling = setTimeout( () => {
			if ( shareIcons ) {
				shareIcons.classList.remove( 'inactive' );
			}
			if ( slider && tocItems.length > 8 ) {
				const activeHref = query( '.SidebarTOC a.active' );
				if ( firstTitle.getBoundingClientRect().top < headerHeight && activeHref ) {
					slider.go( activeHref.dataset.number, true );
				} else if ( firstTitle.getBoundingClientRect().top > headerHeight && activeHref ) {
					activeHref.classList.remove( 'active' );
					slider.go( 0 );
				}
			}
		}, 750 );
	} );
};

// Initialize on load if window size matches
if ( mql.matches ) {
	activateSidebars();
}

// Listen for screen size changes
mql.addEventListener( 'change', ( event ) => {
	if ( event.matches ) {
		activateSidebars();
	}
} );

// Run on initial load
addFaqToToc();
handleScroll();
