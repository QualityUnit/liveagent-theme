/* global grecaptcha, getCookie */
/* global quCrmData */

( () => {
	initCaptchaApi();

	async function initCaptchaApi() {
		const handleError = () => {
			//crm respond with error or failed, show error message on submit attempt
			document.querySelectorAll( 'form[data-form-type=signup-trial-form' ).forEach( ( form ) => {
				form.addEventListener( 'submit', () => {
					const errorWrapper = form.querySelector( '[data-id=signUpError]' );
					if ( errorWrapper ) {
						errorWrapper.textContent = quCrmData.localization.textErrorCaptcha;
						errorWrapper.classList.remove( 'hidden' );
					}
				} );
			} );
		};

		try {
			const response = await fetch( quCrmData.apiBase + 'recaptcha', {
				method: 'GET',
				headers: {
					'Content-Type': 'application/json',
					accept: 'application/json',
					'X-WP-Nonce': quCrmData.nonce,
				},
			} );

			if ( response.ok ) {
				const captcha = await response.json();

				// load appropriate captcha api
				if ( captcha.version === 'v3' ) {
					const script = document.createElement( 'script' );
					script.src = `https://www.google.com/recaptcha/api.js?onload=quCaptchaOnloadCallback&render=${ captcha.site_key }`;
					document.body.appendChild( script );
				}

				if ( captcha.version === 'v2' ) {
					const script = document.createElement( 'script' );
					script.src = 'https://www.google.com/recaptcha/api.js?onload=quCaptchaOnloadCallback&render=explicit';
					script.async = true;
					script.defer = true;
					document.body.appendChild( script );
				}

				// pass captcha information to forms
				document.querySelectorAll( 'form[data-form-type=signup-trial-form' ).forEach( ( form ) => {
					form.dataset.captcha = JSON.stringify( captcha );

					// handle submission without captcha
					if ( captcha.version === 'no recaptcha' ) {
						// enable form submission which is disabled by default within inline js in php
						form.addEventListener( 'submit', () => form.submit() );

						// add empty input hidden by class, server will check if it's set and if is empty to pass submission
						// robot probably fill fake input, human not
						form.insertAdjacentHTML( 'afterbegin', `<input class="hidden" name="fcaptcha" value="" autocomplete="off">` );
					}
				} );
				return;
			}
			handleError();
		} catch ( error ) {
			// eslint-disable-next-line no-console
			console.error( error );
			handleError();
		}
	}
} )();

// global captcha onload callback
// eslint-disable-next-line no-unused-vars
function quCaptchaOnloadCallback() {
	document.querySelectorAll( 'form[data-form-type=signup-trial-form' ).forEach( ( form ) => {
		const captcha = JSON.parse( form.dataset.captcha );
		const ver = captcha.version;
		const siteKey = captcha.site_key;

		const grecaptchaInput = form.querySelector( 'input[data-id="grecaptcha"]' );
		const gaClientInput = form.querySelector( 'input[data-id="ga_client_id"]' );
		const submitButton = form.querySelector( '[data-id=submitFieldmain] button[data-id=createButtonmain]' );

		const gaUserId = getCookie( '_ga' ) || '';

		const handleBeforeSubmiActions = () => {
			if ( gaClientInput ) {
				gaClientInput.value = gaUserId;
			}
		};

		if ( ver === 'v3' ) {
			form.addEventListener( 'submit', ( e ) => {
				e.preventDefault();
				try {
					submitButton.setAttribute( 'disabled', '' );
					grecaptcha.ready( () => {
						grecaptcha.execute(
							siteKey,
							{ action: 'login' }
						).then( ( token ) => {
							if ( grecaptchaInput ) {
								grecaptchaInput.value = token;
							}
							handleBeforeSubmiActions();
							form.submit();
						} );
					} );
				} catch ( error ) {
					submitButton.removeAttribute( 'disabled' );
				}
			} );
		}

		if ( ver === 'v2' ) {
			const captchaWrapper = form.querySelector( '[data-id=captchaFieldmain]' );
			captchaWrapper.classList.remove( 'hidden' );
			grecaptcha.render( captchaWrapper.querySelector( '.grecaptcha-wrapper' ), {
				sitekey: siteKey,
				size: form.closest( '.Signup__sidebar' ) ? 'compact' : 'normal',
				callback: ( token ) => {
					captchaWrapper.classList.remove( 'Error' );
					captchaWrapper.querySelector( '.ErrorMessage' ).textContent = '';
					if ( grecaptchaInput ) {
						grecaptchaInput.value = token;
					}
				},
				'expired-callback': () => {
					if ( grecaptchaInput ) {
						grecaptchaInput.value = '';
					}
				},
				'error-callback': () => {
					if ( grecaptchaInput ) {
						grecaptchaInput.value = '';
					}
				},
			} );

			form.addEventListener( 'submit', ( e ) => {
				e.preventDefault();
				try {
				// handle simple check if token is present in case the crm script is not available
					if ( grecaptchaInput.value === '' ) {
						captchaWrapper.classList.add( 'Error' );
						captchaWrapper.querySelector( '.ErrorMessage' ).textContent = quCrmData.localization.invalid.captcha;
						return;
					}
					submitButton.setAttribute( 'disabled', '' );
					handleBeforeSubmiActions();
					form.submit();
				} catch ( error ) {
					submitButton.removeAttribute( 'disabled' );
				}
			} );
		}
	} );
}
