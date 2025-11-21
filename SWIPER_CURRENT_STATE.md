# Swiper v4.3.3 - Current Implementation Documentation

**Date:** November 21, 2024  
**Purpose:** Documentation of current Swiper implementation before migration to v12  
**Version:** 4.3.3

---

## File Inventory

### Backup Created
✅ **Backup Location:** `assets/lib/swiper-backup-v4/`
- `swiper.min.css` (19,773 bytes)
- `swiper.min.js` (122,695 bytes)

### Current Files in Use
- `assets/lib/swiper/swiper.min.css` - Swiper stylesheet
- `assets/lib/swiper/swiper.min.js` - Swiper JavaScript library

---

## Implementation Details

### 1. Asset Registration

**File:** `inc/modules/post-formats/module.php`

**JavaScript Registration:**
```php
wp_register_script(
    'swiper',
    get_theme_file_uri( 'assets/lib/swiper/swiper.min.js' ),
    array( 'jquery' ),  // Note: jQuery dependency (not needed in v12)
    '4.3.3',
    true
);
```

**CSS Registration:**
```php
wp_register_style(
    'swiper',
    get_theme_file_uri( 'assets/lib/swiper/swiper.min.css' ),
    array(),
    '4.3.3'
);
```

**Dependencies:**
- Swiper is loaded when `is_singular( 'post' )` is true
- Also depends on 'magnific-popup' for lightbox functionality

---

### 2. HTML Structure

**File:** `inc/modules/post-formats/module.php` (lines 387-394)

**Current HTML Output:**
```html
<div class="post-format-gallery-wrapper">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <figure class="post-thumbnail swiper-slide">
                <a href="[image-url]" class="post-thumbnail__link" data-popup="magnificPopup">
                    [thumbnail-image]
                </a>
            </figure>
            <!-- More slides... -->
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>
```

**Key Points:**
- Uses `.swiper-container` class (must change to `.swiper` in v12)
- Navigation buttons are empty divs (icons added via CSS `:before`)
- Each slide is a `<figure>` with class `swiper-slide`
- Links have `data-popup="magnificPopup"` for lightbox integration

---

### 3. JavaScript Initialization

**File:** `assets/js/theme-script.js` (lines 223-245)

**Current Code:**
```javascript
swiperInit() {
    if (typeof Swiper !== 'undefined') {
        // Support both old (.swiper-container) and new (.swiper) class names
        const containers = document.querySelectorAll('.swiper-container, .swiper');
        
        containers.forEach(container => {
            // Check if already initialized
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

**Configuration:**
- `loop: true` - Infinite loop
- `spaceBetween: 10` - 10px gap between slides
- `autoHeight: true` - Adjusts height to current slide
- Navigation: Custom selectors for prev/next buttons

**Initialization Trigger:**
- Called in `initComponents()` method
- Runs after DOM is ready

---

### 4. CSS Styling

**File:** `assets/sass/site/primary/_post-formats.scss` (lines 51-72)

**Current Styles:**
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
    content: '\f104';  // Font Awesome angle-left icon
}
.swiper-button-next:before {
    content: '\f105';  // Font Awesome angle-right icon
}
```

**Key Styling Features:**
- **Size:** 45px × 45px circular buttons
- **Position:** -35px margin-top (centered vertically)
- **Icons:** Font Awesome icons via `:before` pseudo-element
  - Left: `\f104` (fa-angle-left)
  - Right: `\f105` (fa-angle-right)
- **Appearance:** White background, rounded, with shadow
- **Font Awesome:** Uses mixin `@include font-awesome-icon`

**Compiled CSS Location:**
- `assets/css/dynamic/post.css` (lines 151-156, 1696-1703)
- `theme.css` (lines 2021-2051)

---

## Functionality to Preserve

### Core Features
1. ✅ **Gallery Post Format Display**
   - Multiple images in a carousel
   - Only shows on single post pages with gallery format

2. ✅ **Navigation Buttons**
   - Previous/Next buttons
   - Circular white buttons with Font Awesome icons
   - Positioned above the gallery

3. ✅ **Infinite Loop**
   - Slides loop continuously
   - No end/beginning

4. ✅ **Auto Height**
   - Gallery adjusts to tallest image in current view
   - Prevents layout shifts

5. ✅ **Spacing**
   - 10px gap between slides
   - Maintains visual separation

6. ✅ **Lightbox Integration**
   - Clicking images opens Magnific Popup
   - Uses `data-popup="magnificPopup"` attribute

### Visual Design
- **Button Style:** Circular, white background, shadow
- **Button Size:** 45px diameter
- **Icons:** Font Awesome angle-left/right (solid style)
- **Icon Size:** 18px (relative to base font size)
- **Position:** Centered above gallery (-35px margin-top)

---

## Dependencies

### Required Plugins/Libraries
1. **Swiper 4.3.3** - Carousel functionality
2. **Magnific Popup** - Lightbox for images
3. **Font Awesome 6** - Navigation icons (updated in previous migration)
4. **jQuery** - Currently listed as dependency (not actually needed)

### WordPress Hooks
- `is_singular( 'post' )` - Only loads on single post pages
- Post format must be 'gallery'

---

## Testing Checklist (Before Migration)

### Current Functionality Tests
- [ ] Gallery post format displays correctly
- [ ] Navigation buttons appear and are clickable
- [ ] Previous/Next buttons work correctly
- [ ] Infinite loop functions (can go forward/backward infinitely)
- [ ] Auto-height adjusts correctly for different image sizes
- [ ] Spacing between slides is 10px
- [ ] Clicking images opens lightbox (Magnific Popup)
- [ ] Touch/swipe gestures work on mobile
- [ ] Buttons are styled correctly (circular, white, with icons)
- [ ] Icons display correctly (Font Awesome angle-left/right)

### Browser Compatibility
- [ ] Chrome/Edge (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Mobile browsers (iOS Safari, Chrome Mobile)

### Edge Cases
- [ ] Single image in gallery
- [ ] Many images in gallery (10+)
- [ ] Very large images
- [ ] Very small images
- [ ] Mixed image sizes

---

## Files Modified During Migration

These files will need to be updated:

1. **`inc/modules/post-formats/module.php`**
   - Update asset registration (CDN URLs)
   - Update HTML class name (`.swiper-container` → `.swiper`)
   - Remove jQuery dependency

2. **`assets/js/theme-script.js`**
   - Update initialization code
   - Remove `.swiper-container` selector (use only `.swiper`)
   - Potentially add module imports (if using modular build)

3. **`assets/sass/site/primary/_post-formats.scss`**
   - Update styles for SVG icons (or hide SVG, keep Font Awesome)
   - Adjust for new Swiper v12 CSS structure

4. **Compiled CSS files** (will be regenerated)
   - `assets/css/dynamic/post.css`
   - `theme.css`

---

## Rollback Information

If migration fails, restore from backup:

```bash
# Restore Swiper files
rm -rf assets/lib/swiper
cp -r assets/lib/swiper-backup-v4 assets/lib/swiper

# Restore code files (if using git)
git checkout inc/modules/post-formats/module.php
git checkout assets/js/theme-script.js
git checkout assets/sass/site/primary/_post-formats.scss
```

---

## Notes

- Current implementation is stable and working
- Font Awesome icons are custom implementation (not default Swiper)
- jQuery dependency is listed but Swiper doesn't actually require it
- Only used for gallery post format on single post pages
- Integrates with Magnific Popup for image lightbox

---

## Next Steps

After Phase 1 completion:
- ✅ Backup created
- ✅ Documentation complete
- ⏭️ Proceed to Phase 2: Update Dependencies

