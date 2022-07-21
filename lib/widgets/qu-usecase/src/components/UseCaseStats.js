const { TextControl, TextareaControl } = wp.components;

const UseCaseStats = ( props ) => {
	const { attributes, setAttributes } = props;

	return (
		<div className="qu-UseCase__stats">
			<TextControl
				label="Enter value:"
				className="qu-UseCase__stats--value highlight-gradient"
				hideLabelFromVision="true"
				value={ attributes.usecaseStatsValue }
				onFocus={ ( e ) => e.currentTarget.select() }
				onChange={ ( value ) => setAttributes( { usecaseStatsValue: value } ) }
			/>
			<TextControl
				label="Enter title:"
				className="qu-UseCase__stats--title"
				hideLabelFromVision="true"
				value={ attributes.usecaseStatsTitle }
				onFocus={ ( e ) => e.currentTarget.select() }
				onChange={ ( value ) => setAttributes( { usecaseStatsTitle: value } ) }
			/>
			<TextareaControl
				label="Enter some text:"
				className="qu-UseCase__stats--text"
				hideLabelFromVision="true"
				value={ attributes.usecaseStatsContent }
				onFocus={ ( e ) => e.currentTarget.select() }
				onChange={ ( value ) => setAttributes( { usecaseStatsContent: value } ) }
			/>
		</div>
	);
};

export default UseCaseStats;
