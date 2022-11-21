import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
// import InnerBlocksLimited from './components/InnerBlocksLimited';
import Icon from './components/Icon';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;
const { __ } = wp.i18n;

registerBlockType( 'qu/commonproblems', {
	apiVersion: 2,
	title: __( 'QU Common Problems', 'qu-commonproblems' ),
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		commonproblemsId: {
			type: 'string',
			default: 'qu-commonproblems',
		},
		title: {
			type: 'string',
			default: 'Common ^problems and solutions^',
		},
		subtitle: {
			type: 'string',
			default: 'Experiencing problems with this software?',
		},
		subtitle2: {
			type: 'string',
			default: 'Take a look at our list of the most common problems and find out how you can solve them.',
		},
	},
	providesContext: {
		'qu/commonproblemsId': 'commonproblemsId',
	},

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;
		const { title, subtitle, subtitle2 } = attributes;
		const ALLOWED_BLOCKS = [ 'qu/commonproblems-item' ];
		const template = [
			[
				'qu/commonproblems-item',
				{
					placeholder: 'Add another Common problem by clicking on +',
				},
			],
		];

		return (
			<div { ...blockProps } className="qu-CommonProblems">
				<div { ...blockProps }>
					<TextControl
						className="qu-CommonProblems__title"
						value={ title }
						onFocus={ ( e ) => e.currentTarget.select() }
						onChange={ ( value ) => setAttributes( { title: value } ) }
					/>
					<TextControl
						className="qu-CommonProblems__subtitle"
						value={ subtitle }
						onFocus={ ( e ) => e.currentTarget.select() }
						onChange={ ( value ) => setAttributes( { subtitle: value } ) }
					/>
					<TextControl
						className="qu-CommonProblems__subtitle"
						value={ subtitle2 }
						onFocus={ ( e ) => e.currentTarget.select() }
						onChange={ ( value ) => setAttributes( { subtitle2: value } ) }
					/>
				</div>
				<InnerBlocks
					{ ...blockProps }
					{ ...props }
					className="qu-CommonProblems__items"
					allowedBlocks={ ALLOWED_BLOCKS }
					template={ template }
				/>
			</div>
		);
	},

	save: ( ) => {
		return <InnerBlocks.Content />;
	},
} );
