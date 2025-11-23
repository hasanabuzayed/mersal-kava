# PurgeCSS Implementation Plan - Limited Scope

**Date:** November 22, 2024  
**Status:** 📋 Planning Phase  
**Scope:** Limited, Safe Implementation  
**Objective:** Remove unused CSS with minimal risk

---

## Executive Summary

This plan outlines a **limited, safe approach** to implementing PurgeCSS for the Kava v3 theme. The goal is to reduce CSS file sizes by removing unused styles while maintaining 100% functionality and avoiding any visual regressions.

**Key Strategy:** Start small, test thoroughly, expand gradually.

---

## Scope Definition

### ✅ Files to Purge (Limited Scope)

**Phase 1 - Initial Implementation (Low Risk):**
1. **`blog-layouts-module.css`** (147KB - largest file)
   - **Rationale:** Largest file, likely contains many unused layout variants
   - **Risk:** Medium (layout-specific, but isolated to blog layouts)
   - **Testing:** Focus on blog archive pages, single posts, different layouts

**Phase 2 - Expansion (After Phase 1 Validation):**
2. **`woo-module.css`** (85KB)
   - **Rationale:** Second largest, WooCommerce-specific
   - **Risk:** Medium (WooCommerce pages only)
   - **Testing:** Cart, checkout, product pages, shop archive

**Phase 3 - Core Files (After Phases 1-2 Validation):**
3. **`theme.css`** (53KB)
   - **Rationale:** Core theme styles
   - **Risk:** High (affects all pages)
   - **Testing:** All page types, templates, customizer options

**Phase 4 - Main Stylesheet (Final, Most Careful):**
4. **`style.css`** (24KB)
   - **Rationale:** Main stylesheet, required by WordPress
   - **Risk:** Very High (affects everything)
   - **Testing:** Comprehensive testing across all scenarios

### ❌ Files NOT to Purge (Excluded)

- **`admin.css`** - Too small, admin-only, low impact
- **`woo-module-rtl.css`** - RTL version, wait for LTR validation
- **Any minified files** - PurgeCSS runs before minification

---

## Safelist Strategy

### WordPress Core Classes
```javascript
safelist: [
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
]
```

### Plugin Classes
```javascript
safelist: [
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
]
```

### Theme-Specific Classes
```javascript
safelist: [
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
  
  // Responsive classes
  /^mobile-/,
  /^tablet-/,
  /^desktop-/,
  /^hide-/,
  /^show-/,
  /^visible-/,
  /^hidden-/,
]
```

### Dynamic/Generated Classes
```javascript
safelist: [
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
]
```

### Utility Classes
```javascript
safelist: [
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
]
```

---

## Content Paths Configuration

### PHP Templates
```javascript
content: [
  // Root templates
  './*.php',
  './**/*.php',
  
  // Template parts
  './template-parts/**/*.php',
  './inc/**/*.php',
  './inc/modules/**/*.php',
  
  // Specific module templates
  './inc/modules/blog-layouts/**/*.php',
  './inc/modules/woo/**/*.php',
  
  // Framework (if needed)
  './framework/**/*.php',
]
```

### JavaScript Files
```javascript
content: [
  // Theme JavaScript
  './assets/js/**/*.js',
  
  // Module JavaScript
  './inc/modules/**/assets/js/**/*.js',
  
  // Inline scripts in PHP (will be scanned via PHP files)
]
```

### HTML/Blade Templates (if any)
```javascript
content: [
  './**/*.html',
  './**/*.blade.php',
]
```

---

## Implementation Plan

### Phase 1: Setup & Configuration ✅

**Status:** ✅ Complete - See `PURGECSS_PHASE_1_PROGRESS.md` for details

**Tasks:**
1. ✅ Install `gulp-purgecss`
2. ✅ Create PurgeCSS configuration file
3. ✅ Define comprehensive safelist
4. ✅ Configure content paths
5. ✅ Create separate Gulp task for purged CSS
6. ✅ Test on `blog-layouts-module.css` only

**Results:**
- ✅ File size reduction: 81% (145KB → 27KB, 118KB saved)
- ✅ Font Awesome icons preserved and working
- ✅ All layouts tested and verified
- ✅ No visual or functional regressions
- ✅ Ready for Phase 2 expansion

**Configuration File:** `purgecss.config.js`
```javascript
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './assets/js/**/*.js',
    './inc/**/*.php',
  ],
  safelist: [
    // All safelist patterns from above
  ],
  defaultExtractor: (content) => {
    // Custom extractor for WordPress/PHP
    const broadMatches = content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || [];
    const innerMatches = content.match(/[^<>"'`\s.()]*[^<>"'`\s.():]/g) || [];
    return broadMatches.concat(innerMatches);
  },
  fontFace: true, // Keep @font-face rules
  keyframes: true, // Keep @keyframes rules
  variables: true, // Keep CSS custom properties
}
```

### Phase 2: Initial Testing (blog-layouts-module.css)

**Testing Checklist:**
- [ ] Blog archive page (default layout)
- [ ] Blog archive page (masonry layout)
- [ ] Blog archive page (grid layout)
- [ ] Blog archive page (list layout)
- [ ] Blog archive page (vertical justify layouts v1-v10)
- [ ] Single post page
- [ ] Search results page
- [ ] Category archive page
- [ ] Tag archive page
- [ ] Author archive page
- [ ] Date archive page
- [ ] Custom post type archives (if any)
- [ ] Verify no layout breakage
- [ ] Verify responsive behavior
- [ ] Compare file sizes (before/after)

**Success Criteria:**
- ✅ No visual regressions
- ✅ All layouts work correctly
- ✅ File size reduction: 10-20%
- ✅ No console errors
- ✅ All interactive elements work

### Phase 3: Expansion (woo-module.css)

**After Phase 2 Success:**
- Apply PurgeCSS to `woo-module.css`
- Test all WooCommerce pages
- Verify cart, checkout, product pages

### Phase 4: Core Files (theme.css, style.css)

**After Phases 2-3 Success:**
- Apply to `theme.css` (comprehensive testing)
- Finally apply to `style.css` (most careful)

---

## Gulp Integration

### New Gulp Task Structure

```javascript
// PurgeCSS configuration
const purgecssConfig = {
  content: [
    './*.php',
    './**/*.php',
    './assets/js/**/*.js',
    './inc/**/*.php',
  ],
  safelist: [
    // Comprehensive safelist
  ],
  fontFace: true,
  keyframes: true,
  variables: true,
};

