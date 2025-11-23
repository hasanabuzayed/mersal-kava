import gulp from 'gulp';
import rename from 'gulp-rename';
import notify from 'gulp-notify';
import autoprefixer from 'gulp-autoprefixer';
import postcss from 'gulp-postcss';
import postcssPresetEnv from 'postcss-preset-env';
import sassPlugin from 'gulp-sass';
import * as sass from 'sass';
import plumber from 'gulp-plumber';
import rtlcss from 'gulp-rtlcss';
import livereload from 'gulp-livereload';
import checktextdomain from 'gulp-checktextdomain';
import cleanCSS from 'gulp-clean-css';
import sourcemaps from 'gulp-sourcemaps';
import purgecss from 'gulp-purgecss';
// PurgeCSS config will be loaded dynamically in the task

const sassCompiler = sassPlugin(sass);

let sass_settings = {
	outputStyle: 'expanded',
	linefeed:    'crlf',
	indentType:  'tab',
	indentWidth: 1
};

// Environment detection
const isProduction = process.env.NODE_ENV === 'production';

// PostCSS configuration with modern CSS features
// postcss-preset-env includes autoprefixer and many modern CSS features
const postcssPlugins = [
	postcssPresetEnv( {
		stage: 2, // Enable stable CSS features (stage 0-4, lower = more experimental)
		features: {
			'nesting-rules': false, // Disable nesting (Sass handles this)
			'custom-properties': true, // Enable CSS custom properties
			'logical-properties-and-values': true, // Enable logical properties
			'color-function': true, // Enable modern color functions (color(), oklab(), etc.)
			'cascade-layers': false, // Disable @layer (not widely supported yet)
			'has-pseudo-class': false // Disable :has() (not widely supported yet)
		},
		autoprefixer: {
			cascade: false // Match existing autoprefixer config
		}
	} )
];

function CSS_Task( args ) {

	if ( undefined !== args['sass_settings'] && 'object' === typeof (args['sass_settings']) ) {
		sass_settings = Object.assign( {}, sass_settings, args['sass_settings'] );
	}

	// Determine if we should minify based on args or environment
	const shouldMinify = args['minify'] !== undefined ? args['minify'] : isProduction;
	const shouldSourcemap = args['sourcemap'] !== undefined ? args['sourcemap'] : !isProduction;

	let stream = gulp.src( args['src'] )
		.pipe(
			plumber( {
				errorHandler: function( error ) {
					console.log( '=================ERROR=================' );
					console.log( error.message );
					this.emit( 'end' );
				}
			} )
		);

	// Initialize source maps if needed
	if ( shouldSourcemap ) {
		stream = stream.pipe( sourcemaps.init() );
	}

	stream = stream
		.pipe( sassCompiler( sass_settings ).on( 'error', sassCompiler.logError ) )
		.pipe( postcss( postcssPlugins ) );

	// Minify CSS if needed (only if not already compressed by Sass)
	if ( shouldMinify && sass_settings.outputStyle !== 'compressed' ) {
		stream = stream.pipe( cleanCSS( {
			compatibility: 'ie8',
			level: 2
		} ) );
	}

	// Write source maps if needed
	if ( shouldSourcemap ) {
		stream = stream.pipe( sourcemaps.write( '.' ) );
	}

	stream = stream
		.pipe( rename( args['output_file'] ) )
		.pipe( gulp.dest( args['output_dir'] ) )
		.pipe( notify( 'Compile ' + args['output_file'] + '. Done!' ) )
		.pipe( livereload() );

	return stream;
}

