import React from 'react';
import {ConnectedProps, connect} from 'react-redux';

import Text from '../text';
import TextField from '../text-field';
import Timeout from './timeout';
import LineGraph from './line-graph';
import {Store} from '../../redux';

import {action} from '../../action';

type Props = ReduxProps & {}

type State = {}

class Running extends React.Component<Props, State> {
  render() {
    return (
       <div className="TypingTest">
        <div>
          <a onClick={this.onRestart} className="Button Button--full">
            <span>{this.props.localization.i_dont_want_this_text}</span>
          </a>
        </div>
        <div className="TypingTest__text-area">
          <TextField lock={false}/>
          <Text/>
        </div>
        <div className="TypingTest__timer">
          <Timeout/>
          <p className="TypingTest__timer--seconds">{this.props.localization.timer_unit}</p>
        </div>
        <div className="TypingTest__statistic">
          <div className="TypingTest__statistic__item--test">
            <div className="TypingTest__statistic__item__image--word" />
            <p className="TypingTest__statistic__item__state--wpm">{this.props.current_wpm}</p>
            <p className="TypingTest__statistic__item__state__name--test">{this.props.localization.wpm}</p>
          </div>
          <div className="TypingTest__statistic__item--test">
            <div className="TypingTest__statistic__item__image--character"/>
            <p className="TypingTest__statistic__item__state--cpm">{this.props.current_cpm}</p>
            <p className="TypingTest__statistic__item__state__name--test">{this.props.localization.cpm}</p>
          </div>
          <div className="TypingTest__statistic__item--test">
            <div className="TypingTest__statistic__item__image--mistake"/>
            <p className="TypingTest__statistic__item__state--mpm">{this.props.current_mpm}</p>
            <p className="TypingTest__statistic__item__state__name--test">{this.props.localization.mpm}</p>
          </div>
        </div>
        <div style={{display: "none"}}>
          <LineGraph/>
        </div>
      </div>
    )
  }

  onRestart = () => {
     ((window as any)._paq as any[] || []).push(['trackEvent', 'Typing Test', 'Click', 'not-this-text']);
     this.props.new_race();
  }
}

function mapState(state: Store) {
  return {
    average_wpm: state.data_aggregate.average_wpm,
    current_wpm: state.data_aggregate.current_wpm,
    average_mpm: state.data_aggregate.average_mpm,
    current_mpm: state.data_aggregate.current_mpm,
    average_cpm: state.data_aggregate.average_cpm,
    current_cpm: state.data_aggregate.current_cpm,
    localization: state.localization
  }
}

const mapDispatch = {
  new_race: action.new_race
};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(Running);
