import React from 'react';
import {i18n} from '../common/constants';

function FinalHeader(props) {
  const {caseId, name, savings, missing, premium} = props;

  return (
    caseId === "case1"
    ? <h2>{i18n.save} <span className="highlight-gradient"> {i18n.up_to} {savings} % </span>{i18n.final_title1}</h2>
    
    // Case 2
    : caseId === "case2"
    ? <h2 className="smaller">{i18n.save} <span className="highlight-gradient"> {i18n.up_to} {savings} % </span>{i18n.final_title2.replace('%alternative%', name)} {missing}</h2>
    
    // Case 3
    : caseId === "case3"
    ? <h2 className="smaller">{i18n.final_title3.replace('%alternative%', name)} <span className="highlight-gradient">{i18n.final_title_premium}</span> {premium}</h2>
    
    // Case 4
    : caseId === "case4"
    ? <h2>{i18n.final_title4.replace('%alternative%', name)} <span className="highlight-gradient">{i18n.final_title_missing}</span> {missing}</h2>
    
    // Case 5
    : caseId === "case5"
    ? <h2 className="smaller">{i18n.final_title5.replace('%alternative%', name)} <span className="highlight-gradient">{i18n.final_title_missing}</span> {missing}</h2>
    
    // Case 6
    : caseId === "case6"
    ? <h2 className="smaller">{i18n.final_title6.replace('%alternative%', name)} <span className="highlight-gradient">{i18n.final_title_premium}</span> {premium}</h2>
    : ''
  )
}

export default FinalHeader;