function RTL_CSS_Task( args ) {

	if ( undefined !== args['sass_settings'] && 'object' === typeof (args['sass_settings']) ) {
		sass_settings = Object.assign( {}, sass_settings, args['sass_settings'] );
	}

	// Determine if we should minify based on args or environment
	const shouldMinify = args['minify'] !== undefined ? args['minify'] : isProduction;
	const shouldSourcemap = args['sourcemap'] !== undefined ? args['sourcemap'] : !isProduction;

	let stream = gulp.src( args['src'] )
		.pipe(
			plumber( {
				errorHandler: function( error ) {
					console.log( '=================ERROR=================' );
					console.log( error.message );
					this.emit( 'end' );
				}
			} )
		);

	// Initialize source maps if needed
	if ( shouldSourcemap ) {
		stream = stream.pipe( sourcemaps.init() );
	}

	stream = stream
		.pipe( sassCompiler( sass_settings ).on( 'error', sassCompiler.logError ) )
		.pipe( postcss( postcssPlugins ) )
		.pipe( rtlcss() );

	// Minify CSS if needed (only if not already compressed by Sass)
	if ( shouldMinify && sass_settings.outputStyle !== 'compressed' ) {
		stream = stream.pipe( cleanCSS( {
			compatibility: 'ie8',
			level: 2
		} ) );
	}

	// Write source maps if needed
	if ( shouldSourcemap ) {
		stream = stream.pipe( sourcemaps.write( '.' ) );
	}

	stream = stream
		.pipe( rename( args['output_file'] ) )
		.pipe( gulp.dest( args['output_dir'] ) )
		.pipe( notify( 'Compile ' + args['output_file'] + '. Done!' ) )
		.pipe( livereload() );

	return stream;
}

gulp.task( 'css', function() {
	return CSS_Task( {
		src:         './assets/sass/style.scss',
		output_dir:  './',
		output_file: 'style.css',
		minify:      false,
		sourcemap:   true
	} );
} );

gulp.task( 'css_min', function() {
	return CSS_Task( {
		src:         './assets/sass/style.scss',
		output_dir:  './',
		output_file: 'style.css',
		minify:      true,
		sourcemap:   false
	} );
} );

gulp.task( 'css_theme', function() {
	return CSS_Task( {
		src:         './assets/sass/theme.scss',
		output_dir:  './',
		output_file: 'theme.css',
		minify:      false,
		sourcemap:   true
	} );
} );

gulp.task( 'css_theme_min', function() {
	return CSS_Task( {
		src:         './assets/sass/theme.scss',
		output_dir:  './',
		output_file: 'theme.css',
		minify:      true,
		sourcemap:   false
	} );
} );

gulp.task( 'blog_layouts_module', function() {
	return CSS_Task( {
		src:         './inc/modules/blog-layouts/assets/scss/blog-layouts-module.scss',
		output_dir:  './inc/modules/blog-layouts/assets/css/',
		output_file: 'blog-layouts-module.css',
		sass_settings: {
			outputStyle: isProduction ? 'compressed' : 'expanded'
		},
		minify:      false, // Already compressed by Sass if production
		sourcemap:   !isProduction
	} );
} );

gulp.task( 'woo_module', function() {
	return CSS_Task( {
		src:         './inc/modules/woo/assets/scss/woo-module.scss',
		output_dir:  './inc/modules/woo/assets/css/',
		output_file: 'woo-module.css',
		sass_settings: {
			outputStyle: isProduction ? 'compressed' : 'expanded'
		},
		minify:      false, // Already compressed by Sass if production
		sourcemap:   !isProduction
	} );
} );

gulp.task( 'woo_module_rtl', function() {
	return RTL_CSS_Task( {
		src:         './inc/modules/woo/assets/scss/woo-module.scss',
		output_dir:  './inc/modules/woo/assets/css/',
		output_file: 'woo-module-rtl.css',
		sass_settings: {
			outputStyle: isProduction ? 'compressed' : 'expanded'
		},
		minify:      false, // Already compressed by Sass if production
		sourcemap:   !isProduction
	} );
} );

gulp.task( 'admin_css', function() {
	return CSS_Task( {
		src:         './assets/sass/admin.scss',
		output_dir:  './assets/css/',
		output_file: 'admin.css',
		sass_settings: {
			outputStyle: isProduction ? 'compressed' : 'expanded'
		},
		minify:      false, // Already compressed by Sass if production
		sourcemap:   !isProduction
	} );
} );

