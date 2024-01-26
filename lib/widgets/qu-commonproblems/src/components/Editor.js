import {
	BlockEditorKeyboardShortcuts,
	BlockEditorProvider,
	BlockList,
	WritingFlow,
	BlockToolbar,
	ObserveTyping,
	useBlockProps,
} from '@wordpress/block-editor';
import '@wordpress/format-library';

const {
	serialize,
	parse,
} = wp.blocks;
const { Popover, SlotFillProvider } = wp.components;
const { isRTL, __ } = wp.i18n;
const { useEffect, useState } = wp.element;

const Editor = ( props ) => {
	const { attributes, setAttributes } = props;
	const { content } = attributes;
	const [ blocks, updateBlocks ] = useState( [] );
	const [ setShowAddContent ] = useState( true );
	const blockProps = useBlockProps();   //eslint-disable-line
	delete blockProps.ref;

	const textHtml = document.createElement( 'span' );
	const maxContentLength = 2048;

	// We get the text content entered
	const getBlocksContent = () => {
		let text = [];
		text += blocks.map( ( thisBlock ) => {
			if ( thisBlock.name === 'core/list' ) {
				return thisBlock.attributes.values;
			}
			return thisBlock.attributes.content;
		} );
		textHtml.innerHTML = text;
		return textHtml.innerText;
	};

	const editorSettings = {
		allowedBlockTypes: [ 'core/paragraph', 'core/list' ],
		isRTL: isRTL(),
	};

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
	}, [] );

	return (
		<div className="qu-enhancedFAQ__item--inn relative">
			<SlotFillProvider>
				<BlockEditorProvider
					value={ blocks }
					onInput={ handleUpdateBlocks }
					onChange={ handlePersistBlocks }
					onFocus={ () => setShowAddContent( false ) }
					settings={ editorSettings }
				>
					<div className="qu-enhancedFAQ__item--answer">
						<div className="editor-styles-wrapper">
							<BlockToolbar { ...blockProps } />
							<BlockEditorKeyboardShortcuts />
							<WritingFlow>
								<ObserveTyping>
									<BlockList />
								</ObserveTyping>
							</WritingFlow>
						</div>
					</div>
					<Popover.Slot />
				</BlockEditorProvider>
			</SlotFillProvider>
			{ getBlocksContent().length >= maxContentLength ? (
				<div className="input__limit">
					{ __(
						"Maximum length of an answer shouldn't exceed 2048 characters",
						'qu-enhanced-faq'
					) }
				</div>
			) : null }
		</div>
	);
};

export default Editor;
