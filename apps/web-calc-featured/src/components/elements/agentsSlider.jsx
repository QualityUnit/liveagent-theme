import React, { useEffect, useState } from 'react';
import {getWebCalcData, production, path, i18n} from '../common/constants';

function AgentsSlider(props) {
  let [agents, handleRange] = useState(10);
  let [showAgentsModal, setModal] = useState(false);
  let [custom_agents, setCustomAgents] = useState(100);
  let [emailInput, setEmail] = useState("");
  let [emailOk, validateEmail] = useState(false);
  let [gotError, setError] = useState(false);
  let [requestSent, setSend] = useState(false);
  let [isSubmitting, setSubmitting] = useState(false);

  const host = window.location.host;
  let formPath = `https://${host}/app/themes/liveagent/apps/web-calc-featured/build/form-to-la.php`;

  if(!production) {
    formPath = 'http://liveagent.local/app/themes/liveagent/apps/web-calc-featured/public/form-to-la.php';
  }

  const getValue = event => {
    handleRange(agents = Number(event.target.value));
    setTimeout(() => {
      props.returnAgents(agents);
    }, 10);
  };

  useEffect(() => {
    if(agents === 100) {
      setModal(true);
      handleRange(99);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [agents])

  const mailValidator = (email) => {
    const mailRegex = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
    const mailOk = new RegExp(mailRegex).test(email);
    validateEmail(mailOk);
  }

  const handleEmail = (event) => {
    setEmail(event.target.value);
    mailValidator(event.target.value);
  }

  const handleAgents = (event) => {
    setCustomAgents(event.target.value);
  }

  const handleSubmit = (event) => {
    event.preventDefault();
    
    if(emailOk) {
      setSubmitting(true);
      const requestOptions = {
          method: 'GET',
          mode: 'no-cors',
          headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' }
          // used for POST method we got rid off because firewall blocking it
          // body: JSON.stringify({"email":emailInput,"agents":custom_agents,"features":`${getSelectedFeaturesNamed()}`})
      };
      fetch(formPath + `?email=${emailInput}&agents=${custom_agents}&feature=${getWebCalcData()[0]}`, requestOptions)
          .then(response => response.json())
          .then(data => {
            if(data.response === 'OK') {
              setSubmitting(false);
              setSend(true);
              setTimeout(() => {
                setModal(false);
                setSend(false);
              }, 3000);
            }
            if(data.response === 'ERROR') {
              setSubmitting(false);
              setError(true);

              setTimeout(() => {
                setError(false);
              }, 3000)
            }
          });
    }
  }

  return(
    <div className={`AgentsSlider ${showAgentsModal ? 'has-modal' : ''}`}>
      <h4 className="subtitle--icon">
        <img src={`${production ? path:''}images/person.svg`} alt="Agents" />
        {i18n.agents_number}: { !agents ? '1' : agents }
      </h4>
      <input type="range" min="1" max="100" defaultValue={ !agents ? '1' : agents } style={{backgroundSize: ( !agents ? "1" : agents ) +"% 100%"}} onChange={getValue} />
      {showAgentsModal 
        ? <div className="AgentsSlider--modal">
            {requestSent
              ? <>
                  <h2>{i18n.agentsModal_sentTitle}</h2>
                  <p>
                    {i18n.agentsModal_sentText}
                  </p>
                </>
              : <>
                {isSubmitting
                  ? <div className="submitting">{i18n.sending}<span>.</span><span>.</span><span>.</span></div>
                  : null
                }
                <span className="modal--close" onClick={() => setModal(!showAgentsModal)}>&times;</span>
                <img className="AgentsSlider--modal__icon" src={`${production ? path:''}images/person.svg`} alt="Agents" />
                <h2>{i18n.agentsModal_title} <span className="highlight-gradient">{i18n.agentsModal_100}</span></h2>
                <p>
                  {i18n.agentsModal_text}
                </p>
                <form className="flex AgentsSlider--form" onSubmit={handleSubmit}>
                    <h4 className="subtitle--icon">
                      <img src={`${production ? path:''}images/person.svg`} alt="Agents" />
                      {i18n.custom_agents_number}: {custom_agents}
                    </h4>
                    <input className="AgentsSlider__custom-agents" name="agents" type="range" min="100" max="999" steps="1" value={custom_agents} style={{backgroundSize: (custom_agents / 899) * 100 - 11.123 + "% 100%"}} onChange={handleAgents} />
                  <label className="inputField--wrapper inputField--wrapper__hasIcon">
                    <svg className="inputField--icon" viewBox="0 0 20 16" xmlns="http://www.w3.org/2000/svg"><path d="M20 2c0-1.1-.9-2-2-2H2C.9 0 0 .9 0 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V2Zm-2 0-8 5-8-5h16Zm0 12H2V4l8 5 8-5v10Z" /></svg>
                    <input className="inputField" type="email" name="email" onChange={handleEmail} placeholder={i18n.enter_email} />
                  </label>
                    <button type="submit" name="submit" className="Button Button--full" disabled={!emailOk}>{i18n.contactus}</button>
                </form>
                {gotError
                    ? <h3 className="error">{i18n.agentsModal_sentError}</h3>
                    : null
                  }
              </>

            }
          </div>
        : null
      }
    </div>
  )
}

export default AgentsSlider;