gulp.task( 'watch', function() {
	//livereload.listen();

	gulp.watch( ['./assets/sass/**', '!./assets/sass/admin.scss'], gulp.series( 'css', 'css_theme' ) );
	gulp.watch( './inc/modules/blog-layouts/assets/scss/**',       gulp.series( 'blog_layouts_module' ) );
	gulp.watch( './inc/modules/woo/assets/scss/**',                gulp.parallel( 'woo_module', 'woo_module_rtl' ) );
	gulp.watch( './assets/sass/admin.scss',                        gulp.series( 'admin_css' ) );

} );

// Lint CSS/SCSS files using stylelint
// Run via CLI: npx stylelint "assets/sass/**/*.scss"
// Or: npx gulp lint:css
gulp.task( 'lint:css', async function() {
	// Use Node's child_process to run stylelint CLI (ES module syntax)
	const { spawn } = await import( 'node:child_process' );

	return new Promise( ( resolve, reject ) => {
		const stylelint = spawn( 'npx', [
			'stylelint',
			'assets/sass/**/*.scss',
			'inc/modules/**/assets/scss/**/*.scss',
			'--formatter',
			'string'
		], {
			stdio: 'inherit',
			shell: true,
			cwd: process.cwd()
		} );

		stylelint.on( 'close', ( code ) => {
			// stylelint exits with code 2 if there are linting errors (non-fatal)
			if ( code === 0 || code === 2 ) {
				resolve();
			} else {
				reject( new Error( `stylelint exited with code ${code}` ) );
			}
		} );

		stylelint.on( 'error', ( error ) => {
			reject( error );
		} );
	} );
} );

// Analyze CSS files for optimization opportunities
// Run via CLI: npx analyze-css style.css
// Or: npx gulp analyze:css
gulp.task( 'analyze:css', async function() {
	const { spawn } = await import( 'node:child_process' );
	const { readdir } = await import( 'node:fs/promises' );
	const path = await import( 'node:path' );

	return new Promise( async ( resolve, reject ) => {
		try {
			// Find all CSS files in the theme (non-minified)
			const cssFiles = [];
			const cssDirs = [
				{ path: './', pattern: /^[^\.].*\.css$/ }, // Root CSS files (not .min.css)
				{ path: './inc/modules/blog-layouts/assets/css/', pattern: /^blog-layouts-module\.css$/ },
				{ path: './inc/modules/woo/assets/css/', pattern: /^woo-module\.css$/ },
				{ path: './assets/css/', pattern: /.*\.css$/ }
			];

			for ( const dir of cssDirs ) {
				try {
					const files = await readdir( dir.path );
					const cssInDir = files
						.filter( file => dir.pattern.test( file ) && !file.endsWith( '.min.css' ) )
						.map( file => path.join( dir.path, file ) );
					cssFiles.push( ...cssInDir );
				} catch ( err ) {
					// Directory might not exist, skip
					console.log( `Skipping ${dir.path} (not found)` );
				}
			}

			if ( cssFiles.length === 0 ) {
				console.log( 'No CSS files found to analyze.' );
				resolve();
				return;
			}

			console.log( `\n📊 Analyzing ${cssFiles.length} CSS file(s)...\n` );
			console.log( 'Files to analyze:', cssFiles.join( ', ' ), '\n' );

			// Analyze files one by one (analyze-css processes one file at a time)
			let completed = 0;
			let hasErrors = false;

			for ( const file of cssFiles ) {
				await new Promise( ( fileResolve ) => {
					console.log( `\n🔍 Analyzing: ${file}\n` );
					const analyzeProcess = spawn( 'npx', [
						'analyze-css',
						'--file',
						file,
						'--pretty'
					], {
						stdio: 'inherit',
						shell: true,
						cwd: process.cwd()
					} );

					analyzeProcess.on( 'close', ( code ) => {
						completed++;
						if ( code !== 0 ) {
							hasErrors = true;
						}
						if ( completed === cssFiles.length ) {
							if ( hasErrors ) {
								console.log( '\n⚠️  Analysis completed with some warnings/errors' );
							} else {
								console.log( '\n✅ CSS analysis complete!' );
							}
							resolve();
						} else {
							fileResolve();
						}
					} );

					analyzeProcess.on( 'error', ( error ) => {
						console.error( `Error analyzing ${file}:`, error.message );
						hasErrors = true;
						completed++;
						if ( completed === cssFiles.length ) {
							resolve();
						} else {
							fileResolve();
						}
					} );
				} );
			}
		} catch ( error ) {
			reject( error );
		}
	} );
} );

