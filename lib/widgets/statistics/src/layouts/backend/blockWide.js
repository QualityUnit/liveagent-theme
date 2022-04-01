import MediaUploader from '../../components/mediaUploader';
import URLInput from '../../components/urlInput';

const { TextControl, TextareaControl } = wp.components;

const BlockWide = ( props ) => {
	const { attributes, setAttributes } = props;
	const { color } = attributes;
	const { header, text, value, sourceData } = attributes.blockWide;
	const data = { ...attributes.blockWide };

	return (
		<div
			className={ `Statistics--block Statistics--block__wide Post__m__negative Research--color-${ color }` }
		>
			<TextControl
				className="Statistics--block__input Statistics--block--text elementor-widget-text-editor Statistics--block__wide--header"
				label="Text"
				hideLabelFromVision
				value={ header }
				onChange={ ( headerVal ) => {
					data.header = headerVal;
					setAttributes( {
						blockWide: data,
					} );
				} }
			/>
			<div className="Statistics--block__wide--top">
				<TextControl
					className="Statistics--block__input Statistics--block--value value"
					label="Value"
					hideLabelFromVision
					value={ value }
					onChange={ ( val ) => {
						data.value = val;
						setAttributes( {
							blockWide: data,
						} );
					} }
				/>
				<div className="elementor-widget-text-editor text no-color">
					<TextareaControl
						className="Statistics--block__input Statistics--block--text elementor-widget-text-editor text"
						label="Text"
						hideLabelFromVision
						value={ text }
						onChange={ ( textVal ) => {
							data.text = textVal;
							setAttributes( {
								blockWide: data,
							} );
						} }
					/>
					<TextControl
						className="Statistics--block__input Statistics--block--source elementor-widget-text-editor source"
						label="Source"
						hideLabelFromVision
						value={ sourceData }
						onChange={ ( sourceVal ) => {
							data.sourceData = sourceVal;
							setAttributes( {
								blockWide: data,
							} );
						} }
					/>
				</div>
			</div>
			<div className="Statistics--block__wide--image">
				<MediaUploader { ...props } />
			</div>
			<URLInput block="blockWide" { ...props } />
		</div>
	);
};

export default BlockWide;
