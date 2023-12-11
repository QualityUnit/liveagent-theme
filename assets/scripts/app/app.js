( () => {
	const mobileTablet = window.matchMedia( '(max-width: 1380px)' );
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );

	const activateMenuClick = () => {
		/* Header Mobile Menu */
		const hamburger = document.querySelector( '.Header__mobile__hamburger' );
		const navigation = document.querySelector( '.Header__navigation' );

		if ( hamburger ) {
			hamburger.addEventListener( 'click', () => {
				hamburger.classList.toggle( 'active' );
				navigation.classList.toggle( 'active' );
				navigation.classList.toggle( 'mobile-active' );

				if ( navigation.classList.contains( 'mobile-active' ) ) {
					const menuItems = document.querySelectorAll( '.Header__navigation ul.nav > li' );
					const languageToggleLink = document.querySelector( '.Header__navigation .Header__flags__mobile .Header__flags--item-toggle' );

					const closeOtherMenus = ( currentItem ) => {
						menuItems.forEach( ( item ) => {
							if ( item !== currentItem ) {
								item.classList.remove( 'active' );
								const submenu = item.querySelector( ':scope > ul' );
								if ( submenu ) {
									submenu.classList.remove( 'active' );
								}
							}
						} );

						if ( languageToggleLink !== currentItem ) {
							languageToggleLink.classList.remove( 'active' );
							languageToggleLink.nextElementSibling.classList.remove( 'active' );
						}
					};

					menuItems.forEach( ( item ) => {
						const link = item.querySelector( ':scope > a' );
						const submenu = item.querySelector( ':scope > ul' );

						link.addEventListener( 'click', () => {
							closeOtherMenus( item );
							item.classList.toggle( 'active' );
							if ( submenu ) {
								submenu.classList.toggle( 'active' );
							}
						} );
					} );

					languageToggleLink.addEventListener( 'click', () => {
						closeOtherMenus( languageToggleLink );
						languageToggleLink.classList.toggle( 'active' );
						languageToggleLink.nextElementSibling.classList.toggle( 'active' );
					} );
				}
			} );
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

	/* Language switcher desktop*/
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

		/* Toggles language switcher */
		const langSwitcherMenu = query( '.Header__flags .Header__flags--mainmenu' );
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
						'[data-active="elementor-active"].elementor-tab-content'
					) !== null
				) {
					const activeElem = parent.querySelectorAll(
						'[data-active="elementor-active"]'
					);

					if (
						parent.querySelectorAll( '.elementor-accordion-item' )
							.length > 0
					) {
						parent.querySelector(
							'[data-active="elementor-active"].elementor-tab-content'
						).style.height = '0px';
					}
					activeElem.forEach( ( elementorItem ) => {
						elementorItem.dataset.active = '';
					} );
				}

				nonActive.forEach( ( elementorItem ) => {
					elementorItem.dataset.active = 'elementor-active';
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
			item.dataset.active = 'elementor-active';
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
