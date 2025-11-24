# jQuery Replacement Plan

**Date:** November 23, 2024  
**Status:** 📋 Planning Phase  
**Objective:** Complete removal of jQuery dependency from Kava theme

---

## Executive Summary

This plan outlines a comprehensive strategy to replace jQuery with vanilla JavaScript (ES6+) throughout the Kava theme. The migration will improve performance, reduce bundle size, and modernize the codebase while maintaining full functionality.

---

## Current jQuery Usage Analysis

### 1. Theme Scripts (Custom Code)

#### ✅ `assets/js/theme-script.js` - Main Theme Script
**Status:** 95% Modernized  
**jQuery Usage:** Minimal (only Magnific Popup initialization)

**Current jQuery Dependencies:**
- Magnific Popup initialization (lines 213-221)
  ```javascript
  $('[data-popup="magnificPopup"]').magnificPopup({ type: 'image' });
  ```

**Already Modernized:**
- ✅ Responsive menu (vanilla JS)
- ✅ Page preloader (vanilla JS)
- ✅ To-top button (vanilla JS)
- ✅ Swiper initialization (vanilla JS)

**Action Required:**
- Replace Magnific Popup with vanilla JS lightbox alternative

---

#### ⚠️ `assets/js/admin.js` - Admin Settings Page
**Status:** Uses jQuery for AJAX  
**jQuery Usage:** Moderate

**Current jQuery Dependencies:**
- `$.ajax()` for saving settings (lines 49-80)
  ```javascript
  $.ajax({
    type: 'POST',
    url: ajaxurl,
    dataType: 'json',
    data: { options: self.preparedOptions, action: settingsPageConfig.action },
    success: function(response) { /* ... */ }
  });
  ```

**Action Required:**
- Replace `$.ajax()` with `fetch()` API
- Update error handling
- Maintain Vue.js component compatibility

---

#### ⚠️ `inc/modules/woo/assets/js/woo-module-script.js` - WooCommerce Module
**Status:** Fully jQuery-dependent  
**jQuery Usage:** High

**Current jQuery Dependencies:**
- DOM selection: `$('.header-cart__link-wrap')`
- Event handling: `.on('click', toggleButton)`
- Class manipulation: `.toggleClass('show')`
- Container styling: `$("div[id='tab-description']:not(:has(.elementor))").addClass('container')`

**Action Required:**
- Complete rewrite in vanilla JavaScript
- Replace all jQuery selectors and methods
- Maintain WooCommerce compatibility

---

### 2. Third-Party Libraries

#### ⚠️ Magnific Popup (`assets/lib/magnific-popup/`)
**Status:** jQuery-dependent library  
**jQuery Usage:** Required dependency

**Current Implementation:**
- Library file: `jquery.magnific-popup.min.js`
- CSS file: `magnific-popup.min.css`
- Used for: Image lightbox on gallery post formats
- Registration: `inc/modules/post-formats/module.php` (line 70-76)

**Action Required:**
- Replace with vanilla JS lightbox alternative
- Options: GLightbox, Lightbox2, or custom implementation
- Maintain feature parity (image gallery, navigation, close button)

---

### 3. PHP Dependencies

#### jQuery Dependencies in PHP

**Files with jQuery dependencies:**
1. `functions.php` (line 412-414)
   ```php
   $scripts_depends = apply_filters( 'kava-theme/assets-depends/script', ['jquery'] );
   ```

2. `inc/modules/woo/module.php` (line 134)
   ```php
   [ 'jquery' ] // WooCommerce module script dependency
   ```

3. `inc/modules/post-formats/module.php` (line 73)
   ```php
   [ 'jquery' ] // Magnific Popup dependency
   ```

**Action Required:**
- Remove jQuery from all script dependencies
- Update filter hooks if needed
- Ensure WordPress core jQuery is not loaded unnecessarily

---

## Migration Strategy

### Phase 1: Lightbox Replacement (Priority: High) ✅
**Estimated Time:** 2-3 hours  
**Risk Level:** Medium  
**Status:** ✅ **COMPLETE**

