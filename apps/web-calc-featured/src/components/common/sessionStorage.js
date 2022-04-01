import { useState, useRef, useEffect } from 'react';
import { webCalcName, getWebCalcData } from './constants';

export const saveToStorage = (storageKey) => {
  let keyValue = JSON.parse(`["${storageKey}"]`);
  if(typeof value === 'boolean' || typeof value ==='number') {
    keyValue = JSON.parse(`["${storageKey}"]`);
  }
  let webCalcNew = Object.assign(getWebCalcData, keyValue);
  sessionStorage.setItem(webCalcName, JSON.stringify(webCalcNew))
}

export const useStateSessionStorage = storageKey => {

  const hasFetchedData = useRef(false);
  const [value, setValue] = useState(
    getWebCalcData[storageKey] || false
  );
    
  useEffect(() => {
    if (!hasFetchedData.current) {
      saveToStorage(storageKey, value);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [value]);
 
  return [value, setValue];
};

export default useStateSessionStorage;
