import {
	BlockEditorKeyboardShortcuts,
	BlockEditorProvider,
	BlockList,
	ButtonBlockAppender,
	WritingFlow,
	BlockTools,
	ObserveTyping,
	useBlockProps,
} from '@wordpress/block-editor';
import '@wordpress/format-library';

const {
	serialize,
	parse,
} = wp.blocks;
const { SlotFillProvider } = wp.components;
const { isRTL } = wp.i18n;
const { useEffect, useState, useMemo } = wp.element;

const Editor = ( props ) => {
	const { attributes, setAttributes } = props;
	const { layout: banner } = attributes;
	const { content } = attributes[ banner ];
	const [ blocks, updateBlocks ] = useState( [] );
	const blockProps = useBlockProps( {
		className: 'bannerEditor',
	});   //eslint-disable-line
	delete blockProps.ref;

	const editorSettings = useMemo( () => ( {
		allowedBlockTypes: [
			'core/heading',
			'core/paragraph',
			'core/list',
			'core/image',
		],
		isRTL: isRTL(),
	} ), [] );

	// Functions to update content in the editor from Block Editor component

	const handleUpdateBlocks = ( bloky ) => {
		updateBlocks( bloky );
	};

	const handlePersistBlocks = ( newBlocks ) => {
		updateBlocks( newBlocks );
		setAttributes( { [ banner ]: { ...attributes[ banner ], content: serialize( newBlocks ) } } );
	};

	useEffect( () => {
		if ( content?.length ) {
			handleUpdateBlocks( () => parse( content ) );
		}
	}, [] );

	return (
		<div className="qu-Banner__inn" { ...blockProps } >
			<SlotFillProvider>

				<BlockEditorProvider
					value={ blocks }
					onInput={ handleUpdateBlocks }
					onChange={ handlePersistBlocks }
					settings={ editorSettings }
					{ ...blockProps }
				>
					<div className="qu-Banner__content">

						<div className="editor-styles-wrapper">
							<BlockTools { ...blockProps } />
							<BlockEditorKeyboardShortcuts { ...blockProps } />
							<WritingFlow>
								<ObserveTyping>
									<BlockList { ...blockProps } />
									<ButtonBlockAppender { ...blockProps } />
								</ObserveTyping>
							</WritingFlow>
						</div>
					</div>
				</BlockEditorProvider>
			</SlotFillProvider>
		</div>
	);
};

export default Editor;
