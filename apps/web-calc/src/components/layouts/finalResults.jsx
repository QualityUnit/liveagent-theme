import React, { useState, useEffect } from 'react';
import TagManager from 'react-gtm-module';
import { showWebCalcGenerator, getWebCalcData, i18n } from '../common/constants';
import { getPriceAgents, getChartWidth, getMaxPrice, getProps } from '../common/results/baseCalculations';
import { compareResults, getMostExpensive } from '../common/results/compareResults';
import AgentsSlider from '../elements/agentsSlider';
import ClearBackbutton from '../elements/clearBackBtn';
import ChartBar from '../elements/chartBar';
import FinalHeader from '../elements/finalHeader';
import ShortCodeGenerator from '../elements/shortCodeGenerator';

const {select1, select2, select3} = getWebCalcData;
  const alternatives = [select1, select2, select3];
const tagManagerArguments = {
  gtmId: 'G-T9HBB9KMVK',
  dataLayer: {
    WebCalcResultsFor: alternatives
  },
  dataLayerName: 'WebCalc'
}

function FinalResults(props) {
  const {page} = props;
  const {select1, select2, select3, agents} = getWebCalcData;
  const alternatives = [select1, select2, select3];
  const [agentsCount, setAgents] = useState(agents);
  const [result, setResult] = useState(getMostExpensive(alternatives, agentsCount));

  const returnAgents = (agents) => {
    setAgents(agents);
  }

  const goPage = (goPage) => {
    props.backToStart(goPage);
  }

  const maxprice = getMaxPrice(alternatives, agentsCount);

  // Changing variable because agents number is changing too, so we can live update title
  const res = compareResults(result,agentsCount);

  const getAlternative = (alternative) => {
    setResult(alternative);
  }

  useEffect(() => {
    returnAgents(agents);
    getAlternative(result);

    TagManager.dataLayer(tagManagerArguments);
     // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [agents])

  return(
      <div id={`page${page}`} className={`page page${page} optional final`}>
        <span className="features--optional">{i18n.result}</span>
        <FinalHeader {...res} />

        <div className="webcalcBlock webcalcBlock--narrow webcalcBlock--rounded__right">
            <AgentsSlider returnAgents={returnAgents} />
            <small className="click--chartbar">
              {i18n.click_to_chart}
            </small>

            <ul className="charts">
              <ChartBar width={ getChartWidth('liveagent', agentsCount, maxprice)} name="LiveAgent" price={ getPriceAgents('liveagent', agents).price } />

              { alternatives.map( alt => {
                return(typeof alt === 'string'
                    ? <ChartBar key={alt} shortname={alt} getAlternative={getAlternative} width={ getChartWidth(alt, agents, maxprice) } agents={getPriceAgents(alt, agents).agents} url={ getProps(alt, 'url') } name={ getProps(alt, 'name') } price={ getPriceAgents(alt, agents).price } laprice={ getPriceAgents('liveagent', agents).price } />
                    : ''
                  )
                })
              }
            </ul>
        </div>
        {showWebCalcGenerator
            ? <ShortCodeGenerator agents={agents} />
            : <div className="PaginationButtons">
                <ClearBackbutton goPage={goPage} />
                <a className="Button Button--full Button--final Button--narrow Button--icon Button--icon__right" href={i18n.btn_discover_URL}>{i18n.btn_boost}
                  <svg width="8" height="14" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.627837 13.0325C0.273396 12.6495 0.273075 12.0583 0.627099 11.6749L4.31825 7.67742C4.67199 7.29433 4.67199 6.70372 4.31825 6.32063L0.627099 2.32316C0.273075 1.93976 0.273396 1.34858 0.627837 0.965567L0.788311 0.792155C1.18414 0.364417 1.8604 0.364417 2.25622 0.792155L7.37148 6.31983C7.7262 6.70315 7.7262 7.2949 7.37148 7.67822L2.25622 13.2059C1.8604 13.6336 1.18414 13.6336 0.78831 13.2059L0.627837 13.0325Z"  />
                  </svg>
                </a>
              </div>
        }
    </div>
  );
}

export default FinalResults;
