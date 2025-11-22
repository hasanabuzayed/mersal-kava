<?php
if ( ! class_exists( 'Kava_Theme_Setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	class Kava_Theme_Setup {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   Kava_Theme_Setup
		 */
		private static $instance = null;

		/**
		 * True if the page is a blog or archive.
		 *
		 * @since 1.0.0
		 * @var   Boolean
		 */
		private $is_blog = false;

		/**
		 * Sidebar position.
		 *
		 * @since 1.0.0
		 * @var   String
		 */
		public $sidebar_position = 'none';

		/**
		 * Loaded modules
		 *
		 * @var array
		 */
		public $modules = [];

		/**
		 * Theme version
		 *
		 * @var string
		 */
		public readonly string $version;

		/**
		 * Framework component
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    object
		 */
		public $framework;

		/**
		 * Holder for current Customizer module instance.
		 *
		 * @since 1.0.0
		 * @var   CX_Customizer
		 */
		public $customizer = null;

		/**
		 * Holder for current Dynamic CSS module instance.
		 *
		 * @since 1.0.0
		 * @var   CX_Dynamic_CSS
		 */
		public $dynamic_css = null;

		/**
		 * Layout configs.
		 *
		 * @since 1.0.0
		 */
		public $layout = [];

		/**
		 * Sets up needed actions/filters for the theme to initialize.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$template      = get_template();
			$theme_obj     = wp_get_theme( $template );
			$this->version = $theme_obj->get( 'Version' );

			// Load the theme modules.
			add_action( 'after_setup_theme', [ $this, 'framework_loader' ], -20 );

			// Resource hints for external domains (early in head, priority 1)
			add_action( 'wp_head', [ $this, 'add_resource_hints' ], 1 );

			// Optimize font loading (early in head, priority 2)
			add_action( 'wp_head', [ $this, 'optimize_font_loading' ], 2 );

			// Init properties.
			add_action( 'wp_head', [ $this, 'init_theme_properties' ] );

			// Language functions and translations setup.
			add_action( 'after_setup_theme', [ $this, 'l10n' ], 2 );

			// Handle theme supported features.
			add_action( 'after_setup_theme', [ $this, 'theme_support' ], 3 );

			// Load the theme includes.
			add_action( 'after_setup_theme', [ $this, 'includes' ], 4 );

			// Load theme modules.
			add_action( 'after_setup_theme', [ $this, 'load_modules' ], 5 );

			// Initialization of customizer.
			add_action( 'after_setup_theme', [ $this, 'init_customizer' ] );

			// Register public assets.
			add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ], 9 );

			// Enqueue scripts.
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 10 );

			// Enqueue styles.
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 10 );

			// Enqueue admin assets.
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );

			// Maybe register Elementor Pro locations.
			add_action( 'elementor/theme/register_locations', [ $this, 'elementor_locations' ] );

		}

		/**
		 * Retuns theme version
		 *
		 * @return string
		 */
		public function version(): string {
			return apply_filters( 'kava-theme/version', $this->version );
		}

		/**
		 * Load the theme modules.
		 *
		 * @since  1.0.0
		 */
		public function framework_loader(): void {

			require get_theme_file_path( 'framework/loader.php' );

			$this->framework = new Kava_CX_Loader(
				[
					get_theme_file_path( 'framework/modules/customizer/cherry-x-customizer.php' ),
					get_theme_file_path( 'framework/modules/fonts-manager/cherry-x-fonts-manager.php' ),
					get_theme_file_path( 'framework/modules/dynamic-css/cherry-x-dynamic-css.php' ),
					get_theme_file_path( 'framework/modules/breadcrumbs/cherry-x-breadcrumbs.php' ),
					get_theme_file_path( 'framework/modules/post-meta/cherry-x-post-meta.php' ),
					get_theme_file_path( 'framework/modules/interface-builder/cherry-x-interface-builder.php' ),
					get_theme_file_path( 'framework/modules/vue-ui/cherry-x-vue-ui.php' ),
				]
			);

		}

		/**
		 * Run initialization of customizer.
		 *
		 * @since 1.0.0
		 */
		public function init_customizer(): void {

			$enable_customize_options = kava_settings()->get( 'enable_theme_customize_options', true );
			$enqueue_dynamic_css      = kava_settings()->get( 'enqueue_dynamic_css', true );

			// Init CX_Customizer
			$customizer_options = kava_get_customizer_options();

			if ( ! filter_var( $enable_customize_options, FILTER_VALIDATE_BOOLEAN ) ) {
				$customizer_options['just_fonts'] = true;
			}

			$this->customizer = new CX_Customizer( $customizer_options );

			// Init CX_Dynamic_CSS
			if ( filter_var( $enqueue_dynamic_css, FILTER_VALIDATE_BOOLEAN ) ) {
				$this->dynamic_css = new CX_Dynamic_CSS( kava_get_dynamic_css_options() );
			}

		}

		/**
		 * Run init init properties.
		 *
		 * @since 1.0.0
		 */
		public function init_theme_properties(): void {

			$this->is_blog = is_home() || ( is_archive() && ! is_tax() && ! is_post_type_archive() ) ? true : false;

			// Blog list properties init
			if ( $this->is_blog ) {
				$this->sidebar_position = kava_theme()->customizer->get_value( 'blog_sidebar_position' );
			}

			// Single blog properties init
			if ( is_singular( 'post' ) ) {
				$this->sidebar_position = kava_theme()->customizer->get_value( 'single_sidebar_position' );
			}

		}

		/**
		 * Loads the theme translation file.
		 *
		 * @since 1.0.0
		 */
		public function l10n(): void {

			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain( 'kava', get_theme_file_path( 'languages' ) );

		}

		/**
		 * Adds theme supported features.
		 *
		 * @since 1.0.0
		 */
		public function theme_support(): void {

			global $content_width;

			if ( ! isset( $content_width ) ) {
				$content_width = 1200;
			}

			// Add support for core custom logo.
			add_theme_support( 'custom-logo', [
				'height'      => 35,
				'width'       => 135,
				'flex-width'  => true,
				'flex-height' => true
			] );

			// Enable support for Post Thumbnails on posts and pages.
			add_theme_support( 'post-thumbnails' );

			// Enable HTML5 markup structure.
			add_theme_support( 'html5', [
				'comment-list', 'comment-form', 'search-form', 'gallery', 'caption',
			] );

			// Enable default title tag.
			add_theme_support( 'title-tag' );

			// Enable custom background.
			add_theme_support( 'custom-background', [ 'default-color' => 'ffffff', ] );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

		}

		/**
		 * Loads the theme files supported by themes and template-related functions/classes.
		 *
		 * @since 1.0.0
		 */
		public function includes(): void {

			/**
			 * Configurations.
			 */
			require_once get_theme_file_path( 'config/layout.php' );
			require_once get_theme_file_path( 'config/menus.php' );
			require_once get_theme_file_path( 'config/sidebars.php' );
			require_once get_theme_file_path( 'config/modules.php' );

			require_if_theme_supports( 'post-thumbnails', get_theme_file_path( 'config/thumbnails.php' ) );

			require_once get_theme_file_path( 'inc/modules/base.php' );

			/**
			 * Classes.
			*/
			require_once get_theme_file_path( 'inc/classes/class-widget-area.php' );
			require_once get_theme_file_path( 'inc/classes/class-post-meta.php' );
			require_once get_theme_file_path( 'inc/classes/class-settings.php' );
			require_once get_theme_file_path( 'inc/classes/class-dynamic-css-file.php' );

			/**
			 * Functions.
			 */
			require_once get_theme_file_path( 'inc/template-tags.php' );
			require_once get_theme_file_path( 'inc/template-menu.php' );
			require_once get_theme_file_path( 'inc/template-comment.php' );
			require_once get_theme_file_path( 'inc/template-related-posts.php' );
			require_once get_theme_file_path( 'inc/extras.php' );
			require_once get_theme_file_path( 'inc/customizer.php' );
			require_once get_theme_file_path( 'inc/context.php' );
			require_once get_theme_file_path( 'inc/hooks.php' );

		}

		/**
		 * Modules base path
		 *
		 * @return string
		 */
		public function modules_base(): string {
			return 'inc/modules/';
		}

		/**
		 * Returns module class by name
		 * @return string
		 */
		public function get_module_class( string $name ): string {

			$module = str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $name ) ) );
			return 'Kava_' . $module . '_Module';

		}

		/**
		 * Load theme and child theme modules
		 *
		 * @return void
		 */
		public function load_modules(): void {
			foreach ( kava_get_allowed_modules() as $module => $childs ) {
				$this->load_module( $module, $childs );
			}
		}

		/**
		 * Load theme and child theme module
		 *
		 * @param string $module
		 * @param array  $childs
		 */
		public function load_module( string $module = '', array $childs = [] ): void {

			$available_modules = kava_settings()->get( 'available_modules' );
			$enabled = $available_modules[ $module ] ?? true;

			if ( ! filter_var( $enabled, FILTER_VALIDATE_BOOLEAN ) ) {
				return;
			}

			if ( ! file_exists( get_theme_file_path( $this->modules_base() . $module . '/module.php' ) ) ) {
				return;
			}

			require_once get_theme_file_path( $this->modules_base() . $module . '/module.php' );
			$class = $this->get_module_class( $module );

			if ( ! class_exists( $class ) ) {
				return;
			}

			$instance = new $class( $childs );

			$this->modules[ $instance->module_id() ] = $instance;
		}

		/**
		 * Register assets.
		 *
		 * @since 1.0.0
		 */
		public function register_assets(): void {
			// Register Font Awesome 6 exclusively via CDN
			// CDN provides: Font Awesome 6 Free (solid/regular), Font Awesome 6 Brands, and legacy FontAwesome font-face
			// The legacy FontAwesome font-family is used for CSS pseudo-elements (::before, ::after) with Unicode content
			wp_register_style(
				'font-awesome',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css',
				[],
				'7.0.1'
			);

			// Register Montserrat font from Google Fonts with optimized loading
			// display=swap ensures text is visible during font load (prevents FOIT - Flash of Invisible Text)
			wp_register_style(
				'montserrat-font',
				'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap',
				[],
				null
			);
		}

		/**
		 * Enqueue scripts.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_scripts(): void {

			/**
			 * Filter the depends on main theme script.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$scripts_depends = apply_filters( 'kava-theme/assets-depends/script', [
				'jquery'
			] );

			$enqueue_js_scripts = kava_settings()->get( 'enqueue_theme_js_scripts', true );

			if ( filter_var( $enqueue_js_scripts, FILTER_VALIDATE_BOOLEAN ) ) {
				wp_enqueue_script(
					'kava-theme-script',
					get_theme_file_uri( 'assets/js/theme-script.js' ),
					$scripts_depends,
					$this->version(),
					true
				);

				wp_localize_script( 'kava-theme-script', 'kavaConfig', [
					'toTop' => kava_theme()->customizer->get_value( 'totop_visibility' ),
				] );
			}

			// Threaded Comments.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

		}

		/**
		 * Enqueue styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_styles(): void {

			/**
			 * Filter the depends on main theme styles.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$styles_depends = apply_filters( 'kava-theme/assets-depends/styles', [
				'font-awesome',
				'montserrat-font',
			] );

			// Preload critical CSS for faster initial render
			$style_uri = get_stylesheet_uri();
			$style_version = $this->version();
			$this->preload_critical_css( $style_uri, $style_version );

			// Critical CSS: Load synchronously (render-blocking)
			wp_enqueue_style(
				'kava-theme-style',
				$style_uri,
				$styles_depends,
				$style_version
			);

			$enqueue_styles = kava_settings()->get( 'enqueue_theme_styles', true );

			if ( filter_var( $enqueue_styles, FILTER_VALIDATE_BOOLEAN ) ) {
				$theme_css_uri = get_theme_file_uri( 'theme.css' );

				// Preload main theme CSS
				$this->preload_critical_css( $theme_css_uri, $this->version() );

				// Critical CSS: Load synchronously (render-blocking)
				wp_enqueue_style(
					'kava-theme-main-style',
					$theme_css_uri,
					[ 'kava-theme-style' ],
					$this->version()
				);

				if ( is_rtl() ) {
					// RTL CSS: Load synchronously (needed for proper layout)
					wp_enqueue_style(
						'kava-theme-main-rtl-style',
						get_theme_file_uri( 'theme-rtl.css' ),
						[ 'kava-theme-main-style' ],
						$this->version()
					);
				}
			}

			// Optimize CSS loading order and async loading for non-critical CSS
			$this->optimize_css_loading_order();
		}

		/**
		 * Preload critical CSS for faster initial render.
		 *
		 * @since 1.0.0
		 * @param string $href CSS file URL
		 * @param string $version Version string for cache busting
		 */
		private function preload_critical_css( string $href, string $version ): void {
			$href_with_version = add_query_arg( 'ver', $version, $href );

			printf(
				'<link rel="preload" as="style" href="%s" onload="this.onload=null;this.rel=\'stylesheet\'">%s',
				esc_url( $href_with_version ),
				"\n"
			);

			// Fallback for browsers that don't support preload
			printf(
				'<noscript><link rel="stylesheet" href="%s"></noscript>%s',
				esc_url( $href_with_version ),
				"\n"
			);
		}

		/**
		 * Optimize CSS loading order and implement async loading for non-critical CSS.
		 *
		 * @since 1.0.0
		 */
		private function optimize_css_loading_order(): void {
			/**
			 * Filter to allow async loading of non-critical CSS.
			 *
			 * @since 1.0.0
			 * @param bool $enable_async_css Whether to enable async CSS loading. Default: true.
			 */
			$enable_async_css = apply_filters( 'kava-theme/enable-async-css', true );

			if ( ! $enable_async_css ) {
				return;
			}

			// Hook into style_loader_tag to add async loading for non-critical CSS
			add_filter( 'style_loader_tag', [ $this, 'async_non_critical_css' ], 10, 4 );
		}

		/**
		 * Add async loading to non-critical CSS files.
		 *
		 * Non-critical CSS includes:
		 * - Module CSS (blog-layouts, woo-module) - loaded conditionally
		 * - Dynamic CSS - loaded after critical CSS
		 *
		 * @since 1.0.0
		 * @param string $html   The link tag for the enqueued style.
		 * @param string $handle The style's registered handle.
		 * @param string $href   The stylesheet's source URL.
		 * @param string $media  The stylesheet's media attribute.
		 * @return string Modified link tag.
		 */
		public function async_non_critical_css( string $html, string $handle, string $href, string $media ): string {
			// List of non-critical CSS handles that can be loaded asynchronously
			$non_critical_handles = apply_filters( 'kava-theme/non-critical-css-handles', [
				'blog-layouts-module',
				'blog-layouts-module-rtl',
				'kava-woocommerce-style',
				'kava-theme-dynamic-style',
			] );

			// Only apply async loading to non-critical CSS
			if ( ! in_array( $handle, $non_critical_handles, true ) ) {
				return $html;
			}

			// Replace the link tag with async loading version
			// Use media="print" trick with onload to load asynchronously
			$async_html = str_replace(
				"media='{$media}'",
				"media='print' onload=\"this.media='{$media}'\"",
				$html
			);

			// Add noscript fallback for browsers without JavaScript
			$async_html .= '<noscript>' . $html . '</noscript>';

			return $async_html;
		}

		/**
		 * Add resource hints (preconnect, dns-prefetch) for external resources.
		 *
		 * @since 1.0.0
		 */
		public function add_resource_hints(): void {
			// Preconnect to Google Fonts for faster font loading
			echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
			echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

			// Preconnect to CDN for Font Awesome
			echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com">' . "\n";

			/**
			 * Filter to add additional resource hints.
			 *
			 * @since 1.0.0
			 * @param array $hints Array of resource hint URLs.
			 */
			$additional_hints = apply_filters( 'kava-theme/resource-hints', [] );

			foreach ( $additional_hints as $hint ) {
				if ( ! empty( $hint['href'] ) ) {
					$crossorigin = ! empty( $hint['crossorigin'] ) ? ' crossorigin' : '';
					$rel = ! empty( $hint['rel'] ) ? $hint['rel'] : 'preconnect';
					printf(
						'<link rel="%s" href="%s"%s>' . "\n",
						esc_attr( $rel ),
						esc_url( $hint['href'] ),
						$crossorigin
					);
				}
			}
		}

		/**
		 * Optimize font loading with preload and font-display.
		 *
		 * @since 1.0.0
		 */
		public function optimize_font_loading(): void {
			/**
			 * Filter to enable/disable font loading optimization.
			 *
			 * @since 1.0.0
			 * @param bool $enable Whether to enable font loading optimization. Default: true.
			 */
			$enable_optimization = apply_filters( 'kava-theme/enable-font-optimization', true );

			if ( ! $enable_optimization ) {
				return;
			}

			// Add font-display: swap via inline style for Google Fonts
			// This is handled by the display=swap parameter in the Google Fonts URL
			// Additional optimization: Add preload for critical font files if needed

			/**
			 * Filter to add font preload hints.
			 *
			 * @since 1.0.0
			 * @param array $fonts Array of font preload configurations.
			 */
			$font_preloads = apply_filters( 'kava-theme/font-preloads', [] );

			foreach ( $font_preloads as $font ) {
				if ( ! empty( $font['href'] ) ) {
					$as = ! empty( $font['as'] ) ? $font['as'] : 'font';
					$type = ! empty( $font['type'] ) ? $font['type'] : '';
					$crossorigin = ! empty( $font['crossorigin'] ) ? ' crossorigin' : ' crossorigin';

					printf(
						'<link rel="preload" as="%s" href="%s" type="%s"%s>' . "\n",
						esc_attr( $as ),
						esc_url( $font['href'] ),
						esc_attr( $type ),
						$crossorigin
					);
				}
			}
		}

		/**
		 * Enqueue admin assets
		 *
		 * @return void
		 */
	public function enqueue_admin_assets(): void {
		wp_enqueue_style(
			'kava-theme-admin-css',
			get_parent_theme_file_uri( 'assets/css/admin.css' ),
			false,
			$this->version()
		);
	}

		/**
		 * Do Elementor or Jet Theme Core location
		 *
		 * @param string|null $location
		 * @param string|array|null $fallback
		 *
		 * @return bool
		 */
		public function do_location( ?string $location = null, string|array|null $fallback = null ): bool {

			$handler = false;
			$done    = false;

			// Choose handler
			if ( function_exists( 'jet_theme_core' ) ) {
				$handler = [ jet_theme_core()->locations, 'do_location' ];
			} elseif ( function_exists( 'elementor_theme_do_location' ) ) {
				$handler = 'elementor_theme_do_location';
			}

			// If handler is found - try to do passed location
			if ( false !== $handler ) {
				$done = call_user_func( $handler, $location );
			}

			if ( true === $done ) {
				// If location successfully done - return true
				return true;
			} elseif ( null !== $fallback ) {
				// If for some reasons location coludn't be done and passed fallback template name - include this template and return
				if ( is_array( $fallback ) ) {
					// fallback in name slug format
					get_template_part( $fallback[0], $fallback[1] );
				} else {
					// fallback with just a name
					get_template_part( $fallback );
				}
				return true;
			}

			// In other cases - return false
			return false;

		}

		/**
		 * Register Elementor Pro locations
		 *
		 * @param mixed $elementor_theme_manager
		 */
		public function elementor_locations( mixed $elementor_theme_manager ): void {

			// Do nothing if Jet Theme Core is active.
			if ( function_exists( 'jet_theme_core' ) ) {
				return;
			}

			$elementor_theme_manager->register_all_core_location();
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return Kava_Theme_Setup
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}
	}
}

/**
 * Returns instance of main theme configuration class.
 *
 * @since  1.0.0
 * @return Kava_Theme_Setup
 */
function kava_theme(): object {
	return Kava_Theme_Setup::get_instance();
}

kava_theme();
