/* eslint-disable no-unused-vars, prefer-rest-params, consistent-return, new-cap */
/* global $, jQuery, grecaptcha, localStorage */
/* global textValidating, textInvalidField, textEmpty, textFailedDomain, textValidDomain, textRedirecting, loginName, productId, recaptchaId, productDomain */

( function main() {
	const query = document.querySelector.bind( document );

	if ( loginName ) {
		query( '#domainFieldmain input' ).value = loginName;
		query( '#domainFieldmain' ).classList.add( 'Valid' );
	}

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
			main: generateAccessor( '_main', () => $( '#createButtonmain' ) ),
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

	const sF = new SignupForm();

	( function ff( f ) {
		const identifier = '__generatedField__';
		const field = f;
		field.domainField = identifier;

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
			// empty
		}

		return def;
	}

	function setEvents( formField ) {
		formField
			.validateOn( 'focusout' )
			.validateOn( 'keyup', 500 )
			.validateOn( 'change', 500 );
	}

	function initDomainField() {
		const crmOptionsCreator = function optCr( formField ) {
			const options = new Api.domainCheck();

			options.params = {
				productId,
				subdomain: formField.input().val(),
			};

			options.success = function success( jqxhr ) {
				this.error( parseError( jqxhr, textFailedDomain ) );
			};

			options.error = function error() {
				this.valid( textValidDomain );
			};

			return options;
		};

		const crmDomainValidator = FieldValidator.request( crmOptionsCreator );

		const { domainField } = sF;
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
		initDomainField();
	}

	function sendSignupRequest( signupData ) {
		const { errorField } = sF;
	}

	function submitSignup( revalidate ) {
		const formStates = FormField.states;
		const { errorField } = sF;

		let error = false;

		Object.keys( sF.formFields ).forEach( ( fieldName ) => {
			const field = sF.formFields[ fieldName ];

			if ( field.getState() === FormField.states.error ) {
				if ( ! revalidate ) {
					error = true;
				}

				field.validate();

				switch ( field.getState() ) {
					case formStates.error:
						error = true;
						break;
					default:
				}
			}
		} );

		grecaptcha.ready( () => {
			grecaptcha
				.execute( recaptchaId, {
					action: 'login',
				} )
				.then( ( token ) => {
					sendSignupRequest( {
						subdomain: sF.domainField.value(),
						grtoken: token,
					} );

					if ( ! error ) {
						localStorage.setItem(
							'la_login',
							sF.domainField.value()
						);
						$( '#createButtonmain' )
							.find( 'span' )
							.text( textRedirecting );
						window.location.href = `https://${ sF.domainField.value() }.${ productDomain }/agent/`;
					} else {
						$( '.Login__overlay' ).addClass( 'active' );
						$( '.Login__popup' ).addClass( 'active' );
					}
				} );
		} );
	}

	function initFormButton() {
		const button = sF.submitButton;

		button.main().click( () => {
			submitSignup( true );
		} );
	}

	initFormFields();
	initFormButton();
}() );
