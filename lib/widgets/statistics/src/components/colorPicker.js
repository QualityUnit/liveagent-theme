const { Button, Popover, ToolbarButton } = wp.components;
const { useState } = wp.element;

const ColorPicker = ( props ) => {
	const [ colorVisible, showColors ] = useState( false );
	const { setAttributes } = props;
	return (
		<ToolbarButton
			icon="art"
			label="Select Color"
			onClick={ () => showColors( ( state ) => ! state ) }
		>
			Color
			{ colorVisible && (
				<Popover className="Statistics--block__popover Statistics--block__popover-color">
					{ [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ].map( ( i ) => {
						return (
							<Button
								className={ `Statistics--block__popover-colorButton Statistics--block--color-${ i }` }
								key={ i }
								onClick={ () =>
									setAttributes( { color: `${ i }` } )
								}
							>
								Color { i }
							</Button>
						);
					} ) }
				</Popover>
			) }
		</ToolbarButton>
	);
};

export default ColorPicker;
