import BlockFE from './block';

const ColumnsFE = ( props ) => {
	const { style } = props.attributes;

	return (
		<div className="Post__m__negative Statistics__columns">
			<BlockFE { ...props } block="block1" styling={ style[ 0 ] } />
			<BlockFE { ...props } block="block2" styling={ style[ 1 ] } />
			<BlockFE { ...props } block="block3" styling={ style[ 2 ] } />
		</div>
	);
};

export default ColumnsFE;
