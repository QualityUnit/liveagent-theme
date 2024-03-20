
( () => {
	const mobileTablet = window.matchMedia( '(max-width: 1023px)' );
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );

	/* Mobile menu */
	const activateMobileMenuClick = () => {
		const hamburger = document.querySelector( '.Header__mobile__hamburger' );
		const navigation = document.querySelector( '.Header__navigation' );
		const bodyElement = document.querySelector( 'body' );

		if ( hamburger ) {
			hamburger.addEventListener( 'click', () => {
				hamburger.classList.toggle( 'active' );
				navigation.classList.toggle( 'active' );
				navigation.classList.toggle( 'mobile-active' );
				bodyElement.classList.toggle( 'no-scroll' );
			} );

			const menuItems = document.querySelectorAll( '.Header__navigation ul.nav > li' );
			const languageToggleLink = document.querySelector( '.Header__navigation .Header__flags__mobile .Header__flags--item-toggle' );

			menuItems.forEach( ( item ) => {
				const link = item.querySelector( ':scope > a' );
				const submenu = item.querySelector( ':scope > ul' );

				link.addEventListener( 'click', () => {
					closeOtherMenus( item, menuItems, languageToggleLink );
					item.classList.toggle( 'active' );
					if ( submenu ) {
						submenu.classList.toggle( 'active' );
						setSubMenuHeight( submenu );
					}
				} );
			} );

			if ( languageToggleLink ) {
				languageToggleLink.addEventListener( 'click', () => {
					closeOtherMenus( languageToggleLink, menuItems, null );
					languageToggleLink.classList.toggle( 'active' );
					const languageMenu = languageToggleLink.nextElementSibling;
					if ( languageMenu ) {
						languageMenu.classList.toggle( 'active' );
						setSubMenuHeight( languageMenu );
					}
				} );
			}

			document.querySelectorAll( '.Header__navigation ul.nav > li > ul' ).forEach( ( submenu ) => {
				submenu.style.height = '0';
			} );
		}

		const setSubMenuHeight = ( submenu ) => {
			if ( submenu.classList.contains( 'active' ) ) {
				submenu.style.height = submenu.scrollHeight + 'px';
			} else {
				submenu.style.height = '0';
			}
		};

		const closeOtherMenus = ( currentItem, menuItems, languageToggleLink ) => {
			menuItems.forEach( ( item ) => {
				if ( item !== currentItem ) {
					item.classList.remove( 'active' );
					const submenu = item.querySelector( ':scope > ul' );
					if ( submenu ) {
						submenu.classList.remove( 'active' );
						setSubMenuHeight( submenu );
					}
				}
			} );

			if ( languageToggleLink && languageToggleLink !== currentItem ) {
				languageToggleLink.classList.remove( 'active' );
				const languageMenu = languageToggleLink.nextElementSibling;
				if ( languageMenu ) {
					languageMenu.classList.remove( 'active' );
					setSubMenuHeight( languageMenu );
				}
			}
		};
	};

	const activateDesktopMenuClick = () => {
		const menuItems = document.querySelectorAll( '.Header__navigation ul.nav > li' );

		const closeAllSubMenus = ( exceptItem ) => {
			menuItems.forEach( ( item ) => {
				if ( item !== exceptItem ) {
					item.classList.remove( 'active' );
					const submenu = item.querySelector( ':scope > ul' );
					if ( submenu ) {
						submenu.classList.remove( 'active' );

						const allSubmenuSubmenu = submenu.querySelectorAll( ':scope > li > ul' );
						allSubmenuSubmenu.forEach( ( subSub ) => {
							subSub.classList.remove( 'active' );
						} );
					}
				}
			} );
		};

		menuItems.forEach( ( item ) => {
			const link = item.querySelector( ':scope > a' );
			const submenu = item.querySelector( ':scope > ul' );

			link.addEventListener( 'click', () => {
				closeAllSubMenus( item );

				item.classList.toggle( 'active' );
				if ( submenu ) {
					submenu.classList.toggle( 'active' );

					const allSubmenuSubmenu = submenu.querySelectorAll( ':scope > li > ul' );
					allSubmenuSubmenu.forEach( ( subSub ) => {
						subSub.classList.toggle( 'active' );
					} );
				}
			} );
		} );
	};

	if ( mobileTablet.matches ) {
		activateMobileMenuClick();
	} else {
		activateDesktopMenuClick();
	}

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
		const langSwitcherToggle = query( '.Header__flags #languageSwitcher-toggle' );
		const langSwitcherMenu = query( '.Header__flags .Header__flags--mainmenu' );

		if ( langSwitcherToggle && langSwitcherMenu ) {
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
				if ( ! event.target.classList.contains( 'Header__flags--mainmenu' ) ) {
					event.stopPropagation();
					hideLanguageSwitcher( langSwitcherMenu );
				}
			} );
		}
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

