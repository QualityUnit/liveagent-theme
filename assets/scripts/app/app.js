( () => {
	const mobileTablet = window.matchMedia( '(max-width: 1380px)' );
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );

	const activateMenuClick = () => {
		/* Header Mobile Menu */
		if ( query( '.Header__mobileNavigation' ) !== null ) {
			query( '.Header__mobileNavigation' ).addEventListener(
				'click',
				() => {
					query( '.Header__mobileNavigation' ).classList.toggle(
						'active'
					);
					query( '.Header__navigation' ).classList.toggle( 'active' );
				}
			);
		}

		if (
			queryAll( '.Header__navigation ul > .menu-item-has-children' )
				.length > 0
		) {
			queryAll(
				'.Header__navigation ul > .menu-item-has-children'
			).forEach( ( element ) => {
				const link = element.querySelector( "a[href='#']" );
				const sub = element.querySelector( 'ul' );

				if ( link !== null ) {
					link.addEventListener( 'click', () => {
						if (
							! link.parentElement.classList.contains( 'active' )
						) {
							queryAll( '.Header__navigation .active' ).forEach(
								( activated ) => {
									activated.classList.remove( 'active' );
								}
							);
						}
						link.parentElement.classList.toggle( 'active' );
						sub.classList.toggle( 'active' );
					} );
				}
			} );
		}

		/* Main Navigation */
		if ( query( '.Header__navigation' ) !== null ) {
			queryAll( ".Header__navigation a[href='#']" ).forEach(
				( element ) => {
					element.addEventListener( 'click', ( event ) => {
						event.preventDefault();
					} );
				}
			);
		}
	};

	if ( mobileTablet.matches ) {
		activateMenuClick();
	}

	// Handles case when user changes orientation of device from portrait > landscape, ie. iPad Pro
	mobileTablet.addEventListener( 'change', ( event ) => {
		if ( event.matches ) {
			activateMenuClick();
		}
	} );

	/* Data Href */
	if ( queryAll( '[data-href]' ).length > 0 ) {
		queryAll( '[data-href]' ).forEach( ( element ) => {
			element.addEventListener( 'click', () => {
				const link = element.getAttribute( 'data-href' );

				if ( link !== null ) {
					window.location.href = link;
				}
			} );
		} );
	}

	/* Article Sidebar */
	if ( query( '.Article__container__sidebar' ) !== null ) {
		const container = query( '.Article__container__sidebar' );
		const urlPath = window.location.pathname;
		const li = container.querySelectorAll( 'li' );

		li.forEach( ( menuItem ) => {
			const a = menuItem.querySelector( 'a' );
			const href = a.getAttribute( 'href' );

			if ( href.includes( urlPath ) ) {
				const parent = a.parentElement;
				parent.classList.add( 'active' );
			}
		} );
	}

	const form = query( '.Signup__form' );

	function scroll( element ) {
		const scrollToPos =
			form.getBoundingClientRect().top + window.pageYOffset;
		element.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			window.scroll( {
				top: scrollToPos - 175,
				behavior: 'smooth',
			} );
		} );
	}

	/* Scroll Buttons to Signup Form */
	if ( query( '.Signup__form' ) !== null ) {
		if ( queryAll( ".Reviews a[href*='trial']" ).length > 0 ) {
			queryAll( ".Reviews a[href*='trial']" ).forEach( ( element ) => {
				scroll( element );
			} );
		}

		if ( queryAll( ".Reviews a[href*='free-account']" ).length > 0 ) {
			queryAll( ".Reviews a[href*='free-account']" ).forEach(
				( element ) => {
					scroll( element );
				}
			);
		}

		if ( queryAll( ".Portals a[href*='trial']" ).length > 0 ) {
			queryAll( ".Portals a[href*='trial']" ).forEach( ( element ) => {
				scroll( element );
			} );
		}

		if ( queryAll( ".Block a[href*='trial']" ).length > 0 ) {
			queryAll( ".Block a[href*='trial']" ).forEach( ( element ) => {
				scroll( element );
			} );
		}

		if ( queryAll( ".Block a[href*='free-account']" ).length > 0 ) {
			queryAll( ".Block a[href*='free-account']" ).forEach(
				( element ) => {
					scroll( element );
				}
			);
		}

		if ( queryAll( ".BlockPricing a[href*='trial']" ).length > 0 ) {
			queryAll( ".BlockPricing a[href*='trial']" ).forEach(
				( element ) => {
					scroll( element );
				}
			);
		}
	}

	/* Login */
	if ( query( '.Login__overlay' ) !== null ) {
		query( '.Login__overlay' ).addEventListener( 'click', () => {
			query( '.Login__overlay' ).classList.remove( 'active' );
			query( '.Login__popup' ).classList.remove( 'active' );
		} );

		query( '.Login__popup__close' ).addEventListener( 'click', () => {
			query( '.Login__overlay' ).classList.remove( 'active' );
			query( '.Login__popup' ).classList.remove( 'active' );
		} );
	}
} )();

