import React from 'react';
import useStateSessionStorage from '../common/sessionStorage';

function Feature(props) {
  const {feature, label, tooltip} = props;
  let [value, setValue] = useStateSessionStorage(feature);

  const handleChange = (event) => {
    setValue(event.target.checked);
  }

  return(
    <div className="Feature--wrapper">
      <input id={feature} name={feature} type="checkbox" onChange={(e) => handleChange(e)} checked={value} />
      <label htmlFor={feature} className={`Feature ${feature}`}>
        <h4 className="Feature--label">{label}</h4>
        <i className="info-icon">
          <div className="Tooltip">
            {tooltip}
          </div>
        </i>
      </label>
    </div>
  );
}

export default Feature;
