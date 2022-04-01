import React, { useRef, useState, useEffect} from 'react';
import {webCalcName, i18n, getWebCalcData} from '../common/constants';
import Features from '../../data/features';

function ShortCodeGenerator(props) {
  // Function to get all features
  const getAllFeatures = () => {
    const features=[];
    Object.values(Features).map((data) => {
    features.push(...Object.keys(data.features));
    return false;
    });
    return features;
  };

  const [copySuccess, setCopySuccess] = useState(false);
  let [selectedFeature, handleSelect] = useState(getWebCalcData()[0]);

  const getValue = event => {
    handleSelect(selectedFeature = event.target.value);
    sessionStorage.setItem(webCalcName, `["${selectedFeature}"]`);
    props.returnFeature(`["${selectedFeature}"]`);
  };

  // On componentDidMount set the timer
  useEffect(() => {
      setTimeout(() => setCopySuccess(false), 3000);
  }, [copySuccess]);

  const inputRef = useRef(null);

  const copyToClipboard = (e) => {
    inputRef.current.select();
    document.execCommand('copy');
    e.target.focus();
    setCopySuccess(true);
  };
  
  return (
    <>
      <h2 style={{color: "red"}}>
        Please select preselected Feature to define the cost calc, otherwise default Ticketing feature will be used.<br />
        This message is visible only in admin area to logged in users.
      </h2>
      <div className="shortcode--generator">
        {copySuccess && <div className="shortcode--generator__message">Copy Successful!</div>}
        <select style={{fontSize:"1rem", cursor: "pointer"}} value={selectedFeature ? selectedFeature: 'ticketing'} onChange={getValue}>
          {getAllFeatures().map(feature => {
            return(
              <option key={feature} value={feature}>{i18n[feature]}</option>
            )
          })}
        </select>
        <h4 style={{marginTop: 1.5 + "rem"}}>Generated shortcode: </h4>
        <input ref={inputRef} style={{fontSize:"1rem", width: "100%"}} readOnly value={`[calc_featured feature='${selectedFeature ? selectedFeature: 'ticketing'}']`} />
      </div>
      <button style={{marginTop: 1.5 + "rem", marginBottom: 3 + "rem"}} className="Button Button--full" onClick={copyToClipboard}>Copy to clipboard</button> 
    </>
  )
}

export default ShortCodeGenerator;
