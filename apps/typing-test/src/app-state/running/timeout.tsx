import { Store } from '../../redux';

import { action } from '../../action';
import React from 'react';
import { connect, ConnectedProps } from 'react-redux';
import AppState from '..';

type Props = ReduxProps & {

}

type State = {
    timer: any,
}

class Timeout extends React.Component<Props, State> {
    constructor(props: Props) {
	super(props);

	this.state = {
	    timer: undefined,
	};
    }

    componentDidMount() {
	this.setState({
	    timer: setInterval(this.timerHandler, 1000.0)
	})
    }

    componentDidUpdate() {

    }

    componentWillUnmount() {
	clearInterval(this.state.timer);
    }

    timerHandler = () => {
	if (this.props.first_keypress) {
	    this.props.decrement_timer();
	}
    }

    render() {
	return (
	     <p className="TypingTest__timer--number">{ this.props.timeout }</p>
	)
    }
}

function mapState(state: Store) {
    return {
	first_keypress: state.states.running.first_keypress,
	timeout: state.states.running.timeout
    }
}

const mapDispatch = {
    switch_state: action.switch_state,
    decrement_timer: action.decrement_timer,
};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(Timeout);
