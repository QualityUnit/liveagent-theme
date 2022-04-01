import React from 'react';
import { connect, ConnectedProps } from 'react-redux';

import { AppState, Start, Running, End } from './app-state';
import { Store } from './redux';

type StateMachineProps = ReduxProps & {

}

type StateMachineState = {
    
}

class StateMachine extends React.Component<StateMachineProps, StateMachineState> {
    render() {
	switch (this.props.app_state) {
	    case AppState.Start:
		return (
		    <Start/>
		);
	    case AppState.Running:
		return (
		    <Running/>
		);
	    case AppState.End:
		return (
		    <End/>
		);
	}
    }
}

function mapState(state: Store) {
    return {
	app_state: state.app_state
    }
}

const connector = connect(mapState);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(StateMachine);
