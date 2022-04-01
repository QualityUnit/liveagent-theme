/* eslint-disable */
const { TextControl, CheckboxControl } = wp.components;

const CustomAction = ( props ) => {
	const { attributes, setAttributes } = props;
	const { customActionText, customAction } = attributes;

	return (
		<div className="qu-ChecklistItem__footer">
				{customAction ?
						<TextControl
							className="Button Button--outline"
							value={ customActionText }
							autoFocus
							onFocus={e => e.currentTarget.select()}
							onChange={ ( value ) =>
								setAttributes( { customActionText: value } )
							}
						/>
					: null
				}
				<CheckboxControl 
					label={ customAction ? '':'Add custom action button' }
					checked={ customAction }
					onChange={ () =>
						setAttributes( { customAction: !customAction } )
					}
				/>
			</div>
	);
};

export default CustomAction;
