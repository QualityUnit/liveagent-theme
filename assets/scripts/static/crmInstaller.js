/* global _paq, Piwik, gtag, PostAffTracker, FHTrck, analytics, twq */
/* global quCrmData, getCookie, setCookie */

class CrmInstaller {
	constructor( installationElement ) {
		this.installationStarted = false;
		this.signupData = null;
		this.localized = quCrmData.localization;
		this.apiBase = quCrmData.apiBase;
		this.nonce = quCrmData.nonce;

		this.productDomain = 'ladesk.com';

		this.loginLinkExpiration = 10; // in seconds
		this.loginFormSubmissionActive = true;
		this.progress = 0;
		this.progressDots = '';

		this.fields = {
			main: installationElement,
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
		this.readSignUpCookie();
		if ( ! this.signupData ) {
			window.location.href = quCrmData.trialUrl;
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
		this.fields.asyncInstallationButton = this.fields.main.querySelector( '.async-installation' );
		this.fields.progressWrapText = this.fields.main.querySelector( '[data-id="progressWrapText"]' );

		if ( this.signupData.async === true ) {
			this.handleAsyncInstallation();
			return;
		}

		this.showHiddenParts();
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
				}, 1500 );

				return;
			}

			if ( ! this.installationStarted ) {
				this.handleStartupActions();
				this.installationStarted = true;
			}

			if ( data.account_status === 'I' ) {
				this.setProgress( data.progress );

				setTimeout( () => {
					this.handleInstallation();
				}, 1500 );

				return;
			}

