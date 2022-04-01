import BlockWideFE from './blockWide';
import ColumnsFE from './columns';

const LayoutFullFE = ( props ) => {
	return (
		<>
			<BlockWideFE { ...props } />
			<ColumnsFE { ...props } />
		</>
	);
};

export default LayoutFullFE;
