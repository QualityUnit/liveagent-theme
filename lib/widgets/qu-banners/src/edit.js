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
	title: 'QU Banners',
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
				content: '<!-- wp:list -->\n<ul><!-- wp:list-item -->\n<li>Ticketing</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Live Chat</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Social media</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Call center</li>\n<!-- /wp:list-item --><!-- wp:list-item -->\n<li>Knowledge base</li>\n<!-- /wp:list-item --></ul>\n<!-- /wp:list -->',
				buttonText: 'Try for free',
				buttonUrl: '/trial',
				openInTab: false,
				activeStyle: 'Improve__service',
			},
		},
		layout: {
			type: 'string',
			default: 'banner1',
		},
		style: {
			type: 'array',
			default: [
				'Improve__service',
				'',
			],
		},
	},
	usesContext: [ 'qu/bannerId' ],

	edit: ( props ) => {
		const { layout } = props.attributes;
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