// PurgeCSS task for blog-layouts-module.css (Phase 1)
// This is a separate task to allow testing before integrating into main build
gulp.task( 'purgecss:blog-layouts', async function() {
	// Load PurgeCSS config dynamically
	const purgecssConfigModule = await import( './purgecss.config.mjs' );
	const purgecssConfig = purgecssConfigModule.default || purgecssConfigModule;

	// Ensure blog-layouts-module.css exists first
	return gulp.src( './inc/modules/blog-layouts/assets/css/blog-layouts-module.css' )
		.pipe(
			plumber( {
				errorHandler: function( error ) {
					console.log( '=================ERROR=================' );
					console.log( error.message );
					this.emit( 'end' );
				}
			} )
		)
		.pipe(
			purgecss( {
				content: purgecssConfig.content,
				safelist: [
					// Combine all safelist patterns
					...purgecssConfig.safelist.standard,
					...purgecssConfig.safelist.deep,
					...purgecssConfig.safelist.greedy,
					// Preserve ALL selectors with pseudo-elements (::before, ::after) - Font Awesome uses these
					/::before/,
					/::after/,
					/:before/,
					/:after/,
					// Preserve blog layout selectors that use Font Awesome icons
					/\.btn-icon/,
					/\.btn-text-icon/,
					/\.swiper-button/,
					/\.comments-link/,
					/\.justify-item/,
					/\.grid-item/,
					/\.masonry-item/,
					/\.creative-item/,
					/\.posts-list/,
					/\.posts-list__item/,
					// Preserve any selector containing Font Awesome font-family (via function)
					// This is handled by preserving all :before/:after selectors above
				],
				fontFace: purgecssConfig.fontFace,
				keyframes: purgecssConfig.keyframes,
				variables: purgecssConfig.variables,
				defaultExtractor: purgecssConfig.defaultExtractor,
				// Preserve CSS rules containing Font Awesome font-family
				// This is a custom option - we'll handle it via post-processing if needed
			} )
		)
		.pipe( cleanCSS( {
			compatibility: 'ie8',
			level: 2
		} ) ) // Minify after purging
		.pipe( rename( 'blog-layouts-module.css' ) )
		.pipe( gulp.dest( './inc/modules/blog-layouts/assets/css/' ) )
		.pipe( notify( 'Purged blog-layouts-module.css. Done!' ) );
} );

// Production build task (minified)
gulp.task( 'build', gulp.parallel(
	'css_min',
	'css_theme_min',
	'blog_layouts_module',
	'woo_module',
	'woo_module_rtl',
	'admin_css'
) );

// default (development with watch)
gulp.task( 'default', gulp.series(
	gulp.parallel(
		'css',
		'css_theme',
		'blog_layouts_module',
		'woo_module',
		'woo_module_rtl',
		'admin_css'
	),
	'watch'
) );

gulp.task( 'checktextdomain', function() {
	return gulp.src( ['**/*.php', '!framework/**/*.php'] )
		.pipe( checktextdomain( {
			text_domain: 'kava',
			keywords: [
				'__:1,2d',
				'_e:1,2d',
				'_x:1,2c,3d',
				'esc_html__:1,2d',
				'esc_html_e:1,2d',
				'esc_html_x:1,2c,3d',
				'esc_attr__:1,2d',
				'esc_attr_e:1,2d',
				'esc_attr_x:1,2c,3d',
				'_ex:1,2c,3d',
				'_n:1,2,4d',
				'_nx:1,2,4c,5d',
				'_n_noop:1,2,3d',
				'_nx_noop:1,2,3c,4d',
				'translate_nooped_plural:1,2c,3d'
			]
		} ) );
} );

