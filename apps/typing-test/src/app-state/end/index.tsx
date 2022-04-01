import React from 'react';
import {ConnectedProps, connect} from 'react-redux';

import StaticGraph from './static-graph';
import {Store} from '../../redux';
import DataAggregate from '../../data-aggregate';
import LogItem, {Type} from '../../data-aggregate/log-item';
import ReportForm from './report-form';

import {action} from '../../action';
import LineGraph from "../running/line-graph";
import SummaryText from './summary-text';

type Props = ReduxProps & {}

type State = {
  data: { time: number, y: number }[],
  data2: { time: number, y: number }[],
  ymin: number;
}

const YBUF = 20;
const YMIN = 150;

class End extends React.Component<Props, State> {
  constructor(props: Props) {
    super(props);

    var ymin = YMIN;

    var stats: {
      average_wpm: number,
      average_cpm: number,
      average_mpm: number,
      words: number,
      event: LogItem[]
    } = {
      average_wpm: this.props.stats.average_wpm,
      average_cpm: this.props.stats.average_cpm,
      average_mpm: this.props.stats.average_mpm,
      words: this.props.stats.words,
      event: this.props.stats.instance.chunked_data.map((value) => value.log_items).flat()
    };
    ((window as any)._paq as any[] || []).push(['trackEvent', 'Typing Test', 'Finished wpm', stats.average_wpm]);
    ((window as any)._paq as any[] || []).push(['trackEvent', 'Typing Test', 'Finished cpm', stats.average_cpm]);
    ((window as any)._paq as any[] || []).push(['trackEvent', 'Typing Test', 'Finished mpm', stats.average_mpm]);
    ((window as any)._paq as any[] || []).push(['trackEvent', 'Typing Test', 'Finished words', stats.words]);

    this.state = {
      data: this.props.data_aggregate.chunked_data
        .map((chunk, _i) => {
          const adjusted_chunk = {
            time: (chunk.chunked_timestamp - this.props.data_aggregate.chunked_data[0].chunked_timestamp) / 1000,
            y: DataAggregate.wpm(chunk.log_items.filter((item, _i) => {
              return (item.type === Type.Keystroke && !item.has_mistake) || item.type === Type.CompleteWord
            }), this.props.data_aggregate.chunking_interval)
          }

          if (ymin < adjusted_chunk.y + YBUF) {
            ymin = adjusted_chunk.y + YBUF;
          }

          return adjusted_chunk;
        }),
      data2: this.props.data_aggregate.chunked_data
        .map((chunk, _i) => {
          const adjusted_chunk = {
            time: (chunk.chunked_timestamp - this.props.data_aggregate.chunked_data[0].chunked_timestamp) / 1000,
            y: DataAggregate.mpm(chunk.log_items.filter((item, _i) => {
              return item.type === Type.Keystroke && item.has_mistake
            }), this.props.data_aggregate.chunking_interval)
          }

          if (ymin < adjusted_chunk.y + YBUF) {
            ymin = adjusted_chunk.y + YBUF;
          }

          return adjusted_chunk;
        }),
      ymin: ymin
    }
    document.body.classList.add("TypingTest__done");
  }

  onRestart = () => {
    ((window as any)._paq as any[] || []).push(['trackEvent', 'Typing Test', 'Click', 'try-one-more-test']);
    document.body.classList.remove("TypingTest__done");
    this.props.new_race();
  }

  render() {
    return (
      <div className="TypingTest">
        <div className="TypingTest__statistic">
          <div className="TypingTest__statistic__item">
            <div className="TypingTest__statistic__item__image--word"/>
            <p className="TypingTest__statistic__item__state--wpm">{this.props.stats.average_wpm}</p>
            <p className="TypingTest__statistic__item__state__name">{this.props.localization.wpm}</p>
          </div>
          <div className="TypingTest__statistic__item">
            <div className="TypingTest__statistic__item__image--character"/>
            <p className="TypingTest__statistic__item__state--cpm">{this.props.stats.average_cpm}</p>
            <p className="TypingTest__statistic__item__state__name">{this.props.localization.cpm}</p>
          </div>
          <div className="TypingTest__statistic__item">
            <div className="TypingTest__statistic__item__image--mistake"/>
            <p className="TypingTest__statistic__item__state--mpm">{this.props.stats.average_mpm}</p>
            <p className="TypingTest__statistic__item__state__name">{this.props.localization.mpm}</p>
          </div>
        </div>
        <SummaryText/>
        <div className="StaticGraph">
          <StaticGraph data={this.state.data} data2={this.state.data2} y_domain={[0, this.state.ymin]}/>
        </div>
        <div>
          <a onClick={this.onRestart} className="button button__fill">
            <span>{this.props.localization.lets_try_one_more_test}</span>
          </a>
        </div>
        { /*<ReportForm/>*/}
      </div>
    )
  }
}

function mapState(state: Store) {
  return {
    data_aggregate: state.data_aggregate.instance,
    chunking_interval: state.data_aggregate.chunking_interval,
    stats: state.data_aggregate,
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
export default connector(End);


