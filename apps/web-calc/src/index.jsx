import React from 'react';
import ReactDOM from 'react-dom';
import {saveToStorage, useStateSessionStorage} from './components/common/sessionStorage';
import { maxPages, getWebCalcData } from './components/common/constants';
import getSelectedFeatures from './components/common/results/baseCalculations';

/* Import assets */
import './assets/style/webcalc.scss';
import useHandlePagination from './components/common/pagination';

/* Import elements */
import ProgressBar from './components/elements/progressbar';
import PrevButton from './components/elements/prevBtn';
import NextButton from './components/elements/nextBtn';

/* Import pages */
import Page1 from './components/layouts/page1';
import AllFeatures from './components/layouts/allFeatures';
import FinalResults from './components/layouts/finalResults';

function App() {
  const { ispreset } = getWebCalcData;
	const [ currentPage, setPage ] = useHandlePagination( 1 );
	const [ continueVal, willContinue ] = useStateSessionStorage( 'select1' );
	const [ waspreset, setWasPreset ] = useStateSessionStorage( 'waspreset' );

	const canContinue = ( continueVal ) => {
		willContinue( continueVal );
	};

	// Clears preset from sessionStorage and returns back to alternative selection of first feature page
	const backToStart = (backToStart) => {
		if(!ispreset && !waspreset) {
			saveToStorage('select1', false);
			willContinue( false );
			saveToStorage('select2', false);
			saveToStorage('select3', false);
			saveToStorage('agents', 1);

			getSelectedFeatures().map(feature => {
				saveToStorage(feature, false);
				return false;
			});
		}

		if(ispreset || waspreset) {
			saveToStorage('agents', 1);
			saveToStorage('ispreset', false);

			getSelectedFeatures().map(feature => {
				saveToStorage(feature, false);
				return false;
			})
			setWasPreset('waspreset');
		}
		setPage(backToStart);
	}


	return ( currentPage < maxPages ) && !ispreset ? (
		<div className="webcalc--main__inn">
			{ currentPage === 1 ? (
				<Page1 canContinue={ canContinue } page={ currentPage } />
			) : currentPage > 1 && currentPage < 6 ? (
				<AllFeatures currentPage={ currentPage } />
			) : null }

			<ProgressBar page={ currentPage } />

			<div className="PaginationButtons">
				{!waspreset || currentPage > 2
				? <PrevButton
						page={ currentPage }
						onPress={ () => setPage( currentPage - 1 ) }
					/>
				: null
				}
				<NextButton
					canContinue={ continueVal }
					onPress={ () => setPage( currentPage + 1 ) }
					islast={ currentPage === maxPages - 1 }
				/>
			</div>
		</div>
	) : (
		<div className="webcalc--main__inn">
			<FinalResults backToStart={ backToStart } page={ currentPage } />
		</div>
	);
}

ReactDOM.render( <App />, document.getElementById( 'webcalcroot' ) );
