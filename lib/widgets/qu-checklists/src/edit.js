import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

import Icon from './components/Icon';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;

registerBlockType( 'qu/checklist', {
	apiVersion: 2,
	title: 'Checklist',
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		checklistId: {
			type: 'string',
		},
	},
	providesContext: {
		'qu/checklistId': 'checklistId',
	},

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;
		const ALLOWED_BLOCKS = [ 
			'core/heading',
			'core/paragraph',
			'core/list',
			'core/image',
			'core/media-text',
			'core/embed',
			'core/table',
			'core/columns',
			'core/shortcode',
			'qu/checklistitem'
		];
		const template = [
			[
				'qu/checklistitem',
				{
					placeholder: 'Add another Checklist Item by clicking on +',
				},
			],
		];

		if ( ! attributes.checklistId ) {
			setAttributes( {
				checklistId: blockProps[ 'data-block' ],
			} );
		}

		return (
			<div { ...blockProps } className="qu-Checklist">
				<InnerBlocks
					{ ...blockProps }
					{ ...props }
					allowedBlocks={ ALLOWED_BLOCKS }
					template={ template }
				/>
			</div>
		);
	},

	save: () => {
		return <InnerBlocks.Content />;
	},
} );
