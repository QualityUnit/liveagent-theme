import { i18n, getWebCalcData } from '../constants';
import data from '../../../data/alternatives';


export const getAlternativesWithFeature = () => {
  const options = []
  Object.entries( data ).map( ( [key, properties] ) => {
    const {active, features} = properties;
    if ( (active && key !== 'liveagent') ) {
      const feature = getWebCalcData().filter(f => features[f])[0];
      if(feature) {
        options.push(key);
      }
    }
    return false;
  });
  return options;
};

export const alternatives = getAlternativesWithFeature();

/* -----------
This is where all the magic happens
--------*/

export const getPriceAgents = (alternative, agentsFromSlider, selFeature) => {
  const packagePrice = getPackage(alternative, selFeature).price;
  const packageAgents = getPackage(alternative, selFeature).agents;
  const biggestPackage = getMoreAgentsForFixed(alternative);
  const biggestPackageFiltered = biggestPackage.filter(
    (obj) => 
        (obj.agents === 1 || obj.agents >= agentsFromSlider)  && obj.price >= packagePrice
  );

  if (packageAgents === 1) {
    return {
      name: alternative,
      agents: packageAgents,
      price: packagePrice * agentsFromSlider,
    };
  }

  // Fixed agent pricing - filtering smallest price per actual agents in slider
  if (
    (packageAgents >= 1 || packageAgents === 0)
		&& biggestPackageFiltered.length > 0
  ) {
    const filtered = biggestPackageFiltered;
    const { price } = filtered[0];
    const { agents } = filtered[0];
    return { name: alternative, agents, price };
  }

  // Fixed agent pricing - filtering last possible price if we exceed max package agents
  if (packageAgents >= 1 && biggestPackageFiltered.length === 0) {
    const filtered = biggestPackage;
    const { price } = filtered[filtered.length - 1];
    const { agents } = filtered[filtered.length - 1];
    return { name: alternative, agents, price };
  }
};

// If fixed pricing, we want all packages to adjust pricing when agent slider goes above/below the number of agents in package
export function getMoreAgentsForFixed(alternative) {
  const allPackages = Object.values(
    getProps(alternative, 'packages'),
  ).filter((obj) => obj.agents >= 1);
  return allPackages;
}

// Calculates width of the chart bars, alway from highest priced alternative, so highest is always 100 % width and others based on it
export const getChartWidth = (alternative, agentsFromSlider, maxprice, selFeature) => (
  (getPriceAgents(alternative, agentsFromSlider, selFeature).price / maxprice)
		* 100
);

// By Selected Features it attempts to find the lowest package that has the requested feature
export function getPackage(alternative, selFeature) {
  const prices = JSON.parse(selFeature).map((feature) => {
    const thisFeature = data[alternative].features[feature];
    if (typeof thisFeature === 'string') {
      const featurePrice = data[alternative].packages[data[alternative].features[feature]].price;
      if (typeof featurePrice === 'number') {
        return featurePrice;
      }
    }

    // If undefined, returns 0
    return data[alternative].packages.package1.price;
  });

  // We also get info how many agents are in package with a feature selected
  const packages = JSON.parse(selFeature).map((feature) => {
    const thisFeature = data[alternative].features[feature];
    if (typeof thisFeature === 'string') {
      return data[alternative].packages[thisFeature];
    }
    
    // If undefined
    return data[alternative].packages.package1;
  });

  // Getting maximum package of selected features and max agents
  const maxPrice = Math.max.apply(null, prices);
  
  const agents = [];
  if (isFinite(maxPrice)) {
    agents.push(Object.values(packages).filter(obj => obj.price >= maxPrice)[0].agents);
    const maxAgents = Math.max.apply(null, agents);
    return { agents: maxAgents, price: maxPrice };
  }

  // If no Feature selected, we get infinite from maxPackage, so instead we return package1
  const pkg1 = data[alternative].packages.package1;
  return { agents: pkg1.agents, price: pkg1.price };
}

// Getting selected features with names
export function getSelectedFeaturesNamed(selFeature) {
  const array = [];
  JSON.parse(selFeature).map(feature => {
    return array.push(i18n[ feature ]);
  });
  return array;
}


// We get highest price for floating value (price per agent) so we can calculate width of chart bars
export const getMaxPrice = (alternatives, agentsFromSlider, selFeature) => {
  const selectedPrices = Object.values(alternatives).map(
    (alternative) => {
      if (typeof alternative === 'string') {
        return getPriceAgents(alternative, agentsFromSlider, selFeature).price;
      }
      // If undefined, returns 0
      return 0;
    },
  );

  // Adding liveagent dynamic pricing to the array
  selectedPrices.push(
    getPriceAgents('liveagent', agentsFromSlider, selFeature).price,
  );
  const maxPrice = Math.max.apply(null, selectedPrices);

  if (isFinite(maxPrice)) {
    return maxPrice;
  }
};

// Function to get properties for alternative (ie features)
export const getProps = (alternative, prop, subprop) => {
  if (subprop) {
    return data[alternative][prop][subprop];
  }
  return data[alternative][prop];
};
