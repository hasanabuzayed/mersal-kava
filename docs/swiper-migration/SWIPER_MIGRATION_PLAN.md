# Swiper v4.3.3 → v12.0.3 Migration Plan

## Overview

This document outlines the migration plan for upgrading Swiper from version 4.3.3 to 12.0.3 in the Kava WordPress theme.

**Current Version:** 4.3.3  
**Target Version:** 12.0.3  
**Migration Complexity:** High (8 major versions difference)

---

## Current Implementation Analysis

### Files Using Swiper

1. **JavaScript Initialization:**
   - `assets/js/theme-script.js` - Swiper initialization code
   - Currently supports both `.swiper-container` and `.swiper` classes

2. **PHP Template:**
   - `inc/modules/post-formats/module.php` - Gallery post format template
   - Uses `.swiper-container` class
   - Generates HTML structure with navigation buttons

3. **Styles:**
   - `assets/sass/site/primary/_post-formats.scss` - Custom Swiper button styles
   - Uses Font Awesome icons via `:before` pseudo-elements
   - Custom styling for navigation buttons

4. **Asset Registration:**
   - `inc/modules/post-formats/module.php` - Registers Swiper JS and CSS
   - Currently loads from local files: `assets/lib/swiper/`

5. **HTML Structure:**
   ```html
   <div class="swiper-container">
     <div class="swiper-wrapper">
       <figure class="swiper-slide">...</figure>
     </div>
     <div class="swiper-button-prev"></div>
     <div class="swiper-button-next"></div>
   </div>
   ```

---

## Major Breaking Changes (v4 → v12)

### 1. **Class Name Changes**
- ❌ **Old:** `.swiper-container` 
- ✅ **New:** `.swiper` (required in v8+)

### 2. **Module System**
- ❌ **Old (v4):** Everything included in one file
- ✅ **New (v10+):** Modular imports for tree-shaking
  ```javascript
  import Swiper from 'swiper';
  import { Navigation } from 'swiper/modules';
  ```

### 3. **CSS Structure**
- ❌ **Old:** SCSS/LESS files available
- ✅ **New (v12):** Only standard CSS files (no preprocessors)
- CSS variables for customization instead of SCSS variables

### 4. **Navigation Icons**
- ❌ **Old:** Font-based icons (Font Awesome compatible)
- ✅ **New (v12):** Inline SVG icons by default
- Custom icons must be provided as SVG markup

### 5. **Initialization API**
- Navigation selectors changed slightly
- Some configuration options renamed/deprecated

---

## Migration Steps

### Phase 1: Preparation & Backup

- [ ] **Backup current Swiper files**
  ```bash
  cp -r assets/lib/swiper assets/lib/swiper-backup-v4
  ```

- [ ] **Document current functionality**
  - Test gallery post format display
  - Note any custom behaviors
  - Screenshot current appearance

### Phase 2: Update Dependencies

#### Option A: CDN (Recommended for WordPress)
- [ ] **Update CSS registration in `inc/modules/post-formats/module.php`**
  ```php
  wp_register_style(
      'swiper',
      'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css',
      array(),
      '12.0.3'
  );
  ```

- [ ] **Update JS registration**
  ```php
  wp_register_script(
      'swiper',
      'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js',
      array(), // Remove jQuery dependency
      '12.0.3',
      true
  );
  ```

#### Option B: Local Files (Alternative)
- [ ] **Download Swiper v12 files**
  ```bash
  # Download from npm or CDN
  mkdir -p assets/lib/swiper-v12
  # Place swiper-bundle.min.css and swiper-bundle.min.js
  ```

### Phase 3: Update HTML Structure

- [ ] **Update template in `inc/modules/post-formats/module.php`**
  ```php
  // Change from:
  '<div class="swiper-container">'
  
  // To:
  '<div class="swiper">'
  ```

- [ ] **Verify navigation button structure** (should remain the same)
  ```html
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  ```

### Phase 4: Update JavaScript Initialization

