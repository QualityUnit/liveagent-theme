import React from 'react';
import {i18n} from '../common/constants';

function PrevButton(props) {
  return(
    <button id="prevBtn" style={(props.page === 1) ? {visibility:'hidden'}:{visibility:'visible'}} onClick={props.onPress} className="Button Button--icon Button--icon__left Button--outline Button--narrow">
      <svg width="8" height="14" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg">
        <path d="M7.37216 13.0315C7.7266 12.6485 7.72693 12.0573 7.3729 11.6739L3.68175 7.67644C3.32801 7.29335 3.32801 6.70274 3.68175 6.31965L7.3729 2.32219C7.72693 1.93878 7.7266 1.34761 7.37216 0.96459L7.21169 0.791179C6.81586 0.363441 6.1396 0.363441 5.74378 0.791179L0.628521 6.31885C0.273797 6.70217 0.273798 7.29392 0.628522 7.67724L5.74378 13.2049C6.1396 13.6327 6.81586 13.6327 7.21169 13.2049L7.37216 13.0315Z" />
      </svg>

      {i18n.btn_prev}
    </button>
  );
}

export default PrevButton;
