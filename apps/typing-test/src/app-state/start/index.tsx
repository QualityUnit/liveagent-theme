import React, {ReactElement} from 'react';
import {connect, ConnectedProps} from 'react-redux';

import {Store} from '../../redux';
import {action} from '../../action';


type Props = ReduxProps & {}

type State = {
  selected_difficulty: string | null,
  selected_timeout: number | null
}

class Start extends React.Component<Props, State> {
  constructor(props: Props) {
    super(props)

    if (Object.getOwnPropertyNames(this.props.difficulties).length <= 1) {
      this.props.new_race()
    }

    this.state = {
      selected_difficulty: null,
      selected_timeout: null
    }
  }

  submit(value: string, type: string) {
    switch (type) {
      case "difficulty":
        this.setState({selected_difficulty: value});
        break;
      case "timeout":
        this.setState({selected_timeout: +value});
        break;
    }
  }

  componentDidUpdate() {
    if (this.state.selected_difficulty !== null && this.state.selected_timeout !== null) {
      this.props.select_timer_difficulty(this.state.selected_difficulty, this.state.selected_timeout);
      this.props.new_race()
    } else if (Object.getOwnPropertyNames(this.props.difficulties).length <= 1) {
      this.props.new_race()
    } else {
      console.log("nulliii");
    }
  }

  render() {
    return (
      <div className="TypingTest">
        <div className="TypingTest__information__title">1. {this.props.localization.choose_test_diff}</div>
        <div className="TypingTest__statistic">
          <div className={this.state.selected_difficulty == "easy" ? "TypingTest__statistic__item TypingTest__statistic__item-active" : "TypingTest__statistic__item"} onClick={(event) => this.submit("easy", "difficulty")}>
            <div className="TypingTest__icon TypingTest__icon__test-difficulty__easy" />
            <p className="TypingTest__statistic__item__state__name">{this.props.difficulties.get("easy")?.display_name}</p>
          </div>
          <div className={this.state.selected_difficulty == "normal" ? "TypingTest__statistic__item TypingTest__statistic__item-active" : "TypingTest__statistic__item"} onClick={(event) => this.submit("normal", "difficulty")}>
            <div className="TypingTest__icon TypingTest__icon__test-difficulty__normal"/>
            <p className="TypingTest__statistic__item__state__name">{this.props.difficulties.get("normal")?.display_name}</p>
          </div>
          <div className={this.state.selected_difficulty == "hard" ? "TypingTest__statistic__item TypingTest__statistic__item-active" : "TypingTest__statistic__item"} onClick={(event) => this.submit("hard", "difficulty")}>
            <div className="TypingTest__icon TypingTest__icon__test-difficulty__hard"/>
            <p className="TypingTest__statistic__item__state__name">{this.props.difficulties.get("hard")?.display_name}</p>
          </div>
        </div>
        <div className="TypingTest__information__title">2. {this.props.localization.choose_test_dur}</div>
        <div className="TypingTest__statistic">
          <div className={this.state.selected_timeout == 60 ? "TypingTest__statistic__item TypingTest__statistic__item-active" : "TypingTest__statistic__item"} onClick={(event) => this.submit("60", "timeout")}>
            <div className="TypingTest__icon TypingTest__icon__test-duration__1min" />
            <p className="TypingTest__statistic__item__state__name">{this.props.timeouts.get("60")?.display_name}</p>
          </div>
          <div className={this.state.selected_timeout == 180 ? "TypingTest__statistic__item TypingTest__statistic__item-active" : "TypingTest__statistic__item"} onClick={(event) => this.submit("180", "timeout")}>
            <div className="TypingTest__icon TypingTest__icon__test-duration__3min"/>
            <p className="TypingTest__statistic__item__state__name">{this.props.timeouts.get("180")?.display_name}</p>
          </div>
          <div className={this.state.selected_timeout == 300 ? "TypingTest__statistic__item TypingTest__statistic__item-active" : "TypingTest__statistic__item"} onClick={(event) => this.submit("300", "timeout")}>
            <div className="TypingTest__icon TypingTest__icon__test-duration__5min"/>
            <p className="TypingTest__statistic__item__state__name">{this.props.timeouts.get("300")?.display_name}</p>
          </div>
        </div>
      </div>
    )
  }
}

function mapState(state: Store) {
  return {
    difficulties: state.all_texts.difficulties,
    timeouts: state.all_texts.timeouts,
    selected_difficulty: state.selected_difficulty,
    localization: state.localization
  }
}

const mapDispatch = {
  new_race: action.new_race,
  select_timer_difficulty: action.select_timer_difficulty
};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(Start);
