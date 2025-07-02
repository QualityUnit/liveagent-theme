/* global getCookie, setCookie */
/* global quCrmData */

class CrmFormHandler {
	constructor( formElement ) {
		this.form = formElement;
		this.localized = quCrmData.localization;
		this.apiBase = quCrmData.apiBase;
		this.nonce = quCrmData.nonce;
		this.currentLang = quCrmData.currentLang;
		this.crmLangCode = quCrmData.crmLangCode;
		this.isFreeForm = formElement.dataset.freeForm !== undefined;
		this.planType = formElement.dataset.planType;
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
			error: {},
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

		this.fields.error.main = this.form.querySelector( '[data-id=signUpError]' );

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

		this.form.addEventListener( 'createCrmAccount', ( e ) => {
			const data = new FormData( e.target );
			const formData = {};
			for ( const [ key, value ] of data.entries() ) {
				formData[ key ] = value;
			}

			if ( this.fields.submit.button ) {
				this.fields.submit.button.setAttribute( 'disabled', '' );
			}
			this.createCrmAccount( formData );
		} );
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

		// Check if the field is empty
		if ( value === '' ) {
			fields[ key ].main.classList.add( 'Error' );
			this.setError( key, localized.textEmpty );
			return false;
		}

		// Check if the value is less than 3 characters
		if ( key === 'domain' && value.length < 3 ) {
			fields[ key ].main.classList.add( 'Error' );
			this.setError( key, localized.textTooShort );
			return false;
		}

		// Validate against regex pattern
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
			const result = await this.checkAvailableDomain(
				'subscriptions/_check_domain',
				{
					productId: this.getProductId(),
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

	checkAvailableDomain = async ( endpoint, options = {}, key = '' ) => {
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

	createCrmAccount = async ( formData ) => {
		try {
			const isRedeem = formData.redeem_code !== undefined;
			const requestData = this.getRequestData( formData, isRedeem );
			const endpoint = formData.redeem_code ? 'redeem_code/signup/' : 'subscriptions/';

			const response = await fetch( quCrmData.apiBase + endpoint, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					accept: 'application/json',
					'X-WP-Nonce': quCrmData.nonce,
				},
				body: JSON.stringify( requestData ),
			} );

			if ( response.ok ) {
				const result = await response.json();
				// data used by installer, tracking scripts etc...
				const cookieData = {
					id: result.id,
					domain: result.domain,
					customer_email: result.customer_email,
					customer_name: result.customer_name,
					account_id: result.account_id,
					subdomain: requestData.subdomain,
					language: requestData.language,
					async: result.async,
					...( this.planType !== undefined && { plan_type: this.planType } ),
					...( isRedeem && { is_redeem: true } ),
				};

				setCookie( 'trial_signup_response', JSON.stringify( cookieData ) );
				window.location.href = quCrmData.thankYouUrl;
				return;
			}

			// handle error
			const result = await response.json();
			if ( result.message ) {
				if ( this.fields.submit.button ) {
					this.fields.submit.button.removeAttribute( 'disabled' );
				}
				this.setSignupError( result.message );
			}
		} catch ( error ) {
			// eslint-disable-next-line no-console
			console.error( 'Failed to create trial account: ', error );
			if ( this.fields.submit.button ) {
				this.fields.submit.button.removeAttribute( 'disabled' );
			}
		}
	};

	// create payload for signup request
	getRequestData = ( formData, isRedeem ) => {
		const data = formData;
		const requestData = {
			subdomain: data.subdomain,
			region: data.region,
			promo: data.promo === 'on',
			language: this.crmLangCode,
			...( data.grecaptcha !== undefined && { grtoken: data.grecaptcha } ),
			...( data.pap_visitor_id !== undefined && { pap_visitor_id: data.pap_visitor_id } ),
			...( data.source_id !== undefined && { source_id: data.source_id } ),
			...( data.ga_client_id !== undefined && { ga_client_id: data.ga_client_id } ),
		};

		if ( isRedeem ) {
			// shape of redeem code form payload
			return {
				...requestData,
				code: data.redeem_code,
				name: data.fullname,
				email: data.email,
			};
		}

		// shape of standard trial form payload
		return {
			...requestData,
			variation_id: this.getVariationId(),
			customer: {
				name: data.fullname,
				email: data.email,
			},

		};
	};

	getVariationId = () => {
	// variation_ids divided on the base of old crm js
		if ( this.isFreeForm ) {
			return 'freedesk';
		}

		if ( [ 'fi', 'sv' ].includes( this.currentLang ) ) {
			return 'seLaTria';
		}

		if ( 'ja' === this.currentLang ) {
			return 'iwkTrial';
		}

		return '3513230f';
	};

	getProductId = () => {
		// product_ids divided on the base of old crm js
		if ( this.isFreeForm ) {
			return 'b229622b';
		}

		if ( [ 'fi', 'sv' ].includes( this.currentLang ) ) {
			return 'spinla01';
		}

		if ( 'ja' === this.currentLang ) {
			return 'intwkla1';
		}

		return 'b229622b';
	};

	removeSignupError = () => {
		this.fields.error.main.classList.add( 'hidden' );
		this.fields.error.main.innerText = '';
	};

	setSignupError = ( message ) => {
		this.fields.error.main.innerText = message;
		this.fields.error.main.classList.remove( 'hidden' );
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
	document.querySelectorAll( 'form[data-form-type=signup-trial-form]' ).forEach( ( form ) => {
		new CrmFormHandler( form );
	} );
} )();
