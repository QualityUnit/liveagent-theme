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

		this.trackers = {
			googleScript: "<img height='1' width='1' src='//www.googleadservices.com/pagead/conversion/966671101/imp.gif?label=ER6zCKjv_1cQ_fX4zAM&amp;guid=ON&amp;script=0' />",
			capterraScript: '<img src="https://ct.capterra.com/capterra_tracker.gif?vid=2044023&vkey=ccda2d732326c153444c50f6ca6e489b" />',
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
		try {
			const signupResponse = getCookie( 'trial_signup_response' );
			this.signupData = JSON.parse( decodeURIComponent( signupResponse ) );
		} catch ( error ) {
			// eslint-disable-next-line no-console
			console.error( error );
		}

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

				// remove cookie after installation, installation process is available even the user refresh page or come back
				setCookie( 'trial_signup_response', '', -1 );

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
		this.fields.progressHeader.querySelectorAll( '.invisible' ).forEach( ( elm ) => elm.classList.remove( 'invisible' ) );
	};

	handleTrackersAction = () => {
		Object.values( this.trackers ).forEach( ( tracker ) => {
			this.fields.main.insertAdjacentHTML( 'beforeend', tracker );
		} );
		if ( typeof fbq !== 'undefined' ) {
			this.fields.main.insertAdjacentHTML(
				'beforeend',
				`<script>try{ fbq('track', 'StartTrial' ); } catch ( e ) { console.warn( 'Tracking script failed:', 'fbq' ); }</script>`
			);
		}
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
					conversion_action_id: '942942148', // Optional, ID of the conversion action to track
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
}

( () => {
	// init installation progress on thank-you page
	const installWrapper = document.querySelector( '#loader[data-id=signup-trial-installation]' );
	if ( installWrapper ) {
		new CrmInstaller( installWrapper );
	}
} )();
