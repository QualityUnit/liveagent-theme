const { TextareaControl } = wp.components;
const { useState } = wp.element;
const { __ } = wp.i18n;

const Header = ( props ) => {
	const { attributes, setAttributes } = props;
	const [ questionLong, setQuestionLong ] = useState( false );
	const { question } = attributes;
	const questionLength = 255;

	const handleQuestion = ( value ) => {
		setAttributes( { question: value } );
		setQuestionLong( false );

		if ( value.length >= questionLength ) {
			setAttributes( { question: value.substring( 0, questionLength ) } );
			setQuestionLong( true );
		}
	};

	return (
		<div className="qu-enhancedFAQ__item--question relative">
			<svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="9" r="9" fill="var(--qu-faq-color-light)" /><path fill="var(--qu-faq-color)" d="m11.781 6 1.414 1.414-5.657 5.657-1.414-1.414z" /><path fill="var(--qu-faq-color)" d="M8.953 11.657 7.54 13.071 4.004 9.536l1.414-1.414z" /></svg>
			<TextareaControl
				value={ question }
				rows="2"
				autoFocus // eslint-disable-line
				onFocus={ ( e ) => e.currentTarget.select() }
				onChange={ ( value ) => handleQuestion( value ) }
			/>
			{ questionLong ? (
				<div className="input__limit">
					{ __(
						'Maximum length of the question is 255 characters',
						'qu-enhanced-faq'
					) }
				</div>
			) : null }
		</div>
	);
};

export default Header;
