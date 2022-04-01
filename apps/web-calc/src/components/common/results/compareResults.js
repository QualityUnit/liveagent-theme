import { i18n, getWebCalcData } from '../constants';
import {
	getProps,
	getSelectedFeatures,
	getPriceAgents,
} from './baseCalculations';
import data from '../../../data/alternatives';

const { select1, select2, select3 } = getWebCalcData;
export const alternatives = { select1, select2, select3 };

export const compareResults = ( alternative, agentsFromSlider ) => {
	// Get all features of alternative
	const altFeatures = data[ alternative ].features;

	// Gets missing features in alternative and names them
	const unsupportedFeatures = getSelectedFeatures().filter(
		( feature ) => ! altFeatures[ feature ]
	);
	const unsupportedFeaturesNamed = unsupportedFeatures.map(
		( feature, i ) => {
			if ( unsupportedFeatures.length !== i + 1 ) {
				return `${ i18n[ feature ] }, `;
			}
			return i18n[ feature ];
		}
	);

	// Gets special features we have if selected are supported in alternative
	const specialFeatures = Object.keys( data.liveagent.features ).filter(
		( feature ) => ! altFeatures[ feature ]
	);
	const specialFeaturesNamed = specialFeatures.map( ( feature, i ) => {
		if ( specialFeatures.length !== i + 1 ) {
			return `${ i18n[ feature ] }, `;
		}
		return i18n[ feature ];
	} );

	// Gets current LA and alternative price based on slider, if alternative has fixed, returns biggest fixed value
	const laPrice = getPriceAgents( 'liveagent', agentsFromSlider ).price;
	const altPrice = getPriceAgents( alternative, agentsFromSlider ).price;

	// Gets current Alternative agents based on slider, if alternative has fixed agents, returns biggest fixed value
	const altAgents = getPriceAgents( alternative, agentsFromSlider ).agents;

	// Gets alternative real name instead of ID
	const altName = getProps( alternative, 'name' );

	// Calculates actual savings against alternative
	const savings = ( ( ( altPrice - laPrice ) / altPrice ) * 100 ).toFixed(
		0
	);

	/* ---------------------
  RETURNED OBJECT RESPONSE 
  ------------------------*/

	// Returns separate case names so we can show appropriate title, finding if savings are positive (we are cheaper)
	if ( Math.sign( savings ) === 1 && unsupportedFeatures.length === 0 ) {
		//  Save up to XX% by switching to LiveAgent.
		return {
			caseId: 'case1',
			name: altName,
			savings,
			agents: altAgents,
		};
	}

	// We are cheaper and have requested features alternative is missing
	if ( Math.sign( savings ) === 1 && unsupportedFeatures.length > 0 ) {
		// Save up to XX % by switching to LiveAgent. On top of that, other solution is missing following features
		return {
			caseId: 'case2',
			name: altName,
			savings,
			missing: unsupportedFeaturesNamed,
			agents: altAgents,
		};
	}

	// If same price, same selected features
	if (
		Math.sign( savings ) === 0 &&
		unsupportedFeatures.length === 0 &&
		specialFeatures.length > 0
	) {
		// Other solution has the same price, but you will get access to premium features only LiveAgent offers:
		return {
			caseId: 'case3',
			name: altName,
			premium: specialFeaturesNamed,
			agents: altAgents,
		};
	}

	// If same price, missing selected features
	if ( Math.sign( savings ) === 0 && unsupportedFeatures.length > 0 ) {
		// Other solution has the same price, but is missing following features:
		return {
			caseId: 'case4',
			name: altName,
			missing: unsupportedFeaturesNamed,
			agents: altAgents,
		};
	}

	// If LA is not cheaper than alternative, show missing selected features
	if ( Math.sign( savings ) === -1 && unsupportedFeatures.length > 0 ) {
		// Even though LiveAgent is more expensive than the other solution, it's because they are missing following features you need:
		return {
			caseId: 'case5',
			name: altName,
			missing: unsupportedFeaturesNamed,
			agents: altAgents,
		};
	}

	// If LA is not cheaper than alternative and alt is not missing any selected features, show special features
	if (
		Math.sign( savings ) === -1 &&
		unsupportedFeatures.length === 0 &&
		specialFeatures.length > 0
	) {
		// Even though LiveAgent is more expensive than the other solution, you will get access to premium features only LiveAgent offers:
		return {
			caseId: 'case6',
			name: altName,
			premium: specialFeaturesNamed,
			agents: altAgents,
		};
	}
};

export const getMostExpensive = ( alternatives, agentsFromSlider ) => {
	const selectedPrices = Object.values( alternatives ).map(
		( alternative ) => {
			if ( typeof alternative === 'string' ) {
				return getPriceAgents( alternative, agentsFromSlider ).price;
			}
			// If undefined, returns 0
			return 0;
		}
	);

	const maxPrice = Math.max.apply( null, selectedPrices );
	let price = null;
	if ( isFinite( maxPrice ) ) {
		price = maxPrice;
	}

	const getAlternatives = Object.values( alternatives ).map(
		( alternative ) => {
			if ( typeof alternative === 'string' ) {
				return getPriceAgents( alternative, agentsFromSlider );
			}
			// If undefined, returns 0
			return 0;
		}
	);

	return getAlternatives.filter( ( alt ) => alt.price === price )[ 0 ].name;
};
