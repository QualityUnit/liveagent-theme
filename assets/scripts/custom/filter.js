( () => {
	const query = document.querySelector.bind( document );
	const queryAll = document.querySelectorAll.bind( document );

	function recountVisible() {
		// ReCount
		setTimeout( () => {
			const listItem = queryAll( '.list li' );
			const recount =
				listItem.length - queryAll( ".list li[style*='none']" ).length;
			query( '#countPosts' ).textContent = recount;
		}, 25 );
	}

	if ( query( '.Category__container' ) !== null ) {
		const list = query( '.list' );
		const listItems = list.querySelectorAll( 'li' );
		const pillars = list.querySelectorAll( 'li.pillar' );
		const countItems = listItems.length;
		const filterItems = queryAll(
			".Category__sidebar__item input[type='radio']"
		);
		const search = query( "input[type='search']" );
		const { hash } = window.location;
		const activeFilter = {
			collections: '',
			plan: '',
			size: '',
			category: '',
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
			const dataFavourite = listItem.dataset.favourite
				? listItem.dataset.favourite
				: '';
			const dataType = listItem.dataset.type ? listItem.dataset.type : '';

			filterItems.forEach( ( e ) => {
				const filterItem = e;

				filterItem.addEventListener( 'change', () => {
					function regex( activeFilterCategory ) {
						if ( activeFilterCategory !== '' ) {
							return new RegExp( `^${ activeFilterCategory }$` );
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
							regex( activeFilter.category )
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
					.querySelector( 'h3' )
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

				if ( ! title.includes( val ) ) {
					listItem.style.display = 'none';
				}

				recountVisible();
			} );
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
				list.classList.remove( 'empty' );
				list.querySelectorAll( 'li' ).forEach( ( element ) => {
					const el = element;
					el.style = null;
				} );
			}

			recountVisible();
		} );
	}
} )();
