import React, { useRef, useState, useEffect} from 'react';
import {getWebCalcData} from '../common/constants';


function ShortCodeGenerator({agents}) {
  const [copySuccess, setCopySuccess] = useState(false);

  const shortcodeAttributes = Object.entries(getWebCalcData).map( ([key, value]) => {
    if(key !== 'agents') {
      if(typeof value ==='string') {
        const keyvalue = `"${key}":"${value}"`;
        return keyvalue;
      }
      const keyvalue = `"${key}":${value}`;
      return `${keyvalue}`;
    }
    return null;
  })

  // On componentDidMount set the timer
  useEffect(() => {
      setTimeout(() => setCopySuccess(false), 3000);
  }, [copySuccess]);

  const textAreaRef = useRef(null);

  const copyToClipboard = (e) => {
    textAreaRef.current.select();
    document.execCommand('copy');
    e.target.focus();
    setCopySuccess(true);
  };
  
  return (
    <>
      <div className="shortcode--generator">
        {copySuccess && <div className="shortcode--generator__message">Copy Successful!</div>}
        <textarea ref={textAreaRef} rows="10" readOnly value={`[web_calc parameters='{"ispreset":true,"agents":${agents} ${shortcodeAttributes}}']`} />
      </div>
      <button style={{marginTop: 1.5 + "rem"}} className="Button Button--full" onClick={copyToClipboard}>Copy to clipboard</button> 
    </>
  )
}

export default ShortCodeGenerator;