**Tasks:**
1. ✅ Research and select vanilla JS lightbox library (GLightbox selected)
2. ✅ Replace Magnific Popup with GLightbox
3. ✅ Update asset registration in `inc/modules/post-formats/module.php`
4. ✅ Update initialization in `assets/js/theme-script.js`
5. ⏳ Test image gallery functionality (pending)
6. ⏳ Remove Magnific Popup files (pending - kept as backup)

**See:** [PHASE_1_LIGHTBOX_REPLACEMENT.md](./PHASE_1_LIGHTBOX_REPLACEMENT.md) for complete details.

**Recommended Library:** **GLightbox**
- ✅ Zero dependencies (vanilla JS)
- ✅ Lightweight (~15KB minified)
- ✅ Modern API
- ✅ Touch/swipe support
- ✅ Keyboard navigation
- ✅ Accessible (ARIA support)

**Alternative:** **Lightbox2**
- ✅ Well-established
- ✅ No dependencies
- ✅ Simple API
- ⚠️ Slightly larger (~20KB)

---

### Phase 2: WooCommerce Module Modernization (Priority: High)
**Estimated Time:** 1-2 hours  
**Risk Level:** Low

**Tasks:**
1. Rewrite `inc/modules/woo/assets/js/woo-module-script.js` in vanilla JS
2. Replace jQuery selectors with `querySelector`/`querySelectorAll`
3. Replace `.on()` with `addEventListener`
4. Replace `.toggleClass()` with `classList.toggle()`
5. Replace complex selector with vanilla JS equivalent
6. Update PHP dependency in `inc/modules/woo/module.php`
7. Test cart toggle functionality
8. Test tab container styling

**Code Conversion Examples:**

```javascript
// Before (jQuery)
var headerCartButton = $('.header-cart__link-wrap');
headerCartButton.on('click', toggleButton);
$('.header-cart__content').toggleClass('show');
$("div[id='tab-description']:not(:has(.elementor))").addClass('container');

// After (Vanilla JS)
const headerCartButton = document.querySelector('.header-cart__link-wrap');
if (headerCartButton) {
  headerCartButton.addEventListener('click', toggleButton);
}

const headerCartContent = document.querySelector('.header-cart__content');
if (headerCartContent) {
  headerCartContent.classList.toggle('show');
}

// Complex selector replacement
const tabDescription = document.querySelectorAll("div[id='tab-description']");
tabDescription.forEach(tab => {
  if (!tab.querySelector('.elementor')) {
    tab.classList.add('container');
  }
});
```

---

### Phase 3: Admin Script Modernization (Priority: Medium)
**Estimated Time:** 1-2 hours  
**Risk Level:** Low

**Tasks:**
1. Replace `$.ajax()` with `fetch()` API
2. Update error handling
3. Maintain Vue.js component compatibility
4. Test settings save functionality
5. Test error scenarios

**Code Conversion Example:**

```javascript
// Before (jQuery)
$.ajax({
  type: 'POST',
  url: ajaxurl,
  dataType: 'json',
  data: {
    options: self.preparedOptions,
    action: settingsPageConfig.action
  },
  beforeSend: function(jqXHR, ajaxSettings) {
    if (null !== self.ajaxSaveHandler) {
      self.ajaxSaveHandler.abort();
    }
  },
  success: function(response, textStatus, jqXHR) {
    // Handle success
  }
});

// After (Vanilla JS with fetch)
const controller = new AbortController();
if (self.ajaxSaveHandler) {
  self.ajaxSaveHandler.abort();
}
self.ajaxSaveHandler = controller;

fetch(ajaxurl, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
  },
  body: new URLSearchParams({
    options: JSON.stringify(self.preparedOptions),
    action: settingsPageConfig.action
  }),
  signal: controller.signal
})
.then(response => response.json())
.then(data => {
  // Handle success
})
.catch(error => {
  if (error.name !== 'AbortError') {
    // Handle error
  }
});
```

---

