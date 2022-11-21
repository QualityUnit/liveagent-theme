import Review from '../components/Review';
const { compose } = wp.compose;
const { withSelect } = wp.data;
const { useEffect } = wp.element;

const ReviewsSorted = ( props ) => {
	const { reviews, attributes, setAttributes } = props;
	const { layout, reviewsSorted } = attributes;

	useEffect( () => {
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
		setAttributes( { reviewsSorted: reviews } );
	}, [ reviews ] );

	return (

		<div className="qu-Reviews">
			{ reviewsSorted
				? ( reviewsSorted.map( ( reviewProps, number ) => {
					return <Review key={ reviewProps.id } number={ number + 1 } layout={ layout } { ...reviewProps } />;
				} ) )
				: null
			}
		</div>
	);
};

export default compose(
	withSelect( ( select, props ) => {
		const { categoryId, maxReviews } = props.attributes;
		const { getEntityRecords } = select( 'core' );
		const reviews = getEntityRecords( 'postType', 'ms_reviews', { ms_reviews_categories: categoryId, status: 'publish', per_page: maxReviews } );

		return {
			reviews: reviews ? reviews : null,
		};
	} )
)( ReviewsSorted );
