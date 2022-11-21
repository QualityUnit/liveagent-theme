import { useBlockProps } from '@wordpress/block-editor';
import CommonProblem from './components/CommonProblem';

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;

registerBlockType( 'qu/commonproblems-item', {
	apiVersion: 2,
	title: __( 'Common Problems Item', 'qu-commonproblems' ),
	icon: 'sticky',
	category: 'widgets',
	parent: [ 'qu/commonproblems' ],
	attributes: {
		commonproblemsId: {
			type: 'string',
			default: 'qu-commonproblems',
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
	usesContext: [ 'qu/commonproblemsId' ],

	edit: ( props ) => {
		const blockProps = useBlockProps(); //eslint-disable-line

		return (
			<div { ...blockProps } className="qu-CommonProblems__item">
				<CommonProblem { ...props } />
			</div>
		);
	},

	save: () => {
		return null;
	},
} );
