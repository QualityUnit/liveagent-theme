const { Button, Spinner } = wp.components;
const { MediaUpload, MediaUploadCheck } = wp.editor;
const { compose } = wp.compose;
const { withSelect } = wp.data;

const ALLOWED_MEDIA_TYPES = [ 'image' ];

const MediaUploader = ( props ) => {
	const { uploadedImage, attributes, setAttributes } = props;
	const { header, imageId } = attributes.blockWide;
	const data = { ...attributes.blockWide };

	const onUpdateImage = ( image ) => {
		data.imageId = image.id;
		data.imageUrl = image.url;
		setAttributes( { blockWide: data } );
	};

	return (
		<MediaUploadCheck>
			<MediaUpload
				title={ 'Upload image' }
				onSelect={ onUpdateImage }
				allowedTypes={ ALLOWED_MEDIA_TYPES }
				value={ imageId }
				render={ ( { open } ) => (
					<Button
						className={
							! imageId
								? 'editor-post-featured-image__toggle'
								: 'editor-post-featured-image__preview'
						}
						onClick={ open }
					>
						{ ! imageId && 'Upload your image' }
						{ !! imageId && ! uploadedImage && <Spinner /> }
						{ !! imageId && uploadedImage && (
							<img
								src={ uploadedImage.source_url }
								alt={ header }
							/>
						) }
					</Button>
				) }
			/>
		</MediaUploadCheck>
	);
};

export default compose(
	withSelect( ( select, props ) => {
		const { getMedia } = select( 'core' );
		const { imageId } = props.attributes.blockWide;

		return {
			uploadedImage: imageId ? getMedia( imageId ) : null,
		};
	} )
)( MediaUploader );
