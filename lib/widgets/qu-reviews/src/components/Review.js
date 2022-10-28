import parser from 'html-react-parser';

import Arrow from '../elements/Arrow';
import EditorRating from './EditorRating';
import Pricing from './Pricing';
import ProsCons from './ProsCons';
import Rating from './Rating';

const Review = ( { title, excerpt, meta, layout, number } ) => {
	const titleRendered = title.rendered.replaceAll( '^', '' );
	let excerptText = excerpt.rendered.replaceAll( /<p.+?>(<span*?>(.+?)<\/span>)?(.+?)(\[.+?\])?<a.+?><\/p>/g, '$2$3' );
	excerptText = parser( `${ excerptText.split( ' ' ).splice( 0, 20 ).join( ' ' ) }…` );
	const round = ( num, precision ) => Number( Math.round( num + 'e+' + precision ) + 'e-' + precision );

	const editor_avg = round( ( ( +meta.first_rating_value + +meta.second_rating_value + +meta.third_rating_value ) / 3 ), 1 );

	return (
		<div className="qu-Reviews__post">
			<div className="qu-Reviews__post--inn" title={ titleRendered }>
				<span className="qu-Reviews__post--number mr-xl-tablet">{ number }</span>
				<div className="qu-Reviews__post--main">
					<h3 className="qu-Reviews__post--title">{ titleRendered }</h3>
					<div className="qu-Reviews__post--excerpt">{ excerptText }</div>
				</div>

				{ layout !== 'editorrating'
					? <Rating rating={ meta.rating } reviews_count={ meta.reviews_count } />
					: null
				}
				{
					layout === 'editorrating'
						? <EditorRating { ...meta } editor_avg={ editor_avg } />
						: null
				}

				<Arrow />
			</div>
			{
				( layout === 'pricing' || layout === 'proscons' )
					? <div className="qu-Reviews__post--data">
						{
							layout === 'pricing'
								? <Pricing { ...meta } />
								: null
						}
						{
							layout === 'proscons'
								? <ProsCons pros={ meta.pros } cons={ meta.cons } editor_avg={ editor_avg } />
								: null
						}
					</div>
					: null
			}
		</div>
	);
};

export default Review;
