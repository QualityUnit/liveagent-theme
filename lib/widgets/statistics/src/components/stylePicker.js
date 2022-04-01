const { Popover, ToolbarButton } = wp.components;
const { useState } = wp.element;

const StylePicker = ( props ) => {
	const [ styleVisible, showStyle ] = useState( false );
	const { attributes, setAttributes } = props;
	const { style } = attributes;
	return (
		<ToolbarButton
			icon="admin-customizer"
			label="Select Style"
			onClick={ () => showStyle( ( state ) => ! state ) }
		>
			Style
			{ styleVisible && (
				<Popover className="Statistics--block__popover Statistics--block__popover-style">
					<img
						style={ {
							width: '10em',
							marginBottom: '1em',
							cursor: 'pointer',
						} }
						src={ `${ images.url }/researchFull.png` }
						alt="nothing here"
						onClick={ () =>
							setAttributes( {
								activeStyle: style[ 0 ],
							} )
						}
					/>
					<img
						style={ {
							width: '13em',
							cursor: 'pointer',
						} }
						src={ `${ images.url }/researchWhite.png` }
						alt="nothing here"
						onClick={ () =>
							setAttributes( { activeStyle: style[ 1 ] } )
						}
					/>
					<img
						style={ {
							width: '10em',
							marginBottom: '1em',
							cursor: 'pointer',
						} }
						src={ `${ images.url }/researchGrey.png` }
						alt="nothing here"
						onClick={ () =>
							setAttributes( {
								activeStyle: style[ 2 ],
							} )
						}
					/>
				</Popover>
			) }
		</ToolbarButton>
	);
};

export default StylePicker;
