import ProgressBar from '../elements/ProgressBar';

const EditorRating = ( meta ) => {
	const round = ( num, precision ) => Number( Math.round( num + 'e+' + precision ) + 'e-' + precision );

	const average = round( ( ( +meta.first_rating_value + +meta.second_rating_value + +meta.third_rating_value ) / 3 ), 1 );

	const { first_rating, first_rating_value, second_rating, second_rating_value, third_rating, third_rating_value } = meta;
	const colors = [ '#FFB928', '#48C6CE', '#FF492B' ];

	return (
		<>
			<h3>{ average }</h3>
			{ first_rating && first_rating_value
				? <ProgressBar text={ first_rating } rating={ first_rating_value } color={ colors[ 0 ] } /> : ''

			}
			{ second_rating && second_rating_value
				? <ProgressBar text={ second_rating } rating={ second_rating_value } color={ colors[ 1 ] } /> : ''
			}
			{ third_rating && third_rating_value
				? <ProgressBar text={ third_rating } rating={ third_rating_value } color={ colors[ 2 ] } /> : ''
			}
		</>
	);
};

export default EditorRating;
