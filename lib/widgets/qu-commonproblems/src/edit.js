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
		( block ) => block.name === 'qu/commonproblems'
	);

	return filteredFaqs;
};

registerBlockType( 'qu/commonproblems', {
	apiVersion: 2,
	title: __( 'QU Common Problems', 'qu-commonproblems' ),
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		title: {
			type: 'string',
			default: 'Common ^problems and solutions^',
		},
		subtitle: {
			type: 'string',
			default: 'Experiencing problems with this software?',
		},
		subtitle2: {
			type: 'string',
			default: 'Take a look at our list of the most common problems and find out how you can solve them.',
		},
	},

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { clientId, attributes, setAttributes } = props;
		const { title, subtitle, subtitle2 } = attributes;
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
			<div { ...blockProps } className="qu-CommonProblems">
				{ ! manyFaqs ? (
					<>
						<div { ...blockProps }>
							<TextControl
								className="qu-CommonProblems__title"
								value={ title }
								onFocus={ ( e ) => e.currentTarget.select() }
								onChange={ ( value ) => setAttributes( { title: value } ) }
							/>
							<TextControl
								className="qu-CommonProblems__subtitle"
								value={ subtitle }
								onFocus={ ( e ) => e.currentTarget.select() }
								onChange={ ( value ) => setAttributes( { subtitle: value } ) }
							/>
							<TextControl
								className="qu-CommonProblems__subtitle"
								value={ subtitle2 }
								onFocus={ ( e ) => e.currentTarget.select() }
								onChange={ ( value ) => setAttributes( { subtitle2: value } ) }
							/>
						</div>
						<InnerBlocksLimited { ...props } />
					</>
				) : (
					<div className="input__limit--like wp-block">
						{ __(
							'Enhanced FAQ can be used on page only once',
							'qu-commonproblems'
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
