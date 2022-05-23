/* eslint-disable */
const { TextControl } = wp.components;

const Header = ( props ) => {
	const { attributes, setAttributes } = props;
	const { header } = attributes;

	return (
		<div className="qu-HowToItem__header">
			<TextControl
				value={ header }
				autoFocus
				onFocus={e => e.currentTarget.select()}
				onChange={ ( value ) => setAttributes( { header: value } ) }
			/>
		</div>
	);
};

export default Header;
