import AppState from "./app-state";
import LogItem from "./data-aggregate/log-item";

export enum Type {
    SwitchState = 'SwitchState',
    UpdateAttempt = 'UpdateAttempt',
    UpdateWordComplete = 'WordCompleted',
    UpdateWordSubmit = 'UpdateWordSubmit',
    UpdateMistakeOverflow = 'UpdateMistakeOverflow',
    AppendLogItem = 'AppendLogItem',
    UpdateWPMStats = 'UpdateWPMstats',
    UpdateWords = 'UpdateWords',
    FirstKeypress = 'FirstKeypress',
    NewRace = 'NewRace',
    DecrementTimer = 'DecrementTimer',
    SelectTimerDifficulty = "SelectTimerDifficulty",
}

interface SwitchState {
    type: Type.SwitchState,
    state: AppState
}
function switch_state(state: AppState) : Action {
    return {
	type: Type.SwitchState,
	state: state
    }
}

interface UpdateAttempt {
    type: Type.UpdateAttempt,
    attempt: string,
}
function update_attempt(attempt: string) : Action {
    return {
	type: Type.UpdateAttempt,
	attempt: attempt,
    }
}

interface UpdateMistakeOverflow {
    type: Type.UpdateMistakeOverflow,
    mistake_overflow: number
}
function update_mistake_overflow(mistake_overflow: number) : Action {
    return {
	type: Type.UpdateMistakeOverflow,
	mistake_overflow: mistake_overflow
    }
}

interface UpdateWordSubmit {
    type: Type.UpdateWordSubmit,
    submit: boolean
}
function update_word_submit(submit: boolean) : Action {
    return {
	type: Type.UpdateWordSubmit,
	submit: submit
    }
}

interface UpdateWordComplete {
    type: Type.UpdateWordComplete
    complete: boolean
}
function update_word_complete(complete: boolean) : Action {
    return {
	type: Type.UpdateWordComplete,
	complete: complete
    }
}

interface AppendLogItem {
    type: Type.AppendLogItem,
    item: LogItem
}
function append_log_item(item: LogItem) : Action {
    return {
	type: Type.AppendLogItem,
	item: item
    }
}

interface UpdateStats {
    type: Type.UpdateWPMStats,
    current_wpm: number,
    average_wpm: number,
    current_cpm: number,
    average_cpm: number,
    current_mpm: number,
    average_mpm: number
}
function update_stats(current_wpm: number, average_wpm: number, current_cpm: number, average_cpm: number, current_mpm: number, average_mpm: number) : Action {
    return {
	type: Type.UpdateWPMStats,
	current_wpm: current_wpm,
	average_wpm: average_wpm,
	current_cpm: current_cpm,
	average_cpm: average_cpm,
	current_mpm: current_mpm,
	average_mpm: average_mpm
    }
}

interface UpdateWords {
    type: Type.UpdateWords,
    words: string[]
}
function update_words(words: string[]) : Action {
    return {
	type: Type.UpdateWords,
	words: words
    } 
}

interface FirstKeypress {
    type: Type.FirstKeypress,
}
function first_keypress() : Action {
    return {
	type: Type.FirstKeypress
    }
}

interface NewRace {
    type: Type.NewRace,
}
function new_race() : Action {
    return {
	type: Type.NewRace
    }
}

interface DecrementTimer {
    type: Type.DecrementTimer,
}
function decrement_timer() : Action {
    return {
	type: Type.DecrementTimer
    }
}

interface SelectTimerDifficulty {
    type: Type.SelectTimerDifficulty,
    difficulty: string,
    timeout: number
}
function select_timer_difficulty(difficulty: string, timeout: number) : Action {
    return {
	type: Type.SelectTimerDifficulty,
	difficulty: difficulty,
	timeout: timeout
    }
}

type Action = SwitchState |
    UpdateAttempt |
    UpdateWordComplete |
    UpdateMistakeOverflow |
    UpdateWordSubmit |
    AppendLogItem |
    UpdateStats |
    UpdateWords |
    FirstKeypress |
    NewRace |
    DecrementTimer |
    SelectTimerDifficulty;
export const action = {
    switch_state: switch_state,
    update_attempt: update_attempt,
    update_word_complete: update_word_complete,
    update_word_submit: update_word_submit,
    update_mistake_overflow: update_mistake_overflow,
    append_log_item: append_log_item,
    update_stats: update_stats,
    update_words: update_words,
    first_keypress: first_keypress,
    new_race: new_race,
    decrement_timer: decrement_timer,
    select_timer_difficulty: select_timer_difficulty
}
export default Action;
