( () => {
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );

	function recountVisible() {
		// ReCount
		setTimeout( () => {
			const listItem = queryAll( '.list li' );
			const recount =
				listItem.length - queryAll( ".list li[style*='none']" ).length;
			const counter = query( '#countPosts' );
			if ( counter ) {
				counter.textContent = recount;
			}
		}, 25 );
	}

	function filterMenuTitleChange( item ) {
		const clWrap = 'FilterMenu';
		const clTitle = 'FilterMenu__title';
		const title = item.getAttribute( 'title' );
		const elMain = item.closest( '.' + clWrap );
		if ( elMain && title !== null ) {
			const elTitle = elMain.querySelector( '.' + clTitle );
			if ( elTitle ) {
				elTitle.textContent = title;
			}
		}
	}

	if ( query( '.list' ) !== null ) {
		const list = query( '.list' );
		const listItems = list.querySelectorAll( 'li' );
		const pillars = list.querySelectorAll( 'li.pillar' );
		const countItems = listItems.length;
		const filterItems = queryAll(
			'.filter-item'
		);
		const search = query( "input[type='search']" );
		const searchReset = query( "input[type='search']+.search-reset" );
		const searchResetActive = 'search-reset--active';
		const { hash } = window.location;
		const activeFilter = {
			collections: '',
			plan: '',
			size: '',
			category: '',
			region: '',
			favourite: '',
			type: '',
		};

		// Count
		const count =
			queryAll( '.list li' ).length -
			queryAll( ".list li[style*='none']" ).length;
		if ( query( '.Category__content__description' ) ) {
			query( '.Category__content__description span' ).textContent = count;
			query( '.Category__content__description div' ).classList.add(
				'show'
			);
		}

		function resultsReset() {
			searchReset.classList.remove( searchResetActive );
			list.classList.remove( 'empty' );
			list.querySelectorAll( 'li' ).forEach( ( element ) => {
				const el = element;
				el.style = null;
			} );
		}

		// Adds numbered classes to each featured article so we can assign image to it
		if ( pillars !== null ) {
			pillars.forEach( ( pillar, i ) => {
				pillar.classList.add( `pillar-${ i }` );
			} );
		}

		// Filter
		filterItems.forEach( ( element ) => {
			const filterItem = element;

			filterItem.addEventListener( 'change', () => {
				if ( filterItem.matches( ':checked' ) ) {
					const val = filterItem.value;
					const name = filterItem.getAttribute( 'name' );

					if ( name === 'category' ) {
						window.history.pushState( {}, '', `#${ val }` );
						if ( val.length === 0 ) {
							window.history.pushState( {}, '', ' ' );
						}
					}

					activeFilter[ name ] = val;
				}

				recountVisible();
			} );
		} );

		// Items
		listItems.forEach( ( element ) => {
			const listItem = element;
			const dataCollections = listItem.dataset.collections
				? listItem.dataset.collections
				: '';
			const dataPlan = listItem.dataset.plan ? listItem.dataset.plan : '';
			const dataSize = listItem.dataset.size ? listItem.dataset.size : '';
			const dataCategory = listItem.dataset.category
				? listItem.dataset.category
				: '';
			const dataRegion = listItem.dataset.region
				? listItem.dataset.region
				: '';
			const dataFavourite = listItem.dataset.favourite
				? listItem.dataset.favourite
				: '';
			const dataType = listItem.dataset.type ? listItem.dataset.type : '';

			filterItems.forEach( ( e ) => {
				const filterItem = e;

				filterItem.addEventListener( 'change', () => {
					function regexCategory( activeFilterCategory ) {
						if ( activeFilterCategory !== '' ) {
							return new RegExp( ` ?${ activeFilterCategory } ?` );
						}
						return '';
					}

					function regexRegion( activeFilterRegion ) {
						if ( activeFilterRegion !== '' ) {
							return new RegExp( ` ?${ activeFilterRegion } ?` );
						}
						return '';
					}

					if (
						listItem.style.display === 'none' &&
						! listItem.classList.contains( 'pillar' )
					) {
						listItem.style.display = 'block';
					}

					if (
						listItem.style.display === 'none' &&
						listItem.classList.contains( 'pillar' )
					) {
						listItem.style.display = 'flex';
					}

					if (
						! dataCollections.includes(
							activeFilter.collections
						) ||
						! dataPlan.includes( activeFilter.plan ) ||
						! dataSize.includes( activeFilter.size ) ||
						! dataCategory.match(
							regexCategory( activeFilter.category )
						) ||
						! dataRegion.match(
							regexRegion( activeFilter.region )
						) ||
						! dataFavourite.includes( activeFilter.favourite ) ||
						! dataType.includes( activeFilter.type )
					) {
						listItem.style.display = 'none';
					}
				} );
			} );
		} );

		// URL filter
		if ( hash.length ) {
			const filteredHash = hash.replace( '#', '' );

			listItems.forEach( ( element ) => {
				const listItem = element;
				const dataCategory = listItem.dataset.category
					? listItem.dataset.category
					: '';

				if ( ! dataCategory.includes( filteredHash ) ) {
					listItem.style.display = 'none';
				}
			} );

			filterItems.forEach( ( element ) => {
				const filterItem = element;
				const val = filterItem.value;

				if ( filteredHash === val ) {
					filterItem.checked = true;
					filterMenuTitleChange( filterItem );
					recountVisible();
				}
			} );
		}

		// Search
		search.addEventListener( 'keyup', () => {
			const val = search.value.toLowerCase();

			listItems.forEach( ( element ) => {
				const listItem = element;
				const title = listItem
					.querySelector( '.item-title' )
					.textContent.toLowerCase();
				const excerpt = listItem
					.querySelector( '.item-excerpt' )
					.textContent.toLowerCase();

				if (
					listItem.style.display === 'none' &&
					! listItem.classList.contains( 'pillar' )
				) {
					listItem.style.display = 'block';
				}

				if (
					listItem.style.display === 'none' &&
					listItem.classList.contains( 'pillar' )
				) {
					listItem.style.display = 'flex';
				}

				if ( ! title.includes( val ) && ! excerpt.includes( val ) ) {
					listItem.style.display = 'none';
				}

				recountVisible();
			} );
		} );

		searchReset.addEventListener( 'click', () => {
			search.value = '';
			resultsReset();
			recountVisible();
		} );

		// Empty
		filterItems.forEach( ( element ) => {
			const filterItem = element;

			filterItem.addEventListener( 'change', () => {
				if (
					list.querySelectorAll( "li[style*='display: none']" )
						.length === countItems
				) {
					list.classList.add( 'empty' );
				} else {
					list.classList.remove( 'empty' );
				}
			} );
		} );

		search.addEventListener( 'keyup', () => {
			if (
				list.querySelectorAll( "li[style*='display: none']" ).length ===
				countItems
			) {
				list.classList.add( 'empty' );
			} else {
				list.classList.remove( 'empty' );
			}
		} );
		search.addEventListener( 'input', () => {
			if ( search.value === '' ) {
				resultsReset();
			} else {
				searchReset.classList.add( searchResetActive );
				recountVisible();
			}
		} );
	}
} )();
