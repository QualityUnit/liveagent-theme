enum AppState {
    Start,
    Running,
    End,
}

export { default as Start } from './start';
export { default as Running } from './running';
export { default as End } from './end';
export { AppState };
export default AppState;
