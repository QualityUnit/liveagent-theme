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
			qu_usecase_stats_edit: path.resolve(
				process.cwd(),
				'src',
				'edit_usecase_stats.js'
			),
			qu_usecase_edit: path.resolve( process.cwd(), 'src', 'edit.js' ),
			qu_usecase_frontend: path.resolve( process.cwd(), 'src/scss', 'frontend.scss' ),
		},
	},
};
