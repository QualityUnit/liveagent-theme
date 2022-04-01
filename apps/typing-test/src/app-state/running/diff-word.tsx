import React, { CSSProperties } from 'react';
import { ConnectedProps, connect } from 'react-redux';

import { Store } from '../../redux';
import { action } from '../../action';

type LetterData = {
    letters_correct: string,
    letters_incorrect: string,
    letters_upcoming: string,
    mistake:boolean,
    complete: boolean,
}

type DiffWordProps = ReduxProps & {
    word: string,
    extra_style: CSSProperties | undefined,
}

type DiffWordState = {
    letter_data: LetterData,
}

class DiffWord extends React.Component<DiffWordProps, DiffWordState> {
    constructor(props: DiffWordProps) {
	super(props);

	this.state = {
	    letter_data: this.diff(props.word, props.attempt)
	}
    }

    diff(word: string, attempt: string) {
        var data: LetterData = {
	    letters_correct: '',
	    letters_incorrect: '',
	    letters_upcoming: '',
	    mistake: false,
	    complete: false,
	};

        var first_mistake = null;
        var i;

        if (word.length > attempt.length) {
            for (i = 0; i < attempt.length; i++) {
                if (word[i] !== attempt[i]) {
                    first_mistake = i;
                    break;
                } else {
                    data.letters_correct += attempt[i];
                }
            }

            if (first_mistake !== null) {
                // use two fors or if?
                for (i = first_mistake; i < attempt.length; i++) {
                    data.letters_incorrect += word[i];
                }

                for (i = attempt.length; i < word.length; i++) {
                    data.letters_upcoming += word[i];
                }
            } else {
                for (i = attempt.length; i < word.length; i++) {
                    data.letters_upcoming += word[i];
                }
            }
        } else if (word.length < attempt.length) {
            // this.state.attempt = this.state.attempt.slice(0, word.length) TODO

            for (i = 0; i < attempt.length; i++) {
                if (word[i] !== attempt[i]) {
                    first_mistake = i;
                    break;
                } else {
                    data.letters_correct += attempt[i];
                }
            }
            if (first_mistake !== null) {
                for (i = first_mistake; i < word.length; i++) {
                    data.letters_incorrect += word[i];
                }
            }
        } else {
            for (i = 0; i < word.length; i++) {
                if (word[i] !== attempt[i]) {
                    first_mistake = i;
                    break;
                } else {
                    data.letters_correct += word[i];
                }
            }

            if (first_mistake !== null) {
                for (i = first_mistake; i < word.length; i++) {
                    data.letters_incorrect += word[i];
                }
            } else {
                data.complete = true;
            }
        }

        data.mistake = first_mistake !== null;

        return data;
    }

    map_letters(letters_correct: string, letters_incorrect: string, letters_upcoming: string) {
	return (
	    <span style={this.props.extra_style}>
		{ letters_correct.length !== 0 ? <span className={this.props.style.class_correct} key="correct">{letters_correct}</span> : <span style={{color: "transparent", backgroundColor: "transparent"}}></span> }	
		{ letters_incorrect.length !== 0 ? <span className={this.props.style.class_incorrect} key="incorrect">{letters_incorrect}</span> : '' }
		{ this.props.attempt.length <= this.props.word.length ? <span className={this.props.style.fake_cursor}/> : ''}
		{ letters_upcoming.length !== 0 ? <span className={this.props.style.class_upcoming} key="upcoming">{letters_upcoming}</span> : '' }
	    </span>
	)
    }

    componentDidUpdate(prevProps: DiffWordProps, prevState: DiffWordState, snapshot: any) {
	if (this.props.attempt !== prevProps.attempt || this.props.word !== prevProps.word) {
	    var letter_data = this.diff(this.props.word, this.props.attempt);
	    this.setState({ letter_data:  letter_data });

	    this.props.update_word_complete(letter_data.complete); // TODO no need to update if no change?
	}
    }

    render() {
	const letters = this.map_letters(this.state.letter_data.letters_correct, this.state.letter_data.letters_incorrect, this.state.letter_data.letters_upcoming) ;// TODO: Decouple from render

	return letters;
    }
}

function mapState(state: Store) {
    return {
	style: state.style.text_diff,
	attempt: state.states.running.attempt
    }
}

const mapDispatch = {
    update_word_complete: action.update_word_complete,
    update_mistake_overflow: action.update_mistake_overflow
};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(DiffWord);
