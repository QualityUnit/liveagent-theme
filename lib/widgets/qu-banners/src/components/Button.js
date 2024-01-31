const { ToggleControl, TextControl } = wp.components;
const { useState, useEffect, useRef } = wp.element;

const Button = ( props ) => {
	const { attributes, setAttributes } = props;
	const { layout: banner } = attributes;
	const { buttonText, buttonUrl, openInTab } = attributes[ banner ];
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
		<div className="Button Button--full" ref={ ref }>
			{ urlVisible ? (
				<div className={ `Button__link ${ showUp ? 'active' : '' }` }>
					<TextControl
						className="Button__link--input"
						label="Enter URL"
						value={ buttonUrl }
						type="url"
						onChange={ ( urlVal ) => {
							setAttributes( {
								[ banner ]: { ...attributes[ banner ], buttonUrl: urlVal },
							} );
						} }
					/>
					<ToggleControl
						label={ 'Open in new tab' }
						checked={ urlTabStatus }
						onChange={ () => {
							setAttributes( {
								[ banner ]: { ...attributes[ banner ], openInTab: ! openInTab },
							} );
							setUrlTabStatus( ! openInTab );
						} }
					/>
				</div>
			) : null }
			<TextControl
				className="qu-Banner__input Button__text"
				label="URL Text"
				hideLabelFromVision
				value={ buttonText }
				onChange={ ( urlTextVal ) => {
					setAttributes( { [ banner ]: { ...attributes[ banner ], buttonText: urlTextVal } } );
				} }
				onFocus={ () => handleVisibility() }
			/>
		</div>
	);
};

export default Button;
