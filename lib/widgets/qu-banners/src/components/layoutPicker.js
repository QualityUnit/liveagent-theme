const { DropdownMenu } = wp.components;

const LayoutPicker = ( props ) => {
	const { setAttributes } = props;

	return (
		<DropdownMenu
			icon="layout"
			label="Select Layout"
			controls={ [
				{
					title: 'Full',
					icon: () => {
						return (
							<svg viewBox="0 0 48 48">
								<path d="M.028.024h47.909v18.02H.028zM-.017 21.236h13.951v26.77H-.016zM17.049 21.236h13.9v26.84h-13.9zM33.89 21.236h14.047v26.84H33.89z" />
							</svg>
						);
					},
					onClick: () => setAttributes( { layout: 'full' } ),
				},
				{
					title: '3 columns',
					icon: () => {
						return (
							<svg viewBox="0 0 48 48">
								<path d="M-.017 10.611h13.951v26.77H-.016zM17.049 10.575h13.9v26.84h-13.9zM33.89 10.575h14.047v26.84H33.89z" />
							</svg>
						);
					},
					onClick: () => setAttributes( { layout: 'columns' } ),
				},
				{
					title: 'Single',
					icon: () => {
						return (
							<svg viewBox="0 0 48 48">
								<path d="M-.003 7.658h13.95V40.33H-.002zM18.666 12.494H48v8.87H18.666zM18.666 26.636H48v8.87H18.666z" />
							</svg>
						);
					},
					onClick: () => setAttributes( { layout: 'single' } ),
				},
				{
					title: 'Single Full Width',
					icon: 'align-full-width',
					onClick: () => setAttributes( { layout: 'singleWide' } ),
				},
			] }
		/>
	);
};

export default LayoutPicker;
