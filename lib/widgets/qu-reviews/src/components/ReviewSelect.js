import { ToolbarGroup } from '@wordpress/components';
const { SelectControl } = wp.components;
const { useSelect } = wp.data;

const ReviewSelect = ( props ) => {
	const { categories, attributes, setAttributes } = props;
	const { categoryId, reviewId } = attributes;

	const reviews = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'ms_reviews', { ms_reviews_categories: categoryId, status: 'publish' } );
	} );

	let reviewOptions = [];

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

	if ( reviews ) {
		reviewOptions = [];

		if ( ! reviewId ) {
			setAttributes( { reviewId: reviews[ 0 ].id } );
		}

		for ( let i = 0; i < reviews.length; i++ ) {
			const option = {
				label: reviews[ i ].title.rendered.replaceAll( '^', '' ),
				value: reviews[ i ].id,
			};
			reviewOptions.push( option );
		}
	}

	const handleReviewSelect = ( value ) => {
		setAttributes( { reviewId: value } );
	};

	const handleCategorySelect = ( value ) => {
		setAttributes( { categoryId: value } );
	};

	return (
		<ToolbarGroup>
			<SelectControl
				label="Select Review Category"
				value={ categoryId }
				className="selectCategory"
				options={ categoryOptions }
				onChange={ ( value ) => handleCategorySelect( value ) }
			/>
			{ ( reviewOptions.length )
				? <SelectControl
					label="Select Review"
					value={ reviewId }
					className="selectReview"
					options={ reviewOptions }
					onChange={ ( value ) => handleReviewSelect( value ) }
				/>
				: null
			}
		</ToolbarGroup>

	);
};

export default ReviewSelect;
// export default compose(
// 	withSelect( ( select, props ) => {
// 		const { categoryId } = props.attributes;
// 		const { getEntityRecord, getEntityRecords } = select( 'core' );
// 		console.log( categoryId );
// 		if ( categoryId ) {
// 			if ( reviewsPosts.length ) {
// 				console.log( reviewsPosts );
// 				return {
// 					reviews: reviewsPosts,
// 				};
// 			}
// 		}
// 	} )
// )( ReviewSelect );