### Phase 4: PHP Dependency Cleanup (Priority: Medium)
**Estimated Time:** 30 minutes  
**Risk Level:** Low

**Tasks:**
1. Remove jQuery from `functions.php` script dependencies
2. Remove jQuery from WooCommerce module dependencies
3. Remove jQuery from post-formats module dependencies
4. Update filter hooks if needed
5. Test all functionality

**Code Changes:**

```php
// Before
$scripts_depends = apply_filters( 'kava-theme/assets-depends/script', ['jquery'] );

// After
$scripts_depends = apply_filters( 'kava-theme/assets-depends/script', [] );
```

---

### Phase 5: Testing & Validation (Priority: High)
**Estimated Time:** 2-3 hours  
**Risk Level:** Low

**Tasks:**
1. **Functional Testing:**
   - Test image lightbox on gallery post formats
   - Test WooCommerce cart toggle
   - Test WooCommerce tab container styling
   - Test admin settings save functionality
   - Test responsive menu
   - Test to-top button
   - Test page preloader

2. **Cross-Browser Testing:**
   - Chrome/Edge (latest)
   - Firefox (latest)
   - Safari (latest)
   - Mobile browsers (iOS Safari, Chrome Mobile)

3. **Performance Testing:**
   - Measure bundle size reduction
   - Measure page load time improvement
   - Check Lighthouse scores

4. **Accessibility Testing:**
   - Test keyboard navigation
   - Test screen reader compatibility
   - Test ARIA attributes

---

## Implementation Details

### Lightbox Replacement: GLightbox

**Installation:**
```bash
# Option 1: CDN (recommended)
# Add to inc/modules/post-formats/module.php

# Option 2: Local files
# Download and add to assets/lib/glightbox/
```

**Asset Registration:**
```php
// inc/modules/post-formats/module.php
wp_register_script(
    'glightbox',
    'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js',
    [], // No dependencies
    '3.2.0',
    true
);

wp_register_style(
    'glightbox',
    'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css',
    [],
    '3.2.0'
);
```

**JavaScript Initialization:**
```javascript
// assets/js/theme-script.js
lightboxInit() {
  if (typeof GLightbox !== 'undefined') {
    const lightbox = GLightbox({
      selector: '[data-popup="magnificPopup"]',
      touchNavigation: true,
      loop: true,
      autoplayVideos: false
    });
  }
}
```

**HTML Update:**
```html
<!-- No changes needed - GLightbox works with same data attribute -->
<a href="image.jpg" data-popup="magnificPopup">
  <img src="thumbnail.jpg" alt="Image">
</a>
```

---

### WooCommerce Module: Vanilla JS Implementation

**Complete Rewrite:**
```javascript
// inc/modules/woo/assets/js/woo-module-script.js
(function() {
  'use strict';

  const Kava_Woo_Module = {
    init: function() {
      this.wooHeaderCart();
      this.wooTabContainer();
    },

    wooHeaderCart: function() {
      const headerCartButton = document.querySelector('.header-cart__link-wrap');
      const headerCartContent = document.querySelector('.header-cart__content');

      if (!headerCartButton || !headerCartContent) {
        return;
      }

      const toggleButton = function(e) {
        e.preventDefault();
        headerCartContent.classList.toggle('show');
      };

      headerCartButton.addEventListener('click', toggleButton);
    },

    wooTabContainer: function() {
      const tabDescriptions = document.querySelectorAll("div[id='tab-description']");
      
      tabDescriptions.forEach(tab => {
        // Check if Elementor is not present
        if (!tab.querySelector('.elementor')) {
          tab.classList.add('container');
        }
      });
    }
  };

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => Kava_Woo_Module.init());
  } else {
    Kava_Woo_Module.init();
  }
})();
```

---

### Admin Script: Fetch API Implementation

