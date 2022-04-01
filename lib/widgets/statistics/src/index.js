import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import {
	LayoutPicker,
	AlignPicker,
	StylePicker,
	ColorPicker,
	LayoutFull,
	Columns,
	Block,
	BlockWide,
} from './common/indexImports';

import './scss/editor.scss';
import './scss/style.scss';

const { registerBlockType } = wp.blocks;
const { Toolbar, ToolbarGroup } = wp.components;

const blog = document.querySelector( '.BlogPost__content' );
if ( blog ) {
	document.querySelector( 'body' ).classList.add( 'has-statistics' );
}

registerBlockType( 'qu/statistics', {
	apiVersion: 2,
	title: 'Statistics',
	icon: 'chart-bar',
	category: 'widgets',
	attributes: {
		statisticsId: {
			type: 'string',
		},
		blockWide: {
			type: 'object',
			default: {
				header: 'Scripted responses',
				text:
					'of consumers say speed, convenience, knowledgeable help, and friendly service are the most important elements of a positive customer experience.',
				value: '80%',
				sourceData: 'Nicereply',
				urlText: 'See more IVR statistics',
				url: '',
				urlInTab: false,
				imageId: false,
				imageUrl: '',
			},
		},
		block1: {
			type: 'object',
			default: {
				text:
					'The average net FCR for service desks worldwide is about',
				value: '74%',
				sourceData: 'Metric Net',
				urlText: 'See more',
				url: '',
				urlInTab: false,
			},
		},
		block2: {
			type: 'object',
			default: {
				text:
					'The average global CSAT benchmark that includes all industries is',
				value: '86%',
				sourceData: 'Geckoboard',
				urlText: 'See more',
				url: '',
				urlInTab: false,
			},
		},
		block3: {
			type: 'object',
			default: {
				text:
					'The average annual turnover rate for a customer service representative (CSR) is',
				value: '29%',
				sourceData: 'LinkedIn',
				urlText: 'See more',
				url: '',
				urlInTab: false,
			},
		},
		layout: {
			type: 'string',
			default: 'full',
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
		color: {
			type: 'string',
			default: '1',
		},
	},

	edit: ( props ) => {
		const { layout, activeStyle, align } = props.attributes;
		const { setAttributes } = props;

		const isInline = () => {
			if ( align && layout === 'single' ) {
				const blockProps = useBlockProps( { //eslint-disable-line
					className: 'display-inline',
				} );
				return blockProps;
			}
			const blockProps = useBlockProps();  //eslint-disable-line
			return blockProps;
		};

		setAttributes( {
			statisticsId: isInline()[ 'data-block' ],
		} );

		return (
			<div { ...isInline() }>
				<BlockControls>
					<Toolbar>
						<ToolbarGroup>
							<LayoutPicker { ...props } />
							{ layout === 'single' ? (
								<>
									<AlignPicker { ...props } />
									<StylePicker { ...props } />
								</>
							) : null }
							<ColorPicker { ...props } />
						</ToolbarGroup>
					</Toolbar>
				</BlockControls>
				{ layout === 'full' ? <LayoutFull { ...props } /> : null }
				{ layout === 'columns' ? <Columns { ...props } /> : null }
				{ layout === 'single' ? (
					<Block
						{ ...props }
						block="block1"
						align={ align }
						styling={ activeStyle }
					/>
				) : null }
				{ layout === 'singleWide' ? <BlockWide { ...props } /> : null }
			</div>
		);
	},

	save: ( props ) => {
		return null;
	},
} );
