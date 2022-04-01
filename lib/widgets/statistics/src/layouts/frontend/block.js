const BlockFE = ( props ) => {
	const { block, styling, attributes } = props;
	const { color, align } = attributes;
	const { text, value, source, url, urlText, urlInTab } = attributes[ block ];

	return (
		<div
			className={ `Statistics--block Research--color-${ color } ${ styling } ${
				align ? `align-${ align }` : ''
			}` }
		>
			<div className="elementor-widget-text-editor text">
				<p>{ text }</p>
				{ '\n' }
			</div>
			<div className="value">
				<h4 className="elementor-heading-title">
					{ value } { '\n' }
				</h4>
			</div>
			<div className="elementor-widget-text-editor source">
				<p>
					{ source } { '\n' }
				</p>
			</div>
			<div className="to-bottom">
				<a
					className="Statistics--block__url"
					href={ url }
					{ ...( urlInTab ? { target: '_blank' } : {} ) }
				>
					{ urlText }
					<svg
						width="8"
						height="12"
						viewBox="0 0 8 12"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path d="M0 10.59L4.58 6L0 1.41L1.41 0L7.41 6L1.41 12L0 10.59Z" />
					</svg>
				</a>
			</div>
		</div>
	);
};

export default BlockFE;
