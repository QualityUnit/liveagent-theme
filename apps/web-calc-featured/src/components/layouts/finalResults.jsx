import React, { useState, useEffect } from 'react';
import TagManager from 'react-gtm-module';
import { getWebCalcData,i18n } from '../common/constants';
import { alternatives, getPriceAgents, getChartWidth, getMaxPrice, getProps } from '../common/results/baseCalculations';
import { getMostExpensive } from '../common/results/compareResults';
import AgentsSlider from '../elements/agentsSlider';
import ChartBar from '../elements/chartBar';
import { showWebCalcGenerator } from '../common/constants';
import ShortCodeGenerator from '../elements/shortCodeGenerator';

const tagManagerArguments = {
  gtmId: 'G-T9HBB9KMVK',
  dataLayer: {
    WebCalcResultsFor: alternatives
  },
  dataLayerName: 'WebCalcFeatured'
}

function FinalResults() {
  const agents = 1;
  const [agentsCount, setAgents] = useState(agents);
  const [selFeature, setFeature] = useState(`["${getWebCalcData()[0]}"]`);
  const [result, setResult] = useState(getMostExpensive(agentsCount, selFeature));

  // We create empty array where we will push all alternatives and their price
  const alternativesToSort = [];

  // Pushing all alternatives to new array with price to sort it
  alternatives.map( alt => {
    const currentAltPrice = getPriceAgents(alt, agentsCount, selFeature).price;
    alternativesToSort.push([alt, currentAltPrice]);
    return false;
  });

  // Function that sorts alternatives by price from high to low, returns same array sorted
  alternativesToSort.sort((priceA, priceB) => {
    return Math.round(priceB[1]) - Math.round(priceA[1]);
  });

  const returnAgents = (agents) => {
    setAgents(agents);
  }

  const returnFeature = (selFeature) => {
    setFeature(selFeature);
  }

  const maxprice = getMaxPrice(alternatives, agentsCount, selFeature);
  const laprice = getPriceAgents('liveagent', agentsCount, selFeature).price;

  const getAlternative = (alternative) => {
    setResult(alternative);
  }

  useEffect(() => {
    setFeature(selFeature);
    returnAgents(agents);
    getAlternative(result);

    TagManager.dataLayer(tagManagerArguments);
     // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [agents, selFeature])

  const setTitle = () => {
    const customtitle = i18n[`${getWebCalcData()}_title`];
    if (customtitle) {
      return { __html: customtitle.replace('%feature%', `<span class="highlight-gradient">${i18n[getWebCalcData()]}</span>`) }
    }
    return { __html: i18n.title.replace('%feature%', `<span class="highlight-gradient">${i18n[getWebCalcData()]}</span>`) };
  }

  return(
    <>
			{showWebCalcGenerator
				? <ShortCodeGenerator returnFeature={returnFeature} />
				: null
			}
      <h2 dangerouslySetInnerHTML={setTitle()} />
      <div className={`page final`}>

        <div className="webcalcBlock webcalcBlock--narrow webcalcBlock--rounded__right">
            <AgentsSlider returnAgents={returnAgents} />

            <div className="charts">
              <ChartBar width={ getChartWidth('liveagent', agentsCount, maxprice, selFeature)} name="LiveAgent" price={ getPriceAgents('liveagent', agentsCount, selFeature).price } />
            </div>
            <div className="charts charts--colored">
              {alternativesToSort.map( ([alt, price], index) => {
                const currentAltPrice = getPriceAgents(alt, agentsCount, selFeature).price;

                return(typeof alt === 'string' && index < 10 // Limiting to 10 competitors max.
                    ? <ChartBar key={alt} index={index + 1} shortname={alt} getAlternative={getAlternative} width={ getChartWidth(alt, agentsCount, maxprice, selFeature) } agents={getPriceAgents(alt, agentsCount, selFeature).agents} url={ getProps(alt, 'url') } name={ getProps(alt, 'name') } price={ currentAltPrice } laprice={ laprice } />
                    : null
                  )
                })
              }
            </div>
        </div>
        <a className="Button Button--full Button--final Button--narrow Button--icon Button--icon__right" href={i18n.btn_url}>{i18n.btn_trial}
          <svg width="8" height="14" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.627837 13.0325C0.273396 12.6495 0.273075 12.0583 0.627099 11.6749L4.31825 7.67742C4.67199 7.29433 4.67199 6.70372 4.31825 6.32063L0.627099 2.32316C0.273075 1.93976 0.273396 1.34858 0.627837 0.965567L0.788311 0.792155C1.18414 0.364417 1.8604 0.364417 2.25622 0.792155L7.37148 6.31983C7.7262 6.70315 7.7262 7.2949 7.37148 7.67822L2.25622 13.2059C1.8604 13.6336 1.18414 13.6336 0.78831 13.2059L0.627837 13.0325Z"  />
          </svg>
        </a>
    </div>
  </>
  );
}

export default FinalResults;