**Complete Rewrite:**
```javascript
// assets/js/admin.js
(function(settingsPageConfig) {
  'use strict';

  Vue.config.devtools = true;

  window.KavaSettingsPage = new Vue({
    el: '#kava-settings-page',

    data: {
      pageOptions: settingsPageConfig.settingsData,
      preparedOptions: {},
      savingStatus: false,
      ajaxSaveController: null
    },

    mounted: function() {
      this.$el.className = 'is-mounted';
    },

    watch: {
      pageOptions: {
        handler: function(options) {
          var prepared = {};

          for (var option in options) {
            if (options.hasOwnProperty(option)) {
              prepared[option] = options[option]['value'];
            }
          }

          this.preparedOptions = prepared;
          this.saveOptions();
        },
        deep: true
      }
    },

    methods: {
      saveOptions: function() {
        var self = this;

        // Abort previous request if exists
        if (self.ajaxSaveController) {
          self.ajaxSaveController.abort();
        }

        self.savingStatus = true;

        // Create new AbortController for this request
        self.ajaxSaveController = new AbortController();

        // Prepare form data
        const formData = new URLSearchParams();
        formData.append('options', JSON.stringify(self.preparedOptions));
        formData.append('action', settingsPageConfig.action);

        // Make fetch request
        fetch(ajaxurl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: formData,
          signal: self.ajaxSaveController.signal
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          self.savingStatus = false;

          if (data.success) {
            self.$CXNotice.add({
              message: data.data.message,
              type: 'success',
              duration: 3000
            });
          } else {
            self.$CXNotice.add({
              message: data.data.message,
              type: 'error',
              duration: 3000
            });
          }
        })
        .catch(error => {
          self.savingStatus = false;

          if (error.name !== 'AbortError') {
            self.$CXNotice.add({
              message: 'An error occurred while saving settings.',
              type: 'error',
              duration: 3000
            });
          }
        });
      }
    }
  });
})(window.KavaSettingsPageConfig);
```

---

## File Changes Summary

### Files to Modify

1. **`assets/js/theme-script.js`**
   - Replace `magnificPopupInit()` with `lightboxInit()`
   - Update initialization method name

2. **`assets/js/admin.js`**
   - Complete rewrite using `fetch()` API
   - Remove jQuery dependency

3. **`inc/modules/woo/assets/js/woo-module-script.js`**
   - Complete rewrite in vanilla JavaScript
   - Remove all jQuery usage

4. **`inc/modules/post-formats/module.php`**
   - Replace Magnific Popup registration with GLightbox
   - Remove jQuery dependency

5. **`inc/modules/woo/module.php`**
   - Remove jQuery dependency from script registration

6. **`functions.php`**
   - Remove jQuery from default script dependencies
   - Update filter documentation

### Files to Remove

1. **`assets/lib/magnific-popup/`** (entire directory)
   - `jquery.magnific-popup.min.js`
   - `magnific-popup.min.css`

### Files to Add

1. **`assets/lib/glightbox/`** (optional, if using local files)
   - `glightbox.min.js`
   - `glightbox.min.css`

---

## Benefits

### Performance Improvements

1. **Bundle Size Reduction:**
   - jQuery: ~87KB (minified, gzipped: ~30KB)
   - Magnific Popup: ~15KB (minified, gzipped: ~5KB)
   - **Total Savings:** ~35KB gzipped
   - GLightbox: ~15KB (minified, gzipped: ~5KB)
   - **Net Savings:** ~30KB gzipped

2. **Load Time Improvement:**
   - One less HTTP request (jQuery)
   - Faster JavaScript execution (native APIs)
   - Better tree-shaking potential

3. **Runtime Performance:**
   - Native DOM APIs are faster than jQuery
   - Modern JavaScript engines optimize native code better
   - Reduced memory footprint

### Code Quality Improvements

1. **Modern JavaScript:**
   - ES6+ syntax throughout
   - Better browser support (modern browsers)
   - Improved maintainability

2. **Reduced Dependencies:**
   - Fewer external libraries
   - Less version conflict risk
   - Easier updates

3. **Better Developer Experience:**
   - Native APIs are well-documented
   - Better IDE support
   - Easier debugging

---

## Risks & Mitigation

