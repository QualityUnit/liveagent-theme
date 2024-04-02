import { createStore } from 'redux';
import {produce} from "immer";

import AppState from './app-state';
import Action, { Type as ActionType } from './action';
import DataAggregate from './data-aggregate';
import { Type as LogItemType } from './data-aggregate/log-item';

import { Texts, Text, Localization, get_locale } from './localization';

export interface Store {
    app_state: AppState,
    all_texts: Texts,
    localization: Localization,
    selected_difficulty: string | null,
    selected_timeout: number | null,
    data_aggregate: {
	instance: DataAggregate,
	chunking_interval: number,
	current_wpm: number,
	average_wpm: number,
	current_cpm: number,
	average_cpm: number,
	current_mpm: number,
	average_mpm: number,
	words: number
    },
    states: {
	running: {
	    position: number,
	    current_text: Text | null,
	    words: string[],
	    attempt: string,
	    complete: boolean,
	    submit: boolean,
	    mistake_overflow: number,
	    first_keypress: boolean,
	    timeout: number,
	},
    },
    style: {
	text_diff: {
	    class_correct: string,
	    class_incorrect: string,
	    class_upcoming: string,
	    fake_cursor: string
	},
	text_field: {
	    class: string
	}
	text: {
	    class_complete: string,
	    class_upcoming: string,
	    class_incorrect: string,
	    text_spacing: string,
	    fake_cursor: string,
	    class_scrolling_main: string,
	    class_scrolling_left: string,
	    class_scrolling_right: string
	}
    }
}

const CHUNKING_INTERVAL = 1000;

const locale = get_locale()
const initial_store: Store = {
    app_state: AppState.Start,
    all_texts: locale[0],
    localization: locale[1],
    selected_difficulty: null,
    selected_timeout: null,
    data_aggregate: {
	instance: new DataAggregate(CHUNKING_INTERVAL),
	chunking_interval: CHUNKING_INTERVAL,
	current_wpm: 0,
	average_wpm: 0,
	current_cpm: 0,
	average_cpm: 0,
	current_mpm: 0,
	average_mpm: 0,
	words: 0
    },
    states: {
	running: {
	    position: 0,
	    current_text: null,
	    words: [],
	    attempt: '',
	    complete: false,
	    submit: false,
	    mistake_overflow: 0,
	    first_keypress: false,
	    timeout: 60
	},
    },
    style: {
	text_diff: {
	    class_correct: "TypingTest__letter--correct",
	    class_incorrect: "TypingTest__letter--incorrect",
	    class_upcoming: "TypingTest__letter--upcoming",
	    fake_cursor: "TypingTest__fake-cursor TypingTest__fake-cursor-diff"
	},
	text_field: {
	    class: "TypingTest__text-field"
	},
	text: {
	    class_complete: "TypingTest__word--complete",
	    class_upcoming: "TypingTest__word--upcoming",
	    class_incorrect: "TypingTest__word--incorrect",
	    text_spacing: "0 0 0.2rem 0.2rem",
	    fake_cursor: "TypingTest__fake-cursor TypingTest__fake-cursor-text",
	    class_scrolling_main: "TypingTest__scrolling--main",
	    class_scrolling_left: "TypingTest__scrolling--left",
	    class_scrolling_right: "TypingTest__scrolling--right"
	}
    }
}

function reducer(state = initial_store, action: Action) : Store {
    return produce (state, draft => {
	console.log("ASDSADS" + draft.localization.choose_test_diff);
	switch (action.type) {
	    case ActionType.SwitchState:
		draft.app_state = action.state;
		break;
	    case ActionType.UpdateAttempt:
		draft.states.running.attempt = action.attempt.replace(/\s(?!$)/g, '');

		if (state.states.running.complete && state.states.running.submit && state.states.running.words != null) {
		    if (state.states.running.position + 1 < state.states.running.words.length) {
			draft.states.running.attempt = "";
			draft.states.running.position++;
			state.data_aggregate.instance.append_item(
			    {
				type: LogItemType.CompleteWord,
				ms_timestamp: new Date().valueOf(),
				word: state.states.running.attempt
			    });
		    } else {
			draft.app_state = AppState.End
		    }
		}

		break;
	    case ActionType.UpdateWordComplete:
		draft.states.running.complete = action.complete;
		break;
	    case ActionType.UpdateWordSubmit:
		draft.states.running.submit = action.submit;
		break;
	    case ActionType.AppendLogItem:
		draft.data_aggregate.instance.append_item(action.item);
		break;
	    case ActionType.UpdateWPMStats:
		draft.data_aggregate.average_wpm = action.average_wpm;
		draft.data_aggregate.current_wpm = action.current_wpm;
		draft.data_aggregate.average_mpm = action.average_mpm;
		draft.data_aggregate.current_mpm = action.current_mpm;
		draft.data_aggregate.average_cpm = action.average_cpm;
		draft.data_aggregate.current_cpm = action.current_cpm;
		break;
	    case ActionType.UpdateWords:
		draft.states.running.words = action.words;
		break;
	    case ActionType.FirstKeypress:
		draft.states.running.first_keypress = true;
		break;
	    case ActionType.NewRace:
		draft.data_aggregate.instance.chunked_data = [];
		draft.data_aggregate.average_cpm = 0;
		draft.data_aggregate.average_wpm = 0;
		draft.data_aggregate.average_mpm = 0;
		draft.data_aggregate.current_cpm = 0;
		draft.data_aggregate.current_wpm = 0;
		draft.data_aggregate.current_mpm = 0;

		draft.states.running.attempt = '';
		draft.states.running.position = 0;

		draft.states.running.first_keypress = false;

		{
		    let difficultied_text = state.all_texts.texts.get(state.selected_difficulty === null ? "easy" : state.selected_difficulty);
		    if (difficultied_text && state.selected_timeout) {
			const text_index = Math.floor(Math.random() * difficultied_text.length);

			draft.states.running.current_text = difficultied_text[text_index];
			draft.states.running.timeout = state.selected_timeout;
			draft.states.running.words = difficultied_text[text_index].text.split(' ');
		    } else {
			console.log("invalid difficulty");
			console.log(state.all_texts.texts);
			console.log(state.selected_difficulty);
		    }
		}

		draft.data_aggregate.words = draft.states.running.words.length;

		draft.app_state = AppState.Running;
		break;
	    case ActionType.SelectTimerDifficulty:
		draft.selected_difficulty = action.difficulty;
		draft.selected_timeout = action.timeout;
		break;
	    case ActionType.DecrementTimer:
		draft.states.running.timeout--;
		if (draft.states.running.timeout <= 0) {
		    draft.app_state = AppState.End;
		}
		break;
	    default:
		break;
	}
    })// TODO: more concrete types here
}

export const store = createStore<Store, Action, any, any>(reducer);
