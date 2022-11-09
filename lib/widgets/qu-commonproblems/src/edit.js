import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import InnerBlocksLimited from './components/InnerBlocksLimited';
import Icon from './components/Icon';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;
const { __ } = wp.i18n;

const filteredFaqBlocks = () => {
	const getEditorBlocks = wp.data.select( 'core/block-editor' ).getBlocks();

	const filteredFaqs = getEditorBlocks.filter(
		( block ) => block.name === 'qu/enhanced-faq'
	);

	return filteredFaqs;
};

registerBlockType( 'qu/enhanced-faq', {
	apiVersion: 2,
	title: __( 'QU Enhanced FAQ', 'qu-enhanced-faq' ),
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		title: {
			type: 'string',
			default: 'Frequently asked question',
		},
	},

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { clientId, attributes, setAttributes } = props;
		const { title } = attributes;
		let manyFaqs = false;

		wp.domReady( () => {
			if (
				filteredFaqBlocks().length &&
				clientId !== filteredFaqBlocks()[ 0 ].clientId
			) {
				manyFaqs = true;
				setTimeout( () => {
					const anotherFaq = document.querySelector(
						`[data-block*="${ clientId }"]`
					);

					if ( anotherFaq ) {
						setTimeout( () => {
							anotherFaq.classList.add( 'hiding' );
							anotherFaq.addEventListener(
								'transitionend',
								() => {
									wp.data
										.dispatch( 'core/block-editor' )
										.removeBlock( clientId );
								}
							);
						}, 2000 );
					}
				}, 200 );
			}
		} );

		return (
			<div { ...blockProps } className="qu-enhancedFAQ">
				<style>
					{ `.qu-enhancedFAQ {
					--qu-faq-color: hsl( 29.9, 95.3%, 58.6%);
					--qu-faq-color-light: hsl(29.9,100%,95%);
					}`
					}
				</style>
				{ ! manyFaqs ? (
					<>
						<div { ...blockProps }>
							<TextControl
								className="qu-enhancedFAQ__title"
								value={ title }
								onFocus={ ( e ) => e.currentTarget.select() }
								onChange={ ( value ) => setAttributes( { title: value } ) }
							/>
						</div>
						<InnerBlocksLimited { ...props } />
					</>
				) : (
					<div className="input__limit--like wp-block">
						{ __(
							'Enhanced FAQ can be used on page only once',
							'qu-enhanced-faq'
						) }
					</div>
				) }
			</div>
		);
	},

	save: ( ) => {
		if ( filteredFaqBlocks().length <= 1 ) {
			return <InnerBlocks.Content />;
		}
		return null;
	},
} );
