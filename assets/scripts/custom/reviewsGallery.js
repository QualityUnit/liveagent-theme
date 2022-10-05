/* global Splide, IntersectionObserver */

document.addEventListener( 'DOMContentLoaded', function() {
	const reviewsGalleryMain = document.querySelector(
		'.Reviews__Gallery--main'
	);

	const reviewsGalleryThumbs = document.querySelectorAll(
		'.Reviews__Gallery--thumbs .splide__slide'
	);

	/* Reviews gallery thumbnail strip */
	if ( reviewsGalleryMain.length > 0 ) {
		const mainSlider = new Splide( '.Reviews__Gallery--main', {
			type: 'fade',
			perPage: 1,
			perMove: 1,
			width: '100%',
			rewind: true,
			pagination: false,
			arrows: true,
		} );

		const reviewsGalleryThumbsSlider = new Splide( '.Reviews__Gallery--thumbs', {
			fixedWidth: 85,
			fixedHeight: 80,
			gap: '.75em',
			pagination: false,
			arrows: true,
			rewind: true,
			isNavigation: true,
			focus: 'center',
			trimspace: true,
		} );

		const thumbnails = document.querySelectorAll( '.Reviews__Gallery--thumbnail' );
		let current = null;

		thumbnails.forEach( ( thumb, index ) => {
			initThumbnail( thumb, index );
		} );

		function initThumbnail( thumbnail, index ) {
			thumbnail.addEventListener( 'click', function() {
				mainSlider.go( index );
			} );
		}

		mainSlider.on( 'mounted move', function() {
			const thumbnail = thumbnails.item( mainSlider.index );

			if ( thumbnail ) {
				if ( current ) {
					current.classList.remove( 'is-active' );
				}

				thumbnail.classList.add( 'is-active' );
				current = thumbnail;
			}
		} );

		if ( 'IntersectionObserver' in window ) {
			const reviewsGalleryThumbsSliderObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							mainSlider.mount();

							if ( reviewsGalleryThumbs.length > 6 ) {
								reviewsGalleryThumbsSlider.mount();
							}

							const sliderObject = entry.target;
							reviewsGalleryThumbsSliderObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			reviewsGalleryThumbsSliderObserver.observe( reviewsGalleryMain );
		}
	}
} );
