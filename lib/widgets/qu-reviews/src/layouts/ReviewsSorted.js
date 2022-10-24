import Review from '../components/Review';
const { useSelect } = wp.data;

const ReviewsSorted = ( { attributes } ) => {
	const { categoryId, layout } = attributes;

	const reviews = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'ms_reviews', { ms_reviews_categories: categoryId, status: 'publish' } );
	} );

	if ( reviews && ( layout !== 'editorrating' ) ) {
		reviews.sort( ( reviewA, reviewB ) => {
			return reviewB.meta.rating - reviewA.meta.rating;
		} );
	}

	if ( reviews && ( layout === 'editorrating' ) ) {
		reviews.sort( ( reviewA, reviewB ) => {
			const metaA = reviewA.meta;
			const metaB = reviewB.meta;
			const averageA = ( +metaA.first_rating_value + +metaA.second_rating_value + +metaA.third_rating_value ) / 3;
			const averageB = ( +metaB.first_rating_value + +metaB.second_rating_value + +metaB.third_rating_value ) / 3;
			return averageB - averageA;
		} );
	}

	return (

		<div className="qu-Reviews">
			{ reviews
				? ( reviews.map( ( reviewProps ) => {
					return <Review key={ reviewProps.id } layout={ layout } { ...reviewProps } />;
				} ) )
				: null
			}
		</div>
	);
};

export default ReviewsSorted;
