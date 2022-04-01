import React from 'react';

function Page(props) {
  const {page, customClass, tagText = 'Optional', title} = props;
  return(
    <div id={`page${page}`} className={`page page${page} ${customClass ? customClass : ''} ${page === 1 ? 'active':''}`}>
      {customClass === 'optional' 
         ? <span className="features--optional">{tagText}</span>
         : ''
      }
      <h2><span className="highlight-gradient">{page}. &nbsp;</span>{title}</h2>
      {props.children}
    </div>
  );
}

export default Page;
