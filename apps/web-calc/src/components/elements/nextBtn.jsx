import React from 'react';
import {i18n} from '../common/constants';

function NextButton(props) {
  const {canContinue, onPress, islast} = props;

  return(
    <button id="nextBtn" onClick={onPress} disabled={typeof canContinue !== 'string'} className="Button Button--icon Button--icon__right Button--full Button--narrow">
      {!islast ? i18n.btn_next : i18n.btn_calculate}
      <svg width="8" height="14" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.627837 13.0325C0.273396 12.6495 0.273075 12.0583 0.627099 11.6749L4.31825 7.67742C4.67199 7.29433 4.67199 6.70372 4.31825 6.32063L0.627099 2.32316C0.273075 1.93976 0.273396 1.34858 0.627837 0.965567L0.788311 0.792155C1.18414 0.364417 1.8604 0.364417 2.25622 0.792155L7.37148 6.31983C7.7262 6.70315 7.7262 7.2949 7.37148 7.67822L2.25622 13.2059C1.8604 13.6336 1.18414 13.6336 0.78831 13.2059L0.627837 13.0325Z"  />
      </svg>
    </button>
  );
}

export default NextButton;
