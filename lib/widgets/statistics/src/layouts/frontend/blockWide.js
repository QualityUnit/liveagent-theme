const BlockWideFE = ( props ) => {
	const { attributes } = props;
	const { color } = attributes;
	const {
		header,
		text,
		value,
		source,
		imageId,
		imageUrl,
		url,
		urlText,
		urlInTab,
	} = attributes.blockWide;

	return (
		<div
			className={ `Statistics--block Statistics--block__wide Post__m__negative Research--color-${ color }` }
		>
			<h2 className="Statistics--block__wide--header">
				{ header } { '\n' }
			</h2>

			<div className="Statistics--block__wide--top">
				<div className="value">
					<h4 className="elementor-heading-title">
						{ value } { '\n' }
					</h4>
				</div>

				<div className="elementor-widget-text-editor text no-color">
					<p>
						{ text } <span className="source">{ source }</span>
						{ '\n' }
					</p>
				</div>
			</div>
			{ imageId && imageUrl ? (
				<img
					className="Statistics--block__wide--image"
					src={ imageUrl }
					alt={ header }
				/>
			) : null }
			<div className="to-bottom">
				<a
					className="Statistics--block__url"
					href={ url }
					{ ...( urlInTab ? { target: '_blank' } : {} ) }
				>
					{ urlText }
				</a>
			</div>
		</div>
	);
};

export default BlockWideFE;
