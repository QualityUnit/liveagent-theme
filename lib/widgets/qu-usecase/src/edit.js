import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import parser from 'html-react-parser';

import Icon from './components/Icon';

import './scss/editor.scss';

const { registerBlockType } = wp.blocks;
const { select } = wp.data;
const { TextControl, TextareaControl } = wp.components;

registerBlockType( 'qu/usecase', {
	apiVersion: 2,
	title: 'Use Case',
	icon: <Icon />,
	category: 'widgets',
	attributes: {
		usecaseId: {
			type: 'string',
		},
		usecaseTitle: {
			type: 'string',
		},
		usecaseSubtitle: {
			type: 'string',
		},
		usecaseMap: {
			type: 'string',
			default: '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2661.540344671987!2d17.128980316353633!3d48.15766627922503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c893556b5f817%3A0xe9985321b47c6832!2sMileti%C4%8Dova%20550%2F1%2C%20821%2008%20Bratislava!5e0!3m2!1sen!2ssk!4v1657800940668!5m2!1sen!2ssk" width="600" height="450" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>',
		},
	},
	providesContext: {
		'qu/usecaseId': 'usecaseId',
	},

	edit: ( props ) => {
		const blockProps = useBlockProps();   //eslint-disable-line
		const { attributes, setAttributes } = props;
		const { usecaseTitle, usecaseSubtitle, usecaseMap } = attributes;
		const postTitle = select( 'core/editor' ).getEditedPostAttribute( 'title' );
		const ALLOWED_BLOCKS = [
			'qu/usecasestats',
		];
		const template = [
			[
				'qu/usecasestats',
				{
					placeholder: 'Add another Use case Stats by clicking on +',
				},
			],
		];

		if ( ! attributes.usecaseId ) {
			setAttributes( {
				usecaseId: blockProps[ 'data-block' ],
			} );
		}

		return (
			<div { ...blockProps } className="qu-UseCase">
				<div { ...blockProps } className="qu-UseCase__schema wp-block">
					<h1 { ...blockProps } title="Use case title">
						<TextareaControl
							label="Enter title:"
							rows="3"
							value={ usecaseTitle }
							help="Use ^ symbols in pairs to highlight parts of the title. Ie. Company Satur ^has grown^ thanks to LA"
							onFocus={ ( e ) => e.currentTarget.select() }
							onChange={ ( value ) => setAttributes( { usecaseTitle: value } ) }
						/>
					</h1>
					<h3 { ...blockProps } title="Use case subtitle">
						<TextareaControl
							label="Enter subtitle"
							rows="2"
							value={ usecaseSubtitle }
							onFocus={ ( e ) => e.currentTarget.select() }
							onChange={ ( value ) => setAttributes( { usecaseSubtitle: value } ) }
						/>
					</h3>
					<div className="qu-UseCase__stats--wrapper">
						<h3 className="qu-UseCase__stats--wrapper__title">Use Case Statistics</h3>
						<InnerBlocks
							{ ...blockProps }
							{ ...props }
							allowedBlocks={ ALLOWED_BLOCKS }
							template={ template }
						/>
					</div>

					<h2 className="Post__sectiontitle"><span>{ postTitle } company location</span></h2>
					<div { ...blockProps } title="Enter Google Maps url">
						<TextControl
							label="Google Maps Embed code (<iframe>)"
							value={ usecaseMap }
							onFocus={ ( e ) => e.currentTarget.select() }
							onChange={ ( value ) => setAttributes( { usecaseMap: value } ) }
						/>
						<div>{ usecaseMap
							? parser( usecaseMap )
							: '' }</div>
					</div>
				</div>

			</div>
		);
	},

	save: () => {
		return <InnerBlocks.Content />;
	},
} );
