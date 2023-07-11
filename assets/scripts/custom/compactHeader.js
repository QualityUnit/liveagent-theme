( () => {
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );
	const clStickyMain = 'compact-header';
	const clStickyActive = clStickyMain + '--sticky';
	const clStickyTransition = clStickyMain + '--transition';
	const clStickyPlaceholder = clStickyMain + '__placeholder';
	const clMobileActive = 'compact-header--active';
	const elSticky = query( '.' + clStickyMain );
	const elStickyPlaceholder = query( '.' + clStickyPlaceholder );
	let isSticky = false;
	const elBody = query( 'body' );
	const elHeader = query( '.Header' );
	const elSidebarSticky = query( '.js-sidebar-sticky' );
	const elToggle = query( '.js-compact-header__toggle' );
	const elClose = query( '.js-compact-header__close' );
	const elApply = query( '.js-compact-header__apply' );
	let scrollPos = 0;
	//disable sticky header
	let stickyDisable = false;
	const elStickyMain = query( '.' + clStickyMain );
	const elStickyBottom = query( '.compact-header__bottom' );
	if ( elStickyMain.classList.contains( 'compact-header--lvl-1' ) && ! elStickyBottom ) {
		stickyDisable = true;
	}
	//scroll bar on single pages
	let elHeaderScrollBar = null;
	if ( elBody.classList.contains( 'single' ) && ! elBody.classList.contains( 'about' ) ) {
		elHeaderScrollBar = document.createElement( 'div' );
		elHeaderScrollBar.classList.add( 'compact-header__scrollbar' );
	}
	//TOC
	const elTOC = query( '.js-toc' );
	const elTocChecklists = query( '.Checklists__toc' );
	const tocHeaderItems = ( () => {
		if ( queryAll( '.js-toc .FilterMenu__item--h3' ).length > 0 ) {
			return queryAll( '.Content h2[id], .Content h3[id]' );
		}
		return queryAll( '.Content h2[id]' );
	} )();
	const tocChecklistsHeaderItems = ( () => {
		if ( queryAll( '.js-toc js-toc__item' ).length > 0 ) {
			return queryAll( '.Content .qu-ChecklistItem__header--text' );
		}
		return queryAll( '.Content .qu-ChecklistItem__header--text' );
	} )();
	const tocTitle = query( '.js-toc .js-toc__title' );
	const tocItems = queryAll( '.js-toc .js-toc__item' );
	const threshold = 96; // about height of regular <p> paragraph to delay the highlight of toc item
	const mql = window.matchMedia( '(min-width: 1380px)' );

	function fnOffsetTop( elem ) {
		const box = elem.getBoundingClientRect();
		const body = document.body;
		const docEl = document.documentElement;
		const scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
		const clientTop = docEl.clientTop || body.clientTop || 0;
		const top = box.top + scrollTop - clientTop;
		return Math.round( top );
	}
	function fnHeaderHeight( units = null ) {
		if ( elHeader && elSticky ) {
			const heightHeader = elHeader.offsetHeight;
			const heightSticky = elSticky.offsetHeight;
			const height = heightHeader + heightSticky;
			if ( units ) {
				return height + units;
			}
			return height;
		}
		return false;
	}
	function fnStickyPlaceholder() {
		if ( ! stickyDisable && elSticky && elStickyPlaceholder && ! elSticky.classList.contains( clStickyActive ) ) {
			elStickyPlaceholder.style.minHeight = elSticky.offsetHeight + 'px';
		}
	}
	function fnStickyHeader( scrollDirection = null ) {
		if ( ! stickyDisable && elSticky && elStickyPlaceholder && fnHeaderHeight() ) {
			fnStickyPlaceholder();
			const stickyPoint = elStickyPlaceholder.offsetHeight * 2;
			if ( stickyPoint <= document.documentElement.scrollTop ) {
				elSticky.classList.add( clStickyActive );
				isSticky = true;
				return false;
			}
			if ( scrollDirection === 'up' ) {
				elSticky.classList.add( clStickyTransition );
				setTimeout( () => {
					elSticky.classList.remove( clStickyActive );
					elSticky.classList.remove( clStickyTransition );
					isSticky = false;
					fnStickyPlaceholder();
				}, 300 );
				return false;
			}
			elSticky.classList.remove( clStickyActive );
			isSticky = false;
		}
	}
	function fnStickyHeaderActions() {
		if ( elToggle && elClose && elApply ) {
			[ elToggle, elClose, elApply ].forEach( ( item ) => {
				item.addEventListener( 'click', () => {
					elBody.classList.toggle( clMobileActive );
				} );
			} );
		}
	}
	function fnGetScrollPercent() {
		const h = document.documentElement,
			b = document.body,
			st = 'scrollTop',
			sh = 'scrollHeight',
			val = ( h[ st ] || b[ st ] ) / ( ( h[ sh ] || b[ sh ] ) - h.clientHeight ) * 100;
		return val + '%';
	}
	function fnHeaderScrollBar() {
		if ( elHeaderScrollBar ) {
			if ( ! elHeaderScrollBar.hasChildNodes() ) {
				const elChild = document.createElement( 'div' );
				elHeaderScrollBar.appendChild( elChild );
			}
			const el = elHeaderScrollBar.firstChild;
			el.style.width = fnGetScrollPercent();
		}
	}
	function fnHeaderScrollBarPosition() {
		if ( elHeaderScrollBar ) {
			if ( window.innerWidth <= 767 ) {
				elHeader.append( elHeaderScrollBar );
			} else {
				elSticky.append( elHeaderScrollBar );
			}
		}
	}
	function fnFilterSelect() {
		const clFilterMain = 'FilterMenu';
		const clFilterTitle = 'FilterMenu__title';
		const clFilterItems = 'FilterMenu__items';
		const clFilterItem = 'FilterMenu__item';
		const clFilterItemTitle = 'FilterMenu__item-title';
		const elFilterMain = queryAll( '.' + clFilterMain );

		if ( elFilterMain ) {
			elFilterMain.forEach( ( filterMain ) => {
				const elFilterTitle = filterMain.querySelector( '.' + clFilterTitle );
				const elFilterItems = filterMain.querySelector( '.' + clFilterItems );
				const elFilterItem = filterMain.querySelectorAll( '.' + clFilterItem );
				elFilterItem.forEach( ( item ) => {
					const elFilterItemTitle = item.querySelector( '.' + clFilterItemTitle );
					if ( elFilterTitle && elFilterItemTitle ) {
						const textItem = elFilterItemTitle.textContent;
						item.addEventListener( 'click', () => {
							elFilterTitle.textContent = textItem;
							if ( elFilterItems.classList.contains( 'visible' ) ) {
								elFilterItems.classList.remove( 'visible' );
								if ( elFilterTitle.classList.contains( 'active' ) ) {
									elFilterTitle.classList.remove( 'active' );
								}
								setTimeout( () => {
									elFilterItems.classList.remove( 'active' );
								}, 200 );
							}
						} );
					}
				} );
			} );
		}
	}
	function fnTocRemoveActive() {
		tocItems.forEach( ( element ) => {
			element.classList.remove( 'active' );
		} );
	}
	function fnTocActivate() {
		let isScrolling;
		if ( elTOC !== null ) {
			tocItems.forEach( ( element, index ) => {
				const el = element;
				const elTitle = el.querySelector( '.js-toc__item-title' );
				el.dataset.number = index;

				//fill TOC title with first item if empty
				if ( tocTitle.textContent === '' && index === 0 && elTitle ) {
					tocTitle.textContent = elTitle.textContent;
				}

				el.addEventListener( 'click', ( event ) => {
					event.preventDefault();
					fnTocRemoveActive();
					el.classList.add( 'active' );

					//smooth window scroll with correction
					const targetElement = document.querySelector( el.getAttribute( 'href' ) );
					const targetOffset = fnOffsetTop( targetElement );
					window.scroll( {
						top: ( targetOffset - ( fnHeaderHeight() + 24 ) ),
						behavior: 'smooth',
					} );
				} );
			} );
		}

		window.addEventListener(
			'scroll',
			() => {
				window.clearTimeout( isScrolling );
				if ( elTOC !== null && fnHeaderHeight() ) {
					let itemsTocHeader = tocHeaderItems;
					if ( elTocChecklists ) {
						itemsTocHeader = tocChecklistsHeaderItems;
					}
					itemsTocHeader.forEach( ( element ) => {
						if ( element.getBoundingClientRect().top <= ( fnHeaderHeight() + threshold ) ) {
							const elemHref = element.getAttribute( 'id' );
							const activateItem = query(
								`.js-toc a[href*=${ elemHref }`
							);
							if ( activateItem ) {
								fnTocRemoveActive();
								activateItem.classList.add( 'active' );
								tocTitle.textContent = activateItem.textContent;
							}
						}
					} );
				}
			},
			false
		);
	}
	function fnSidebarStickyPos() {
		let topMargin = 36;
		if ( elSidebarSticky && fnHeaderHeight() && isSticky === true ) {
			topMargin = ( topMargin + fnHeaderHeight() ) + 'px';
			elSidebarSticky.style.top = topMargin;
		}
	}

	fnStickyHeader();
	fnStickyHeaderActions();
	fnHeaderScrollBar();
	fnHeaderScrollBarPosition();
	fnFilterSelect();
	fnSidebarStickyPos();
	fnTocActivate();
	window.addEventListener( 'scroll', function() {
		let scrollDirection = 'down';
		if ( ( document.body.getBoundingClientRect() ).top > scrollPos ) {
			scrollDirection = 'up';
		}
		scrollPos = ( document.body.getBoundingClientRect() ).top;
		fnStickyHeader( scrollDirection = scrollDirection );
		fnHeaderScrollBar();
		fnSidebarStickyPos();
	}, true );
	window.addEventListener( 'resize', function() {
		fnStickyHeader();
		fnHeaderScrollBarPosition();
	}, true );
	// Handles TOC in case when user changes orientation of device from portrait > landscape, ie. iPad Pro
	mql.addEventListener( 'change', ( event ) => {
		if ( event.matches ) {
			fnTocActivate();
		}
	} );
} )();
