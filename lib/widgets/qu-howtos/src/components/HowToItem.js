import Header from './Header';
import Editor from './Editor';

const { MediaPlaceholder } = wp.editor;

const HowToItem = ( props ) => {
	const { attributes, setAttributes } = props;
	const { schemaImage } = attributes;

	return (
		<div className="qu-HowToItem">
			<div className="qu-HowToItem__schemaImage--wrapper">
				{ schemaImage
					? <img className="qu-HowToItem__schemaImage" src={ schemaImage } alt="" />
					: <div className="qu-HowToItem__schemaImage placeholder"><h3>No Image</h3></div>
				}
				<MediaPlaceholder
					icon="format-image"
					labels={ {
						title: 'Insert Schema.org Image (optional)',
						instructions: 'Adds image for Schema.org microdata properties. This image is not visible on the actual web and it should be of a square aspect ratio. If no image is selected, fallback image is automatically used from the content or from post header.',
					} }
					className="qu-HowToItem__schemaImage--loader"
					onSelect={ ( el ) => {
						setAttributes( { schemaImage: el.url } );
					} }
					accept="image/*"
					allowedTypes={ [ 'image' ] }
				/>
			</div>
			<Header { ...props } />
			<Editor { ...props } />
		</div>
	);
};

export default HowToItem;
