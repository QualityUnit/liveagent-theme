const Rating = ( { rating, reviews_count } ) => {
	return (
		<div className="Reviews__rating">
			<span className="Reviews__rating--rating mr-s-tablet-landscape">{ rating }</span>
			<div className="Reviews__rating--stars">
				<div className="Reviews__rating--stars__fill"
					style={ { width: rating / 5 * 100 } }></div>
			</div>
			<div className="Reviews__rating--count">{ reviews_count } reviews</div>
		</div>
	);
};

export default Rating;
