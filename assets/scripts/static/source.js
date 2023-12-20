/* eslint-disable no-restricted-globals */
/* global getCookie, setCookie */

function processAnchor( name ) {
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
}

function processUtm( url ) {
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
}

function processGAds( url ) {
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
}

function processS() {
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
}

processS();
