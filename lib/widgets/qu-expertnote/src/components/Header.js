/* eslint-disable */
const { TextareaControl } = wp.components;

const Header = ( props ) => {
	const { attributes, setAttributes } = props;
	const { header } = attributes;

	return (
		<div className="qu-expertNote__title">
			<TextareaControl
				value={ header }
				rows="2"
				onFocus={e => e.currentTarget.select()}
				onChange={ ( value ) => setAttributes( { header: value } ) }
			/>
		</div>
	);
};

export default Header;
