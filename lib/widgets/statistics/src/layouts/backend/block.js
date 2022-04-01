import URLInput from '../../components/urlInput';

const { TextControl, TextareaControl } = wp.components;

const Block = ( props ) => {
	const { block, styling, attributes, setAttributes } = props;
	const { color, align } = attributes;
	const { text, value, sourceData } = attributes[ block ];
	const data = { ...attributes[ block ] };

	return (
		<div
			className={ `Statistics--block Research--color-${ color } ${ styling } ${
				align ? `align-${ align }` : ''
			}` }
		>
			<TextareaControl
				className="Statistics--block__input Statistics--block--text elementor-widget-text-editor text"
				label="Text"
				hideLabelFromVision
				value={ text }
				onChange={ ( textVal ) => {
					data.text = textVal;
					setAttributes( { [ block ]: data } );
				} }
			/>
			<TextControl
				className="Statistics--block__input Statistics--block--value value"
				label="Value"
				hideLabelFromVision
				value={ value }
				onChange={ ( val ) => {
					data.value = val;
					setAttributes( { [ block ]: data } );
				} }
			/>
			<TextControl
				className="Statistics--block__input Statistics--block--source elementor-widget-text-editor source"
				label="Source"
				hideLabelFromVision
				value={ sourceData }
				onChange={ ( sourceVal ) => {
					data.sourceData = sourceVal;
					setAttributes( { [ block ]: data } );
				} }
			/>
			<URLInput block={ block } { ...props } />
		</div>
	);
};

export default Block;
