import React, {useState, useEffect} from 'react';
import { getWebCalcData, i18n } from '../common/constants';
import { saveToStorage } from '../common/sessionStorage';

import Page from '../templates/page';
import AgentsSlider from '../elements/agentsSlider';

function PageLast(props) {
  const {agents} = getWebCalcData;
  const [agentsCount, setAgents] = useState(agents);
  
  if(!agents) {
    saveToStorage('agents', 1);
  }

  const returnAgents = (agents) => {
    setAgents(agents);
  }

  useEffect(() => {
    returnAgents(agents)
  }, [agents])

  return(
    <Page page={props.page} customClass="optional" title={i18n.pageLast_title}>
      <div className="webcalcBlock webcalcBlock--narrow">
          <AgentsSlider returnAgents={returnAgents} />
      </div>
    </Page>
  );
}

export default PageLast;
