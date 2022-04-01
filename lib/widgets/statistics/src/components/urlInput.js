const { ToggleControl, TextControl } = wp.components;
const { useState, useEffect, useRef } = wp.element;

const URLInput = ( props ) => {
	const { block, attributes, setAttributes } = props;
	const { urlText, url, urlInTab } = attributes[ block ];
	const data = { ...attributes[ block ] };
	const [ urlVisible, setUrlVisible ] = useState( false );
	const [ showUp, setShowUp ] = useState( false );
	const [ urlTabStatus, setUrlTabStatus ] = useState( urlInTab );
	const ref = useRef( null );

	const handleVisibility = () => {
		setUrlVisible( true );
		setTimeout( () => {
			setShowUp( true );
		}, 0 );
	};

	useEffect( () => {
		const handleClickOutside = ( event ) => {
			if ( ref.current && ! ref.current.contains( event.target ) ) {
				setShowUp( false );
				setTimeout( () => {
					setUrlVisible( false );
				}, 200 );
			}
		};
		document.addEventListener( 'click', handleClickOutside );
	}, [ ref ] );

	return (
		<div className="URLInput" ref={ ref }>
			{ urlVisible ? (
				<div className={ `URLInput__link ${ showUp ? 'active' : '' }` }>
					<TextControl
						className="URLInput__link--input"
						label="Enter URL"
						value={ url }
						type="url"
						onChange={ ( urlVal ) => {
							data.url = urlVal;
							setAttributes( {
								[ block ]: data,
							} );
						} }
					/>
					<ToggleControl
						label={ 'Open in new tab' }
						checked={ urlTabStatus }
						onChange={ () => {
							data.urlInTab = ! urlInTab;
							setAttributes( {
								[ block ]: data,
							} );
							setUrlTabStatus( ! urlInTab );
						} }
					/>
				</div>
			) : null }
			<TextControl
				className="Statistics--block__input URLInput__text"
				label="URL Text"
				hideLabelFromVision
				value={ urlText }
				onChange={ ( urlTextVal ) => {
					data.urlText = urlTextVal;
					setAttributes( { [ block ]: data } );
				} }
				onFocus={ () => handleVisibility() }
			/>
		</div>
	);
};

export default URLInput;
