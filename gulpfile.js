const autoprefixer = require( 'gulp-autoprefixer' );
const browserSync = require( 'browser-sync' ).create();
const clean = require( 'del' );
const concat = require( 'gulp-concat' );
const eslint = require( 'gulp-eslint' );
const filter = require( 'gulp-filter' );
const gcmq = require( 'gulp-group-css-media-queries' );
const gulp = require( 'gulp' );
const plumber = require( 'gulp-plumber' );
const rename = require( 'gulp-rename' );
const replace = require( 'gulp-replace' );
const sass = require( 'gulp-sass' )( require( 'sass' ) );
const stylelint = require( 'gulp-stylelint' );
const terser = require( 'gulp-terser' );
const uglifycss = require( 'gulp-uglifycss' );
const revertPath = require( 'gulp-revert-path' );
const rtlcss = require( 'gulp-rtlcss' );
const svgSprites = require( 'gulp-svg-sprite' );

gulp.task( 'set-path', async () => {
	if ( process.env.NODE_ENV === 'production' ) {
		return process.env.url = '/app/themes/liveagent/assets';
	}
	return process.env.url = '/app/themes/liveagent-theme/assets';
} );

gulp.task( 'browser-reload', ( done ) => {
	browserSync.reload();
	done();
} );

gulp.task( 'clean-dist', () =>
	clean(
		[
			'./assets/dist/**/*',
		],
		{ force: true }
	)
);

gulp.task( 'browser-sync', () => {
	browserSync.init(
		[ '**/*.html', '**/*.php', '**/*.{png,jpg,jpeg,gif,svg}' ],
		{
			proxy: 'http://liveagent.local',
			port: 3000,
			open: false,
			notify: false,
			injectChanges: true,
		}
	);

	gulp.watch( './assets/styles/**/*.scss', gulp.series( 'styles' ) );
	gulp.watch( './assets/scripts/app/**/*.js', gulp.series( 'app-js' ) );
	gulp.watch(
		'./assets/scripts/vendor/splide.js',
		gulp.series( 'splide-js' )
	);
	gulp.watch(
		'./assets/scripts/vendor/popper.js',
		gulp.series( 'popper-js' )
	);
	gulp.watch( './assets/scripts/custom/**/*.js', gulp.series( 'custom-js' ) );
	gulp.watch( './assets/scripts/static/**/*.js', gulp.series( 'static-js' ) );
	gulp.watch(
		'./assets/images/flags/*.svg',
		gulp.series( 'langFlagsSprite' )
	);
	gulp.watch(
		'./assets/images/icons-common/*.svg',
		gulp.series( 'iconsSprite' )
	);
} );

gulp.task( 'styles', () =>
	gulp
		.src( './assets/styles/**/*.scss' )
		.pipe( plumber() )
		.pipe(
			sass( {
				errLogToConsole: true,
				outputStyle: 'expanded',
				precision: 10,
			} )
		)
		.pipe( autoprefixer( 'last 3 version', 'android 4', 'ie 11' ) )
		.pipe( plumber.stop() )
		.pipe( replace( /(url\().+?(images|webfonts)/g, `$1${ process.env.url }/$2` ) )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( filter( '**/*.css' ) )
		.pipe( gcmq() )
		.pipe( browserSync.reload( { stream: true } ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglifycss() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( rtlcss() )
		.pipe( revertPath() )
		.pipe( rename( { suffix: '-rtl.min' } ) )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

const iconsConfig = {
	shape: {
		id: {
			separator: '/',
			generator: ( name ) => {
				const renamed = name.replace( '/', '-' ).replace( '.svg', '' );
				return renamed;
			},
		},
	},
	svg: {
		xmlDeclaration: false,
	},
	mode: {
		symbol: {
			dest: '.',
			sprite: 'icons.svg',
			prefix: '%s',
			dimensions: '',
			inline: false,
			rootviewbox: false,
		},
	},
};

const langFlagsConfig = {
	shape: {
		id: {
			generator: 'flag-%s',
		},
	},
	mode: {
		symbol: {
			dest: '.',
			sprite: 'flags.svg',
			prefix: '%s',
			dimensions: '',
			inline: true,
		},
	},
};

gulp.task( 'iconsSprite', () =>
	gulp
		.src( [
			'./vendor/qualityunit/wordpress-icons/icons/common/**/*.svg',
			'./vendor/qualityunit/wordpress-icons/icons/liveagent/**/*.svg',
		] )
		.pipe( svgSprites( iconsConfig ) )
		.pipe( gulp.dest( './assets/images' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'langFlagsSprite', () =>
	gulp
		.src( [ './assets/images/flags/*.svg' ] )
		.pipe( svgSprites( langFlagsConfig ) )
		.pipe( gulp.dest( './assets/images' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'splide-js', () =>
	gulp
		.src( [ './assets/scripts/vendor/splide.js' ] )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe(
			rename( {
				basename: 'splide',
				suffix: '.min',
			} )
		)
		.pipe( terser() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'popper-js', () =>
	gulp
		.src( [ './assets/scripts/vendor/popper.js' ] )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe(
			rename( {
				basename: 'popper',
				suffix: '.min',
			} )
		)
		.pipe( terser() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'app-js', () =>
	gulp
		.src( './assets/scripts/app/**/*.js' )
		.pipe( concat( 'app.js' ) )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe(
			rename( {
				basename: 'app',
				suffix: '.min',
			} )
		)
		.pipe( terser() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'custom-js', () =>
	gulp
		.src( './assets/scripts/custom/**/*.js' )
		.pipe( gulp.dest( './assets/dist' ) )
		.pipe(
			rename( ( path ) => {
				// eslint-disable-next-line no-param-reassign
				path.basename += '.min';
			} )
		)
		.pipe( terser() )
		.pipe( gulp.dest( './assets/dist/' ) )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'static-js', () =>
	gulp
		.src( './assets/scripts/static/**/*.js' )
		.pipe( browserSync.reload( { stream: true } ) )
);

gulp.task( 'stylelint', () =>
	gulp.src( 'assets/styles/**/*.scss' ).pipe(
		stylelint( {
			reporters: [
				{
					formatter: 'string',
					console: true,
				},
			],
		} )
	)
);

gulp.task( 'eslint', () =>
	gulp
		.src( 'assets/scripts/**/*.js' )
		.pipe( eslint() )
		.pipe( eslint.format() )
		.pipe( eslint.failAfterError() )
);

gulp.task(
	'build',
	gulp.series(
		'set-path',
		'clean-dist',
		'styles',
		'splide-js',
		'popper-js',
		'app-js',
		'custom-js',
		'langFlagsSprite',
		'iconsSprite'
	)
);

gulp.task(
	'default',
	gulp.series(
		'set-path',
		'clean-dist',
		'styles',
		'splide-js',
		'popper-js',
		'app-js',
		'custom-js',
		'static-js',
		'langFlagsSprite',
		'iconsSprite',
		'browser-sync'
	)
);
