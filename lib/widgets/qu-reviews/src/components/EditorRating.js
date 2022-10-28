import ProgressBar from '../elements/ProgressBar';

const EditorRating = ( meta ) => {
	const { first_rating, first_rating_value, second_rating, second_rating_value, third_rating, third_rating_value, editor_avg } = meta;
	const colors = [ '#FFB928', '#48C6CE', '#FF492B' ];

	return (
		<div className="Reviews__rating editor">
			<div className="Reviews__rating--count mb-s">Editor`s Rating</div>
			<div className="flex flex-align-center">
				<span className="Reviews__rating--rating mr-s-tablet-landscape">{ editor_avg }</span>
				<div className="Reviews__rating--stars">
					<div className="Reviews__rating--stars__fill"
						style={ { width: `${ editor_avg / 5 * 103.3 }%` } }></div>
				</div>
			</div>
			<div className="Reviews__rating--progress">
				{ first_rating && first_rating_value
					? <ProgressBar text={ first_rating } rating={ first_rating_value } color={ colors[ 0 ] } /> : ''

				}
				{ second_rating && second_rating_value
					? <ProgressBar text={ second_rating } rating={ second_rating_value } color={ colors[ 1 ] } /> : ''
				}
				{ third_rating && third_rating_value
					? <ProgressBar text={ third_rating } rating={ third_rating_value } color={ colors[ 2 ] } /> : ''
				}
			</div>
		</div>
	);
};

export default EditorRating;
