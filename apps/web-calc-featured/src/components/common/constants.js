export const production = true;
export const path = '/app/themes/liveagent/apps/web-calc-featured/build/';

export const showWebCalcGenerator = document.querySelector('#calcfeatured').dataset.showgenerator;

export { i18n } from './languages';

export const webCalcName = 'WebCalcFeatured';
const webCalcRaw = sessionStorage.getItem(webCalcName);
export const getWebCalcData = () => {
  return JSON.parse(webCalcRaw);
}
