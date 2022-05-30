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
			qu_howto_edit_item: path.resolve(
				process.cwd(),
				'src',
				'edit_howtoitem.js'
			),
			qu_howtos_edit: path.resolve( process.cwd(), 'src', 'edit.js' ),
		},
	},
};
