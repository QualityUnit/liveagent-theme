import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import LayoutPicker from './elements/LayoutPicker';
import CategorySelect from './elements/CategorySelect';
import MaxReviews from './elements/MaxReviews';
import ReviewsSorted from './layouts/ReviewsSorted';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;
const { Toolbar, ToolbarGroup } = wp.components;

registerBlockType( 'qu/reviews', {
	apiVersion: 2,
	title: 'Reviews',
	icon: 'star-half',
	category: 'widgets',
	attributes: {
		categoryId: {
			type: 'string',
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

	edit: withSelect( ( select, props ) => {
		const { attributes, setAttributes } = props;
		const cats = select( 'core' ).getEntityRecords( 'taxonomy', 'ms_reviews_categories' );
		if ( cats && ! attributes.categoryId ) {
			setAttributes( { categoryId: cats[ 0 ].id } );
		}

		return {
			categories: cats ? cats : null,
		};
	} )( ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { categories, attributes } = props;
		const { categoryId } = attributes;

		if ( ! categoryId || ! categories ) {
			return (
				<div className="selectExpert loading">
					<div htmlFor="">Loading...</div>
				</div>
			);
		}

		if ( categories && categories.length === 0 ) {
			return (
				<div className="selectExpert loading error">
					<div htmlFor="">No categories</div>
				</div>
			);
		}

		return (
			categoryId
				? <div { ...blockProps }>
					<BlockControls>
						<Toolbar label="toolbar" className="qu-Reviews__edit">
							<ToolbarGroup>
								{ categoryId
									? <>
										<CategorySelect { ...props } />
										<LayoutPicker { ...props } />
										<MaxReviews { ...props } />
									</>
									: null
								}
							</ToolbarGroup>
						</Toolbar>
					</BlockControls>
					{ categoryId
						? <ReviewsSorted { ...props } />
						: null
					}
				</div>
				: null
		);
	} ),

	save: () => {
		return null;
	},
} );
