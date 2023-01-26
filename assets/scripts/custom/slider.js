/* global Splide */

const direction = () => {
	return document.documentElement.dir;
};

const thisSliders = document.querySelectorAll(
	'.elementor-shortcode .SliderTestimonials__slider:not(.SliderTestimonials__slider--home) .slider'
);

/* Testimonials Slider */
if ( thisSliders.length > 0 ) {
	thisSliders.forEach( ( slider ) => {
		slider.querySelectorAll( '[data-src]' ).forEach( ( image ) => {
			const img = image;
			img.setAttribute( 'src', img.dataset.src );
			img.style.cssText = null;
		} );
		const testimonialSlider = new Splide( slider, {
			type: 'loop',
			autoplay: true,
			direction: direction(),
			lazyLoad: 'sequential',
			speed: 300,
			easing: 'linear',
			fixedWidth: 'calc(50% - 70px)',
			perPage: 2,
			perMove: 1,
			pagination: false,
			arrows: true,
			breakpoints: {
				768: {
					fixedWidth: 'calc(100% - 70px)',
					perPage: 1,
				},
				767: {
					fixedWidth: '100%',
					perPage: 1,
					arrows: false,
				},
			},
		} );

		if ( 'IntersectionObserver' in window && thisSliders.length > 0 ) {
			const testimonialSliderObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							testimonialSlider.mount( );

							const sliderObject = entry.target;
							testimonialSliderObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			thisSliders.forEach( ( sliderObject ) => {
				testimonialSliderObserver.observe( sliderObject );
			} );
		}
	} );
}

/* Redesigned homepage vertical testimonials slider (earth map at bg) */
const homeVertical = document.querySelectorAll(
	'.elementor-shortcode .SliderTestimonials__slider--home .slider'
);

/* Testimonials Slider */
if ( homeVertical.length > 0 ) {
	homeVertical.forEach( ( slider ) => {
		slider.querySelectorAll( '[data-src]' ).forEach( ( image ) => {
			const img = image;
			img.setAttribute( 'src', img.dataset.src );
			img.style.cssText = null;
		} );
		const testimonials = new Splide( slider, {
			type: 'loop',
			direction: 'ttb',
			autoplay: true,
			lazyLoad: 'sequential',
			height: '44.5rem',
			fixedHeight: '13.5rem',
			speed: 500,
			interval: 10000,
			perPage: 3,
			perMove: 1,
			focus: 'center',
			pagination: false,
			arrowPath:
				'M11,16.1l1.8,1.8l5.9-5.9v19.5h2.6V12l5.9,5.9l1.8-1.8l-9-9L11,16.1z',
			arrows: true,
			trimspace: true,
			gap: '2em',
			breakpoints: {
				1380: {
					arrows: true,
					fixedHeight: '10.5rem',
					height: '35.5rem',
					gap: '1.5em',
					perPage: 3,
				},
				599: {
					fixedHeight: '23rem',
					height: '23rem',
					speed: 4000,
					perPage: 1,
					arrows: false,
					gap: '1.5em',
				},
			},
		} );

		// Bugfix for not showing images on first slide
		testimonials.on( 'lazyload:loaded', () => {
			const visibles = slider.querySelectorAll( '.is-visible' );

			if ( visibles.length >= 2 ) {
				visibles
					.item( 0 )
					.querySelectorAll( '[data-splide-lazy]' )
					.forEach( ( image ) => {
						const showImage = image;
						showImage.style.display = null;
						if ( showImage.nextElementSibling !== null ) {
							showImage.nextElementSibling.remove();
						}
					} );
			}
		} );

		// Fix to achieve fluid opacity animation on move, not after move
		testimonials.on( 'move', () => {
			const visibles = slider.querySelectorAll( '.is-visible' );
			if ( visibles.length >= 2 ) {
				visibles.item( 1 ).classList.remove( 'is-active' );
				visibles.item( 2 ).classList.add( 'is-active' );
			}
		} );

		if ( 'IntersectionObserver' in window && homeVertical.length > 0 ) {
			const testimonialsObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							testimonials.mount( );

							const sliderObject = entry.target;
							testimonialsObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			homeVertical.forEach( ( sliderObject ) => {
				testimonialsObserver.observe( sliderObject );
			} );
		}
	} );
}

