import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import LayoutPicker from './components/layoutPicker';
import Banner1 from './layouts/Banner1';

import './scss/editor.scss';
import './scss/style.scss';

const { registerBlockType } = wp.blocks;
const { Toolbar, ToolbarGroup } = wp.components;
const { useEffect } = wp.element;

registerBlockType( 'qu/banners', {
	apiVersion: 2,
	title: 'Banners',
	icon: 'tickets-alt',
	category: 'widgets',
	attributes: {
		bannerId: {
			type: 'string',
		},
		banner1: {
			type: 'object',
			default: {
				header:
					'Improve your customer service with the right help desk software',
				content: '',
				buttonText: 'Try for free',
				buttonUrl: '',
				openInTab: false,
			},
		},
		layout: {
			type: 'string',
			default: 'banner1',
		},
		align: {
			type: 'string',
			default: '',
		},
		style: {
			type: 'array',
			default: [
				'Statistics--block__negative has-bg',
				'',
				'Statistics--block__grey',
			],
		},
		activeStyle: {
			type: 'string',
			default: 'Statistics--block__negative has-bg',
		},
	},
	usesContext: [ 'qu/bannerId' ],

	edit: ( props ) => {
		const { layout, activeStyle, align } = props.attributes;
		const { attributes, setAttributes } = props;
		const blockProps = useBlockProps();   //eslint-disable-line

		useEffect(() => {  //eslint-disable-line
			if ( ! attributes.bannerId ) {
				setAttributes( { bannerId: props.context[ 'qu/bannerId' ] } );
			}
		}, [ attributes.bannerId, blockProps, props.context, setAttributes ] );

		return (
			<div { ...blockProps }>
				<BlockControls>
					<Toolbar>
						<ToolbarGroup>
							<LayoutPicker { ...props } />
							{ /* { layout === 'banner1' ? (
								<>
									<AlignPicker { ...props } />
									<StylePicker { ...props } />
								</>
							) : null }
							<ColorPicker { ...props } /> */ }
						</ToolbarGroup>
					</Toolbar>
				</BlockControls>
				{ layout === 'banner1' ? (
					<Banner1
						{ ...props }
					/>
				) : null }
			</div>
		);
	},

	save: ( ) => {
		return null;
	},
} );
