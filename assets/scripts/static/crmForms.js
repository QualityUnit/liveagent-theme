/* global getCookie, setCookie */
/* global quCrmData */

class CrmFormHandler {
	constructor( formElement ) {
		this.form = formElement;
		this.localized = quCrmData.localization;
		this.apiBase = quCrmData.apiBase;
		this.nonce = quCrmData.nonce;
		this.productId = quCrmData.productId;
		this.liveValidationTimeout = undefined;
		this.lastValidatedDomain = undefined;
		this.shouldCheckDomain = true;

		this.fields = {
			name: { valid: false },
			email: { valid: false },
			domain: { valid: false },
			region: { valid: false },
			code: { valid: false },
			captcha: { valid: false },
			promo: {},
			submit: {},
		};

		this.regexPatterns = {
			name: /[^\p{L}0-9\s]+/gu, // allow any unicode letters, numbers, spaces, disallow special characters
			email: /^(?![a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$)/,
			domain: /^(?!((?!http|www))[^A-Z][-a-z0-9]*$)/, // allow a-z, 0-9, hyphens, disallow A-Z, www/http in start and special characters
			code: /^(?![A-Za-z0-9-]+$)/, // allow a-z, A-Z, 0-9 and hyphens
			emailCompany: new RegExp( '@(gmail.com|outlook.com|yahoo.com|zoho.com|aol.com|icloud.com|yandex' + '.com|gmx.us|@gmx.com)$' ),

			// exclude unwanted characters during typing, we cannot use whole regex for this purpose
			domain_live: /[^A-Za-z0-9-]/g,
			code_live: /[^A-Za-z0-9-]/g,
		};

		this.init();
	}

	init() {
		this.initFields();
		this.initValidation();
		this.initSubmission();
		// add form fields with tracking data which are not accessible on server side submission
		this.initTrackingFields();

		this.handleOnloadValidation();
	}

	initFields = () => {
		this.fields.name.main = this.form.querySelector( '[data-id=nameFieldmain]' );
		this.fields.name.input = this.fields.name.main?.querySelector( 'input[name=fullname]' );
		this.fields.name.validator = {
			callback: () => this.validateTextField( this.fields.name.input, 'name' ),
			events: [ 'blur', 'input' ],
		};

		this.fields.email.main = this.form.querySelector( '[data-id=mailFieldmain]' );
		this.fields.email.input = this.fields.email.main?.querySelector( 'input[name=email]' );
		this.fields.email.companyEmailMessage = this.fields.email.main?.querySelector( '[data-id="messageTrial"]' );
		this.fields.email.validator = {
			callback: () => {
				this.checkCompanyMail( this.fields.email.input );
				this.validateTextField( this.fields.email.input, 'email' );
			},
			events: [ 'blur', 'input' ],
		};

		this.fields.domain.main = this.form.querySelector( '[data-id=domainFieldmain]' );
		this.fields.domain.input = this.fields.domain.main?.querySelector( 'input[name=subdomain]' );
		this.fields.domain.validator = {
			callback: () => this.validateDomainField( this.fields.domain.input, 'domain' ),
			events: [ 'blur', 'input' ],
		};

		this.fields.region.main = this.form.querySelector( '[data-id=regionFieldmain]' );
		this.fields.region.input = this.fields.region.main.querySelector( '.FilterMenu' );
		this.fields.region.validator = {
			callback: () => this.validateSelection( this.fields.region.input, 'region' ),
			events: [ 'closedFilterMenu' ],
		};

		this.fields.code.main = this.form.querySelector( '[data-id=codeFieldmain]' );
		this.fields.code.input = this.fields.code.main?.querySelector( 'input[name=redeem_code]' );
		this.fields.code.validator = {
			callback: () => this.validateTextField( this.fields.code.input, 'code' ),
			events: [ 'blur', 'input' ],
		};

		this.fields.promo.main = this.form.querySelector( '[data-id=promoFieldmain]' );
		this.fields.promo.input = this.fields.promo.main?.querySelector( 'input[name=promo]' );

		this.fields.captcha.main = this.form.querySelector( '[data-id=captchaFieldmain]' );

		this.fields.submit.main = this.form.querySelector( '[data-id=submitFieldmain]' );
		this.fields.submit.button = this.fields.submit.main?.querySelector( 'button[type=submit]' );
	};

	initValidation = () => {
		const fields = this.fields;
		const regexPatterns = this.regexPatterns;

		Object.keys( fields ).forEach( ( key ) => {
			const input = fields[ key ].input;

			if ( input && fields[ key ].validator ) {
				const events = fields[ key ].validator.events;

				if ( events.includes( 'blur' ) ) {
					input.addEventListener(
						'blur', () => {
							if ( fields[ key ].validator.callback ) {
								fields[ key ].validator.callback();
							}
						}
					);
				}

				if ( events.includes( 'closedFilterMenu' ) ) {
					input.addEventListener(
						'closedFilterMenu', () => {
							if ( fields[ key ].validator.callback ) {
								fields[ key ].validator.callback();
							}
						}
					);
				}

				if ( events.includes( 'input' ) ) {
					input.addEventListener(
						'input', ( e ) => {
							const currentValue = e.target.value;
							const regex = regexPatterns[ `${ key }_live` ] ? regexPatterns[ `${ key }_live` ] : regexPatterns[ key ];

							// disallow typing unwanted characters
							e.target.value = currentValue.replace( regex, '' );

							// additionally disallow defined characters
							if ( key === 'email' ) {
								e.target.value = currentValue.replace( /%/g, '' );
							}
							// debounced check of user input
							clearTimeout( this.liveValidationTimeout );
							this.liveValidationTimeout = setTimeout( () => {
								if ( fields[ key ].validator.callback ) {
									fields[ key ].validator.callback();
								}
							}, 300 );
						}
					);
				}
			}
		} );
	};

	initSubmission = () => {
		const button = this.fields.submit.button;
		if ( button ) {
			button.addEventListener( 'click', ( e ) => {
				if ( ! this.isFormValid() ) {
					e.preventDefault();
				}
			} );
		}
	};

	initTrackingFields = () => {
		const createTrackingField = ( name, value ) => {
			const input = `<input name="${ name }" type="hidden" value="${ value }" autocomplete="off">`;
			this.form.insertAdjacentHTML( 'afterbegin', input );
		};

		const papVisitorId = getCookie( 'PAPVisitorId' );
		createTrackingField( 'pap_visitor_id', papVisitorId ? papVisitorId : '' );
		createTrackingField( 'source_id', this.getSourceId() );
	};

	getSourceId = () => {
		const crmsor = getCookie( 'crmsor' );
		if ( typeof crmsor !== 'undefined' && crmsor.length > 0 ) {
			const source = encodeURIComponent( window.atob( crmsor ) );
			return decodeURIComponent( source );
		}
		return '';
	};

	handleOnloadValidation = () => {
		const fields = this.fields;
		Object.keys( fields ).forEach( ( key ) => {
			const input = fields[ key ].input;
			const validator = fields[ key ].validator?.callback;
			if ( input && input.tagName.toLowerCase() === 'input' && input.value.length && validator ) {
				validator();
			}
		} );
	};

	isFormValid = () => {
		const fields = this.fields;
		const captcha = this.form.dataset.captcha;

		const validity = [];
		Object.keys( fields ).forEach( ( key ) => {
			const input = fields[ key ].input;
			const validator = fields[ key ].validator?.callback;
			if ( input && validator ) {
				validity.push( validator() && fields[ key ].valid );
			}
		} );

		if ( captcha && captcha.version === 'v2' ) {
			validity.push( this.validateCaptchaV2() );
		}

		return validity.some( ( v ) => v === false ) ? false : true;
	};

	validateCaptchaV2 = () => {
		if ( this.form.querySelector( '[data-id=grecaptcha]' )?.value === '' ) {
			this.setError( 'captcha', this.localized.invalid.captcha );
			return false;
		}
		return true;
	};

	validateSelection = ( element, key ) => {
		const localized = this.localized;
		const inputs = element.querySelectorAll( 'input.filter-item' );
		if ( inputs && inputs.length > 0 ) {
			let selected = '';
			inputs.forEach( ( input ) => {
				if ( input.checked ) {
					selected = input.value;
				}
			} );

			if ( ! selected ) {
				this.setError( key, localized.textEmpty );
				return false;
			}
			this.setValid( key );
			return true;
		}
	};

	validateTextField = ( element, key, waitForValidity = false ) => {
		const localized = this.localized;
		const fields = this.fields;
		const regex = this.regexPatterns[ key ];
		const value = element.value.trim();

		if ( value === '' ) {
			fields[ key ].main.classList.add( 'Error' );
			this.setError( key, localized.textEmpty );
			return false;
		}

		if ( regex.test( value ) ) {
			this.setError( key, localized.invalid[ key ] );
			return false;
		}

		if ( ! waitForValidity ) {
			this.setValid( key );
		}
		return true;
	};

	validateDomainField = async ( element, key ) => {
		const textValid = this.validateTextField( element, key, true );
		if ( textValid && this.lastValidatedDomain !== element.value ) {
			const result = await this.apiFetch(
				'subscriptions/_check_domain',
				{
					productId: this.productId,
					subdomain: element.value,
				},
				key
			);
			this.lastValidatedDomain = element.value;
			return result;
		}
		this.lastValidatedDomain = element.value;
	};

	checkCompanyMail = ( element ) => {
		const email = element.value;
		if ( email && this.fields.email.companyEmailMessage ) {
			const elm = this.fields.email.companyEmailMessage;
			if ( this.regexPatterns.emailCompany.test( email ) ) {
				elm.classList.remove( 'hidden' );
			} else {
				elm.classList.add( 'hidden' );
			}
		}
	};

	apiFetch = async ( endpoint, options = {}, key = '' ) => {
		try {
			this.setValidating( key );
			const params = Object.keys( options )
				.map( ( o ) => `${ encodeURIComponent( o ) }=${ encodeURIComponent( options[ o ] ) }` )
				.join( '&' );

			const response = await fetch( this.apiBase + endpoint + `?${ params }`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					accept: 'application/json',
					'X-WP-Nonce': this.nonce,
				},
			} );

			if ( response.ok ) {
				this.setValid( key );
				return true;
			}

			const result = await response.json();
			if ( result.message ) {
				this.setError( key, result.message );
				return false;
			}

			// fallback to show general error if no cases above
			this.setError( key, this.localized.textFailedDomain );
			return false;
		} catch ( error ) {
			// eslint-disable-next-line no-console
			console.error( error );
			this.setError( key, this.localized.textFailedDomain );
			return false;
		}
	};

	setError = ( key, message ) => {
		if ( key ) {
			const fields = this.fields;
			fields[ key ].main.classList.remove( 'Valid', 'Waiting' );
			fields[ key ].main.classList.add( 'Error' );
			fields[ key ].valid = false;
			const errorWrapper = fields[ key ].main.querySelector( 'div.ErrorMessage' );
			if ( errorWrapper ) {
				errorWrapper.textContent = message;
			}
		}
	};

	setValid = ( key ) => {
		if ( key ) {
			const fields = this.fields;
			fields[ key ].main.classList.remove( 'Error', 'Waiting' );
			fields[ key ].main.classList.add( 'Valid' );
			fields[ key ].valid = true;
			const errorWrapper = fields[ key ].main.querySelector( 'div.ErrorMessage' );
			if ( errorWrapper ) {
				errorWrapper.textContent = '';
			}
		}
	};

	setValidating = ( key ) => {
		if ( key ) {
			const fields = this.fields;
			fields[ key ].main.classList.remove( 'Error', 'Valid' );
			fields[ key ].main.classList.add( 'Waiting' );
			fields[ key ].valid = false;
			const errorWrapper = fields[ key ].main.querySelector( 'div.ErrorMessage' );
			if ( errorWrapper ) {
				errorWrapper.textContent = this.localized.textValidating;
			}
		}
	};
}

