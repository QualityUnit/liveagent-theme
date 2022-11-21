import Header from './Header';
import Editor from './Editor';

const CommonProblem = ( props ) => {
	return (
		<div >
			<Header { ...props } />
			<Editor { ...props } />
		</div>
	);
};

export default CommonProblem;
