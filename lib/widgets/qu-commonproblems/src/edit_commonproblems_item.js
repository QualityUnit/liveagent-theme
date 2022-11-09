import { useBlockProps } from '@wordpress/block-editor';
import FAQItem from './components/FAQItem';

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;

registerBlockType( 'qu/commonproblems-item', {
	apiVersion: 2,
	title: __( 'Common Problems Item', 'qu-commonproblems' ),
	icon: 'sticky',
	category: 'widgets',
	parent: [ 'qu/commonproblems' ],
	attributes: {
		targetId: {
			type: 'string',
			default: '',
		},
		question: {
			type: 'string',
			default: 'Enter Problem…',
		},
		content: {
			type: 'string',
			default: '',
		},
	},

	edit: ( props ) => {
		const blockProps = useBlockProps(); //eslint-disable-line
		const { clientId, setAttributes } = props;

		setAttributes( {
			targetId: clientId,
		} );

		return (
			<FAQItem { ...blockProps } { ...props } />
		);
	},

	save: () => {
		return null;
	},
} );
