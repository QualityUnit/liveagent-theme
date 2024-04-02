import React, {useState, useEffect} from 'react';
import { NumericFormat } from 'react-number-format';
import { i18n } from '../common/constants';

function ChartBar(props) {
  const {name, price, laprice, width, agents, shortname} = props;
  const [defaultwidth, setWidth] = useState(0);
  const [active, setActive] = useState(false);

  const handleClick = () => {
    setActive(active);
    if(shortname) {
      props.getAlternative(shortname);
    }
  }

  useEffect(() => {
    setTimeout(() => {
      setWidth(width);
    }, 0);
  }, [width]);

  return(
    <li className={`chart--bar__wrapper ${active ? 'active':''} ${ ( price < laprice && ( agents > 1 || agents < 9999 ) ) ? 'limited': '' }`} value={name} onClick={handleClick}>
      <div className="chart--bar" style={{width: defaultwidth + "%"}}></div>
      <dl className="chart--bar__info">
        <dt className="name">
          {name}
        </dt>
        <dd className="price">
          <NumericFormat value={price} displayType={'text'} thousandSeparator={' '} prefix={'$'} />
        </dd>
      </dl>
      { agents > 1
        ? <i className={`info-icon ${ agents > 1 && agents < 9999 ? 'warning': '' }`}>
          <div className="Tooltip">
            { i18n.agents_maxNumber }&nbsp;
            { agents > 1 && agents < 9999
              ? agents
              : ''
            }
            { agents === 9999
              ? i18n.agents_unlimited
              : ''
            }
          </div>
        </i>
        : ''
      }
    </li>
  )
}

export default ChartBar;
