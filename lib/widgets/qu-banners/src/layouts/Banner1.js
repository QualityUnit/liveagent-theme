import Button from '../components/Button';
import Editor from '../components/Editor';
const { TextControl } = wp.components;

const Banner1 = ( props ) => {
	const { attributes, setAttributes } = props;
	const { layout: banner } = attributes;
	const { header, activeStyle } = attributes[ banner ];

	return (
		<div
			className={ `qu-Banner qu-Banner-${ banner } ${ activeStyle }` }
		>
			<h3 className="qu-Banner--head">
				<TextControl
					className="qu-Banner__input  elementor-widget-text-editor text"
					hideLabelFromVision
					value={ header }
					onChange={ ( textVal ) => {
						setAttributes( { [ banner ]: { ...attributes[ banner ], header: textVal } } );
					} }
				/>
			</h3>
			<Editor { ...props } />
			<Button { ...props } />
		</div>
	);
};

export default Banner1;
