const { DropdownMenu } = wp.components;

const AlignPicker = ( props ) => {
	const { setAttributes } = props;

	return (
		<DropdownMenu
			icon="align-none"
			label="Align item"
			controls={ [
				{
					title: "Don't align",
					icon: 'align-none',
					onClick: () => setAttributes( { align: '' } ),
				},
				{
					title: 'Align Left',
					icon: 'align-left',
					onClick: () => setAttributes( { align: 'left' } ),
				},
				{
					title: 'Align Right',
					icon: 'align-right',
					onClick: () => setAttributes( { align: 'right' } ),
				},
				{
					title: 'Align Center',
					icon: 'align-center',
					onClick: () => setAttributes( { align: 'center' } ),
				},
			] }
		/>
	);
};

export default AlignPicker;
