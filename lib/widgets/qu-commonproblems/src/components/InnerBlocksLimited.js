import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

const { useSelect } = wp.data;
const { __ } = wp.i18n;

const InnerBlocksLimited = ( props ) => {
	const { clientId } = props;
	const ALLOWED_BLOCKS = [ 'qu/commonproblems-item' ];

	const innerBlockCount = useSelect(
		( select ) =>
			select( 'core/block-editor' ).getBlock( clientId ).innerBlocks
	);

	const template = [
		[
			'qu/commonproblems-item',
			{
				placeholder: __( 'Add Common problem', 'qu-commonproblems' ),
			},
		],
	];

	const faqItemAppender = () => {
		if ( innerBlockCount.length < 16 ) {
			return (
				<div className="qu-CommonProblems__addItemButton">
					<InnerBlocks.ButtonBlockAppender />
				</div>
			);
		}
		return (
			<div className="input__limit--like wp-block">
				{ __(
					'You can add maximum of 16 Common problems',
					'qu-commonproblems'
				) }
			</div>
		);
	};

	const blockProps = useBlockProps();   //eslint-disable-line
	return (
		<InnerBlocks
			{ ...blockProps }
			{ ...props }
			className="qu-CommonProblems__items"
			allowedBlocks={ ALLOWED_BLOCKS }
			template={ template }
			renderAppender={ () => faqItemAppender() }
		/>
	);
};

export default InnerBlocksLimited;
