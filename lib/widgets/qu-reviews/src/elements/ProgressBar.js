const ProgressBar = ( { text, rating, color } ) => {
	return (
		<div className="progressBar__wrapper">
			<strong className="progressBar__desc">{ text }</strong>
			<div className="progressBar">
				<div className="progressBar__inn visible" style={ { backgroundColor: color, width: `${ rating / 5 * 103.3 }%` } }></div>
			</div>
			<strong className="progressBar__rating">{ rating }</strong>
		</div>
	);
};

export default ProgressBar;
