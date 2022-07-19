import { useBlockProps } from '@wordpress/block-editor';
import UseCaseStats from './components/UseCaseStats';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;

registerBlockType( 'qu/usecasestats', {
	apiVersion: 2,
	title: 'Use Case Stats Item',
	icon: 'sticky',
	category: 'widgets',
	parent: [ 'qu/usecase' ],
	attributes: {
		usecaseId: {
			type: 'string',
		},
		usecaseStatsId: {
			type: 'string',
		},
		usecaseStatsValue: {
			type: 'string',
			default: '15%',
		},
		usecaseStatsTitle: {
			type: 'string',
			default: 'Use Case Stats Title',
		},
		usecaseStatsContent: {
			type: 'string',
			default: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores quasi ad eaque tempore, consequuntur mollitia quas animi necessitatibus omnis impedit incidunt, voluptatem nihil blanditiis fugit nulla dolores! Recusandae eos, magni numquam nobis laborum in fugiat officiis molestias enim, quibusdam illum?',
		},
	},
	usesContext: [ 'qu/usecaseId' ],

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;

		if ( ! attributes.usecaseId ) {
			setAttributes( { usecaseId: props.context[ 'qu/usecaseId' ] } );
		}

		if ( ! attributes.usecaseStatsId ) {
			setAttributes( {
				usecaseStatsId: blockProps[ 'data-block' ],
			} );
		}

		return (
			<div { ...blockProps }>
				<UseCaseStats { ...props } />
			</div>
		);
	},

	save: () => {
		return null;
	},
} );
