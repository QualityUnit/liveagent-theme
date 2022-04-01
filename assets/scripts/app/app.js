( () => {
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );

	/* Header Mobile Menu */
	if ( query( '.Header__mobileNavigation' ) !== null ) {
		query( '.Header__mobileNavigation' ).addEventListener( 'click', () => {
			query( '.Header__mobileNavigation' ).classList.toggle( 'active' );
			query( '.Header__navigation' ).classList.toggle( 'active' );
		} );
	}

	if (
		queryAll( '.Header__navigation ul > .menu-item-has-children' ).length >
		0
	) {
		queryAll( '.Header__navigation ul > .menu-item-has-children' ).forEach(
			( element ) => {
				const link = element.querySelector( "a[href='#']" );
				const sub = element.querySelector( 'ul' );

				if ( link !== null ) {
					link.addEventListener( 'click', () => {
						sub.classList.toggle( 'active' );
					} );
				}
			}
		);
	}

	/* Main Navigation */
	if ( query( '.Header__navigation' ) !== null ) {
		queryAll( ".Header__navigation a[href='#']" ).forEach( ( element ) => {
			element.addEventListener( 'click', ( event ) => {
				event.preventDefault();
			} );
		} );
	}

	/* Language switcher */
	function hideLanguageSwitcher( target ) {
		if ( target.classList.contains( 'visible' ) ) {
			target.classList.remove( 'visible' );
			setTimeout( () => {
				target.classList.remove( 'active' );
			}, 200 );
		}
	}

	if ( query( '.Header__flags #languageSwitcher-toggle' ) !== null ) {
		const langSwitcherToggle = query(
			'.Header__flags #languageSwitcher-toggle'
		);

		/* Gets region of active language and activates mobile switcher for such region */
		// const langActive = langSwitcherToggle.parentElement.getAttribute(
		// 	'lang'
		// );
		// const matchRegion = langSwitcherToggle.parentElement.querySelector(
		// 	`.Header__flags--item[lang=${ langActive }]`
		// ).dataset.region;

		// document.querySelector(
		// 	`#${ matchRegion }.input--region`
		// ).checked = true;

		/* Toggles language switcher */
		const langSwitcherMenu = query( '.Header__flags--mainmenu' );
		langSwitcherToggle.addEventListener( 'click', ( event ) => {
			event.stopPropagation();
			if ( ! langSwitcherMenu.classList.contains( 'visible' ) ) {
				langSwitcherMenu.dataset.active = 'active';
				langSwitcherMenu.classList.add( 'active' );
				setTimeout( () => {
					langSwitcherMenu.classList.add( 'visible' );
				}, 200 );
			}
			hideLanguageSwitcher( langSwitcherMenu );
		} );

		document.addEventListener( 'click', ( event ) => {
			if (
				! event.target.classList.contains( 'Header__flags--mainmenu' )
			) {
				event.stopPropagation();
				hideLanguageSwitcher( langSwitcherMenu );
			}
		} );
	}

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

	/* Glossary */
	if ( query( '.Archive__container--glossary' ) !== null ) {
		queryAll( '.Archive__filter ul li a' ).forEach( ( element ) => {
			const link = element.getAttribute( 'href' );

			element.addEventListener( 'click', ( event ) => {
				const scrollToPos =
					query( link ).getBoundingClientRect().top +
					window.pageYOffset;
				event.preventDefault();
				if ( window.matchMedia( '(min-width: 1180px)' ).matches ) {
					window.scroll( {
						top: scrollToPos - 215,
						behavior: 'smooth',
					} );
				} else {
					window.scroll( {
						top: scrollToPos - 115,
						behavior: 'smooth',
					} );
				}
			} );
		} );
	}

	// Custom tabs and accordion, replacing Elementor one
	if ( queryAll( '.elementor-tab-title' ).length > 0 ) {
		const tabItems = queryAll( '.elementor-tab-title' );
		const firstItemRef = tabItems.item( 0 ).getAttribute( 'aria-controls' );
		const parent = tabItems
			.item( 0 )
			.closest( '.elementor-widget-container' );

		tabItems.forEach( ( element ) => {
			const elemReference = element.getAttribute( 'aria-controls' );
			const elemContent = document.querySelector( `#${ elemReference }` );

			if (
				parent.querySelectorAll( '.elementor-accordion-item' ).length >
				0
			) {
				elemContent.dataset.height = `${ elemContent.clientHeight }px`;
				elemContent.style.height = '0px';
				elemContent.style.paddingBottom = '0px';
			}
			element.addEventListener( 'click', ( event ) => {
				const nonActive = queryAll(
					`[aria-controls=${ elemReference }], #${ elemReference }`
				);

				event.preventDefault();

				if (
					parent.querySelector(
						'.elementor-tab-content.elementor-active'
					) !== null
				) {
					const activeElem = parent.querySelectorAll(
						'.elementor-active'
					);

					if (
						parent.querySelectorAll( '.elementor-accordion-item' )
							.length > 0
					) {
						parent.querySelector(
							'.elementor-tab-content.elementor-active'
						).style.height = '0px';
					}
					activeElem.forEach( ( elementorItem ) => {
						elementorItem.classList.remove( 'elementor-active' );
					} );
				}

				nonActive.forEach( ( elementorItem ) => {
					elementorItem.classList.add( 'elementor-active' );
				} );

				if (
					parent.querySelectorAll( '.elementor-accordion-item' )
						.length > 0
				) {
					elemContent.style.height = elemContent.dataset.height;
				}
			} );
		} );

		queryAll(
			`[aria-controls=${ firstItemRef }], #${ firstItemRef }`
		).forEach( ( item ) => {
			item.classList.add( 'elementor-active' );
			// eslint-disable-next-line no-param-reassign
			item.style.height = 'auto';
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

	/* Copy to clipboard */
	if ( queryAll( '.Copy ' ).length > 0 ) {
		queryAll( '.Copy ' ).forEach( ( item ) => {
			item.querySelector( '.Button--copy' ).addEventListener(
				'click',
				() => {
					const thisCopy = item;
					const copyText = thisCopy.querySelector(
						'.textarea-pseudo'
					).innerText;
					const defaultText = thisCopy.querySelector(
						'.Button--copy span'
					).textContent;

					const textArea = document.createElement( 'textarea' );
					textArea.value = copyText;
					document.body.appendChild( textArea );
					textArea.select();

					document.execCommand( 'copy' );
					document.body.removeChild( textArea );

					thisCopy.querySelector( '.Button--copy span' ).textContent =
						'Copied!';

					setTimeout( () => {
						thisCopy.querySelector(
							'.Button--copy span'
						).textContent = defaultText;
					}, 5000 );
				}
			);
		} );
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

	/* Open an External Links in a New Tab */
	const excludes = [ 'liveagent', 'live-agent' ];

	queryAll( 'a[href^=http]' ).forEach( ( element ) => {
		if (
			! element.href.includes( excludes[ 0 ] ) &&
			! element.href.includes( excludes[ 1 ] )
		) {
			element.setAttribute( 'target', '_blank' );
		}
	} );

	/* Awards switching */
	const awardsYears = document.querySelectorAll( '.Awards__switcher--year' );

	if ( awardsYears.length > 0 ) {
		awardsYears.forEach( ( year ) => {
			year.addEventListener( 'click', () => {
				const yearActive = document.querySelector(
					'.Awards__switcher--year.active'
				);
				const yearContainerActive = document.querySelector(
					'.Awards__container.active'
				);

				const thisYear = year;
				const thisYearRef = year.dataset.year;

				yearActive.classList.remove( 'active' );
				thisYear.classList.add( 'active' );
				yearContainerActive.classList.remove( 'active' );
				document
					.querySelector(
						`.Awards__container[data-year='${ thisYearRef }']`
					)
					.classList.add( 'active' );
			} );
		} );
	}
} )();
