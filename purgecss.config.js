/**
 * PurgeCSS Configuration for Kava v3 Theme
 * 
 * This configuration ensures that dynamic and plugin-generated classes
 * are not removed during CSS purging.
 * 
 * Usage: Used by gulp-purgecss in gulpfile.mjs
 */

// PurgeCSS configuration object
const purgecssConfig = {
	// Content paths to scan for class usage
	content: [
		// Root PHP files
		'./*.php',
		'./**/*.php',
		
		// Template parts
		'./template-parts/**/*.php',
		'./inc/**/*.php',
		'./inc/modules/**/*.php',
		
		// Specific module templates
		'./inc/modules/blog-layouts/**/*.php',
		'./inc/modules/woo/**/*.php',
		
		// JavaScript files
		'./assets/js/**/*.js',
		'./inc/modules/**/assets/js/**/*.js',
		
		// HTML files (if any)
		'./**/*.html',
	],

	// Comprehensive safelist to prevent removal of dynamic classes
	safelist: {
		// Standard patterns (regex)
		standard: [
			// WordPress core classes
			/^wp-/,
			/^wp-block-/,
			/^wp-element-/,
			/^has-/,
			/^is-/,
			/^align/,
			/^size-/,
			/^attachment-/,
			
			// WordPress admin classes
			/^admin/,
			/^screen-/,
			/^postbox/,
			
			// WordPress body classes (dynamic)
			/^home/,
			/^blog/,
			/^archive/,
			/^single/,
			/^page/,
			/^search/,
			/^404/,
			/^logged-in/,
			/^admin-bar/,
			
			// Elementor
			/^elementor-/,
			/^elementor-widget-/,
			/^elementor-section-/,
			/^elementor-column-/,
			/^elementor-row-/,
			
			// Jet Plugins (Crocoblock)
			/^jet-/,
			/^jet-listing-/,
			/^jet-engine-/,
			/^jet-smart-filters-/,
			/^jet-woo-/,
			/^jet-form-builder-/,
			/^jet-popup-/,
			/^jet-menu-/,
			/^jet-blog-/,
			/^jet-search-/,
			/^jet-reviews-/,
			/^jet-compare-/,
			/^jet-wishlist-/,
			
			// WooCommerce
			/^woocommerce-/,
			/^wc-/,
			/^product-/,
			/^cart-/,
			/^checkout-/,
			/^shop-/,
			/^order-/,
			/^account-/,
			/^variation-/,
			/^stock-/,
			/^outofstock/,
			/^instock/,
			/^onsale/,
			/^sale/,
			
			// Contact Form 7
			/^wpcf7-/,
			/^wpcf7-form/,
			
			// WPML
			/^wpml-/,
			/^lang-/,
			/^icl-/,
			
			// Ecwid
			/^ecwid-/,
			
			// Other common plugins
			/^yoast-/,
			/^schema-/,
			/^seo-/,
			
			// Kava theme classes
			/^kava-/,
			/^site-/,
			/^header-/,
			/^footer-/,
			/^main-/,
			/^sidebar-/,
			/^widget-/,
			/^menu-/,
			/^nav-/,
			/^breadcrumbs-/,
			/^post-/,
			/^entry-/,
			/^comment-/,
			/^author-/,
			/^pagination-/,
			/^page-/,
			/^archive-/,
			/^single-/,
			/^search-/,
			/^error-/,
			/^404-/,
			
			// Blog layouts (dynamic)
			/^blog-layout-/,
			/^layout-/,
			/^masonry-/,
			/^grid-/,
			/^list-/,
			/^vertical-/,
			/^horizontal-/,
			/^creative-/,
			/^default-/,
			/^justify-/,
			
			// Responsive classes
			/^mobile-/,
			/^tablet-/,
			/^desktop-/,
			/^hide-/,
			/^show-/,
			/^visible-/,
			/^hidden-/,
			
			// JavaScript-generated classes
			/^js-/,
			/^active/,
			/^current/,
			/^selected/,
			/^open/,
			/^closed/,
			/^expanded/,
			/^collapsed/,
			/^loading/,
			/^loaded/,
			/^error/,
			/^success/,
			/^disabled/,
			/^enabled/,
			
			// State classes
			/^is-/,
			/^has-/,
			/^no-/,
			
			// Animation classes
			/^animate-/,
			/^fade-/,
			/^slide-/,
			/^transition-/,
			
			// Common utility patterns
			/^clearfix/,
			/^sr-only/,
			/^screen-reader/,
			/^skip-link/,
			/^visually-hidden/,
			/^hidden/,
			/^visible/,
			/^show/,
			/^hide/,
			
			// Spacing utilities (if used)
			/^m[tblrxy]?-\d+/,
			/^p[tblrxy]?-\d+/,
			
			// Typography utilities
			/^text-/,
			/^font-/,
			/^leading-/,
		],
		
		// Deep patterns (for nested selectors)
		deep: [
			// WordPress nested patterns
			/^wp-block-/,
			/^elementor-widget-/,
			/^jet-listing-/,
		],
		
		// Greedy patterns (match partial class names)
		greedy: [
			// Match any class containing these strings
			/variation-/,
			/layout-/,
			/version-/,
		],
	},

	// Keep these CSS features
	fontFace: true, // Keep @font-face rules
	keyframes: true, // Keep @keyframes rules
	variables: true, // Keep CSS custom properties

	// Custom extractor for WordPress/PHP files
	defaultExtractor: (content) => {
		// Extract class names from PHP files
		// Matches: class="...", class='...', class="...", etc.
		const broadMatches = content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || [];
		const innerMatches = content.match(/[^<>"'`\s.()]*[^<>"'`\s.():]/g) || [];
		
		// Also extract from PHP class attributes
		const phpClassMatches = content.match(/class=["']([^"']+)["']/g) || [];
		const phpClasses = phpClassMatches
			.map(match => match.replace(/class=["']|["']/g, ''))
			.flatMap(classes => classes.split(/\s+/));
		
		return broadMatches.concat(innerMatches).concat(phpClasses);
	},
};

// CommonJS export (for gulp-purgecss)
if (typeof module !== 'undefined' && module.exports) {
	module.exports = purgecssConfig;
}

// ES module export (for gulpfile.mjs)
export default purgecssConfig;

