/* global Splide, body */

const gallery = document.querySelectorAll( '[data-lightbox="gallery"]' );

function removeLightboxModal( event, target ) {
	const lightboxTarget = target;
	event.stopPropagation();
	lightboxTarget.classList.remove( 'active' );
	body.classList.remove( 'lb-disable-scrolling' );

	setTimeout( () => {
		lightboxTarget.style.display = 'none';
	}, 500 );
}

if ( gallery.length > 0 ) {
	const galleryConst = document.createElement( 'div' );
	let lightbox = null;
	galleryConst.classList.add( 'lightbox', 'splide' );
	galleryConst.innerHTML += '<span class="lightbox__close">&times;</span>';
	galleryConst.innerHTML +=
		'<div class="splide__track"><ul class="splide__list"></ul></div>';

	gallery.forEach( ( imageLink, imageIndex ) => {
		const imageConstructor = `
    <li class="splide__slide"><div class="lightbox__image-wrapper">\
    <img class="lightbox__image" \
    data-splide-lazy="${ imageLink.href }" \
    data-imageid="${ imageIndex }" \
		alt="gallery image" \
		/></div></li>`;

		galleryConst.querySelector(
			'.splide__list'
		).innerHTML += imageConstructor;

		lightbox = new Splide( galleryConst, {
			fixedWidth: '100%',
			perPage: 1,
			speed: 400,
			pagination: false,
			arrows: true,
			lazyLoad: 'nearby',
		} );

		imageLink.addEventListener( 'click', ( event ) => {
			const thisImage = imageIndex;
			event.preventDefault();

			if ( body.querySelector( '.lightbox' ) === null ) {
				lightbox.mount();

				body.appendChild( galleryConst );
			}

			body.classList.add( 'lb-disable-scrolling' );
			galleryConst.style.display = 'block';

			setTimeout( () => {
				galleryConst.classList.add( 'active' );
				lightbox.go( thisImage );
			}, 100 );
		} );
	} );

	galleryConst
		.querySelector( '.lightbox__close' )
		.addEventListener( 'click', ( event ) => {
			removeLightboxModal( event, galleryConst );
		} );

	document.addEventListener( 'keyup', ( event ) => {
		if ( event.key === 'Escape' ) {
			removeLightboxModal( event, galleryConst );
		}
	} );
}
