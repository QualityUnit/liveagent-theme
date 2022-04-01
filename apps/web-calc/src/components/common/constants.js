export const production = true;
export const path = '/app/themes/liveagent/apps/web-calc/build/';

export const showWebCalcGenerator = window.location.hash.includes(
  'showWebCalcGenerator'
);

export { i18n } from './languages';

export const maxPages = 6;

export const webCalcName = 'WebCalc';
export const webCalcRaw = sessionStorage.getItem(webCalcName);
export const getWebCalcData = JSON.parse(webCalcRaw);
