/* global _paq */

/* Main Navigation */
if ( document.querySelector( '.Header__navigation' ) !== null ) {
	document.querySelectorAll( '.Header__navigation a' ).forEach( ( e ) => {
		const href = e.getAttribute( 'href' );

		e.addEventListener( 'click', () => {
			_paq.push( [
				'trackEvent',
				'Activity',
				'main-nav',
				`go to ${ href }`,
			] );
		} );
	} );
}

/* Footer Top Navigation */
if ( document.querySelector( '.Footer__top' ) !== null ) {
	document.querySelectorAll( '.Footer__top a' ).forEach( ( e ) => {
		const href = e.getAttribute( 'href' );

		e.addEventListener( 'click', () => {
			_paq.push( [
				'trackEvent',
				'Activity',
				'footer-top-nav',
				`go to ${ href }`,
			] );
		} );
	} );
}

/* Footer Bottom Navigation */
if ( document.querySelector( '.Footer__bottom' ) !== null ) {
	document.querySelectorAll( '.Footer__bottom a' ).forEach( ( e ) => {
		const href = e.getAttribute( 'href' );

		e.addEventListener( 'click', () => {
			_paq.push( [
				'trackEvent',
				'Activity',
				'footer-bottom-nav',
				`go to ${ href }`,
			] );
		} );
	} );
}

/* Footer Mobile Numbers */
if ( document.querySelector( '.Footer__middle__number' ) !== null ) {
	document.querySelectorAll( '.Footer__middle__number a' ).forEach( ( e ) => {
		const href = e.getAttribute( 'href' );

		e.addEventListener( 'click', () => {
			_paq.push( [
				'trackEvent',
				'Activity',
				'footer-mobile-number',
				`clicked to ${ href }`,
			] );
		} );
	} );
}

/* Integrations Search */
if (
	document.querySelector(
		'.Category__sidebar__item--search .search--integrations'
	) !== null
) {
	const search = document.querySelector(
		'.Category__sidebar__item--search input'
	);

	search.addEventListener( 'input', () => {
		_paq.push( [
			'trackEvent',
			'Activity',
			'Integrations',
			`Filter - Search - ${ search.value }`,
		] );
	} );
}

/* Features Search */
if (
	document.querySelector(
		'.Category__sidebar__item--search .search--features'
	) !== null
) {
	const search = document.querySelector(
		'.Category__sidebar__item--search input'
	);

	search.addEventListener( 'input', () => {
		_paq.push( [
			'trackEvent',
			'Activity',
			'Features',
			`Filter - Search - ${ search.value }`,
		] );
	} );
}

/* VoIP Partners Search */
if (
	document.querySelector(
		'.Category__sidebar__item--search .search--voip'
	) !== null
) {
	const search = document.querySelector(
		'.Category__sidebar__item--search input'
	);

	search.addEventListener( 'input', () => {
		_paq.push( [
			'trackEvent',
			'Activity',
			'VoIP Partners',
			`Filter - Search - ${ search.value }`,
		] );
	} );
}

/* Academy Search */
if (
	document.querySelector(
		'.Category__sidebar__item--search .search--academy'
	) !== null
) {
	const search = document.querySelector(
		'.Category__sidebar__item--search input'
	);

	search.addEventListener( 'input', () => {
		_paq.push( [
			'trackEvent',
			'Activity',
			'Academy',
			`Filter - Search - ${ search.value }`,
		] );
	} );
}

/* Templates Search */
if (
	document.querySelector(
		'.Category__sidebar__item--search .search--templates'
	) !== null
) {
	const search = document.querySelector(
		'.Category__sidebar__item--search input'
	);

	search.addEventListener( 'input', () => {
		_paq.push( [
			'trackEvent',
			'Activity',
			'Templates',
			`Filter - Search - ${ search.value }`,
		] );
	} );
}

/* Login Form */
if ( document.querySelector( '.Login' ) !== null ) {
	const search = document.querySelector( '.Login input' );

	search.addEventListener( 'input', () => {
		_paq.push( [
			'trackEvent',
			'Activity',
			'Login',
			`Search - ${ search.value }`,
		] );
	} );
}
