import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import LayoutPicker from './components/LayoutPicker';
import ReviewSelect from './components/ReviewSelect';
import ReviewsSorted from './layouts/ReviewsSorted';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;

const { ToolbarGroup } = wp.components;

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

		if ( ! categories ) {
			return (
				<div className="selectExpert loading">
					<div htmlFor="">Loading...</div>
				</div>
			);
		}

		if ( categories.length === 0 ) {
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
					<ToolbarGroup label="toolbar">
						{ categoryId
							? <ReviewSelect { ...props } />
							: null
						}
						{
							categoryId
								? <LayoutPicker { ...props } />
								: null
						}
					</ToolbarGroup>
				</BlockControls>
				{ categoryId
					? <ReviewsSorted { ...props } />
					: null
				}
			</div>
		);
	} ),

	save: () => {
		return null;
	},
} );
