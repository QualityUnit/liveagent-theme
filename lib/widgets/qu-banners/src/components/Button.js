const { ToggleControl, TextControl } = wp.components;
const { useState, useEffect, useRef } = wp.element;

const Button = ( props ) => {
	const { attributes, setAttributes } = props;
	const { layout: banner } = attributes;
	const { buttonText, buttonUrl, openInTab } = banner;
	const [ urlVisible, setUrlVisible ] = useState( false );
	const [ showUp, setShowUp ] = useState( false );
	const [ urlTabStatus, setUrlTabStatus ] = useState( openInTab );
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
							setAttributes( {
								[ banner ]: { ...banner, buttonUrl: urlVal },
							} );
						} }
					/>
					<ToggleControl
						label={ 'Open in new tab' }
						checked={ urlTabStatus }
						onChange={ () => {
							setAttributes( {
								[ banner ]: { ...banner, openInTab: ! openInTab },
							} );
							setUrlTabStatus( ! openInTab );
						} }
					/>
				</div>
			) : null }
			<TextControl
				className="Statistics--block__input URLInput__text"
				label="URL Text"
				hideLabelFromVision
				value={ buttonText }
				onChange={ ( urlTextVal ) => {
					setAttributes( { [ banner ]: { ...banner, buttonText: urlTextVal } } );
				} }
				onFocus={ () => handleVisibility() }
			/>
		</div>
	);
};

export default Button;
