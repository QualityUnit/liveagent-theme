const { SelectControl } = wp.components;
const { compose } = wp.compose;
const { withSelect } = wp.data;

const ReviewSelect = ( props ) => {
	const { attributes, setAttributes } = props;
	const { reviewId, postCategory } = attributes;

	if ( ! props.posts ) {
		return (
			<div className="selectExpert loading">
				<label htmlFor="">Loading...</label>
			</div>
		);
	}

	if ( props.posts.length === 0 ) {
		return (
			<div className="selectExpert loading error">
				<label htmlFor="">No posts</label>
			</div>
		);
	}

	const options = [];
	for ( let i = 0; i < props.posts.length; i++ ) {
		const option = {
			label: props.posts[ i ].title.rendered,
			value: props.posts[ i ].id,
		};
		options.push( option );
	}

	const categoryName = () => {
		if ( postCategory ) {
			const txt = document.createElement( 'textarea' );
			txt.innerHTML = postCategory.name;
			return txt.value;
		}
		return null;
	};

	const handleExpertSelect = ( value ) => {
		setAttributes( { reviewId: value } );
		setAttributes( { expertPosition: categoryName() } );
	};

	return (
		<SelectControl
			label="Select Expert"
			value={ reviewId }
			className="selectExpert"
			options={ options }
			onChange={ ( value ) => handleExpertSelect( value ) }
		/>
	);
};

export default compose(
	withSelect( ( select, props ) => {
		const { reviewId } = props.attributes;
		const { getEntityRecord } = select( 'core' );
		const post = getEntityRecord( 'postType', 'ms_reviews', reviewId );

		return {
			post: post ? post : null,
			postCategory: post ? getEntityRecord( 'taxonomy', 'ms_reviews_categories', post.ms_reviews_categories[ 0 ] ) : null,
		};
	} )
)( ReviewSelect );
