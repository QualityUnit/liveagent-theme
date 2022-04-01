/* eslint-disable */
const { TextControl } = wp.components;

const Header = ( props ) => {
	const { attributes, setAttributes } = props;
	const { header, isOpen } = attributes;

	const handleOpening = ( event ) => {
		if ( event.target !== event.currentTarget ) {
			return;
		}
		setAttributes( { isOpen: ! isOpen } );
	};

	return (
		<div className="qu-ChecklistItem__header" onClick={ handleOpening }>
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
