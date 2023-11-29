import { useBlockProps } from '@wordpress/block-editor';
import HowToItem from './components/HowToItem';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { useEffect } = wp.element;

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

		useEffect(() => {  //eslint-disable-line
			if ( ! attributes.howtoId ) {
				setAttributes( { howtoId: props.context[ 'qu/howtoId' ] } );
			}

			if ( ! attributes.howtoItemId ) {
				setAttributes( {
					howtoItemId: blockProps[ 'data-block' ],
				} );
			}
		}, [ attributes.howtoId, attributes.howtoItemId, blockProps, props.context, setAttributes ] );

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