const homeHorizontal = document.querySelectorAll(
	'.elementor-shortcode .SliderTestimonials__slider--horizontal .slider'
);

/* Testimonials Slider */
if ( homeHorizontal.length > 0 ) {
	homeHorizontal.forEach( ( slider ) => {
		slider.querySelectorAll( '[data-src]' ).forEach( ( image ) => {
			const img = image;
			img.setAttribute( 'src', img.dataset.src );
			img.style.cssText = null;
		} );
		const horizontalSlider = new Splide( slider, {
			type: 'loop',
			lazyLoad: 'sequential',
			autoplay: true,
			fixedWidth: '27.65rem',
			height: '15.5em',
			speed: 500,
			interval: 5000,
			perMove: 1,
			pagination: false,
			arrows: true,
			arrowPath:
				'M15.5966 -6.81751e-07L24 8.33333L24 10.6667L15.5966 19L13.2101 16.6667L18.7227 11.1667L-3.42406e-07 11.1667L-4.88111e-07 7.83333L18.7227 7.83333L13.1765 2.33333L15.5966 -6.81751e-07Z',
			trimspace: true,
			gap: '4em',
			breakpoints: {
				1024: {
					fixedWidth: 'calc(100% - 3em)',
					height: '18em',
					arrows: false,
				},
				767: {
					fixedWidth: '100%',
					height: '18em',
					arrows: false,
					gap: '0',
				},
			},
		} );

		// Fix to achieve fluid opacity animation on move, not after move
		horizontalSlider.on( 'move', () => {
			const visibles = slider.querySelectorAll( '.is-visible' );
			if ( visibles.length > 0 ) {
				visibles.item( 0 ).classList.add( 'is-active' );
				slider
					.querySelector( '.is-visible + li:not(.is-visible)' )
					.classList.add( 'is-visible' );
			}
		} );

		if ( 'IntersectionObserver' in window && homeHorizontal.length > 0 ) {
			const horizontalSliderObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							horizontalSlider.mount( );

							const sliderObject = entry.target;
							horizontalSliderObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			homeHorizontal.forEach( ( sliderObject ) => {
				horizontalSliderObserver.observe( sliderObject );
			} );
		}
	} );
}

/* Testimonials Slider in Gutenberg */
const gutenSliders = document.querySelectorAll(
	'.Gutenberg .SliderTestimonials__slider .slider'
);
if ( gutenSliders.length > 0 ) {
	gutenSliders.forEach( ( slider ) => {
		slider.querySelectorAll( '[data-src]' ).forEach( ( image ) => {
			const img = image;
			img.setAttribute( 'src', img.dataset.src );
			img.style.cssText = null;
		} );
		const gutenSlider = new Splide( slider, {
			type: 'loop',
			autoplay: true,
			direction: direction(),
			lazyLoad: 'sequential',
			speed: 300,
			easing: 'linear',
			fixedWidth: 'calc(100% - 100px)',
			perPage: 1,
			perMove: 1,
			pagination: false,
			arrows: true,
			breakpoints: {
				600: {
					arrows: true,
				},
				480: {
					fixedWidth: 'calc(100% - 40px)',
					arrows: false,
				},
			},
		} );

		if ( 'IntersectionObserver' in window && gutenSliders.length > 0 ) {
			const testimonialSliderObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							gutenSlider.mount( );

							const sliderObject = entry.target;
							testimonialSliderObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			gutenSliders.forEach( ( sliderObject ) => {
				testimonialSliderObserver.observe( sliderObject );
			} );
		}
	} );
}

