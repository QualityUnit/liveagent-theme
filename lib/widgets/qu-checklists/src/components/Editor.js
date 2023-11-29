import {
	BlockEditorKeyboardShortcuts,
	BlockEditorProvider,
	BlockList,
	WritingFlow,
	BlockTools,
	ObserveTyping,
} from '@wordpress/block-editor';
import '@wordpress/format-library';
import { uploadMedia } from '@wordpress/media-utils';

import CustomAction from './CustomAction';

const {
	serialize,
	parse,
	getBlockVariations,
	unregisterBlockVariation,
} = wp.blocks;
const { SlotFillProvider } = wp.components;
const { isRTL } = wp.i18n;
const { useEffect, useState, useMemo } = wp.element;
const { useSelect } = wp.data;

const Editor = ( props ) => {
	const { attributes, setAttributes } = props;
	const { content } = attributes;
	const [ blocks, updateBlocks ] = useState( [] );

	const canUserCreateMedia = useSelect( ( select ) => {
		const canCreateMedia = select( 'core' ).canUser( 'create', 'media' );
		return canCreateMedia || canCreateMedia !== false;
	}, [] );

	const editorSettings = useMemo( () => ( {
		allowedBlockTypes: [
			'core/heading',
			'core/paragraph',
			'core/list',
			'core/image',
			'core/embed',
			'core/table',
		],
		isRTL: isRTL(),
	} ), [] );

	useEffect( () => {
		// We want only youtube
		const allowedEmbedVariants = [ 'youtube' ];
		getBlockVariations( 'core/embed' ).forEach( ( variant ) => {
			if ( ! allowedEmbedVariants.includes( variant.name ) ) {
				unregisterBlockVariation( 'core/embed', variant.name );
			}
		} );
	}, [ ] );

	// Extending our settings for support for Media library in Image block type
	const settings = useMemo( () => {
		if ( ! canUserCreateMedia ) {
			return editorSettings;
		}
		return {
			...editorSettings,
			mediaUpload( { onError, ...rest } ) {
				uploadMedia( {
					wpAllowedMimeTypes: editorSettings.allowedMimeTypes,
					onError: ( { message } ) => onError( message ),
					...rest,
				} );
			},
		};
	}, [ canUserCreateMedia, editorSettings ] );

	// Functions to update content in the editor from Block Editor component

	const handleUpdateBlocks = ( bloky ) => {
		updateBlocks( bloky );
	};

	const handlePersistBlocks = ( newBlocks ) => {
		updateBlocks( newBlocks );
		setAttributes( { content: serialize( newBlocks ) } );
	};

	useEffect( () => {
		if ( content?.length ) {
			handleUpdateBlocks( () => parse( content ) );
		}
	}, [ ] );

	return (
		<div className="qu-ChecklistItem__inn" { ...props }>
			<SlotFillProvider>
				<BlockEditorProvider
					value={ blocks }
					onInput={ handleUpdateBlocks }
					onChange={ handlePersistBlocks }
					settings={ settings }
					{ ...props }
				>
					<div className="qu-ChecklistItem__content">
						<BlockTools { ...props }>
							<div className="editor-styles-wrapper">
								<BlockEditorKeyboardShortcuts { ...props } />
								<WritingFlow { ...props }>
									<ObserveTyping>
										<BlockList { ...props } />
									</ObserveTyping>
								</WritingFlow>
							</div>
						</BlockTools>
						<CustomAction { ...props } />
					</div>
				</BlockEditorProvider>
			</SlotFillProvider>
		</div>
	);
};

export default Editor;
