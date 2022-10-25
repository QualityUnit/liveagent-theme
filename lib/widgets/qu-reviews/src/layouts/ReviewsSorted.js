import Review from '../components/Review';
const { useSelect } = wp.data;

const ReviewsSorted = ( { attributes, setAttributes } ) => {
	const { categoryId, layout, maxReviews } = attributes;

	const reviews = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'ms_reviews', { ms_reviews_categories: categoryId, status: 'publish', per_page: maxReviews } );
	} );

	if ( reviews && ( layout !== 'editorrating' ) ) {
		reviews.sort( ( reviewA, reviewB ) => {
			return reviewB.meta.rating - reviewA.meta.rating;
		} );
		setAttributes( { reviewsSorted: reviews } );
	}

	if ( reviews && ( layout === 'editorrating' ) ) {
		reviews.sort( ( reviewA, reviewB ) => {
			const metaA = reviewA.meta;
			const metaB = reviewB.meta;
			const averageA = ( +metaA.first_rating_value + +metaA.second_rating_value + +metaA.third_rating_value ) / 3;
			const averageB = ( +metaB.first_rating_value + +metaB.second_rating_value + +metaB.third_rating_value ) / 3;
			return averageB - averageA;
		} );
		setAttributes( { reviewsSorted: reviews } );
	}

	return (

		<div className="qu-Reviews">
			{ reviews
				? ( reviews.map( ( reviewProps, number ) => {
					return <Review key={ reviewProps.id } number={ number + 1 } layout={ layout } { ...reviewProps } />;
				} ) )
				: null
			}
		</div>
	);
};

export default ReviewsSorted;
