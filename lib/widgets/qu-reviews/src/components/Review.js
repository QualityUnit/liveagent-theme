const { useSelect } = wp.data;

const Review = ( props ) => {
	const { attributes, setAttributes } = props;
	const { reviewId, reviewMeta } = attributes;

	return (
		<div className="qu-expertNote__top">
			<strong className="qu-expertNote__note"></strong>
			<div className="qu-expertNote__expert">

			</div>
		</div>
	);
};

export default Review;