const handleSourceScripts = () => {
	const processAnchor = ( name ) => {
		const replacedName = name.replace( '#', '' );
		const q = [
			'kuk',
			'support',
			'david',
			'ac',
			'qm',
			'qn',
			'qu',
			'sw',
			'nat',
			'paju',
		];

		if ( q.includes( replacedName ) ) {
			return `Quora/${ replacedName }`;
		}

		return `Anchor/${ replacedName }`;
	};

	const processUtm = ( url ) => {
		const sources = [];

		if ( url.searchParams.get( 'utm_source' ) !== null ) {
			sources.push( `UTM/${ url.searchParams.get( 'utm_source' ) }` );
		}

		if ( url.searchParams.get( 'utm_campaign' ) !== null ) {
			sources.push( url.searchParams.get( 'utm_campaign' ) );
		}

		if ( url.searchParams.get( 'utm_medium' ) !== null ) {
			sources.push( url.searchParams.get( 'utm_medium' ) );
		}

		return sources.join();
	};

	const processGAds = ( url ) => {
		const sources = [];

		if ( url.searchParams.get( 'a_aid' ) !== null ) {
			sources.push( `PAP/${ url.searchParams.get( 'a_aid' ) }` );
		}

		if ( url.searchParams.get( 'chan' ) !== null ) {
			sources.push( url.searchParams.get( 'chan' ) );
		}

		if ( url.searchParams.get( 'keyword' ) !== null ) {
			sources.push( url.searchParams.get( 'keyword' ) );
		}

		return sources.join();
	};

	const urlString = window.location.href;
	const url = new URL( urlString );
	let source = '';

	if ( url !== null ) {
		if ( url.searchParams.get( 'utm_source' ) !== null ) {
			source = processUtm( url );
		} else if ( url.searchParams.get( 'utm_channel' ) !== null ) {
			source = `UTM/${ url.searchParams.get( 'utm_channel' ) }`;
		} else if ( url.searchParams.get( 'a_aid' ) !== null ) {
			source = processGAds( url );
		} else if ( url.searchParams.get( 'fbclid' ) !== null ) {
			source = `Facebook_share/${ window.location.href }`;
		} else if ( url.searchParams.get( 'ref' ) !== null ) {
			source = `Reference/${ url.searchParams.get( 'ref' ) }/${
				window.location.href
			}`;
		} else if ( url.searchParams.get( 'rel' ) !== null ) {
			source = `Relation/${ url.searchParams.get( 'rel' ) }/${
				window.location.href
			}`;
		} else if ( location.hash ) {
			source = processAnchor( location.hash );
		} else {
			source = `Landing_page/${ window.location.href }`;
		}
	} else {
		source = `Landing_page/${ window.location.href }`;
	}

	if ( source !== '' ) {
		setCookie( 'crmsor', window.btoa( source ), 60 );
	}
};

( () => {
	// source scripts, previously source.js
	handleSourceScripts();

	// init signup forms handlers
	document.querySelectorAll( 'form[data-form-type=signup-trial-form' ).forEach( ( form ) => {
		new CrmFormHandler( form );
	} );
} )();
