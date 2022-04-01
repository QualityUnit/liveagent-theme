import React from 'react';
import {getWebCalcData, i18n} from '../common/constants';

export default function ClearBackbutton(props) {  
  const { ispreset, waspreset } = getWebCalcData;

  const handleClear = () => {
    if(!ispreset) {
      props.goPage(1);
    }
    if(ispreset || waspreset) {
      props.goPage(2);
    }
  }

  return(
    <button id="clearBtn" onClick={handleClear} className="Button Button--icon Button--icon__right Button--outline Button--outline__dark Button--narrow">
      {i18n.btn_clearstart}
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.1791 5.82091C14.8499 4.49175 13.0258 3.66675 10.9999 3.66675C6.94828 3.66675 3.67578 6.94841 3.67578 11.0001C3.67578 15.0517 6.94828 18.3334 10.9999 18.3334C14.4191 18.3334 17.2699 15.9959 18.0858 12.8334H16.1791C15.4274 14.9692 13.3924 16.5001 10.9999 16.5001C7.96578 16.5001 5.49995 14.0342 5.49995 11.0001C5.49995 7.96591 7.96578 5.50008 10.9999 5.50008C12.5216 5.50008 13.8783 6.13258 14.8683 7.13175L11.9166 10.0834H18.3333V3.66675L16.1791 5.82091Z" />
      </svg>
    </button>
  );
}
