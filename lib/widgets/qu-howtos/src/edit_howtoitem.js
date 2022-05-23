import { useBlockProps } from '@wordpress/block-editor';
import HowToItem from './components/HowToItem';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;

registerBlockType( 'qu/howtoitem', {
	apiVersion: 2,
	title: 'HowToItem Item',
	icon: 'sticky',
	category: 'widgets',
	parent: [ 'qu/howto' ],
	attributes: {
		howtoId: {
			type: 'string',
		},
		howtoItemId: {
			type: 'string',
		},
		schemaImage: {
			type: 'string',
		},
		header: {
			type: 'string',
			default: 'Enter howto title here…',
		},
		content: {
			type: 'string',
			default: '',
		},
	},
	usesContext: [ 'qu/howtoId' ],

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;

		if ( ! attributes.howtoId ) {
			setAttributes( { howtoId: props.context[ 'qu/howtoId' ] } );
		}

		if ( ! attributes.howtoItemId ) {
			setAttributes( {
				howtoItemId: blockProps[ 'data-block' ],
			} );
		}

		return (
			<div { ...blockProps }>
				<HowToItem { ...props } />
			</div>
		);
	},

	save: () => {
		return null;
	},
} );
