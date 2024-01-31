import Button from '../components/Button';
import Editor from '../components/Editor';
const { TextControl } = wp.components;

const Banner1 = ( props ) => {
	const { attributes, setAttributes } = props;
	const { layout: banner, style, align } = attributes;
	const { header } = attributes[ banner ];

	return (
		<div
			className={ `Statistics--block ${ style }` }
		>
			<TextControl
				className="Statistics--block__input Statistics--block--text elementor-widget-text-editor text"
				hideLabelFromVision
				value={ header }
				onChange={ ( textVal ) => {
					setAttributes( { [ banner ]: { ...[ banner ], header: textVal } } );
				} }
			/>
			<Editor { ...props } />
			<Button { ...props } />
		</div>
	);
};

export default Banner1;
