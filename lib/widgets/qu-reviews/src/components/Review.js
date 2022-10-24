import parser from 'html-react-parser';

import Arrow from '../elements/Arrow';
import EditorRating from './EditorRating';
import Pricing from './Pricing';
import ProsCons from './ProsCons';
import Rating from './Rating';

const Review = ( { title, excerpt, meta, layout } ) => {
	const titleRendered = title.rendered.replaceAll( '^', '' );
	const excerptText = parser( excerpt.rendered.replaceAll( /\[|\]/g, '' ) );

	return (
		<div className="qu-Reviews__post">
			<div className="qu-Reviews__post--inn" title={ titleRendered }>
				<span className="qu-Reviews__post--number mr-xl-tablet" data-order>1</span>
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
						? <EditorRating { ...meta } />
						: null
				}

				<Arrow />
			</div>
			{
				layout === 'pricing'
					? <Pricing { ...meta } />
					: null
			}
			{
				layout === 'proscons'
					? <ProsCons pros={ meta.pros } cons={ meta.cons } />
					: null
			}

		</div>
	);
};

export default Review;
