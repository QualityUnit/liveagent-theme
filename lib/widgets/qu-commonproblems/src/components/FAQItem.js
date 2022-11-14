import Header from './Header';
import Editor from './Editor';

const FAQItem = ( props ) => {
	return (
		<div >
			<Header { ...props } />
			<Editor { ...props } />
		</div>
	);
};

export default FAQItem;
