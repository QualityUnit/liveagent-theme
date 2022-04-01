import {Store} from '../../redux';

import React, {ReactElement} from 'react';
import {connect, ConnectedProps} from 'react-redux';
import {Type} from '../../data-aggregate/log-item';
import {ReactComponent} from '*.svg';


type Props = ReduxProps & {}

type State = {
    spans: ReactElement[],

}

class SummaryText extends React.Component<Props, State> {
    constructor(props: Props) {
	super(props);

	var start = 0;
	var state_switch = false;
	var ranges: [number, number, boolean][] = [];

	var skip = 0;
	var c = 0;
	for (var i = 0; i < this.props.chunked_data.length; i++) {
	    const chunk = this.props.chunked_data[i];
	    for (var j = 0; j < chunk.log_items.length; j++) {
		const log_item = chunk.log_items[j];

		if (skip == 0) {
		    if (log_item.type == Type.Keystroke || log_item.type == Type.CompleteWord) {
			if (state_switch) {
			    state_switch = false;
			    ranges.push([start, c, true]);
			    skip = c;
			    start += c;
			    c = 0;
			}
		    } else if (log_item.type == Type.Backspace) {
			if (!state_switch) {
			    state_switch = true;
			    ranges.push([start, c + 1, false]);
			    start += c + 1;
			    c = 0;
			}
		    }
		    c++;
		} else {
		    skip--;
		}
	    }
	}

	var spans: ReactElement[] = [];
	for (var i = 0; i < ranges.length; i++) {
	    const range = ranges[i];
	    spans.push(
		<span key={i} style={{color: range[2] ? "red" : "lightgray"}}>
		    {this.props.text != null ? this.props.text.text.substr(range[0], range[1]) : ""}
		</span>)
	}

	if (this.props.text != null && ranges.length != 0 &&
	    ranges[ranges.length - 1][1] != this.props.text.text.length - 1) {
	    spans.push(<span key="end">{ this.props.text.text.substr(ranges[ranges.length - 1][0] + ranges[ranges.length - 1][1])}</span>)
	} else if (ranges.length == 0 && this.props.text != null) {
	    spans.push(<span key="end">{ this.props.text.text }</span>);
	}

	this.state = {
	    spans: spans
	};

	this.state = {
	    spans: spans
	};
    }

    componentDidMount() {
	this.setState({})
    }

    

    render() {


	return (
	    <div className="TypingTest__text--mistake">
		{this.state.spans}
	    </div>
	)
    }
}

function mapState(state: Store) {
    return {
	words: state.states.running.words,
	text: state.states.running.current_text,
	chunked_data: state.data_aggregate.instance.chunked_data
    }
}

const mapDispatch = {};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(SummaryText);
