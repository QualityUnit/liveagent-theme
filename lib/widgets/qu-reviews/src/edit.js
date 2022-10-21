import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import Review from './components/Review';
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
		categoryId: {
			type: 'string',
		},
		reviewId: {
			type: 'string',
		},
	},

	edit: withSelect( ( select ) => {
		const cats = select( 'core' ).getEntityRecords( 'taxonomy', 'ms_reviews_categories' );

		return {
			categories: cats,
		};
	} )( ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;
		const { categoryId, reviewId } = attributes;

		if ( ! props.categories ) {
			return (
				<div className="selectExpert loading">
					<div htmlFor="">Loading...</div>
				</div>
			);
		}

		if ( props.categories.length === 0 ) {
			return (
				<div className="selectExpert loading error">
					<div htmlFor="">No categories</div>
				</div>
			);
		}

		if ( props.categories && ! categoryId ) {
			setAttributes( { categoryId: props.categories[ 0 ].id } );
		}

		return (
			<div { ...blockProps }>
				<BlockControls>
					<Toolbar label="toolbar">
						<ToolbarGroup>
							{ categoryId
								? <ReviewSelect { ...props } />
								: null
							}
						</ToolbarGroup>
					</Toolbar>
				</BlockControls>
				<div className="qu-reviewWidget">
					{ reviewId
						? <Review { ...props } />
						: null
					}
				</div>
			</div>
		);
	} ),

	save: ( props ) => {
		return null;
	},
} );
