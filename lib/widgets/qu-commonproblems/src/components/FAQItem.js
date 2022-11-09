import Header from './Header';
import Editor from './Editor';

const FAQItem = ( props ) => {
	return (
		<div className="qu-CommonProblems__item">
			<Header { ...props } />
			<Editor { ...props } />
		</div>
	);
};

export default FAQItem;
