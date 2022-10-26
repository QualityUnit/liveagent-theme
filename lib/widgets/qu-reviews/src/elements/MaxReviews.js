const { TextControl } = wp.components;

const MaxReviews = ( { attributes, setAttributes } ) => {
	const { maxReviews } = attributes;

	return <TextControl
		label="Show max.:"
		type="number"
		min="1"
		max="20"
		value={ maxReviews }
		onChange={ ( value ) => setAttributes( { maxReviews: value } ) }
		style={ { marginBottom: 0 } }
	/>;
};

export default MaxReviews;
