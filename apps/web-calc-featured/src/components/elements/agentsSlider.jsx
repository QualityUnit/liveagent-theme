import React, { useEffect, useState } from 'react';
import {production, path, i18n} from '../common/constants';

function AgentsSlider(props) {
	let [agents, handleRange] = useState(1);
	let [showAgentsModal, setModal] = useState(false);

	const getValue = event => {
		handleRange(agents = Number(event.target.value));
		setTimeout(() => {
			props.returnAgents(agents);
		}, 10);
	};

  const formScript = () => {
    (function(d, src, c) { var t=d.scripts[d.scripts.length - 1],s=d.createElement('script');s.id='la_x2s6df8d';s.async=true;s.src=src;s.onload=s.onreadystatechange=function(){var rs=this.readyState;if(rs&&(rs!='complete')&&(rs!='loaded')){return;}c(this);};t.parentElement.insertBefore(s,t.nextSibling);})(document, 'https://support.qualityunit.com/scripts/track.js', function(e){ LiveAgent.createForm('0w1pzaj4', e); });  // eslint-disable-line
  }

	agents=JSON.parse(agents);

	useEffect(() => {
		if(agents === 100) {
			// setModal(true);
			handleRange(99);
		}

		// eslint-disable-next-line react-hooks/exhaustive-deps
	}, [agents])

	return(
			<div className={`AgentsSlider ${showAgentsModal ? 'has-modal' : ''}`}>
				<h4 className="subtitle--icon">
					<img src={`${production ? path:''}images/person.svg`} alt="Agents" />
					{i18n.agents_number}: { !agents ? '1' : agents }
				</h4>
				<input type="range" min="1" max="100" defaultValue={ !agents ? '1' : agents } style={{backgroundSize: ( !agents ? "1" : agents ) +"% 100%"}} onChange={getValue} />
				{showAgentsModal
        ? <div className="AgentsSlider--modal">
						<span className="modal--close" onClick={() => setModal(!showAgentsModal)}>&times;</span>
						<img className="AgentsSlider--modal__icon" src={`${production ? path:''}images/person.svg`} alt="Agents" />
						<h2>{i18n.agentsModal_title} <span className="highlight-gradient">{i18n.agentsModal_100}</span></h2>
						<p>
							{i18n.agentsModal_text}
						</p>
						<script>
                  {formScript()}
                </script>
          </div>
        : null
      }
			</div>
	)
}

export default AgentsSlider;
