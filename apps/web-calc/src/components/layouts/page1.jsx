import React, { useState } from 'react';
import { production, path, getWebCalcData, i18n } from '../common/constants';
import { saveToStorage } from '../common/sessionStorage';
// import Select from '../elements/select';
import Laselect from '../elements/reactselect';
import Page from '../templates/page';

function Page1(props) {
  const [option, setSelected] = useState(false);
  const {selected, value} = option;
  const {select1, select2, select3, agents} = getWebCalcData;
  
  if(!agents) {
    saveToStorage('agents', 1);
  }

  let sel1Value = select1;
  let sel2Value = select2;
  let sel3Value = select3;

  const getSelected = (selected, value) => {
    setSelected({selected, value});
    if(selected === 'select1') {
      props.canContinue(value);
    }
  };

  if(selected === 'select1') {
    sel1Value = value;
  }
  
  if(selected === 'select2') {
    sel2Value = value;
  }
  if(selected === 'select3') {
    sel3Value = value;
  }

  let sel = [sel1Value, sel2Value, sel3Value]

  return(
    <Page page={props.page} title={i18n.page1_title}>
      <div className="flex split">
        <img className="intro--logo" src={`${production ? path:''}images/liveagent_logo.svg`} alt="logo" />
        <div className="full">
          <Laselect getSelected={getSelected} isSelected={sel} isDisabled={false} thisId="select1" />
          <Laselect getSelected={getSelected} isSelected={sel} isDisabled={typeof sel1Value !== 'string' ? true:false } thisId="select2" />
          <Laselect getSelected={getSelected} isSelected={sel} isDisabled={typeof sel2Value !== 'string' ? true:false } thisId="select3" />
        </div>
      </div>
    </Page>
  );
}

export default Page1;
