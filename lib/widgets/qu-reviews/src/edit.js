import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import Top from './components/Top';
import Header from './components/Header';
import ReviewSelect from './components/ReviewSelect';
import Icon from './components/Icon';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;

const { Toolbar, ToolbarGroup } = wp.components;

registerBlockType( 'qu/reviews', {
	apiVersion: 2,
	title: 'Reviews widget',
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		reviewId: {
			type: 'string',
			default: '3647',
		},
		expertPosition: {
			type: 'string',
			default: '',
		},
	},

	edit: withSelect( ( select ) => {
		const reviews = select( 'core' ).getEntityRecords( 'postType', 'ms_reviews', { per_page: -1, status: 'publish' } );

		return {
			posts: reviews,
		};
	} )( ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;
		const { reviewId } = attributes;

		if ( props.posts && ! reviewId ) {
			setAttributes( { reviewId: props.posts[ 0 ].id } );
		}

		return (
			<div { ...blockProps }>
				<BlockControls>
					<Toolbar>
						<ToolbarGroup>
							<ReviewSelect { ...props } />
						</ToolbarGroup>
					</Toolbar>
				</BlockControls>
				<div className="qu-reviewWidget">
					{ reviewId
						? <Top { ...props } />
						: null
					}
					<Header { ...props } />
				</div>
			</div>
		);
	} ),

	save: ( props ) => {
		return null;
	},
} );