			if ( data.account_status === 'A' ) {
				this.setProgress( 100 );
				this.handleFinishActions();
				this.handleFinishOverlay();
				this.removeSignUpCookie();

				if ( data.login_url ) {
					this.createGoToAppForm( data );
				} else {
					this.setProgressText( this.localized.textProgressLoginViaEmail );
				}

				return;
			}
		}

		if ( ! response.success ) {
			this.setProgressText( response.message );
		}
	};

	handleAsyncInstallation = () => {
		this.showAsyncInstallationButton();
		this.setAsyncHeading();
		this.handleFinishActions();
		this.removeSignUpCookie();
	};

	setAsyncHeading = () => {
		if ( this.fields.progressHeader ) {
			const titleElement = this.fields.progressHeader.querySelector( '.BuildingApp__progress__header__title' );
			if ( titleElement ) {
				// Set heading
				if ( this.localized.textAsyncHeading ) {
					titleElement.textContent = this.localized.textAsyncHeading;
				}
				// Add subtitle with async text
				if ( this.localized.textProgressAsyncInstallation ) {
					const subtitle = document.createElement( 'p' );
					subtitle.className = 'async-subtitle';
					subtitle.textContent = this.localized.textProgressAsyncInstallation;
					titleElement.insertAdjacentElement( 'afterend', subtitle );
				}
			}
			// Change layout to flex column for async
			this.fields.progressHeader.classList.add( 'async-mode' );
		}
		// Hide the default wrap text for async
		if ( this.fields.progressWrapText ) {
			this.fields.progressWrapText.style.display = 'none';
		}
	};

	checkInstallationProgress = async () => {
		try {
			const response = await fetch( this.apiBase + `accounts/${ this.signupData.account_id }/install_progress`, {
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
		const goToText = this.signupData.is_redeem ? this.localized.textGoToApp : this.localized.textGoToLiveAgent;
		const redirectFormString =
		`<form method='POST' action='${ data.login_url }' data-id="gotoapp-form">
			<input type='hidden' name='l' value='${ this.signupData.language }'>
			<button type="submit" class='FinalButton'><span class="FinalButton__counter"><span class="FinalButton__counter__number"></span></span><span class="FinalButton__text">${ goToText }</span></button>
		</form>`;

		this.fields.main.querySelectorAll( '[data-id="redirectButtonPanel"]' ).forEach( ( elm ) => {
			elm.insertAdjacentHTML( 'beforeend', redirectFormString );
			elm.style.display = 'block';

			const redirectForm = elm.querySelector( 'form[data-id="gotoapp-form"]' );
			const goToButton = elm.querySelector( '.FinalButton' );

			redirectForm.addEventListener( 'submit', ( e ) => {
				e.preventDefault();

				if ( ! this.loginFormSubmissionActive ) {
					return;
				}

				setTimeout( () => {
					const form = e.target;
					const href = form.getAttribute( 'action' );

					const url = new URL( href );
					const params = new URLSearchParams( url.search );
					const baseUrl = url.origin + url.pathname;

					if ( this.pkvid ) {
						params.set( 'pk_vid', this.pkvid );
					}

					const redirectUrl = params.size ? `${ baseUrl }?${ params.toString() }` : baseUrl;
					form.setAttribute( 'action', redirectUrl );
					form.submit();
				}, 100 );
			} );

			this.runLoginExpirationCounter( goToButton );
		} );
	};

	showAsyncInstallationButton = () => {
		if ( this.fields.asyncInstallationButton ) {
			this.fields.asyncInstallationButton.style.display = 'block';
		}
		if ( this.fields.progressPercentage ) {
			this.fields.progressPercentage.style.display = 'none';
		}
	};

	runLoginExpirationCounter = ( goToButton ) => {
		const counterElm = goToButton.querySelector( '.FinalButton__counter__number' );
		const textElm = goToButton.querySelector( '.FinalButton__text' );

		if ( counterElm ) {
			let counter = this.loginLinkExpiration;
			counterElm.innerText = counter;
			const interval = setInterval( () => {
				counter--;
				counterElm.innerText = counter;

				if ( counter === 0 ) {
					clearInterval( interval );
					goToButton.classList.add( 'disabled' );
					goToButton.setAttribute( 'aria-disabled', true );
					goToButton.setAttribute( 'tabindex', -1 );

					textElm.innerText = this.localized.textLogInEmail;
					this.setProgressText( this.localized.textProgressLoginViaEmail );
					this.loginFormSubmissionActive = false;
				}
			}, 1000 );
		}
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
		this.handlePapAction();
		this.handleTrackersAction();
		this.handlePaqAction();
		this.handleFlowHuntAction();

		if ( ! this.signupData.is_redeem && typeof gtag !== 'undefined' ) {
			try {
				gtag( 'set', 'user_data', { email: this.signupData.customer_email } );
				gtag( 'event', 'Trial_sign_up', { send_to: 'AW-966671101/bfzFCPmy1eMZEP31-MwD' } );
			} catch ( e ) {
				// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', 'gtag' );
			}
		}

		if ( this.signupData.is_redeem && this.signupData.plan_type && typeof gtag !== 'undefined' ) {
			try {
				gtag( 'event', this.signupData.plan_type, {
					event_category: 'SignUp',
				} );
			} catch ( e ) {
				// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', 'gtag' );
			}
		}

		try {
			window.uetq = window.uetq || [];
			window.uetq.push( 'event', 'SignUp', {
				event_category: 'Click',
				event_label: 'SignUp',
				event_value: '1',
			} );
		} catch ( e ) {
			// eslint-disable-next-line no-console
			console.warn( 'Tracking script failed:', 'uetq' );
		}
	};

	handleFinishActions = () => {
		if ( typeof _paq !== 'undefined' ) {
			try {
				_paq.push( [
					'trackEvent',
					'Trial',
					'created',
					`${ this.signupData.subdomain }.${ this.productDomain }`,
				] );
			} catch ( e ) {
				// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', '_paq', 'trackEvent' );
			}

			if ( typeof Piwik === 'undefined' ) {
				this.pkvid = '';
			} else {
				try {
					this.pkvid = Piwik.getTracker().getVisitorId();
				} catch ( e ) {
					// eslint-disable-next-line no-console
					console.warn( 'Tracking script failed:', 'Piwik' );
				}
			}
		}

		if ( typeof analytics !== 'undefined' ) {
			try {
				analytics.identify( null, { email: this.signupData.customer_email } );
				analytics.track( 'formSubmitted' );
			} catch ( e ) {
			// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', 'analytics' );
			}
		}

		if ( typeof twq !== 'undefined' ) {
			try {
				twq( 'event', 'tw-ocrty-odnh2', {} );
			} catch ( e ) {
				// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', 'twq' );
			}
		}
	};

	showHiddenParts = () => {
		// by default, some parts like percentage and progress indicator are invisible in case the installation is processed for user with corrupted javascript
		this.fields.progressHeader.querySelectorAll( '.progress-invisible' ).forEach( ( elm ) => elm.classList.remove( 'progress-invisible' ) );
	};

	readSignUpCookie = () => {
		try {
			const cookieData = getCookie( 'trial_signup_response' );
			if ( cookieData ) {
				this.signupData = JSON.parse( decodeURIComponent( cookieData ) );
			}
		} catch ( error ) {
			// eslint-disable-next-line no-console
			console.error( error );
		}
	};

	removeSignUpCookie = () => {
		// remove cookie after installation, installation process is available even the user refresh page or come back
		setCookie( 'trial_signup_response', '', -1 );
	};

	handlePapAction = () => {
		if ( typeof PostAffTracker !== 'undefined' ) {
			try {
				PostAffTracker.setAccountId( this.pap.account );
				const sale = PostAffTracker.createAction( this.pap.action );
				sale.setTotalCost( '1' );
				sale.setOrderID( this.signupData.id );
				sale.setProductID( '' );
				sale.setData1( this.signupData.customer_email );
				sale.setData3( 'api_qu_signup' );
				sale.setData4( this.signupData.subdomain );
				sale.setCampaignID( this.pap.campaign );
				PostAffTracker.register();
			} catch ( e ) {
				// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', 'PostAffTracker' );
			}
		}
	};

	handleFlowHuntAction = async () => {
		if ( typeof FHTrck !== 'undefined' ) {
			try {
				await FHTrck.trackEvent( {
					event_name: 'fh_trial_signup',
					event_value: 0.1,
					link_ids: [ this.signupData.customer_email, this.signupData.subdomain, this.signupData.id ], // Optional, session ID will be automatically added
					conversion_action_id: '6722290247', // Optional, ID of the conversion action to track
				} );
			} catch ( e ) {
			}
		}
	};

	handlePaqAction = () => {
		if ( typeof _paq !== 'undefined' ) {
			try {
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
					`${ this.signupData.subdomain }.${ this.productDomain }`,
				] );
			} catch ( e ) {
				// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', '_paq' );
			}
		}
	};

	// Google trackers as HTML (robust fallback)
	insertHtmlTrackers = () => {
		let success = true;
		try {
			document.body.insertAdjacentHTML( 'beforeend', "<img height='1' width='1' src='//www.googleadservices.com/pagead/conversion/966671101/imp.gif?label=ER6zCKjv_1cQ_fX4zAM&amp;guid=ON&amp;script=0' />" );
		} catch ( e ) {
			// eslint-disable-next-line no-console
			console.warn( '[TRACKING] HTML trackers insert failed', e );
			success = false;
		}
		return success;
	};
	// Reddit tracker (JS)
	handleRedditTracker = () => {
		try {
			const redditScript = document.createElement( 'script' );
			redditScript.type = 'text/javascript';
			redditScript.async = true;
			redditScript.src = 'https://www.redditstatic.com/ads/pixel.js';
			const s = document.getElementsByTagName( 'script' )[ 0 ];
			s.parentNode.insertBefore( redditScript, s );
			redditScript.onload = () => {
				if ( typeof window.rdt === 'function' ) {
					window.rdt( 'init', 't2_an9rcu5x', { optOut: false, useDecimalCurrencyValues: true } );
					window.rdt( 'track', 'PageVisit' );
				}
			};
			return true;
		} catch ( e ) {
		// eslint-disable-next-line no-console
			console.warn( 'Tracking script failed:', 'Reddit', e );
			return false;
		}
	};

	// LinkedIn tracker (JS)
	handleLinkedInTracker = () => {
		try {
			window._linkedin_partner_id = '8316681';
			window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
			window._linkedin_data_partner_ids.push( window._linkedin_partner_id );
			if ( ! window.lintrk ) {
				window.lintrk = function( a, b ) {
					window.lintrk.q = window.lintrk.q || [];
					window.lintrk.q.push( [ a, b ] );
				};
			}
			const s = document.getElementsByTagName( 'script' )[ 0 ];
			const b = document.createElement( 'script' );
			b.type = 'text/javascript';
			b.async = true;
			b.src = 'https://snap.licdn.com/li.lms-analytics/insight.min.js';
			s.parentNode.insertBefore( b, s );
			return true;
		} catch ( e ) {
			// eslint-disable-next-line no-console
			console.warn( 'Tracking script failed:', 'LinkedIn', e );
			return false;
		}
	};

	// Facebook tracker (JS or HTML fallback)
	handleFacebookTracker = () => {
		if ( typeof window.fbq !== 'undefined' ) {
			try {
				window.fbq( 'track', 'StartTrial' );
				return true;
			} catch ( e ) {
				// fallback to HTML
				document.body.insertAdjacentHTML( 'beforeend', "<script>try{ fbq('track', 'StartTrial' ); } catch ( e ) { console.warn( 'Tracking script failed:', 'fbq' ); }</script>" );
				// eslint-disable-next-line no-console
				console.warn( 'Tracking script failed:', 'Facebook', e );
				return false;
			}
		} else {
			document.body.insertAdjacentHTML( 'beforeend', "<script>try{ fbq('track', 'StartTrial' ); } catch ( e ) { console.warn( 'Tracking script failed:', 'fbq' ); }</script>" );
			// eslint-disable-next-line no-console
			console.warn( 'Tracking script failed:', 'Facebook', 'fbq not defined' );
			return false;
		}
	};

	// Load Capterra script first
	loadCapterraScript = () => {
		return new Promise( ( resolve ) => {
			if ( window.ct ) {
				resolve( true );
				return;
			}

			try {
				( function( l, o, w, n, g ) {
					window._gz = function( e, t ) {
						window._ct = { vid: e, vkey: t, uc: true, hasDoNotTrackIPs: false };
						window.ct;
					};
					n = l.createElement( o );
					g = l.getElementsByTagName( o )[ 0 ];
					n.async = 1;
					n.src = w;
					n.onload = () => resolve( true );
					n.onerror = () => resolve( false );
					g.parentNode.insertBefore( n, g );
				}(
					document, 'script',
					'https://tr.capterra.com/static/wp.js'
				) );
				window._gz( 'fe449882-d667-41be-9d89-9653a963c094',
					'ca1d7fde1191b65d701f8444dee12e71' );
			} catch ( e ) {
				// eslint-disable-next-line no-console
				console.warn( 'Capterra script loading failed:', e );
				resolve( false );
			}
		} );
	};

	// Capterra conversion tracker (JS)
	handleCapterraTracker = async () => {
		try {
			const loaded = await this.loadCapterraScript();
			if ( loaded && window.ct && window.ct.sendEvent ) {
				window.ct.sendEvent( {
					installationId: '44996ef8-76ee-4173-814c-87d98a8ac925',
				} );
				return true;
			}
			// eslint-disable-next-line no-console
			console.warn( 'Capterra tracker not loaded' );
			return false;
		} catch ( e ) {
			// eslint-disable-next-line no-console
			console.warn( 'Tracking script failed:', 'Capterra', e );
			return false;
		}
	};

	// Main tracking method that executes all individual trackers
	handleTrackersAction = () => {
		this.insertHtmlTrackers();
		this.handleRedditTracker();
		this.handleLinkedInTracker();
		this.handleFacebookTracker();
		this.handleCapterraTracker();
	};
}

( () => {
	// init installation progress on thank-you page
	const installWrapper = document.querySelector( '#loader[data-id=signup-trial-installation]' );
	if ( installWrapper ) {
		new CrmInstaller( installWrapper );
	}
} )();
