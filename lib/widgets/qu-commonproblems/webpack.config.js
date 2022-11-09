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
			qu_commonproblems_edit_item: path.resolve(
				process.cwd(),
				'src',
				'edit_commonproblems_item.js'
			),
			qu_commonproblems_edit: path.resolve( process.cwd(), 'src', 'edit.js' ),
			qu_commonproblems_frontend: path.resolve(
				process.cwd(),
				'src/scss',
				'frontend.scss'
			),
		},
	},
};
