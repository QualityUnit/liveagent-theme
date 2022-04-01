import React from 'react';
import ReactDOM from 'react-dom';

/* Import assets */
import './assets/style/webcalc.scss';

/* Import pages */
import FinalResults from './components/layouts/finalResults';

function App() {

	return (
		<div className="calcfeatured--main__inn">
			<FinalResults />
		</div>
	);
}

ReactDOM.render( <App />, document.getElementById( 'calcfeatured' ) );
