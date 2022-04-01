import { i18n } from '../common/constants';

import Features from '../templates/features';
import Feature from '../elements/feature';
import FeatureData from '../../data/features';


function AllFeatures({currentPage}) {
  const i = currentPage - 2;
  const [key, datas] = Object.entries(FeatureData)[i];
  const {title, features} = datas;
  const featuresList = Object.entries(features);

  return(
    <Features key={key} page={currentPage} title={i18n[title]}>
      {featuresList.map(([feature,values]) => {
        const {name, tooltip} = values;
        return(
          <Feature key={feature} label={i18n[name]} feature={feature} tooltip={i18n[tooltip]} />
        );
      })}
    </Features>
  )
}

export default AllFeatures;

