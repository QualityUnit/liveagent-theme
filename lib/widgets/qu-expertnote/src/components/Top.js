const { compose } = wp.compose;
const { withSelect } = wp.data;
const { TextControl } = wp.components;

const Top = ( props ) => {
	const { post, postCategory, image, attributes, setAttributes } = props;
	const { expertPosition, expertNote } = attributes;

	let imageSmall = null;

	const categoryName = () => {
		if ( postCategory ) {
			const txt = document.createElement( 'textarea' );
			txt.innerHTML = postCategory.name;
			return txt.value;
		}
		return null;
	};

	if ( image ) {
		imageSmall = image.media_details.sizes.logo_thumbnail;
	}

	if ( ! expertPosition ) {
		setAttributes( { expertPosition: categoryName() } );
	}

	return (
		<div className="qu-expertNote__top">
			<strong className="qu-expertNote__note">{ expertNote }</strong>
			<div className="qu-expertNote__expert">
				<div className="qu-expertNote__expert--image">
					<img alt={ post ? post.title.raw : '' } src={ imageSmall ? imageSmall.source_url : '' } />
				</div>
				<div className="qu-expertNote__expert--info">
					<p className="qu-expertNote__expert--name">{ post ? post.title.raw : '' }</p>
					<TextControl
						className="qu-expertNote__expert--position"
						value={ expertPosition }
						autoFocus
						onFocus={ ( e ) => e.currentTarget.select() }
						onChange={ ( value ) => setAttributes( { expertPosition: value } ) }
					/>
				</div>
			</div>
		</div>
	);
};

export default compose(
	withSelect( ( select, props ) => {
		const { expertId } = props.attributes;
		const { getEntityRecord, getMedia } = select( 'core' );
		const post = getEntityRecord( 'postType', 'ms_people', expertId );
		const mediaId = () => {
			if ( post ) {
				return post.featured_media;
			}
			return null;
		};

		return {
			post: post ? post : null,
			postCategory: post ? getEntityRecord( 'taxonomy', 'ms_people_categories', post.ms_people_categories[ 0 ] ) : null,
			image: mediaId() ? getMedia( mediaId() ) : null,
		};
	} )
)( Top );