- [ ] **Update `assets/js/theme-script.js`**

  **Current Code:**
  ```javascript
  swiperInit() {
      if (typeof Swiper !== 'undefined') {
          const containers = document.querySelectorAll('.swiper-container, .swiper');
          
          containers.forEach(container => {
              if (container.swiper) {
                  return;
              }

              new Swiper(container, {
                  loop: true,
                  spaceBetween: 10,
                  autoHeight: true,
                  navigation: {
                      nextEl: container.querySelector('.swiper-button-next'),
                      prevEl: container.querySelector('.swiper-button-prev')
                  }
              });
          });
      }
  }
  ```

  **Updated Code for v12:**
  ```javascript
  swiperInit() {
      if (typeof Swiper !== 'undefined') {
          // Swiper v12 uses .swiper class (not .swiper-container)
          const containers = document.querySelectorAll('.swiper');
          
          containers.forEach(container => {
              // Check if already initialized
              if (container.swiper) {
                  return;
              }

              // Import Navigation module (if using modular build)
              // For bundle version, Navigation is included
              new Swiper(container, {
                  modules: [Swiper.Navigation], // Only if using modular build
                  loop: true,
                  spaceBetween: 10,
                  autoHeight: true,
                  navigation: {
                      nextEl: container.querySelector('.swiper-button-next'),
                      prevEl: container.querySelector('.swiper-button-prev')
                  }
              });
          });
      }
  }
  ```

  **Note:** If using bundle version (recommended for WordPress), `modules` array is not needed.

### Phase 5: Update Styles

- [ ] **Update `assets/sass/site/primary/_post-formats.scss`**

  **Current Implementation:**
  ```scss
  .swiper-button-prev,
  .swiper-button-next {
      width: 45px;
      height: 45px;
      margin-top: -35px;
      text-align: center;
      @include font-awesome-icon;
      @include font-size(18/16);
      border-radius: 50%;
      background-image: none;
      background-color: $color__white;
      box-shadow: 0px 0px 20px 0px rgba(59, 61, 66, 0.1);
      &:before {
          line-height: 45px;
      }
  }
  .swiper-button-prev:before {
      content: '\f104'; // Font Awesome left arrow
  }
  .swiper-button-next:before {
      content: '\f105'; // Font Awesome right arrow
  }
  ```

  **Updated for v12 (Option 1 - Use CSS Variables):**
  ```scss
  .swiper-button-prev,
  .swiper-button-next {
      width: 45px;
      height: 45px;
      margin-top: -35px;
      border-radius: 50%;
      background-color: $color__white;
      box-shadow: 0px 0px 20px 0px rgba(59, 61, 66, 0.1);
      
      // Hide default SVG, use custom Font Awesome icons
      svg {
          display: none;
      }
      
      // Use Font Awesome icons via :before
      &::before {
          content: '';
          font-family: 'Font Awesome 6 Free';
          font-weight: 900;
          line-height: 45px;
          display: block;
      }
  }
  
  .swiper-button-prev::before {
      content: '\f104'; // fa-angle-left
  }
  
  .swiper-button-next::before {
      content: '\f105'; // fa-angle-right
  }
  ```

  **Updated for v12 (Option 2 - Custom SVG Icons):**
  ```scss
  .swiper-button-prev,
  .swiper-button-next {
      width: 45px;
      height: 45px;
      margin-top: -35px;
      border-radius: 50%;
      background-color: $color__white;
      box-shadow: 0px 0px 20px 0px rgba(59, 61, 66, 0.1);
      
      // Style default SVG
      svg {
          width: 18px;
          height: 18px;
          fill: currentColor;
      }
  }
  ```

  **And update HTML template to include custom SVG:**
  ```php
  <div class="swiper-button-prev">
      <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M15 18l-6-6 6-6"/>
      </svg>
  </div>
  <div class="swiper-button-next">
      <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M9 18l6-6-6-6"/>
      </svg>
  </div>
  ```

### Phase 6: CSS Variables Customization (Optional)

- [ ] **Add CSS variables for global Swiper theming**
  
  Create or update `assets/sass/site/primary/_post-formats.scss`:
  ```scss
  .post_format-post-format-gallery {
      // Swiper CSS Variables
      --swiper-navigation-color: #{$color__text-main};
      --swiper-navigation-size: 18px;
      --swiper-theme-color: #{$color__text-main};
  }
  ```

