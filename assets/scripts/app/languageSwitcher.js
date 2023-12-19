
/* Language switcher */
function hideLanguageSwitcher( target ) {
	if ( target.classList.contains( 'visible' ) ) {
		target.classList.remove( 'visible' );
		setTimeout( () => {
			target.classList.remove( 'active' );
		}, 200 );
	}
}

if ( document.querySelector( '.Header__flags #languageSwitcher-toggle' ) !== null ) {
	const langSwitcherToggle = document.querySelector(
		'.Header__flags #languageSwitcher-toggle'
	);

	/* Gets region of active language and activates mobile switcher for such region */
	// const langActive = langSwitcherToggle.parentElement.getAttribute(
	// 	'lang'
	// );
	// const matchRegion = langSwitcherToggle.parentElement.querySelector(
	// 	`.Header__flags--item[lang=${ langActive }]`
	// ).dataset.region;

	// document.querySelector(
	// 	`#${ matchRegion }.input--region`
	// ).checked = true;

	/* Toggles language switcher */
	const langSwitcherMenu = document.querySelector( '.Header__flags--mainmenu' );
	langSwitcherToggle.addEventListener( 'click', ( event ) => {
		event.stopPropagation();
		if ( ! langSwitcherMenu.classList.contains( 'visible' ) ) {
			langSwitcherMenu.dataset.active = 'active';
			langSwitcherMenu.classList.add( 'active' );
			setTimeout( () => {
				langSwitcherMenu.classList.add( 'visible' );
			}, 200 );
		}
		hideLanguageSwitcher( langSwitcherMenu );
	} );

	document.addEventListener( 'click', ( event ) => {
		if (
			! event.target.classList.contains( 'Header__flags--mainmenu' )
		) {
			event.stopPropagation();
			hideLanguageSwitcher( langSwitcherMenu );
		}
	} );
}
