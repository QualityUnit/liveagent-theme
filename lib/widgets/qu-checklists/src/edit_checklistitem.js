import { useBlockProps } from '@wordpress/block-editor';
import CheckListItem from './components/CheckListItem';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;

registerBlockType( 'qu/checklistitem', {
	apiVersion: 2,
	title: 'Checklist Item',
	icon: 'sticky',
	category: 'widgets',
	parent: [ 'qu/checklist' ],
	attributes: {
		checklistId: {
			type: 'string',
		},
		checklistItemId: {
			type: 'string',
		},
		schemaImage: {
			type: 'string',
		},
		header: {
			type: 'string',
			default: 'Enter checklist title here…',
		},
		content: {
			type: 'string',
			default: '',
		},
		isOpen: {
			type: 'boolean',
			default: true,
		},
		customAction: {
			type: 'boolean',
			default: false,
		},
		customActionText: {
			type: 'string',
			default: 'Custom Action Text',
		},
	},
	usesContext: [ 'qu/checklistId' ],

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;

		if ( ! attributes.checklistId ) {
			setAttributes( { checklistId: props.context[ 'qu/checklistId' ] } );
		}

		if ( ! attributes.checklistItemId ) {
			setAttributes( {
				checklistItemId: blockProps[ 'data-block' ],
			} );
		}

		return (
			<div { ...blockProps }>
				<CheckListItem { ...props } />
			</div>
		);
	},

	save: () => {
		return null;
	},
} );