### Phase 7: Testing

- [ ] **Test Gallery Post Format**
  - Create a test post with gallery format
  - Verify images display correctly
  - Test navigation buttons (prev/next)
  - Test on mobile devices
  - Test with multiple images
  - Test with single image

- [ ] **Test Responsive Behavior**
  - Test on different screen sizes
  - Verify touch/swipe gestures work
  - Check auto-height functionality

- [ ] **Test Browser Compatibility**
  - Chrome/Edge (latest)
  - Firefox (latest)
  - Safari (latest)
  - Mobile browsers

- [ ] **Performance Testing**
  - Check page load time
  - Verify no console errors
  - Check for memory leaks

### Phase 8: Cleanup

- [ ] **Remove old Swiper files** (after successful migration)
  ```bash
  rm -rf assets/lib/swiper
  # Keep backup: assets/lib/swiper-backup-v4
  ```

- [ ] **Update documentation**
  - Update MODERNIZATION.md
  - Update README.md if needed

---

## Recommended Approach

### For WordPress Theme (Recommended: CDN)

1. **Use CDN for Swiper v12** - Easier to update, no local file management
2. **Keep custom Font Awesome icons** - Maintain current design
3. **Use bundle version** - Simpler integration, no module imports needed
4. **Update HTML class** - Change `.swiper-container` to `.swiper`
5. **Update styles** - Hide default SVG, use Font Awesome via `:before`

### Implementation Priority

1. **High Priority:**
   - Update HTML class name
   - Update JavaScript initialization
   - Update CSS to handle new SVG icons

2. **Medium Priority:**
   - Switch to CDN
   - Add CSS variables for theming
   - Optimize styles

3. **Low Priority:**
   - Consider custom SVG icons
   - Performance optimizations

---

## Potential Issues & Solutions

### Issue 1: Navigation Icons Not Showing
**Cause:** Swiper v12 uses SVG by default, Font Awesome icons won't work directly  
**Solution:** Hide default SVG, use Font Awesome via `:before` pseudo-element

### Issue 2: Styles Not Applying
**Cause:** CSS class names changed  
**Solution:** Update all `.swiper-container` references to `.swiper`

### Issue 3: JavaScript Errors
**Cause:** Module imports required in modular build  
**Solution:** Use bundle version instead, or properly import modules

### Issue 4: jQuery Dependency
**Cause:** Swiper v12 doesn't require jQuery  
**Solution:** Remove jQuery from script dependencies

---

## Rollback Plan

If migration fails:

1. **Restore backup files:**
   ```bash
   cp -r assets/lib/swiper-backup-v4 assets/lib/swiper
   ```

2. **Revert PHP changes:**
   ```bash
   git checkout inc/modules/post-formats/module.php
   ```

3. **Revert JavaScript:**
   ```bash
   git checkout assets/js/theme-script.js
   ```

4. **Revert SCSS:**
   ```bash
   git checkout assets/sass/site/primary/_post-formats.scss
   ```

---

## Timeline Estimate

- **Phase 1-2 (Preparation & Dependencies):** 30 minutes
- **Phase 3-4 (HTML & JavaScript):** 1 hour
- **Phase 5 (Styles):** 1-2 hours
- **Phase 6 (CSS Variables):** 30 minutes
- **Phase 7 (Testing):** 2-3 hours
- **Phase 8 (Cleanup):** 30 minutes

**Total Estimated Time:** 5-7 hours

---

## Resources

- [Swiper v12 Blog Post](https://swiperjs.com/blog/swiper-v12)
- [Swiper v12 Documentation](https://swiperjs.com/get-started)
- [Swiper Migration Guide v10](https://swiperjs.com/migration-guide-v10)
- [Swiper CDN](https://cdn.jsdelivr.net/npm/swiper@12/)

---

## Notes

- Swiper v12 is a major version with significant changes
- Test thoroughly before deploying to production
- Consider staging environment for testing
- Keep backup of current implementation
- Document any custom behaviors that need to be preserved

