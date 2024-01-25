import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

import Icon from './components/Icon';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;
const { useEffect } = wp.element;

registerBlockType( 'qu/checklist', {
	apiVersion: 2,
	title: 'Checklist',
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		checklistId: {
			type: 'string',
		},
		supply: {
			type: 'string',
			default: 'Help Desk Software',
		},
		tool: {
			type: 'string',
			default: 'LiveAgent',
		},
		totalTime: {
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
			'qu/checklistitem',
		];
		const template = [
			[
				'qu/checklistitem',
				{
					placeholder: 'Add another Checklist Item by clicking on +',
				},
			],
		];

		useEffect(() => {  //eslint-disable-line
			if ( ! attributes.checklistId ) {
				setAttributes( {
					checklistId: blockProps[ 'data-block' ],
				} );
			}
		}, [ attributes.checklistId, blockProps, setAttributes ] );

		return (
			<div { ...blockProps } className="qu-Checklist">
				<div { ...blockProps } className="qu-Checklist__schema wp-block">
					<h2 { ...blockProps }>Additional Schema.org info</h2>
					<div { ...blockProps } title="A supply consumed when performing instructions or a direction. Ie. if checklist is about graphics, supply can be set to “provided design”">
						<TextControl
							label="Enter a Supply:"
							value={ attributes.supply }
							onFocus={ ( e ) => e.currentTarget.select() }
							onChange={ ( value ) => setAttributes( { supply: value } ) }
						/>
					</div>
					<div { ...blockProps } title="An object used (but not consumed) when performing instructions or a direction. Ie. might be “Adobe Photoshop”">
						<TextControl
							label="Enter a Tool:"
							value={ attributes.tool }
							onFocus={ ( e ) => e.currentTarget.select() }
							onChange={ ( value ) => setAttributes( { tool: value } ) }
						/>
					</div>
					<div { ...blockProps } title="Enter estimated time duration in minutes – how long all steps in checklist would take to perform properly">
						<TextControl
							label="Enter Total time in minutes:"
							value={ attributes.totalTime }
							onFocus={ ( e ) => e.currentTarget.select() }
							onChange={ ( value ) => setAttributes( { totalTime: value } ) }
						/>
					</div>
				</div>
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
