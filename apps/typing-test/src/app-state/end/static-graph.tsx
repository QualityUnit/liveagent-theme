import React from 'react';
import {connect, ConnectedProps} from 'react-redux';
import {VictoryChart, VictoryArea, VictoryLabel, VictoryAxis, VictoryTheme} from 'victory';

import {Store} from '../../redux';

type Props = ReduxProps & {
  data: { time: number, y: number }[],
  data2: { time: number, y: number }[],
  y_domain: [number, number],
}

type State = {
  domain: { x: [number, number], y: [number, number] }
}

class StaticGraph extends React.Component<Props, State> {
  constructor(props: Props) {
    super(props);

    if (this.props.data.length > 0) {
      this.state = {
        domain: {
          x: [this.props.data[0].time, this.props.data[this.props.data.length - 1].time],
          y: this.props.y_domain
        }
      }
    } else {
      this.state = {
        domain: {
          x: [0, 100],
          y: this.props.y_domain
        }
      }
    }
  }

  componentDidUpdate(previous_props: Props, previous_state: State, snapshot: any) {
    if (previous_props.data !== this.props.data || previous_props.y_domain !== this.props.y_domain) {
      if (this.props.data.length > 0) {
        this.setState({
          domain: {
            x: [this.props.data[0].time, this.props.data[this.props.data.length].time],
            y: this.props.y_domain
          }
        })
      } else {
        this.state = {
          domain: {
            x: [0, 100],
            y: this.props.y_domain
          }
        }
      }
    }
  }

  render() {
    const styles = this.getStyles();

    return (
      // TODO style hardcoded
      <div className="TypingTest__statistic__graph__box">
        <VictoryChart
          width={1000} height={400} scale={{x: "linear"}}
          domain={this.state.domain}
          animate={{
            duration: 2000,
            onLoad: {duration: 1000}
          }}>
          <VictoryLabel x={50} y={30} style={styles.titleCharacter} text={this.props.localization.average_cpm}/>
            <VictoryLabel x={500} y={30} style={styles.titleMistake} text={this.props.localization.average_mpm}/>
          <VictoryAxis
            style={styles.graphAxis}
            tickFormat={(t) => `${t} sec`}
          />
          <VictoryArea
            style={styles.areaCharacterRed}
            data={this.props.data2}
            interpolation="basis"
            x="time"
            y="y"/>
          <VictoryArea
            style={styles.areaCharacterGreen}
            data={this.props.data}
            interpolation="basis"
            x="time"
            y="y"/>
        </VictoryChart>
      </div>
    )
  }

  getStyles() {
    return {
      titleCharacter: {
        fill: "#4AC65C",
        fontFamily: "poppins",
        fontSize: "18px",
      },
      titleMistake: {
        fill: "red",
        fontFamily: "poppins",
        fontSize: "18px",
      },
      areaCharacterGreen: {
        data: {stroke: "#4AC65C", fill: "#4AC65C", fillOpacity: 0.05}
      },
      areaCharacterRed: {
        data: {stroke: "red", fill: "red", fillOpacity: 0.05}
      },
      graphAxis: {
        axis: {stroke: "transparent"},
        grid: {stroke: "grey", strokeOpacity: 0.15},
        tickLabels: {fontSize: 10, fill: "grey", fillOpacity: 0.3, padding: -205, fontFamily: "poppins"}
      }
    };
  }
}

function mapState(state: Store) {
  return {
      localization: state.localization
  }
}

const mapDispatch = {

};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(StaticGraph);
