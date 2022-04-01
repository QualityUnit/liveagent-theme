export enum Type {
    Keystroke,
    Backspace,
    CompleteWord,
}

interface Keystroke {
    type: Type.Keystroke,
    ms_timestamp: number,
    key: string,
    has_mistake: boolean // char?
}

interface Backspace {
    type: Type.Backspace,
    ms_timestamp: number,
}

interface CompleteWord {
    type: Type.CompleteWord,
    ms_timestamp: number,
    word: string,
}

// TODO Start text End text

type LogItem = Keystroke | Backspace | CompleteWord;

export default LogItem;
