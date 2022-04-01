import Block from './block';

const Columns = ( props ) => {
	const { attributes } = props;
	const { style } = attributes;

	return (
		<div className="Post__m__negative Statistics__columns">
			<Block { ...props } block="block1" styling={ style[ 0 ] } />
			<Block { ...props } block="block2" styling={ style[ 1 ] } />
			<Block { ...props } block="block3" styling={ style[ 2 ] } />
		</div>
	);
};

export default Columns;
