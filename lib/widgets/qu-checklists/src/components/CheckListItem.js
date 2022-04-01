import Header from './Header';
import Editor from './Editor';

const CheckListItem = ( props ) => {
	const { attributes } = props;
	const { isOpen } = attributes;

	return (
		<div className={ `qu-ChecklistItem ${ isOpen ? 'open' : '' }` }>
			<Header { ...props } />
			<Editor { ...props } />
		</div>
	);
};

export default CheckListItem;
