import React from 'react';
import Select, { components } from 'react-select';
import useStateSessionStorage from '../common/sessionStorage';
import {production, path, i18n} from '../common/constants';
import data from '../../data/alternatives.json';

const Laselect = (props) => {
  const {thisId, isDisabled, isSelected} = props;
  const [sel1, sel2, sel3] = isSelected;
  let [alt, setSelected] = useStateSessionStorage(thisId);

  const optionSet = (getValue) => {
    const {value} = getValue;
    setSelected(value);
    props.getSelected(thisId, value);
  }

  const styleProxy = new Proxy(
  {},
  {
    get: (target, propKey) => () => {}
  }
);

const ControlComponent = (props) => (
  <>
    <img className="select--icon" src={`${production ? path:''}images/icon-select.svg`} alt="Select icon" />
    <components.Control {...props} />
  </>
);

  const options = [];
  return(
    <>
    {Object.entries( data ).map( ( [key, properties] ) => {
      const {active} = properties;
      if ( (active && key !== 'liveagent') ) {
        options.push({value: key, label: properties.name});
      }
      return false;
    })}
    <Select styles={styleProxy} components={{ Control: ControlComponent }} searchable placeholder={i18n.select} optionSet={optionSet} className="select" classNamePrefix="select" isOptionDisabled={option => (sel1 === option.value || sel2 === option.value || sel3 === option.value)} defaultValue={options[options.findIndex(p => p.value === alt)]} isDisabled={isDisabled} onChange={optionSet} options={options} />
    </>
  )
}

export default Laselect;