### Risk 1: Lightbox Feature Parity
**Risk:** New lightbox may not have all Magnific Popup features  
**Mitigation:**
- Thoroughly test GLightbox features
- Maintain same HTML structure
- Keep CSS compatible
- Test on all browsers

### Risk 2: WooCommerce Compatibility
**Risk:** Vanilla JS implementation may break WooCommerce functionality  
**Mitigation:**
- Test all WooCommerce features
- Test with different WooCommerce versions
- Maintain event compatibility
- Test cart functionality thoroughly

### Risk 3: Admin Settings Save
**Risk:** Fetch API may not work exactly like jQuery AJAX  
**Mitigation:**
- Test all save scenarios
- Test error handling
- Test abort functionality
- Maintain Vue.js compatibility

### Risk 4: Browser Compatibility
**Risk:** Modern JavaScript may not work in older browsers  
**Mitigation:**
- Check browser support requirements
- Use polyfills if needed (unlikely for modern browsers)
- Test on target browsers
- Document browser requirements

---

## Testing Checklist

### Functional Testing

- [ ] Image lightbox opens on gallery post format
- [ ] Lightbox navigation (next/prev) works
- [ ] Lightbox closes properly
- [ ] Keyboard navigation works (ESC, arrows)
- [ ] Touch/swipe navigation works on mobile
- [ ] WooCommerce cart toggle works
- [ ] WooCommerce tab container styling works
- [ ] Admin settings save works
- [ ] Admin settings error handling works
- [ ] Admin settings abort works
- [ ] Responsive menu works
- [ ] To-top button works
- [ ] Page preloader works

### Cross-Browser Testing

- [ ] Chrome/Edge (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] iOS Safari
- [ ] Chrome Mobile
- [ ] Samsung Internet

### Performance Testing

- [ ] Bundle size reduced
- [ ] Page load time improved
- [ ] Lighthouse score improved
- [ ] No JavaScript errors in console

### Accessibility Testing

- [ ] Keyboard navigation works
- [ ] Screen reader compatibility
- [ ] ARIA attributes maintained
- [ ] Focus management works

---

## Timeline

### Phase 1: Lightbox Replacement
**Duration:** 2-3 hours  
**Dependencies:** None

### Phase 2: WooCommerce Module
**Duration:** 1-2 hours  
**Dependencies:** None

### Phase 3: Admin Script
**Duration:** 1-2 hours  
**Dependencies:** None

### Phase 4: PHP Cleanup
**Duration:** 30 minutes  
**Dependencies:** Phases 1-3 complete

### Phase 5: Testing
**Duration:** 2-3 hours  
**Dependencies:** All phases complete

**Total Estimated Time:** 7-11 hours

---

## Success Criteria

1. ✅ No jQuery dependencies in custom code
2. ✅ All functionality works as before
3. ✅ Bundle size reduced by ~30KB
4. ✅ Page load time improved
5. ✅ No JavaScript errors
6. ✅ All tests pass
7. ✅ Cross-browser compatibility maintained
8. ✅ Accessibility maintained

---

## Post-Migration

### Documentation Updates

1. Update `docs/overview/MODERNIZATION.md`
2. Update code comments
3. Update developer documentation
4. Create migration guide for future reference

### Monitoring

1. Monitor error logs for JavaScript issues
2. Monitor performance metrics
3. Collect user feedback
4. Track browser compatibility issues

---

## Notes

- **Framework Files:** jQuery usage in `framework/` directory is out of scope for this migration
- **WordPress Core:** WordPress core jQuery will still be available but not loaded by theme
- **Backward Compatibility:** Theme will work with or without jQuery loaded
- **Gradual Migration:** Can be done incrementally (phase by phase)
- **Rollback Plan:** Keep Magnific Popup files as backup until migration is validated

---

## Next Steps

1. Review and approve this plan
2. Begin Phase 1: Lightbox Replacement
3. Test each phase before proceeding
4. Document any issues or deviations
5. Complete all phases
6. Final testing and validation
7. Update documentation

---

**Status:** 📋 **PLAN READY** - Awaiting approval to begin implementation

