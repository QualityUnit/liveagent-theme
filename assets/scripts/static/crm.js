/* global _paq, Piwik, gtag, PostAffTracker, analytics, twq */
/* global getCookie, setCookie */
/* global quCrmData */

class CrmFormHandler {
	constructor( formElement ) {
		this.form = formElement;
		this.localized = quCrmData.localization;
		this.apiBase = quCrmData.apiBase;
		this.nonce = quCrmData.nonce;
		this.captchaVersion = quCrmData.captchaVersion;
		this.productId = quCrmData.productId;
		this.liveValidationTimeout = undefined;
		this.shouldCheckDomain = true;
		this.lastValidatedDomain = undefined;

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
		const crmsor = this.getSourceId();
		createTrackingField( 'pap_visitor_id', papVisitorId ? papVisitorId : '' );
		createTrackingField( 'source_id', crmsor ? crmsor : '' );
	};

	getSourceId = () => {
		const crmsor = getCookie( 'crmsor' );

		if ( typeof crmsor !== 'undefined' && crmsor.length > 0 ) {
			const source = window.escape(
				window.atob( window.unescape( crmsor ) )
			);
			const source2 = source.replace( new RegExp( '%2C', 'g' ), ',' );
			const source3 = source2.replace( new RegExp( '%3A', 'g' ), ':' );
			const source4 = source3.replace( new RegExp( '%26', 'g' ), '&' );
			const source5 = source4.replace( new RegExp( '%3D', 'g' ), '=' );
			return source5;
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
		const validity = [];
		Object.keys( fields ).forEach( ( key ) => {
			const input = fields[ key ].input;
			const validator = fields[ key ].validator?.callback;
			if ( input && validator ) {
				validity.push( validator() && fields[ key ].valid );
			}
		} );

		if ( this.captchaVersion === 'v2' ) {
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

class CrmInstaller {
	constructor( installationElement ) {
		this.signupData = quCrmData.signupData;
		this.localized = quCrmData.localization;
		this.apiBase = quCrmData.apiBase;
		this.nonce = quCrmData.nonce;

		this.productDomain = 'ladesk.com';
		this.authTokenName = 'AuthToken';
		this.userFormData = this.signupData.form_data;

		this.progress = 0;
		this.progressDots = '';

		this.fields = {
			main: installationElement,
		};

		this.trackers = {
			googleScript: "<img height='1' width='1' src='//www.googleadservices.com/pagead/conversion/966671101/imp.gif?label=ER6zCKjv_1cQ_fX4zAM&amp;guid=ON&amp;script=0' />",
			capterraScript: "<script src='https://ct.capterra.com/capterra_tracker.js?vid=2044023&vkey=ccda2d732326c153444c50f6ca6e489b'></script>",
			g2crowdTracking: '<img src="https://tracking.g2crowd.com/funnels/938455d7-8e96-4676-9ae2-427524d169d9.gif?stage=finish&stype=offer">',
			redditTracking: '<script>!function(w,d){if(!w.rdt){var p=w.rdt=function(){p.sendEvent?p.sendEvent.apply(p,arguments):p.callQueue.push(arguments)};p.callQueue=[];var t=d.createElement("script");t.src="https://www.redditstatic.com/ads/pixel.js",t.async=!0;var s=d.getElementsByTagName("script")[0];s.parentNode.insertBefore(t,s)}}(window,document);rdt("init","t2_an9rcu5x", {"optOut":false,"useDecimalCurrencyValues":true});rdt("track", "PageVisit");</script>',
		};
		this.pap = {
			account: 'default1',
			action: 'LATrial',
			campaign: 'cc052a4f',
		};
		this.pkvid = '';

		this.init();
	}

	init = () => {
		if ( ! this.signupData.id ) {
			return;
		}

		this.fields.progressHeader = this.fields.main.querySelector( '.BuildingApp__progress__header' );
		this.fields.progressTitle = this.fields.main.querySelector( '.BuildingApp__progress__header__title' );
		this.fields.progressBar = this.fields.main.querySelector( '.progress__bar' );
		this.fields.progressBarTick = this.fields.main.querySelector( '.progress__ball' );
		this.fields.progressPercentage = this.fields.main.querySelector( '.BuildingApp__progress__header__percentage' );

		this.fields.introductionVideos = this.fields.main.querySelector( '.Introduction__videos' );
		this.fields.progressDoneOverlay = this.fields.main.querySelector( '.progress__done__overlay' );
		this.fields.redirectButtonPanel = this.fields.main.querySelector( '[data-id="redirectButtonPanel"]' );

		// do not lazy load videos and images, installation on thank-you page starts immediately on load
		//this.initLazyLoadedContent();

		this.handleStartupActions();
		this.handleInstallation();
	};

	handleInstallation = async () => {
		const response = await this.checkInstallationProgress();

		if ( response.success ) {
			const data = response.data;

			if (
				data.account_status === undefined ||
				data.progress === undefined
			) {
				this.setProgress( 0 );
				this.setProgressText( this.localized.textFailedRetrieve );

				setTimeout( () => {
					this.handleInstallation();
				}, 500 );

				return;
			}

			if ( data.account_status === 'I' ) {
				this.setProgress( data.progress );

				setTimeout( () => {
					this.handleInstallation();
				}, 500 );

				return;
			}

			if ( data.account_status === 'A' ) {
				this.setProgress( 100 );
				this.handleFinishActions();
				this.handleFinishOverlay();

				if ( data.login_token ) {
					this.createGoToAppForm( data );
				}

				return;
			}
		}

		if ( ! response.success ) {
			this.setProgressText( response.message );
		}
	};

	checkInstallationProgress = async () => {
		try {
			const response = await fetch( this.apiBase + `subscriptions/${ this.signupData.id }/install_progress`, {
				method: 'GET',
				headers: {
					'Content-Type': 'application/json',
					accept: 'application/json',
					'X-WP-Nonce': this.nonce,
				},
			} );

			const result = await response.json();

			if ( response.ok ) {
				return {
					success: true,
					data: result,
				};
			}

			if ( result.message ) {
				return {
					success: false,
					message: result.message,
				};
			}
		} catch ( error ) {
			// eslint-disable-next-line no-console
			console.error( error );
			return {
				success: false,
				message: error.message,
			};
		}
	};

	initLazyLoadedContent = () => {
		const elements = this.fields.main.querySelectorAll( 'video[data-src-trial], img[data-src-trial]' );
		elements.forEach( ( elm ) => elm.setAttribute( 'src', elm.dataset.srcTrial ) );
	};

	setProgress = ( progress ) => {
		const roundedProgress = Math.round( progress );
		// If the new progress is greater than the current progress, update it.
		if ( this.progress <= roundedProgress ) {
			this.progress = roundedProgress;

			// Update the visual display of the progress bar.
			this.fields.progressBar.style.width = `${ this.progress }%`;
			this.fields.progressBarTick.style.left = `${ this.progress }%`;
			this.fields.progressPercentage.textContent = `${ this.progress }%`;
		}

		if ( this.progress <= 32 ) {
			this.setProgressText( this.localized.textProgressInstalling );
		} else if ( this.progress <= 52 ) {
			this.setProgressText( this.localized.textProgressLaunching );
		} else if ( this.progress <= 99 ) {
			this.setProgressText( this.localized.textProgressRedirecting );
		} else if ( this.progress === 100 ) {
			this.setProgressText( this.localized.textProgressFinalizing );
		}
	};

	handleFinishOverlay = () => {
		const toggleOverlay = this.toggleFinishOverlay;

		this.fields.progressPercentage.style.display = 'none';
		this.fields.progressHeader.classList.add( 'progress--done' );

		toggleOverlay();

		const selectedTab = this.fields.main.querySelector( '.Introduction__videos__tab.selected' );
		const continueButton = this.fields.main.querySelector( '.continue__watching' );
		const dataTab = selectedTab.dataset.tab;
		const video = this.fields.main.querySelector( `.tab-content[data-tab="${ dataTab }"] video` );

		if ( video ) {
			video.pause();
		}

		if ( ! this.fields.progressDoneOverlay.classList.contains( 'invisible' ) ) {
			continueButton.addEventListener( 'click', function( e ) {
				e.preventDefault();
				toggleOverlay();
				if ( video ) {
					video.play();
				}
			} );
		}
	};

	toggleFinishOverlay = () => {
		this.fields.introductionVideos.classList.toggle( 'opacity--low' );
		this.fields.progressDoneOverlay.classList.toggle( 'invisible' );
	};

	createGoToAppForm = ( data ) => {
		const goToText = this.userFormData.is_redeem ? this.localized.textGoToApp : this.localized.textGoToLiveAgent;
		const redirectFormString =
		`<form method='POST' action='${ data.login_url }' data-id="trialform">
			<input type='hidden' name='action' value='login'>
			<input type='hidden' name='${ this.authTokenName }' value='${ data.login_token }'>
			<input type='hidden' name='l' value='${ this.userFormData.language }'>
			<input type='submit' name='goto' value='${ goToText }' class='FinalButton' style='display: none;'>
			<a href='${ data.login_url }' data-id='gotoapp' class='FinalButton'>${ goToText }</a>
		</form>`;

		this.fields.main.querySelectorAll( '[data-id="redirectButtonPanel"]' ).forEach( ( elm ) => {
			elm.insertAdjacentHTML( 'beforeend', redirectFormString );
			elm.style.display = 'block';

			const redirectForm = elm.querySelector( 'form[data-id="trialform"]' );
			const goToButton = elm.querySelector( '[data-id=gotoapp]' );

			goToButton.addEventListener( 'click', ( e ) => {
				e.preventDefault();
				setTimeout( () => {
					const btn = e.target;
					const href = btn.href;
					let param = href.replace(
						`${ data.login_url }`,
						''
					);
					param = param.replace( '?', '' );

					if ( this.pkvid === '' ) {
						const url = `${ data.login_url }?${ param }`;
						redirectForm.setAttribute( 'action', url );
					} else if ( param === '' ) {
						const url = `${ data.login_url }${ this.pkvid }`;
						redirectForm.setAttribute( 'action', url );
					} else if ( this.pkvid === '' && param === '' ) {
						const url = `${ data.login_url }`;
						redirectForm.setAttribute( 'action', url );
					} else {
						const url = `${ data.login_url }${ this.pkvid }&${ param }`;
						redirectForm.setAttribute( 'action', url );
					}

					redirectForm.submit();
				}, 100 );
			} );
		} );
	};

	setProgressText = ( text ) => {
		if ( this.progressDots.length > 2 ) {
			this.progressDots = '.';
		} else {
			this.progressDots += '.';
		}

		if ( this.progress === 100 ) {
			this.progressDots = '...';
		}

		if ( this.progress === 0 ) {
			this.progressDots = '';
		}

		this.fields.progressTitle.textContent = `${ text }${ this.progressDots }`;
	};

	handleStartupActions = () => {
		this.showHiddenParts();
		this.handlePapAction();
		this.handleTrackersAction();
		this.handlePaqAction();

		if ( this.userFormData.is_redeem && this.userFormData.plan_type && typeof gtag !== 'undefined' ) {
			gtag( 'event', this.userFormData.plan_type, {
				event_category: 'SignUp',
			} );
		}

		window.uetq = window.uetq || [];
		window.uetq.push( 'event', 'SignUp', {
			event_category: 'Click',
			event_label: 'SignUp',
			event_value: '1',
		} );
	};

	handleFinishActions = () => {
		if ( typeof _paq !== 'undefined' ) {
			_paq.push( [
				'trackEvent',
				'Trial',
				'created',
				`${ this.userFormData.subdomain }.${ this.productDomain }`,
			] );
			if ( typeof Piwik === 'undefined' ) {
				this.pkvid = '';
			} else {
				this.pkvid = `?pk_vid=${ Piwik.getTracker().getVisitorId() }`;
			}
		}

		if ( typeof analytics !== 'undefined' ) {
			analytics.identify( null, { email: this.signupData.customer_email } );
			analytics.track( 'formSubmitted' );
		}

		if ( typeof twq !== 'undefined' ) {
			twq( 'event', 'tw-ocrty-odnh2', {} );
		}
	};

	showHiddenParts = () => {
		// by default, some parts like percentage and progress indicator are invisible in case the installation is processed for user with corrupted javascript
		this.fields.progressHeader.querySelectorAll( '.invisible' ).forEach( ( elm ) => elm.classList.remove( 'invisible' ) );
	};

	handleTrackersAction = () => {
		Object.values( this.trackers ).forEach( ( tracker ) => {
			this.fields.main.insertAdjacentHTML( 'beforeend', tracker );
		} );
		if ( typeof fbq !== 'undefined' ) {
			this.fields.main.insertAdjacentHTML( 'beforeend', "<script>fbq('track', 'StartTrial')</script>" );
		}
	};

	handlePapAction = () => {
		if ( typeof PostAffTracker !== 'undefined' ) {
			PostAffTracker.setAccountId( this.pap.account );
			const sale = PostAffTracker.createAction( this.pap.action );
			sale.setTotalCost( '1' );
			sale.setOrderID( this.signupData.id );
			sale.setProductID( '' );
			sale.setData1( this.signupData.customer_email );
			sale.setData3( 'api_qu_signup' );
			sale.setData4( this.userFormData.subdomain );
			sale.setCampaignID( this.pap.campaign );
			PostAffTracker.register();
		}
	};

	handlePaqAction = () => {
		if ( typeof _paq !== 'undefined' ) {
			_paq.push( [ 'setObjectId', this.signupData.account_id ] );
			_paq.push( [
				'setCustomData',
				'cd1',
				btoa( encodeURIComponent( this.signupData.customer_name ) ),
			] );
			_paq.push( [
				'setCustomData',
				'cd2',
				btoa( encodeURIComponent( this.signupData.customer_email ) ),
			] );
			_paq.push( [
				'trackEvent',
				'Trial',
				'install',
				`${ this.userFormData.subdomain }.${ this.productDomain }`,
			] );
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

	if ( getCookie( 'crmsor' ) !== null ) {
		return;
	}

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

	// init installation progress on thank-you page
	const installWrapper = document.querySelector( '#loader[data-id=signup-trial-installation]' );
	if ( installWrapper ) {
		new CrmInstaller( installWrapper );
	}
} )();
