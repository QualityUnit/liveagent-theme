import React, { ReactNode } from 'react';
import { connect, ConnectedProps } from 'react-redux';

import DiffWord from './running/diff-word';
import { Store } from '../redux';

type TextProps = ReduxProps & {

}

type TextState = {

}

class Text extends React.Component<TextProps, TextState> {
    render() {
	var words_before: ReactNode[] = []; // most likely innefficient because I can't reserve before hand
	var words_after = ''; // same here



	for (var i = 0; i < this.props.running.position; i++) {
	    words_before.push(<span key={'words_before_' + i } className={this.props.style.class_complete}>{this.props.running.words[i]}</span>);
	}
	for (i = this.props.running.position + 1; i < this.props.running.words.length; i++) {
	    words_after += this.props.running.words[i] + ' ';
	}

	const current_word = this.props.running.words[this.props.running.position];
	const overflow = this.props.running.attempt.length > current_word.length;
	const overflow_amount = this.props.running.attempt.length - current_word.length - 1;

	return (
	    <div className={this.props.style.class_scrolling_main}>
		<div className={this.props.style.class_scrolling_left}>
		    {words_before}
	            <DiffWord key={i} word={this.props.running.words[this.props.running.position]} extra_style={{}}/>
		</div>
		<div className={this.props.style.class_scrolling_right}>
		    { overflow ? <span className={this.props.style.class_incorrect}>{ ' ' + words_after.slice(0, overflow_amount) }</span> : <span> </span>}
		    { this.props.running.attempt.length > current_word.length ? <span className={this.props.style.fake_cursor}/> : ''}
	            { words_after ? <span key='words_after' className={this.props.style.class_upcoming}>{!overflow ? words_after : words_after.slice(overflow_amount)}</span> : '' }
		</div>
	    </div>
	)

	// if (i === this.props.running.position) {
	//     return (  )
	// } else if (i < this.props.running.position) {
	//     return ( <span key={i} style={{ margin: this.props.style.text_spacing}} className={this.props.style.class_complete}>{word}</span> )
	// } else {
	//     return ( <span key={i} style={{ margin: this.props.style.text_spacing}} className={this.props.style.class_upcoming}>{word}</span> )
	// }
    }
}

function mapState(state: Store) {
    return {
	style: state.style.text,
	running: state.states.running
    }
}

const mapDispatch = {

};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(Text);