// Purged CSS task (production only)
gulp.task( 'css_blog_layouts_purged', function() {
  return gulp.src( './inc/modules/blog-layouts/assets/css/blog-layouts-module.css' )
    .pipe( purgecss( purgecssConfig ) )
    .pipe( cleanCSS() ) // Minify after purging
    .pipe( rename( 'blog-layouts-module.css' ) )
    .pipe( gulp.dest( './inc/modules/blog-layouts/assets/css/' ) );
} );
```

### Production Build Integration

**Option 1: Separate Purged Build**
- Create `build:purged` task
- Keep regular `build` task unchanged
- Allows A/B testing

**Option 2: Conditional Purging**
- Add `PURGE_CSS=true` environment variable
- Only purge when flag is set
- Default: no purging (safe)

**Recommended:** Start with Option 1 (separate task) for safety.

---

## Risk Mitigation

### High-Risk Areas

1. **Dynamic Classes**
   - **Risk:** JavaScript-generated classes might be removed
   - **Mitigation:** Comprehensive safelist, test all interactive elements

2. **Plugin Compatibility**
   - **Risk:** Third-party plugin classes removed
   - **Mitigation:** Plugin-specific safelist patterns, test with all active plugins

3. **Customizer Options**
   - **Risk:** Customizer-generated classes removed
   - **Mitigation:** Test all customizer options, safelist custom classes

4. **RTL Support**
   - **Risk:** RTL-specific classes removed
   - **Mitigation:** Test RTL layouts, safelist RTL classes

### Testing Strategy

1. **Automated Testing:**
   - Visual regression testing (if available)
   - CSS coverage analysis
   - File size comparison

2. **Manual Testing:**
   - Test all page types
   - Test all layouts
   - Test all interactive elements
   - Test with different plugins active
   - Test responsive breakpoints
   - Test RTL layouts

3. **Staging Environment:**
   - Always test on staging first
   - Compare before/after screenshots
   - Monitor for errors

---

## Expected Results

### File Size Reduction

**Conservative Estimates:**
- `blog-layouts-module.css`: 10-20% reduction (14-29KB saved)
- `woo-module.css`: 10-15% reduction (8-13KB saved)
- `theme.css`: 5-10% reduction (2-5KB saved)
- `style.css`: 5-10% reduction (1-2KB saved)

**Total Potential Savings:** 25-49KB (8-16% of total CSS)

### Performance Impact

- **Faster Page Load:** Smaller CSS files = faster downloads
- **Better Caching:** Smaller files cache more efficiently
- **Improved Core Web Vitals:** Better LCP scores
- **Reduced Bandwidth:** Less data transfer

---

## Rollback Plan

### If Issues Detected

1. **Immediate Rollback:**
   - Revert to non-purged CSS files
   - Restore from backup
   - Investigate issue

2. **Debugging:**
   - Check PurgeCSS output logs
   - Review safelist patterns
   - Test specific selectors
   - Add missing patterns to safelist

3. **Incremental Fix:**
   - Fix safelist
   - Re-run PurgeCSS
   - Re-test
   - Deploy fix

---

## Success Criteria

### Phase 1 Success (blog-layouts-module.css)
- ✅ No visual regressions
- ✅ All blog layouts work
- ✅ 10%+ file size reduction
- ✅ No broken functionality
- ✅ All tests pass

### Overall Success
- ✅ All phases completed
- ✅ 15%+ total CSS reduction
- ✅ Zero production issues
- ✅ Improved performance scores
- ✅ Maintainable configuration

---

## Timeline Estimate

### Phase 1: Setup & Initial Testing
- **Duration:** 4-6 hours
- **Tasks:** Configuration, initial testing, validation

### Phase 2: Expansion
- **Duration:** 2-4 hours per file
- **Tasks:** Apply to additional files, test, validate

### Total Estimated Time: 10-20 hours

---

## Documentation

### Files to Create
- `purgecss.config.js` - PurgeCSS configuration
- `PURGECSS_PLAN.md` - This document
- `PURGECSS_TESTING.md` - Testing checklist and results
- Update `gulpfile.mjs` - Add PurgeCSS tasks

### Files to Update
- `package.json` - Add `gulp-purgecss` dependency
- `CSS_OPTIMIZATION_PLAN.md` - Mark Phase 1.2 as in progress
- `README.md` - Document PurgeCSS usage

---

## Next Steps

1. **Review this plan** - Confirm scope and approach
2. **Install dependencies** - `gulp-purgecss`
3. **Create configuration** - `purgecss.config.js`
4. **Start Phase 1** - Test with `blog-layouts-module.css`
5. **Validate results** - Thorough testing
6. **Expand gradually** - Move to Phase 2, 3, 4

---

**Status:** 📋 Ready for Implementation  
**Priority:** Medium (Optional optimization)  
**Risk Level:** Medium (with proper testing, low risk)

