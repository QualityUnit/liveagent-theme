import React from 'react';
import { VictoryChart, VictoryArea } from 'victory';
import { connect, ConnectedProps } from 'react-redux';

import { Store } from '../../redux';
import DataAggregate from '../../data-aggregate';
import { Type } from '../../data-aggregate/log-item';
import { action } from '../../action';

type Props = ReduxProps & {
    
}

type State = {
    correct_chunks: { time: number, wpm: number }[],
    incorrect_chunks: { time: number, mpm: number }[],
    timer: any,
    start_time: number
    domain: { x: [number, number], y: [number, number]}
}

const LOOKBACK = 10;
const YBUF = 20;
const YMIN = 150;

class LineGraph extends React.Component<Props, State> {    
    constructor(props: Props) {
	super(props);

	this.state = {
	    correct_chunks: [],
	    incorrect_chunks: [],
	    timer: undefined,
	    start_time: new Date().valueOf() / this.props.data_aggregate.chunking_interval,
	    domain: { x: [0, LOOKBACK], y: [0, YMIN] }
	};
    }

    componentDidMount() {
	this.setState({
	    timer: setInterval(this.timerHandler, this.props.data_aggregate.chunking_interval) as any
	})
    }

    componentWillUnmount() {
	clearInterval(this.state.timer);
    }

    timerHandler = () => {
	if (this.props.first_keypress) {
	    const data_aggregate = this.props.data_aggregate.instance;
	    const lookahead_index = 1000 / data_aggregate.chunking_interval * LOOKBACK;

	    const time_key = DataAggregate.current_time_key(
		new Date().valueOf(),
		data_aggregate.chunking_interval
	    );	
	    if (data_aggregate.chunked_data.length === 0 || data_aggregate.chunked_data[
		data_aggregate.chunked_data.length - 1
	    ].chunked_timestamp !== time_key) {
		data_aggregate.chunked_data.push({ chunked_timestamp: time_key, log_items: [] })
	    }

	    var ymin = YMIN;

	    const static_graph = data_aggregate.chunked_data.length < lookahead_index;
	    const correct_chunks = data_aggregate.chunked_data
		.slice(0, data_aggregate.chunked_data.length)
		.map((chunk, _i) => {
		    const adjusted_chunk = {
			time: (chunk.chunked_timestamp - data_aggregate.chunked_data[0].chunked_timestamp) / 1000,
			wpm: DataAggregate.wpm(chunk.log_items.filter((item, _i) => {
			    return (item.type === Type.Keystroke && !item.has_mistake) || item.type === Type.CompleteWord
			}), data_aggregate.chunking_interval)
		    }

		    if (ymin < adjusted_chunk.wpm + YBUF) {
			ymin = adjusted_chunk.wpm + YBUF;
		    }

		    return adjusted_chunk;
		});
	    const incorrect_chunks = data_aggregate.chunked_data
		.slice(0, data_aggregate.chunked_data.length)
		.map((chunk, _i) => {
		    const adjusted_chunk = {
			time: (chunk.chunked_timestamp - data_aggregate.chunked_data[0].chunked_timestamp) / 1000,
			mpm: DataAggregate.mpm(chunk.log_items.filter((item, _i) => {
			    return item.type === Type.Keystroke && item.has_mistake
			}), data_aggregate.chunking_interval)	
		    }

		    if (ymin < adjusted_chunk.mpm + YBUF) {
			ymin = adjusted_chunk.mpm + YBUF;
		    }

		    return adjusted_chunk;
		});
	    const correct_chunks_cpm = data_aggregate.chunked_data
		.slice(0, data_aggregate.chunked_data.length)
		.map((chunk, _i) => {
		    return {
			time: (chunk.chunked_timestamp - data_aggregate.chunked_data[0].chunked_timestamp) / 1000,
			cpm: DataAggregate.cpm(chunk.log_items.filter((item, _i) => {
			    return (item.type === Type.Keystroke && !item.has_mistake) || item.type === Type.CompleteWord
			}), data_aggregate.chunking_interval)	
		    }
		});

	    var total = 0;
	    for (var i = 0; i < correct_chunks.length ; i++) {
		total += correct_chunks[i].wpm
	    }
	    
	    this.props.update_stats(
		Math.floor(correct_chunks[correct_chunks.length - 1].wpm),
		LineGraph.average(correct_chunks.map((val, _i) => val.wpm)),
		Math.floor(correct_chunks_cpm[correct_chunks_cpm.length - 1].cpm),
		LineGraph.average(correct_chunks_cpm.map((val, _i) => val.cpm)),
		Math.floor(incorrect_chunks[incorrect_chunks.length - 1].mpm),
		LineGraph.average(incorrect_chunks.map((val, _i) => val.mpm))
	    );
	    
	    this.setState({
		correct_chunks: correct_chunks,
		incorrect_chunks: incorrect_chunks,
		domain: {
		    x: static_graph ? [0, LOOKBACK] : [
			correct_chunks[0].time,
			correct_chunks[correct_chunks.length - 1].time
		    ],
		    y: [0, ymin]
		}
	    })
	}
    }

    static average(nums: number[]) : number {
	return Math.floor(nums.reduce((acc, val) => acc + val) / nums.length)
    }
    
    render() {
	return (	    
		<div style={{ width: "600px", height: "470px", background: "url(#gradient1)"}}>
		    <svg style={{ position: "fixed", opacity: 0 }}>
			<defs>
			    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stopColor="#FF000000" />
				<stop offset="100%" stopColor="#00FF00FF" />
			    </linearGradient>
			</defs>
		    </svg>
		    <VictoryChart
			width={600} height={470} scale={{x: "linear"}}
			domain={this.state.domain}>
			<VictoryArea
			style={{
			    data: { stroke: "red", fill: "red", fillOpacity: 0.2 }
			}}
			data={this.state.incorrect_chunks}
			interpolation="catmullRom"
			x="time"
			y="mpm"/>
			<VictoryArea
			style={{
			    data: { stroke: "green", fill: "url(#gradient1)", fillOpacity: 1 }
			}}
		            data={this.state.correct_chunks}
		            interpolation="catmullRom" 
	                    x="time"
	                    y="wpm"/> 
		    </VictoryChart>
		</div>
	)
    }
}

function mapState(state: Store) {
    return {
	data_aggregate: state.data_aggregate,
	first_keypress: state.states.running.first_keypress
    }
}

const mapDispatch = {
    update_stats: action.update_stats
};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(LineGraph);

