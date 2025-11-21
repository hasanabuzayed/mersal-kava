import gulp from 'gulp';
import rename from 'gulp-rename';
import notify from 'gulp-notify';
import autoprefixer from 'gulp-autoprefixer';
import sassPlugin from 'gulp-sass';
import * as sass from 'sass';
import plumber from 'gulp-plumber';
import rtlcss from 'gulp-rtlcss';
import livereload from 'gulp-livereload';
import checktextdomain from 'gulp-checktextdomain';

const sassCompiler = sassPlugin(sass);

let sass_settings = {
	outputStyle: 'expanded',
	linefeed:    'crlf',
	indentType:  'tab',
	indentWidth: 1
};

function CSS_Task( args ) {

	if ( undefined !== args['sass_settings'] && 'object' === typeof (args['sass_settings']) ) {
		sass_settings = Object.assign( {}, sass_settings, args['sass_settings'] );
	}

	return gulp.src( args['src'] )
		.pipe(
			plumber( {
				errorHandler: function( error ) {
					console.log( '=================ERROR=================' );
					console.log( error.message );
					this.emit( 'end' );
				}
			} )
		)
		.pipe( sassCompiler( sass_settings ).on( 'error', sassCompiler.logError ) )
		.pipe( autoprefixer( {
			cascade: false
		} ) )
		.pipe( rename( args['output_file'] ) )
		.pipe( gulp.dest( args['output_dir'] ) )
		.pipe( notify( 'Compile ' + args['output_file'] + '. Done!' ) )
		.pipe( livereload() );
}

function RTL_CSS_Task( args ) {

	if ( undefined !== args['sass_settings'] && 'object' === typeof (args['sass_settings']) ) {
		sass_settings = Object.assign( {}, sass_settings, args['sass_settings'] );
	}

	return gulp.src( args['src'] )
		.pipe(
			plumber( {
				errorHandler: function( error ) {
					console.log( '=================ERROR=================' );
					console.log( error.message );
					this.emit( 'end' );
				}
			} )
		)
		.pipe( sassCompiler( sass_settings ).on( 'error', sassCompiler.logError ) )
		.pipe( autoprefixer( {
			cascade: false
		} ) )
		.pipe( rtlcss() )
		.pipe( rename( args['output_file'] ) )
		.pipe( gulp.dest( args['output_dir'] ) )
		.pipe( notify( 'Compile ' + args['output_file'] + '. Done!' ) )
		.pipe( livereload() );
}

gulp.task( 'css', function() {
	return CSS_Task( {
		src:         './assets/sass/style.scss',
		output_dir:  './',
		output_file: 'style.css'
	} );
} );

gulp.task( 'css_theme', function() {
	return CSS_Task( {
		src:         './assets/sass/theme.scss',
		output_dir:  './',
		output_file: 'theme.css'
	} );
} );

gulp.task( 'blog_layouts_module', function() {
	return CSS_Task( {
		src:         './inc/modules/blog-layouts/assets/scss/blog-layouts-module.scss',
		output_dir:  './inc/modules/blog-layouts/assets/css/',
		output_file: 'blog-layouts-module.css',
		sass_settings: {
			outputStyle: 'compressed'
		}
	} );
} );

gulp.task( 'woo_module', function() {
	return CSS_Task( {
		src:         './inc/modules/woo/assets/scss/woo-module.scss',
		output_dir:  './inc/modules/woo/assets/css/',
		output_file: 'woo-module.css',
		sass_settings: {
			outputStyle: 'compressed'
		}
	} );
} );

gulp.task( 'woo_module_rtl', function() {
	return RTL_CSS_Task( {
		src:         './inc/modules/woo/assets/scss/woo-module.scss',
		output_dir:  './inc/modules/woo/assets/css/',
		output_file: 'woo-module-rtl.css',
		sass_settings: {
			outputStyle: 'compressed'
		}
	} );
} );

gulp.task( 'admin_css', function() {
	return CSS_Task( {
		src:         './assets/sass/admin.scss',
		output_dir:  './assets/css/',
		output_file: 'admin.css',
		sass_settings: {
			outputStyle: 'compressed'
		}
	} );
} );

gulp.task( 'watch', function() {
	//livereload.listen();

	gulp.watch( ['./assets/sass/**', '!./assets/sass/admin.scss'], gulp.series( 'css', 'css_theme' ) );
	gulp.watch( './inc/modules/blog-layouts/assets/scss/**',       gulp.series( 'blog_layouts_module' ) );
	gulp.watch( './inc/modules/woo/assets/scss/**',                gulp.parallel( 'woo_module', 'woo_module_rtl' ) );
	gulp.watch( './assets/sass/admin.scss',                        gulp.series( 'admin_css' ) );

} );

// default
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

