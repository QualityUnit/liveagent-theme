const ProgressBar = ( props ) => {
	const { text, rating, color } = props;

	return (
		<div className="progressBar__wrapper">
			<strong className="progressBar__desc">{ text }</strong>
			<div className="progressBar">
				<div className="progressBar__inn" style={ { backgroundColor: color, width: rating / 5 * 100 } }></div>
			</div>
			<strong className="progressBar__rating">{ rating }</strong>
		</div>
	);
};

export default ProgressBar;
