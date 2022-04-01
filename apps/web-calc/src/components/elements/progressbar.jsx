import { maxPages, i18n } from '../common/constants';

function ProgressBar(props) {
  let value = parseFloat((props.page / maxPages * 100).toFixed(0))
  return(
    <div className="ProgressBar--wrapper">
      <label htmlFor="progress" className="ProgressBar--label" style={{width: value+'%'}}>{value} % <span className="desktop--only">{i18n.progress}</span></label>
      <progress id="progress" className="ProgressBar" value={value} max="100">{value} %</progress>
    </div>
  );
}

export default ProgressBar;
