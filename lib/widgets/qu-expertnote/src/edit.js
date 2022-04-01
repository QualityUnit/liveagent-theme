import { BlockControls, useBlockProps } from '@wordpress/block-editor';

import Top from './components/Top';
import Header from './components/Header';
import Editor from './components/Editor';
import ExpertSelect from './components/ExpertSelect';
import Icon from './components/Icon';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;

const { Toolbar, ToolbarGroup } = wp.components;

registerBlockType( 'qu/expertnote', {
	apiVersion: 2,
	title: 'Expert Note',
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		expertId: {
			type: 'string',
			default: '3647',
		},
		expertPosition: {
			type: 'string',
			default: '',
		},
		expertNote: {
			type: 'string',
			default: "Expert's note",
		},
		header: {
			type: 'string',
			default: 'Enter title here…',
		},
		content: {
			type: 'string',
			default: '',
		},
	},

	edit: withSelect( ( select ) => {
			const people = select('core').getEntityRecords('postType','ms_people', { per_page: -1, status: 'publish' });

			return {
					posts: people
			};
	} )(( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;
		const {expertId} = attributes;
		
		if( props.posts && ! expertId ) {
			setAttributes( {expertId: props.posts[0].id} );
		}

		return (
			<div { ...blockProps }>
				<BlockControls>
					<Toolbar>
						<ToolbarGroup>
							<ExpertSelect { ...props } />
						</ToolbarGroup>
					</Toolbar>
				</BlockControls>
				<div className="qu-expertNote">
					{expertId
						? <Top { ...props } />
						: null
					}
					<Header { ...props } />
					<Editor { ...props } />
				</div>
			</div>
		);
	}),

	save: ( props ) => {
		return null;
	},
} );
