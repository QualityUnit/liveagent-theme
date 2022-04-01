import React from 'react';
import {i18n} from '../common/constants';

function Features(props) {
  return(
    <div id={`page${props.page}`} className={`page page${props.page} optional page--features`}>
      <span className="features--optional">{i18n.optional}</span>
      <h2><span className="highlight-gradient">{props.page}.&nbsp;</span>{props.title}</h2>
      <div className="features">
        {props.children}
      </div>
    </div>
  );
}

export default Features;
