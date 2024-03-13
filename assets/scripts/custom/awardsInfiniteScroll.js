
/*
 * DYNAMIC INFINITE SCROLL FOR awards ITEMS INSTEAD OF PAGINATION
 */
// Listening for the DOM content to be fully loaded before running the script.

document.addEventListener( 'DOMContentLoaded', ( ) => {
	const awardsItems = document.querySelector( '.Awards__container' );

	// Exiting the function early if the awardsItems element doesn't exist or if IntersectionObserver isn't supported.
	if ( ! awardsItems || ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	// Constructing the URL for the REST API call to fetch awards items.
	const locationServer = window.location.origin;

	let page = 1;

	const postsUrl = `${ locationServer }/wp-json/wp/v2/awards/`;

	// Selecting the loader element that indicates more items are being loaded.
	const loader = document.querySelector( '.Awards__items__loading' );

	// Asynchronous function to fetch posts from the REST API.
	const getPosts = async ( url ) => {
		try {
			const fetchResult = await fetch( url );
			if ( ! fetchResult.ok ) {
				return null;
			}
			const totalPages = fetchResult.headers.get( 'X-WP-TotalPages' );

			const data = await fetchResult.json();

			return { data, totalPages };
		} catch ( error ) {
			return null;
		}
	};

	// Function to create HTML for an image element.
	function createImageHtml( imageUrl, title ) {
		const img = document.createElement( 'img' );
		img.src = imageUrl;
		img.alt = title;
		return img.outerHTML;
	}

	// Function to construct HTML for a single awards post.

	function awardsPostConstructor( data ) {
		const {
			title,
			excerpt,
			url,
			image,
		} = data;

		const imageHtml = image ? createImageHtml( image, title ) : '';

		return `
	      <li class="Awards__item Archive__container__content__item inactive">
	          <article>
	              <div class="Awards__item--thumbnail">
	                  <a href="${ url }" target="_blank" rel="nofollow noopener">${ imageHtml }</a>
	              </div>
	              <div class="Awards__item--text">
	                  <h3><a href="${ url }" target="_blank" rel="nofollow noopener">${ title }</a></h3>
	                  ${ excerpt }
	              </div>
	          </article>
	      </li>
	  `;
	}

	// Function to find or create a container for awards posts of a specific year.
	const findOrCreateYearContainer = ( yearName ) => {
		let container = document.querySelector( `[data-year='${ yearName }']` );
		let list;

		if ( ! container ) {
			// If not found, creating a new container for that year.
			container = document.createElement( 'div' );
			container.setAttribute( 'data-year', yearName );
			container.className = 'Awards__container Archive__container Archive__container--boxes Archive__container--testimonials Archive__container--awards';
			awardsItems.appendChild( container );

			// Adding a year title for the year.
			const yearTitle = document.createElement( 'h3' );
			yearTitle.textContent = `${ yearName }`;
			yearTitle.className = 'Awards__container--year';
			container.appendChild( yearTitle );

			// Creating a list element within the container to hold the posts.
			list = document.createElement( 'ul' );
			list.className = 'Awards__content Archive__container__content list';
			container.appendChild( list );
		} else {
			list = container.querySelector( '.Awards__content' );
		}
		return list;
	};

	// Creating an IntersectionObserver to load more items as the user scrolls.
	const awardsPostsObserver = new IntersectionObserver( ( entries ) => {
		entries.forEach( ( entry ) => {
			if ( entry.boundingClientRect.bottom > 0 ) {
				page += 1;

				loader.classList.remove( 'invisible' );

				// Fetching the next set of posts.
				getPosts( `${ postsUrl }page=${ page }` ).then( ( response ) => {
					if ( response && page < response.totalPages ) {
						loader.classList.add( 'invisible' );
						response.data.forEach( ( item ) => {
							const yearName = item.ms_awards_years[ 0 ].name;
							const list = findOrCreateYearContainer( yearName );
							list.insertAdjacentHTML( 'beforeend', awardsPostConstructor( item ) );
						} );
						// We show up only first 3 awards items we had scrolled to, but preloaded all 9
						const hiddenBlogItems = new IntersectionObserver(
							// eslint-disable-next-line no-shadow
							( entries ) => {
								entries.forEach( ( e ) => {
									if ( e.isIntersecting ) {
										e.target.classList.remove( 'inactive' );
									}
								} );
							}
						);
						document
							.querySelectorAll( '.Awards__item.inactive' )
							.forEach( ( item ) => {
								hiddenBlogItems.observe( item );
							} );
					} else {
						loader.remove();
					}
				} );
			}
		} );
	}, {
		rootMargin: '100% 0px 0px 0px',
	} );

	awardsPostsObserver.observe( loader );
} );
