const { SelectControl } = wp.components;

const CategorySelect = ( { categories, attributes, setAttributes } ) => {
	const { categoryId } = attributes;

	const categoryOptions = [];
	for ( let i = 0; i < categories.length; i++ ) {
		if ( categories[ i ].count ) {
			const option = {
				label: categories[ i ].name,
				value: categories[ i ].id,
			};
			categoryOptions.push( option );
		}
	}

	const handleCategorySelect = ( value ) => {
		setAttributes( { categoryId: value } );
		setAttributes( { reviewsSorted: null } );
	};

	return (
		<>
			<SelectControl
				label="Review Category:"
				value={ categoryId }
				className="selectCategory"
				options={ categoryOptions }
				onChange={ ( value ) => handleCategorySelect( value ) }
			/>
		</>
	);
};

export default CategorySelect;
