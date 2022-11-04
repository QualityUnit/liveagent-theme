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
			qu_reviews_edit: path.resolve( process.cwd(), 'src', 'edit.js' ),
			qu_reviews_frontend: path.resolve( process.cwd(), 'src/scss', 'frontend.scss' ),
		},
	},
};
