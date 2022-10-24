const { SelectControl } = wp.components;

const LayoutPicker = ( { attributes, setAttributes } ) => {
	const { layout } = attributes;

	const LayoutOptions = [
		{
			label: 'Compact',
			value: '',
		},
		{
			label: 'Pricing',
			value: 'pricing',
		},
		{
			label: 'Pros & Cons',
			value: 'proscons',
		},
		{
			label: 'Editor Rating',
			value: 'editorrating',
		},
	];

	const handleLayout = ( value ) => {
		setAttributes( { layout: value } );
	};
	return (
		<SelectControl
			label="Layout:"
			value={ layout }
			className="selectLayout"
			options={ LayoutOptions }
			onChange={ ( value ) => handleLayout( value ) }
		/>
	);
};

export default LayoutPicker;
