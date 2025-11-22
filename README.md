# kava
Kava Theme. Get the truly easy-to-use free theme with tons of functionality and perfect design!

## Requirements

- **Node.js:** >=24.0.0 (LTS recommended)
- **npm:** >=11.0.0 (bundled with Node.js 24)
- **PHP:** 8.2.x or 8.3.x (recommended)
- **WordPress:** 6.8+

## Installation

### 1. Install Node.js 24 (if using nvm)
```bash
# Install Node.js 24 LTS
nvm install 24 --lts
nvm use 24

# Or if .nvmrc exists, just run:
nvm use
```

### 2. Install Dependencies
```bash
npm install
```

### 3. Build Assets
```bash
# Development (with watch)
npm run gulp

# Or directly
gulp
```

See `MODERNIZATION.md` for complete build system details.

## Changelog

### 2.1.4
- FIX: PHP 8 compatibility.

### 2.1.3
- FIX: various minor fixes.

### 2.1.2
- ADD: `Show Archive Title` and `Show Archive Description` options

### 2.1.1
- FIX: compatibility with WP 5.6
- FIX: prevent php error in customizer

### 2.1.0
- ADD: an ability enable/disable children modules
- ADD: Spinner animation while ajax loading
- UPD: prevent notices in some rare cases
- UPD: Google fonts collection
- FIX: Cart page Cross Sell products grid styles
- FIX: payment stripe fields styles

### 2.0.2
- UPD: stop using deprecated Woo hooks
- FIX: minor conflicts with third-party plugins

### 2.0.1
- UPD: Google fonts collection

### 2.0.0
- ADD: New Dashboard
- ADD: multiple performance improvements and bug fixes

### 1.2.7
- ADD: `Show Page Title` option
- FIX: `Justify Layout` in IE
- FIX: compatibility with WP Rocket
- FIX: minor woo issue

### 1.2.6
- ADD: `Default System Font` to font control
- ADD: customizer options for ToTop button
- ADD: ability creating custom 404 page
- FIX: strings translation

### 1.2.5
- ADD: Ecwid compatibility
- ADD: compatibility with Jet Compare Wishlist
- ADD: French localization
- UPD: swiper.js to 4.3.3
- UPD: CX Customizer module
- UPD: woo module styles

### 1.2.4
- ADD: RU localization
- UPD: styles for elementor pro widgets

### 1.2.3
- UPD: New Google fonts for Customizer

### 1.2.2
- FIX: Version

### 1.2.1
- UPD: WooCommerce widget styles

### 1.2.0
- FIX: prevent error in PHP 7.2 on a single post if an empty excerpt
- FIX: visibility comment meta on single post
- FIX: minor style for single posts layouts
- FIX: sidebar visibility on Vertical-Justify Blog Layout
- FIX: masonry posts listing on IOS
- DEL: unused framework modules
- FIX: shop sidebar no widgets issue
- UPD: pagination styles
- FIX: single product tabs styles

### 1.1.0
- FIX: Minor CSS fixes
- ADD: Português(Brasil) translation
- ADD: Archives location for Elementor Pro and JetThemeCore
- ADD: Single location for Elementor Pro and JetThemeCore


