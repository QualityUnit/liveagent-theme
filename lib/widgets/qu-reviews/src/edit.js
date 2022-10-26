import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import LayoutPicker from './elements/LayoutPicker';
import CategorySelect from './elements/CategorySelect';
import MaxReviews from './elements/MaxReviews';
import ReviewsSorted from './layouts/ReviewsSorted';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { withSelect, useSelect } = wp.data;

const { Toolbar, ToolbarGroup } = wp.components;

registerBlockType( 'qu/reviews', {
	apiVersion: 2,
	title: 'Reviews',
	icon: 'star-half',
	category: 'widgets',
	attributes: {
		categoryId: {
			type: 'number',
		},
		reviewsSorted: {
			type: 'array',
		},
		layout: {
			type: 'string',
			default: '',
		},
		maxReviews: {
			type: 'number',
			default: 10,
		},
	},

	edit: withSelect( ( select ) => {
		const cats = select( 'core' ).getEntityRecords( 'taxonomy', 'ms_reviews_categories' );

		return {
			categories: cats,
		};
	} )( ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { categories, attributes, setAttributes } = props;
		const { categoryId } = attributes;

		if ( categories && categories.length === 0 ) {
			return (
				<div className="selectExpert loading error">
					<div htmlFor="">No categories</div>
				</div>
			);
		}

		if ( categories && ! categoryId ) {
			setAttributes( { categoryId: categories[ 0 ].id } );
		}

		return (
			<div { ...blockProps }>
				<BlockControls>
					<Toolbar label="toolbar" className="qu-Reviews__edit">
						<ToolbarGroup>
							{ categoryId
								? <CategorySelect { ...props } />
								: <div className="selectExpert loading">
									<div>Loading...</div>
								</div>
							}

							<LayoutPicker { ...props } />
							<MaxReviews { ...props } />

						</ToolbarGroup>
					</Toolbar>
				</BlockControls>
				{ categoryId
					? <ReviewsSorted { ...props } />
					: <div className="selectExpert loading">
						<div>Loading...</div>
					</div>
				}
			</div>
		);
	} ),

	save: ( props ) => {
		return null;
	},
} );
