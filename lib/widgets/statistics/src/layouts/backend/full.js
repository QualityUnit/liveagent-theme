import BlockWide from './blockWide';
import Columns from './columns';

const LayoutFull = ( props ) => {
	return (
		<>
			<BlockWide { ...props } />
			<Columns { ...props } />
		</>
	);
};

export default LayoutFull;
