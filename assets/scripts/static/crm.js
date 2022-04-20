/* eslint-disable no-console, prefer-rest-params, consistent-return, no-global-assign, new-cap, no-mixed-operators, no-redeclare */
/* global $, _paq, Piwik, pkvid, gtag, PostAffTracker, grecaptcha */
/* global progressStep, newProgress, btoa */
/* global debug, textValidating, textInvalidField, textEmpty, textInstalling, textLaunching, textRedirecting, textFinalizing, textInvalidMail, productId, textValidDomain, textFailedDomain, textDomainNoHttp, textFailedRetrieve, productDomain, authTokenName, languageCode, textGoApp, textReadyApp, textDoneAppTitle, textDoneAppText, textError, papAccount, papAction, papCampaign, googleScript, capterraScript, textStart, textInvalid, textCreating, recaptchaId, variationId */

( function main() {
	const g2crowdTracking = '<img src="https://tracking.g2crowd.com/funnels/938455d7-8e96-4676-9ae2-427524d169d9.gif?stage=finish&stype=offer">';

	function sendApiRequest( options ) {
		const opt = options;
		opt.dataType = 'json';

		if ( opt.data ) {
			opt.data = JSON.stringify( opt.data );
		}

		if ( opt.params ) {
			opt.url += `?${ $.param( opt.params ) }`;
			opt.params = undefined;
		}

		$.ajax( opt );
	}

	const Api = function api() {
		this.url = 'https://crm.qualityunit.com/api/v3/';
		this.method = 'GET';
	};

	Api.domainCheck = function domcheck() {
		Api.apply( this, arguments );
		this.url += 'subscriptions/_check_domain';
		this.method = 'POST';
		this.params = {};
	};

	Api.installProgress = function install( subscriptionId ) {
		Api.apply( this, arguments );
		this.url += `subscriptions/${ subscriptionId }/install_progress`;
	};

	Api.signup = function signup() {
		Api.apply( this, arguments );
		this.url += 'subscriptions/';
		this.method = 'POST';
		this.data = {};
	};

	function generateAccessor( fieldName, accessor ) {
		return function a( reset ) {
			let rst = reset;
			rst = typeof rst !== 'undefined' ? rst : false;

			if ( rst || ! this[ fieldName ] ) {
				this[ fieldName ] = accessor.call( this, rst );
			}

			return this[ fieldName ];
		};
	}

	function setVisible( element, value ) {
		if ( value ) {
			element.removeClass( 'invisible' );
			$( 'body' ).addClass( 'activeOverlay' );
		} else {
			element.addClass( 'invisible' );
			$( 'body' ).removeClass( 'activeOverlay' );
		}
	}

	function FormField( name ) {
		this.name = name;
		this.active = true;
		this.validators = [];
		this.validationTimer = undefined;
	}

	FormField.prototype = {
		constructor: FormField,

		block: generateAccessor( '_block', function b() {
			return $( `.${ this.name }` );
		} ),

		main: generateAccessor( '_main', function m() {
			return $( `#${ this.name }main` );
		} ),

		input: generateAccessor( '_input', function i( reset ) {
			return this.main( reset ).find( 'input' );
		} ),

		value( reset ) {
			let rst = reset;
			rst = typeof rst !== 'undefined' ? rst : false;
			return this.input( rst ).val();
		},

		isChecked( reset ) {
			let rst = reset;
			rst = typeof rst !== 'undefined' ? rst : false;
			return this.input( rst ).is( ':checked' );
		},

		setActive( value ) {
			this.active = value === true;

			if ( ! this.active ) {
				this.setState( '', '' );
			} else if ( this.value() ) {
				this.validate();
			}

			this.onActivityChange( value );
		},

		onActivityChange() {},

		isActive() {
			return this.active;
		},

		setState( state, message ) {
			let msg = message;
			msg = typeof msg !== 'undefined' ? msg : '';
			const field = this.main();

			Object.keys( FormField.states ).forEach( ( s ) => {
				if ( FormField.states[ s ] === state ) {
					field.addClass( FormField.states[ s ] );
				} else {
					field.removeClass( FormField.states[ s ] );
				}
			} );

			this.errorMessage( msg );
		},

		errorMessage( message ) {
			this.main().find( '.ErrorMessage' ).html( message );
		},

		validate() {
			if ( this.validationTimer ) {
				this.cancelValidation();
			}

			if ( this.validators.length < 1 || ! this.isActive() ) {
				return;
			}

			const inst = this;
			const notifyResult = function notify( validator ) {
				let waiting = false;

				for ( let i = 0; i < inst.validators.length; i += 1 ) {
					const { state } = inst.validators[ i ];

					if ( state === FormField.states.error ) {
						inst.setState(
							FormField.states.error,
							inst.validators[ i ].message
						);
						return;
					}

					if ( state === FormField.states.waiting ) {
						waiting = true;
					}
				}

				if ( waiting ) {
					inst.setState( FormField.states.waiting, textValidating );
					return;
				}

				inst.setState( FormField.states.valid, validator.message );
			};

			for ( let i = 0; i < this.validators.length; i += 1 ) {
				this.validators[ i ].validate( this, notifyResult );
			}
		},

		getState() {
			let waiting = false;
			for ( let i = 0; i < this.validators.length; i += 1 ) {
				const { state } = this.validators[ i ];

				if ( state === FormField.states.error ) {
					return FormField.states.error;
				}

				if ( state === FormField.states.waiting ) {
					waiting = true;
				}
			}

			if ( waiting ) {
				return FormField.states.waiting;
			}

			return FormField.states.valid;
		},

		scheduleValidation( time ) {
			let t = time;
			t = typeof t !== 'undefined' ? t : 0;

			if ( t <= 0 ) {
				this.validate();
				return;
			}

			const inst = this;

			if ( this.validationTimer ) {
				clearTimeout( this.validationTimer );
			}

			this.validationTimer = setTimeout( () => {
				inst.validationTimer = undefined;
				inst.validate();
			}, t );
		},

		cancelValidation() {
			if ( this.validationTimer ) {
				clearTimeout( this.validationTimer );
				this.validationTimer = undefined;
			}
		},

		registerValidator( validator ) {
			if ( $.inArray( validator, this.validators ) >= 0 ) {
				return;
			}

			this.validators.push( validator );

			return this;
		},

		validateOn( event, time, selector ) {
			let t = time;
			t = typeof t !== 'undefined' ? t : 0;
			const inst = this;

			const runValidate = function run() {
				inst.scheduleValidation( t );
			};

			if ( typeof selector !== 'undefined' ) {
				this.main().find( selector ).on( event, runValidate );
			} else {
				this.main().on( event, runValidate );
			}

			return this;
		},
	};

	FormField.states = {
		error: 'Error',
		waiting: 'Waiting',
		valid: 'Valid',
	};

	function FieldValidator() {
		this.state = FormField.states.error;
		this.message = textInvalidField;
		this.unique = [];
	}

	FieldValidator.prototype = {
		constructor: FieldValidator,

		valid( message ) {
			this.state = FormField.states.valid;
			this.message = message;
		},

		error( message ) {
			this.state = FormField.states.error;
			this.message = message;
		},

		waiting() {
			this.state = FormField.states.waiting;
			this.message = '';
		},

		setUnique() {
			this.unique = [];

			for ( let i = 0; i < arguments.length; i += 1 ) {
				this.unique.push( arguments[ i ] );
			}
		},

		uniqueChanged() {
			if ( this.unique.length !== arguments.length ) {
				return true;
			}

			for ( let i = 0; i < arguments.length; i += 1 ) {
				if ( this.unique[ i ] !== arguments[ i ] ) {
					return true;
				}
			}

			return false;
		},
	};

	FieldValidator.textLength = function tl( errorMessage, minimum, selector ) {
		let em = errorMessage;
		let sel = selector;
		let min = minimum;
		em = typeof em !== 'undefined' ? em : textEmpty;
		sel = typeof sel !== 'undefined' ? sel : 'input';
		min = typeof min !== 'undefined' ? min : 1;

		const validator = new FieldValidator();
		validator.message = em;

		validator.validate = function validate( formField, notifyResult ) {
			const input = formField.main().find( sel ).val();

			if ( input && input.length >= min ) {
				validator.valid();
			} else {
				validator.error( em );
			}

			notifyResult( this );
		};

		return validator;
	};

	FieldValidator.request = function request( createOptions, precheckInput ) {
		const validator = new FieldValidator();

		validator.precheck = precheckInput;

		if ( typeof precheckInput === 'undefined' ) {
			validator.precheck = function precheck( formField ) {
				const input = formField.input().val();

				if ( input === 'undefined' || input === '' ) {
					this.error( textEmpty );
					return true;
				}

				if ( ! this.uniqueChanged( input ) ) {
					return true;
				}

				this.setUnique( input );

				return false;
			};
		}

		validator.validate = function v( formField, notifyResult ) {
			if ( this.precheck( formField ) ) {
				notifyResult( this );
				return;
			}

			const options = createOptions( formField );
			options.context = this;

			options.complete = function complete() {
				notifyResult( this );
			};

			sendApiRequest( options );

			this.waiting();
			notifyResult( this );
		};

		return validator;
	};

	FieldValidator.regex = function reg( regex, errorMessage, selector ) {
		let sel = selector;
		sel = typeof sel !== 'undefined' ? sel : 'input';

		const validator = new FieldValidator();
		validator.message = errorMessage;

		validator.validate = function v( formField, notifyResult ) {
			if ( regex.test( formField.main().find( sel ).val() ) ) {
				validator.valid();
			} else {
				validator.error( errorMessage );
			}

			notifyResult( this );
		};

		return validator;
	};

	function SignupForm() {
		this.formFields = {};

		this.submitButton = {
			isEnabled() {
				return ! this.main().attr( 'disabled' );
			},

			setEnabled( value ) {
				if ( value ) {
					this.main().removeAttr( 'disabled' );
				} else {
					this.main().attr( 'disabled', true );
				}
			},

			main: generateAccessor( '_main', () => $( '#createButtonmain' ) ),
			text: generateAccessor( '_text', () =>
				$( '#createButtontextSpan' )
			),
		};

		this.errorField = {
			display( message ) {
				if ( message ) {
					this.main().html( `<div>${ message }</div>` );
				} else {
					this.main().html( '' );
				}
			},

			main: generateAccessor( '_main', () => $( '#signUpError' ) ),
		};
	}

	SignupForm.prototype = {
		constructor: SignupForm,

		block: generateAccessor( '_block', () => $( '#signup' ) ),

		getField( name ) {
			if ( ! this.formFields[ name ] ) {
				this.formFields[ name ] = new FormField( name );
			}

			return this.formFields[ name ];
		},
	};

	function ProgressLoader() {
		this.dots = '';
		this.progress = 0;
		this.clientProgress = 0;
	}

	ProgressLoader.prototype = {
		constructor: ProgressLoader(),

		block: generateAccessor( '_block', () => $( '#loader' ) ),

		label: generateAccessor( '_label', function label( reset ) {
			return this.block( reset ).find( '.loader-label' );
		} ),

		percent: generateAccessor( '_percent', function percent( reset ) {
			return this.block( reset ).find( '.percentage' );
		} ),

		bar: generateAccessor( '_bar', function bar( reset ) {
			return this.block( reset ).find( '.progress-bar' );
		} ),

		setProgress( progress ) {
			if ( this.progress < progress ) {
				this.progress = progress;
			}

			progressStep =
				( 0.5 + ( 1 - this.clientProgress / this.progress ) ) *
				( 1 + this.clientProgress / this.progress );
			newProgress = Math.round( this.clientProgress + progressStep );
			if ( newProgress <= this.progress ) {
				this.clientProgress = newProgress;
				this.bar().width( `${ this.clientProgress }%` );
				this.percent().text( `${ this.clientProgress }%` );

				if ( this.clientProgress !== 0 ) {
					$( '#heart-1' ).css(
						'stroke-dashoffset',
						269.663 - this.clientProgress * ( 269.663 / 100 )
					);
				}

				const label = this.label();

				if ( this.dots.length > 2 ) {
					this.dots = '.';
				} else {
					this.dots += '.';
				}

				if ( this.clientProgress <= 33 ) {
					label.text( `${ textInstalling }${ this.dots }` );
				} else if ( this.clientProgress <= 66 ) {
					label.text( `${ textLaunching }${ this.dots }` );
				} else if ( this.clientProgress === 100 ) {
					label.text( `${ textRedirecting }${ this.dots }` );
				} else {
					label.text( `${ textFinalizing }${ this.dots }` );
				}
			}
		},
	};

	const progressLoader = new ProgressLoader();
	const sF = new SignupForm();

	( function ff( f ) {
		const identifier = '__generatedField__';
		const field = f;
		field.nameField = identifier;
		field.mailField = identifier;
		field.domainField = identifier;
		field.promoField = identifier;

		Object.keys( field ).forEach( ( property ) => {
			if (
				Object.hasOwnProperty.call( field, property ) &&
				field[ property ] === identifier
			) {
				field[ property ] = field.getField( property );
			}
		} );
	}( sF ) );

	function parseError( response, def ) {
		if ( response.status === 500 ) {
			return def;
		}

		try {
			const errorData = JSON.parse( response.responseText );
			return errorData.message;
		} catch ( ignore ) {
			if ( debug ) {
				console.log( '...' );
			}
		}

		return def;
	}

	function setEvents( formField ) {
		formField
			.validateOn( 'focusout' )
			.validateOn( 'keyup', 500 )
			.validateOn( 'change', 500 );
	}

	function initNameField() {
		const { nameField } = sF;
		nameField.registerValidator( FieldValidator.textLength() );
		setEvents( nameField );
	}

	function initMailField() {
		const mailRegex = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
		const regexMailValidator = FieldValidator.regex(
			mailRegex,
			textInvalidMail
		);
		const { mailField } = sF;
		mailField.registerValidator( regexMailValidator );
		setEvents( mailField );
	}

	function initDomainField() {
		const crmOptionsCreator = function optCr( formField ) {
			const options = new Api.domainCheck();

			options.params = {
				productId,
				subdomain: formField.input().val(),
			};

			options.success = function success() {
				this.valid( textValidDomain );
			};

			options.error = function error( jqxhr ) {
				this.error( parseError( jqxhr, textFailedDomain ) );
			};

			return options;
		};

		const domainRegex = /^((?!http|www))[^A-Z][a-z0-9]*$/;
		const regexDomainValidator = FieldValidator.regex(
			domainRegex,
			textDomainNoHttp
		);

		const crmDomainValidator = FieldValidator.request( crmOptionsCreator );

		const { domainField } = sF;
		domainField.registerValidator( regexDomainValidator );
		domainField.registerValidator( crmDomainValidator );
		setEvents( domainField );

		domainField.input().alphanum( {
			allow: '-0123456789', // Allow extra characters
			disallow: '', // Disallow extra characters
			allowSpace: false, // Allow the space character
			allowNumeric: true, // Allow digits 0-9
			allowUpper: true, // Allow upper case characters
			allowLower: true, // Allow lower case characters
			allowCaseless: false, // Allow characters that don't have both upper & lower variants - eg Arabic or Chinese
			allowLatin: true, // a-z A-Z
			allowOtherCharSets: false, // eg ? ? Arabic, Chinese etc
			// forceLower: true, // problem in iOS, not working
		} );
	}

	function initFormFields() {
		initNameField();
		initMailField();
		initDomainField();
	}

	function getCookie( name ) {
		const value = `; ${ document.cookie }`;
		const parts = value.split( `; ${ name }=` );

		if ( parts.length === 2 ) {
			return parts.pop().split( ';' ).shift();
		}
	}

	function doLoading( subscription ) {
		const options = new Api.installProgress( subscription.id );

		options.success = function success( data ) {
			if ( debug ) {
				console.log( JSON.stringify( data ) );
			}

			if (
				data.account_status === undefined ||
				data.progress === undefined
			) {
				progressLoader.setProgress( 0 );
				progressLoader.label().text( textFailedRetrieve );

				setTimeout( () => {
					doLoading( subscription );
				}, 500 );

				return;
			}
			if ( data.account_status === 'I' ) {
				progressLoader.setProgress( data.progress );

				setTimeout( () => {
					doLoading( subscription );
				}, 500 );
			} else {
				pkvid = '';

				if ( typeof _paq !== 'undefined' ) {
					_paq.push( [
						'trackEvent',
						'Trial',
						'created',
						`${ sF.domainField.value() }.${ productDomain }`,
					] );
					if ( typeof Piwik === 'undefined' ) {
						pkvid = '';
					} else {
						pkvid = `?pk_vid=${ Piwik.getTracker().getVisitorId() }`;
					}
				}

				progressLoader.setProgress( 100 );

				if ( data.login_token ) {
					const redirectForm = `<form method='POST' action='${ data.login_url }' id="trialform"><input type='hidden' name='action' value='login'><input type='hidden' name='${ authTokenName }' value='${ data.login_token }'><input type='hidden' name='l' value='${ languageCode }'><input type='submit' name='goto' value='${ textGoApp }' class='FinalButton' style='display: none;'><a href='${ data.login_url }' id='gotoapp' class='FinalButton'>Go to your App</a></form>`;

					$( redirectForm ).appendTo( '#redirectButtonPanel' );
					$( '#redirectButtonPanel' ).css( 'display', 'block' );

					if ( $( '#BuildingHeader' ).length > 0 ) {
						$( '#BuildingHeader' ).text( textReadyApp );
						$( '#loader' ).addClass( 'ApplicationReady' );
					}

					$( '#gotoapp' ).click( ( e ) => {
						e.preventDefault();

						setTimeout( () => {
							const href = $( '#gotoapp' ).attr( 'href' );
							let param = href.replace(
								`${ data.login_url }`,
								''
							);
							param = param.replace( '?', '' );

							if ( pkvid === '' ) {
								const url = `${ data.login_url }?${ param }`;
								$( '#trialform' ).attr( 'action', url );
							} else if ( param === '' ) {
								const url = `${ data.login_url }${ pkvid }`;
								$( '#trialform' ).attr( 'action', url );
							} else if ( pkvid === '' && param === '' ) {
								const url = `${ data.login_url }`;
								$( '#trialform' ).attr( 'action', url );
							} else {
								const url = `${ data.login_url }${ pkvid }&${ param }`;
								$( '#trialform' ).attr( 'action', url );
							}

							$( '#trialform' ).submit();
						}, 100 );
					} );
				} else if ( $( '#BuildingHeader' ).length > 0 ) {
					$( '#BuildingHeader' ).text( textDoneAppTitle );
					$( '#BuildingText' ).text( textDoneAppText );
					$( '#loader' ).addClass( 'ApplicationReady' );
					$( '#loader' ).addClass( 'ApplicationReady--spam' );
				}
			}
		};

		options.error = function error( jqxhr ) {
			progressLoader.label().text( parseError( jqxhr, textError ) );
		};

		sendApiRequest( options );
	}

	function completeSignup( subscription ) {
		setVisible( sF.block(), false );
		setVisible( progressLoader.block(), true );

		function sendPapAction( subscriptionId, mail, domain ) {
			if ( typeof PostAffTracker !== 'undefined' ) {
				PostAffTracker.setAccountId( papAccount );
				const sale = PostAffTracker.createAction( papAction );
				sale.setTotalCost( '1' );
				sale.setOrderID( subscriptionId );
				sale.setProductID( '' );
				sale.setData1( mail );
				sale.setData3( 'api_qu_signup' );
				sale.setData4( domain );
				sale.setCampaignID( papCampaign );
				PostAffTracker.register();
			}
		}
		sendPapAction(
			subscription.id,
			subscription.customer_email,
			subscription.domain
		);

		if ( typeof gtag !== 'undefined' ) {
			gtag( 'event', $( '#plan' ).val(), {
				event_category: 'SignUp',
			} );
		}

		$( googleScript ).appendTo( '#signup' );
		$( capterraScript ).appendTo( '#signup' );
		if ( typeof fbq !== 'undefined' ) {
			$( "<script>fbq('track', 'StartTrial')</script>" ).appendTo(
				'#signup'
			);
		}
		$( g2crowdTracking ).appendTo( '#signup' );

		if ( typeof _paq !== 'undefined' ) {
			_paq.push( [ 'setObjectId', subscription.account_id ] );
			_paq.push( [
				'setCustomData',
				'cd1',
				btoa( encodeURIComponent( sF.nameField.value() ) ),
			] );
			_paq.push( [
				'setCustomData',
				'cd2',
				btoa( encodeURIComponent( sF.mailField.value() ) ),
			] );
			_paq.push( [
				'trackEvent',
				'Trial',
				'install',
				`${ sF.domainField.value() }.${ productDomain }`,
			] );
		}

		window.uetq = window.uetq || [];
		window.uetq.push( 'event', 'SignUp', {
			event_category: 'Click',
			event_label: 'SignUp',
			event_value: '1',
		} );

		doLoading( subscription );
	}

	function sendSignupRequest( signupData ) {
		const { errorField } = sF;
		const { submitButton } = sF;

		const options = new Api.signup();
		options.data = signupData;

		options.success = function success( subscription ) {
			completeSignup( subscription );
		};

		options.error = function success( jqxhr ) {
			errorField.display( parseError( jqxhr, textError ) );
			submitButton.setEnabled( true );
			submitButton.text().html( textStart );
		};

		sendApiRequest( options );
	}

	function getSourceId() {
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
	}

	function submitSignup( revalidate ) {
		const formStates = FormField.states;
		const { errorField } = sF;
		const button = sF.submitButton;

		let error = false;
		let wait = false;

		Object.keys( sF.formFields ).forEach( ( fieldName ) => {
			const field = sF.formFields[ fieldName ];

			if ( ! field.isActive() ) {
				if ( debug ) {
					console.info( `${ fieldName } inactive` );
				}
			}

			if ( debug ) {
				console.info( `Checking field: ${ fieldName }...` );
			}

			if ( field.getState() === FormField.states.error ) {
				if ( ! revalidate ) {
					if ( debug ) {
						console.warn( 'Error' );
					}
					error = true;
				}

				if ( debug ) {
					console.warn( 'Error: Validating...' );
				}
				field.validate();

				switch ( field.getState() ) {
					case formStates.waiting:
						wait = true;
						if ( debug ) {
							console.log( 'new status: Waiting...' );
						}
						break;
					case formStates.error:
						error = true;
						if ( debug ) {
							console.warn( 'new status: Error' );
						}
						break;
					default:
						if ( debug ) {
							console.log( 'new status: Valid' );
						}
				}
			}

			if ( field.getState() === formStates.waiting ) {
				if ( debug ) {
					console.log( 'Waiting...' );
				}
				wait = true;
			}
		} );

		if ( error ) {
			if ( debug ) {
				console.warn( 'ERROR: form not submitted' );
			}
			if ( debug ) {
				console.log( '---------------------------------' );
			}
			errorField.display( textInvalid );
			button.text().html( textStart );
			button.setEnabled( true );
			return;
		}

		if ( wait ) {
			if ( debug ) {
				console.log( 'WAIT: form submit rescheduled' );
			}
			if ( debug ) {
				console.log( '---------------------------------' );
			}
			errorField.display( '' );
			button.text().html( textValidating );
			setTimeout( () => {
				submitSignup( false );
			}, 500 );
			return;
		}

		if ( debug ) {
			console.info( 'SUCCESS: form submitted' );
		}
		if ( debug ) {
			console.log( '---------------------------------' );
		}

		errorField.display( '' );
		button.text().html( textCreating );
		const papVisitorId =
			$.cookie( 'PAPVisitorId' ) !== 'undefined'
				? $.cookie( 'PAPVisitorId' )
				: '';

		grecaptcha.ready( () => {
			grecaptcha
				.execute( recaptchaId, {
					action: 'login',
				} )
				.then( ( token ) => {
					sendSignupRequest( {
						variation_id: variationId,
						subdomain: sF.domainField.value(),
						pap_visitor_id: papVisitorId,
						source_id: getSourceId(),
						customer: {
							name: sF.nameField.value(),
							email: sF.mailField.value(),
						},
						promo: sF.promoField.isChecked(),
						grtoken: token,
						language: languageCode,
					} );
				} );
		} );
	}

	function initFormButton() {
		const button = sF.submitButton;

		button.main().click( () => {
			if ( ! button.isEnabled() ) {
				return;
			}

			button.setEnabled( false );
			submitSignup( true );
		} );
	}

	initFormFields();
	initFormButton();
}() );
