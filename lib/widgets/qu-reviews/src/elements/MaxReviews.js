const { TextControl } = wp.components;

const MaxReviews = ( { attributes, setAttributes } ) => {
	const { maxReviews } = attributes;

	const handleMaxReviews = ( value ) => {
		setAttributes( { maxReviews: value } );
	};

	return <TextControl
		label="Show max.:"
		type="number"
		min="1"
		max="20"
		value={ maxReviews }
		onChange={ ( value ) => handleMaxReviews( value ) }
		style={ { marginBottom: 0 } }
	/>;
};

export default MaxReviews;
