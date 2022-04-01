import React, { ReactNode } from 'react';

import { Store } from '../redux';
import { connect, ConnectedProps } from 'react-redux';
import { action } from '../action';
import { Type } from '../data-aggregate/log-item';

type TextFieldProps = ReduxProps & {
    lock: boolean,
}

type TextFieldState = {
    word_list: string,
    textarea: React.RefObject<HTMLTextAreaElement>,
}

class TextField extends React.Component<TextFieldProps, TextFieldState> {
    constructor(props: TextFieldProps) {
	super(props);

	const word_list = this.props.running.words.slice(0, this.props.running.position);
	if (word_list.length !== 0) {
	    var acc = '';

	    for (var word in word_list) {
		acc += word_list[word] + ' ';
	    }

	    this.state = {
		word_list: acc,
		textarea: React.createRef()
	    }
	} else {
	    this.state = {
		word_list: '',
		textarea: React.createRef()
	    }
	}
    }

    static has_mistake(word: string, attempt: string) {
        var first_mistake = null;
        var i;

        if (word.length > attempt.length) {
            for (i = 0; i < attempt.length; i++) {
                if (word[i] !== attempt[i]) {
                    first_mistake = i;
                    break;
                }
            }
        } else if (word.length < attempt.length) {
            first_mistake = word.length;
        } else {
            for (i = 0; i < word.length; i++) {
                if (word[i] !== attempt[i]) {
                    first_mistake = i;
                    break;
                }
            }
        }

        return first_mistake !== null;
    }

    onInputChange = (event: React.ChangeEvent<HTMLTextAreaElement>) => {
	const value = event.target.value;	

	if (value[value.length - 1] === ' ') {
	    this.props.update_word_submit(true);
	    this.props.update_attempt(value.slice(this.state.word_list.length, value.length - 1));
	} else if (this.props.running.position !== this.props.running.words.length - 1 || !this.props.running.complete) {
	    this.props.update_word_submit(false);
	    this.props.update_attempt(value.slice(this.state.word_list.length, value.length));
	}
    }

    onKeyDown = (event: React.KeyboardEvent<HTMLTextAreaElement>) => {
	var key = event.keyCode;

	let text_area = (event.target as HTMLTextAreaElement);
	text_area.setSelectionRange(text_area.value.length, text_area.value.length);

	if (key === 8) {
	    this.props.append_log_item({ type: Type.Backspace, ms_timestamp: new Date().valueOf() });
	} else if (key !== 32 && event.key.length === 1) {
	    this.props.append_log_item({
		type: Type.Keystroke,
		ms_timestamp: new Date().valueOf(),
		key: event.key,
		has_mistake: TextField.has_mistake(this.props.running.words[this.props.running.position], this.props.running.attempt + event.key)
	    });
	}

	if (!this.props.running.first_keypress) {
	    this.props.first_keypress();
	}
    }

    componentDidUpdate(prevProps: TextFieldProps, prevState: TextFieldState, snapshot: any) {
	if (this.state.textarea.current != null) { this.state.textarea.current.focus() }
	if (prevProps.running.words !== this.props.running.words || prevProps.running.position !== this.props.running.position) {
	    const word_list = this.props.running.words.slice(0, this.props.running.position);

	    if (word_list.length !== 0) {
		var acc = ''; // doesnt run if word_list.length === 1

		for (var word in word_list) {
		    acc += word_list[word] + ' ';
		}

		this.setState({
		    word_list: acc
		})
	    } else {
		this.setState({
		    word_list: ''
		})
	    }
	}
    }

    render() {
	// TODO code duplication
	if (!this.props.lock) {
	    return (
		<textarea className={this.props.style.class} ref={this.state.textarea} onKeyDown={this.onKeyDown} onChange={this.onInputChange} value={ this.state.word_list + this.props.running.attempt} autoFocus spellCheck="false"></textarea>
	    )
	} else {
	    return (
		<textarea readOnly className={this.props.style.class} onKeyDown={this.onKeyDown} onChange={this.onInputChange} value={ this.state.word_list + this.props.running.attempt} autoFocus spellCheck="false"></textarea>
	    )
	}
    }
}

function mapState(state: Store) {
    return {
	running: state.states.running,
	style: state.style.text_field,
    }
}

const mapDispatch = {
    update_attempt: action.update_attempt,
    update_word_submit: action.update_word_submit,
    append_log_item: action.append_log_item,
    first_keypress: action.first_keypress
};

const connector = connect(mapState, mapDispatch);
type ReduxProps = ConnectedProps<typeof connector>;
export default connector(TextField);