/* Base of new testimonials slider */
const successStories = document.querySelectorAll(
	'.elementor-shortcode .SliderSuccessStories__slider .slider'
);
if ( successStories.length > 0 ) {
	successStories.forEach( ( slider ) => {
		slider.querySelectorAll( '[data-src]' ).forEach( ( image ) => {
			const img = image;
			img.setAttribute( 'src', img.dataset.src );
			img.style.cssText = null;
		} );
		const horizontalSlider = new Splide( slider, {
			type: 'loop',
			lazyLoad: 'sequential',
			autoplay: true,
			autoHeight: false,
			speed: 500,
			interval: 5000,
			perPage: 2,
			perMove: 1,
			pagination: false,
			arrows: true,
			arrowPath: 'M 11.304316,-1.4038072e-8 A 2.6087213,2.6087213 0 0 0 9.4598685,0.76427379 a 2.6087213,2.6087213 0 0 0 0,3.68889511 L 25.006897,20.000197 9.4598685,35.547225 a 2.6087213,2.6087213 0 0 0 0,3.688895 2.6087213,2.6087213 0 0 0 3.6888955,0 L 30.540239,21.844645 a 2.6089822,2.6089822 0 0 0 0,-3.688896 L 13.148764,0.76427379 A 2.6087213,2.6087213 0 0 0 11.304316,-1.4038072e-8 Z',
			trimspace: true,
			gap: '0',
			breakpoints: {
				767: {
					perPage: 1,
				},
			},
		} );

		// Fix to achieve fluid opacity animation on move, not after move
		horizontalSlider.on( 'move', () => {
			const visibles = slider.querySelectorAll( '.is-visible' );
			if ( visibles.length > 0 ) {
				visibles.item( 0 ).classList.add( 'is-active' );
				slider
					.querySelector( '.is-visible + li:not(.is-visible)' )
					.classList.add( 'is-visible' );
			}
		} );

		if ( 'IntersectionObserver' in window && successStories.length > 0 ) {
			const horizontalSliderObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							horizontalSlider.mount( );

							const sliderObject = entry.target;
							horizontalSliderObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			successStories.forEach( ( sliderObject ) => {
				horizontalSliderObserver.observe( sliderObject );
			} );
		}
	} );
}

/* Demo Slider */
if ( document.querySelectorAll( '.FullScreen__sidebar .slider' ).length > 0 ) {
	document
		.querySelectorAll( '.FullScreen__sidebar .slider' )
		.forEach( ( slider ) => {
			new Splide( slider, {
				type: 'loop',
				autoplay: true,
				direction: direction(),
				speed: 500,
				easing: 'linear',
				fixedWidth: '100%',
				perPage: 1,
				perMove: 1,
				pagination: true,
				arrows: false,
				breakpoints: {
					600: {
						arrows: true,
					},
					480: {
						arrows: false,
					},
				},
			} ).mount();
		} );
}

const customerbubbles = document.querySelectorAll(
	'.elementor-shortcode .CustomersBubbles .slider'
);

/* Customers Header Bubbles Slider */
if ( customerbubbles.length > 0 ) {
	customerbubbles.forEach( ( slider ) => {
		slider.querySelectorAll( '[data-src]' ).forEach( ( image ) => {
			const img = image;
			img.setAttribute( 'src', img.dataset.src );
			img.style.cssText = null;
		} );
		const bubbleSlider = new Splide( slider, {
			type: 'loop',
			direction: 'ttb',
			autoplay: true,
			lazyLoad: 'sequential',
			height: '29em',
			speed: 500,
			interval: 5000,
			perPage: 2,
			perMove: 1,
			pagination: false,
			arrows: false,
			trimspace: true,
			gap: '0em',
		} );

		// Fix to achieve fluid opacity animation on move, not after move
		bubbleSlider.on( 'move', () => {
			const visibles = slider.querySelectorAll( '.is-visible' );

			visibles.item( 1 ).classList.add( 'is-active' );
			slider
				.querySelector( '.is-visible + li:not(.is-visible)' )
				.classList.add( 'is-visible' );
		} );

		bubbleSlider.mount();
	} );
}

