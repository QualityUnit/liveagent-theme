/* eslint-disable camelcase */

/*
 * DYNAMIC INFINITE SCROLL FOR BLOG ITEMS INSTEAD OF PAGINATION
 */

const { __ } = wp.i18n;
const blogItems = document.querySelector( '.Blog__items' );

if ( blogItems && 'IntersectionObserver' in window ) {
	const { origin, pathname } = window.location;
	const locationServer = origin;

	const pathFragments = pathname.split( '/' ).filter( ( fragment ) => fragment !== '' );

	let postsUrl;

	const categoriesUrl = `${ locationServer }/wp-json/wp/v2/blog/cat_slug=`;

	if ( pathFragments[ 0 ] === 'author' && pathFragments.length === 2 ) {
		const bodyClasses = document.body.className;
		const authorIdMatch = bodyClasses.match( /author-(\d+)/ );
		if ( authorIdMatch ) {
			const authorId = authorIdMatch[ 1 ];
			postsUrl = `${ locationServer }/wp-json/wp/v2/blog/cat_id=1&author_id=${ authorId }`;
		}
	} else {
		postsUrl = `${ locationServer }/wp-json/wp/v2/blog/cat_id=1`;
		if ( pathFragments[ 0 ] === 'blog' && pathFragments.length === 2 ) {
			const categorySlug = pathFragments[ 1 ];
			postsUrl = categoriesUrl + categorySlug;
		}
	}

	const loader = document.querySelector( '.Blog__items__loading' );

	let page = 1; // Start on the first page, increment in the observer

	// Main fetch function to get posts
	const getPosts = async ( url ) => {
		try {
			const fetchResult = await fetch( url );
			const result = await fetchResult.json();

			if ( fetchResult.status === 200 ) {
				return result;
			}
			if ( fetchResult.status === 404 ) {
				return false;
			}
		} catch ( err ) {
			return false;
		}
		return false;
	};

	// HTML for Blog item where we dynamically load fetched data
	const blogPostConstructor = ( data ) => {
		const {
			id,
			title,
			categories,
			excerpt,
			url,
			image,
			date,
			dateU,
		} = data;

		const blogPost = `
					<li itemprop="blogPost" itemscope="" itemtype="http://schema.org/BlogPosting" class="Blog__item inactive postDynamic-${ id }">
						<a href="${ url }" title=${ title }" itemprop="url">
							<div class="Blog__item__thumbnail">
								<meta itemprop="image" content="${ image }">
								<img data-src="${ image }" alt="${ title }" />
							</div>
							<div class="Blog__item__content">
								<div class="Blog__item__meta">
									<div class="Blog__item__meta__categories">
										<span class="hidden">Categories:</span>
										<span class="postDynamicCats-${ id }">
											${ categories
		.map( ( cat ) => {
			return `<span>${ cat.name }</span>`;
		} )
		.join( '' ) }
										</span>
									</div>

									<div class="Blog__item__meta__date">
										<svg viewBox="0 0 11 12" xmlns="http://www.w3.org/2000/svg">
											<path d="M8.556 5.4H2.444v1.2h6.112V5.4Zm1.222-4.2h-.611V0H7.944v1.2H3.056V0H1.833v1.2h-.61c-.68 0-1.217.54-1.217 1.2L0 10.8c0 .66.544 1.2 1.222 1.2h8.556C10.45 12 11 11.46 11 10.8V2.4c0-.66-.55-1.2-1.222-1.2Zm0 9.6H1.222V4.2h8.556v6.6Zm-3.056-3H2.444V9h4.278V7.8Z"></path>
											</svg>
											<span itemprop="datePublished" content="${ dateU }">
												${ date }
											</span>
									</div>
								</div>

								<h3 class="Blog__item__title" itemprop="name">${ title }</h3>
								<p itemprop="abstract">
									${ excerpt }
									<span class="learn-more">
										${ __(
		'Learn More',
		'ms'
	) } <svg width="15" height="13" xmlns="http://www.w3.org/2000/svg">
											<path d="M8.514 0 7.37 1.146l4.525 4.542H0v1.625h11.895L7.37 11.854 8.514 13 15 6.5 8.514 0Z"></path>
											</svg>
									</span>
								</p>
							</div>
					</a>
					</li>
			`;

		return blogPost;
	};

	// Main observer function to check if we a little bit before end of blog items list

	const blogPostsObserver = new IntersectionObserver(
		( [ entry ] ) => {
			if ( entry.boundingClientRect.bottom > 0 ) {
				page += 1; // Iterating through pages to fetch from URL

				// Temporarily showing Loader
				loader.classList.remove( 'invisible' );

				// Fetching the blog posts from custom REST API endpoint
				getPosts( `${ postsUrl }&page=${ page }` ).then( ( data ) => {
					if ( data ) {
						loader.classList.add( 'invisible' );

						data.map( ( keys ) => {
							blogItems.insertAdjacentHTML(
								'beforeend',
								blogPostConstructor( keys )
							);
							return false;
						} );

						// We show up only first 3 blog items we had scrolled to, but preloaded all 9
						const hiddenBlogItems = new IntersectionObserver(
							( entries ) => {
								entries.forEach( ( e ) => {
									if ( e.isIntersecting ) {
										e.target.classList.remove( 'inactive' );
									}
								} );

								customLazyLoad(); // Calling images lazyload
							}
						);
						document
							.querySelectorAll( '.Blog__item.inactive' )
							.forEach( ( item ) => {
								hiddenBlogItems.observe( item );
							} );
					}
					if ( ! data ) {
						loader.remove();
					}
				} );
			}
		},
		{
			rootMargin: `100% 0px 0px 0px`, // Moving top of the observer window to the bottom of the screen
		}
	);

	blogPostsObserver.observe( loader ); // Binding observer on the Footer newsletter element
}

const customLazyLoad = () => {
	const media = document.querySelectorAll(
		'img[data-src], img[data-srcset], video[data-src]'
	);

	const eventType = ( element ) => {
		const elemType = element.tagName;
		if ( elemType === 'VIDEO' ) {
			return 'loadeddata';
		}
		return 'load';
	};

	if ( 'IntersectionObserver' in window && media.length > 0 ) {
		const mediaObserver = new IntersectionObserver( ( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					const datasrc = entry.target.getAttribute( 'data-src' );
					const datasrcset = entry.target.getAttribute( 'data-srcset' );
					const mediaObject = entry.target;

					if ( datasrcset !== null ) {
						mediaObject.setAttribute( 'srcset', datasrcset );
						mediaObject.removeAttribute( 'data-srcset' );
						mediaObject.addEventListener(
							eventType( mediaObject ),
							() => {
								const e = mediaObject;
								e.style.opacity = '1';
							}
						);
					}

					if ( datasrc !== null ) {
						mediaObject.setAttribute( 'src', datasrc );
						mediaObject.removeAttribute( 'data-src' );
						mediaObject.addEventListener(
							eventType( mediaObject ),
							() => {
								const e = mediaObject;
								e.style.opacity = '1';
							}
						);
					}

					mediaObserver.unobserve( mediaObject );
				}
			} );
		} );

		media.forEach( ( mediaObject ) => {
			mediaObserver.observe( mediaObject );
		} );
	}
};
