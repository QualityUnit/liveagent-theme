/* global fetch */
/* eslint prefer-promise-reject-errors: ["error", {"allowEmptyReject": true}] */
/*
	---------
	Used to add generic advertisement
	for Trial page into Box-stars elementor boxes
	if there are not more than 2 of them in a row
	----------
*/

// We first check if we are at least on Tablet

const mqtablet = window.matchMedia( '(min-width: 768px)' );

const addTrialBanner = () => {
	const boxesStars = document.querySelectorAll(
		'section.Boxes--stars .elementor-inner-section .elementor-row'
	);

	if ( boxesStars.length > 0 ) {
		const getLang = () => {
			const { lang } = document
				.querySelector( '.Header__flags--item-link.active' )
				.closest( '.Header__flags--item' );
			return lang.toLowerCase();
		};

		const enLangUrl =
			'/app/themes/liveagent/assets/i18n/trial_banner/en.json';
		const langUrl = `/app/themes/liveagent/assets/i18n/trial_banner/${ getLang() }.json`;

		const adConstructor = ( strings ) => {
			const {
				discover,
				fastest,
				onmarket,
				answerTickets,
				buttonText,
				buttonUrl,
			} = strings;

			const trialAd = `
				<div class="elementor-column elementor-col-50">
					<div class="trialAd">
						<img class="trialAd__icon" src="/app/themes/liveagent/assets/images/trialAd_chat.svg" alt="trial Ad chat icon" />
						<h3 class="trialAd__title">${ discover }
							<div class="highlight-gradient">${ fastest }</div>
							${ onmarket }
						</h3>
						<p class="trialAd__text">${ answerTickets }</p>
						<a class="Button Button--full" href="${ buttonUrl }"><span>${ buttonText }</span></a>
					</div>
				</div>
			`;

			return trialAd;
		};

		// We add final constructed AD to star boxes where only 2 present
		const addToStars = ( data ) => {
			boxesStars.forEach( ( box ) => {
				if ( box.querySelectorAll( '.elementor-column' ).length < 3 ) {
					box.insertAdjacentHTML(
						'beforeend',
						adConstructor( data )
					);
				}
			} );
		};

		// Function to asynchrounsly get the language JSON file
		const texts = async ( url ) => {
			try {
				const fetchResult = await fetch( url );
				const result = await fetchResult.json();

				if ( fetchResult.status === 200 ) {
					return result;
				}
				if ( fetchResult.status === 404 ) {
					return Promise.reject( new Error( 'error 404' ) );
				}
			} catch ( err ) {
				return false;
			}
			return false;
		};

		texts( langUrl ).then( ( data ) => {
			if ( data ) {
				addToStars( data );
			}
			if ( ! data ) {
				texts( enLangUrl ).then( ( dataEn ) => {
					addToStars( dataEn );
				} );
			}
		} );
	}
};

if ( mqtablet.matches ) {
	addTrialBanner();
}

// Handles case when user changes orientation of device from portrait > landscape, ie. iPad Pro
mqtablet.addEventListener( 'change', ( event ) => {
	if ( event.matches ) {
		addTrialBanner();
	}
} );