const referenceSlider = document.querySelectorAll( '.RealTestimonials' );
const showArrows = () => {
	if (
		document.querySelectorAll( '.RealTestimonials__thumbnails__slide' )
			.length > 6
	) {
		return true;
	}

	return false;
};

if ( referenceSlider.length > 0 ) {
	referenceSlider.forEach( () => {
		const main = new Splide( '.RealTestimonials__main', {
			type: 'slide',
			rewind: true,
			lazyLoad: 'nearby',
			pagination: false,
			arrows: false,
			direction: direction(),
		} );

		const thumbnails = new Splide( '.RealTestimonials__thumbnails', {
			fixedWidth: '10.625em',
			fixedHeight: '4.25em',
			gap: 0,
			rewind: true,
			pagination: false,
			arrows: showArrows(),
			direction: direction(),
			cover: true,
			perMove: 6,
			isNavigation: true,
			breakpoints: {
				1024: {
					fixedHeight: '3em',
					perMove: 3,
					arrows: false,
				},
			},
		} );

		if ( ! showArrows() ) {
			document
				.querySelector( '.RealTestimonials__thumbnails' )
				.classList.add( 'full' );
		}
		main.sync( thumbnails );
		thumbnails.mount();
		main.mount();
	} );
}

const sliderCutted = document.querySelectorAll( '.SliderCutted' );

if ( sliderCutted.length > 0 ) {
	sliderCutted.forEach( ( slider ) => {
		new Splide( slider, {
			type: 'slide',
			rewind: true,
			autoplay: true,
			direction: direction(),
			speed: 500,
			interval: 10000,
			perPage: 1,
			perMove: 1,
			pagination: true,
			arrows: true,
		} ).mount();
	} );
}

const smallPhotoSlider = document.querySelectorAll( '.SmallPhoto__slider' );

if ( smallPhotoSlider.length > 0 ) {
	smallPhotoSlider.forEach( ( slider ) => {
		slider.querySelectorAll( '[data-src]' ).forEach( ( image ) => {
			const img = image;
			img.setAttribute( 'src', img.dataset.src );
			img.style.cssText = null;
		} );
		const smallPhotos = new Splide( slider, {
			type: 'loop',
			autoplay: true,
			direction: direction(),
			lazyLoad: 'sequential',
			speed: 300,
			easing: 'linear',
			perPage: 3,
			perMove: 3,
			pagination: false,
			arrows: true,
			gap: '1.5em',
			breakpoints: {
				767: {
					perPage: 1,
					pagination: true,
				},
			},
		} );

		if ( 'IntersectionObserver' in window && smallPhotoSlider.length > 0 ) {
			const smallPhotosObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							smallPhotos.mount( );

							const sliderObject = entry.target;
							smallPhotosObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			smallPhotoSlider.forEach( ( sliderObject ) => {
				smallPhotosObserver.observe( sliderObject );
			} );
		}
	} );
}

const logosSlider = document.querySelectorAll( '.Logos__slider' );

if ( logosSlider.length > 0 ) {
	logosSlider.forEach( ( slider ) => {
		const logos = new Splide( slider, {
			type: 'loop',
			autoplay: true,
			direction: direction(),
			lazyLoad: 'sequential',
			speed: 600,
			interval: 8000,
			easing: 'linear',
			height: '50px',
			pagination: false,
			perPage: 6,
			perMove: 6,
			arrows: false,
			gap: '3em',
			breakpoints: {
				767: {
					perPage: 3,
					perMove: 3,
					pagination: true,
				},
			},
		} );

		if ( 'IntersectionObserver' in window && logosSlider.length > 0 ) {
			const logosObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							logos.mount( );

							const sliderObject = entry.target;
							logosObserver.unobserve( sliderObject );
						}
					} );
				}
			);
			logosSlider.forEach( ( sliderObject ) => {
				logosObserver.observe( sliderObject );
			} );
		}
	} );
}
