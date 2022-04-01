/**
 * External Dependencies
 */
const path = require( 'path' );

/**
 * WordPress Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	...{
		entry: {
			qu_checklist_edit_item: path.resolve(
				process.cwd(),
				'src',
				'edit_checklistitem.js'
			),
			qu_checklists_edit: path.resolve( process.cwd(), 'src', 'edit.js' ),
			qu_checklists_frontend: path.resolve(
				process.cwd(),
				'src',
				'frontend.js'
			),
		},
	},
};
