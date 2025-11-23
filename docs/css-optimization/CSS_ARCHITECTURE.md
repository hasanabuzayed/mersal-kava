# CSS Architecture Documentation

**Date:** November 22, 2024  
**Version:** 1.0.0  
**Theme:** Kava v3

---

## Overview

This document describes the CSS/SCSS architecture of the Kava v3 WordPress theme. The theme uses a modular SCSS structure with modern CSS features, organized by component and feature.

---

## Directory Structure

```
assets/sass/
├── _normalize.scss          # CSS reset/normalize
├── style.scss               # Main stylesheet entry point
├── theme.scss               # Theme styles entry point
├── admin.scss               # Admin styles
│
├── elements/                 # Base HTML elements
│   ├── _base.scss           # Base element styles
│   ├── _elements.scss       # General element styles
│   ├── _lists.scss          # List styles
│   ├── _page-preloader.scss # Preloader styles
│   └── _totop-button.scss   # To-top button
│
├── forms/                    # Form components
│   ├── _forms.scss          # Forms entry point
│   ├── _buttons.scss        # Button styles
│   ├── _fields.scss         # Input field styles
│   ├── _search-form.scss    # Search form
│   └── _password-form.scss  # Password form
│
├── grid/                     # Grid system
│   ├── _grid.scss           # Grid entry point
│   ├── _variables.scss      # Grid variables
│   ├── _breakpoints.scss    # Media query breakpoints
│   └── _mixins.scss         # Grid mixins
│
├── media/                    # Media elements
│   ├── _media.scss          # Media entry point
│   ├── _captions.scss       # Image captions
│   ├── _embeds.scss         # Embedded content
│   └── _galleries.scss      # Gallery styles
│
├── mixins/                   # Reusable mixins
│   ├── _mixins-master.scss  # Main mixins
│   └── _border-radius.scss  # Border radius mixins
│
├── modules/                  # Reusable modules
│   ├── _accessibility.scss  # Accessibility features
│   ├── _alignments.scss     # Text alignments
│   ├── _author-bio.scss     # Author biography
│   ├── _clearings.scss      # Clearfix utilities
│   └── _comments.scss       # Comment styles
│
├── navigation/               # Navigation components
│   ├── _navigation.scss     # Navigation entry point
│   ├── _breadcrumbs.scss    # Breadcrumb navigation
│   ├── _links.scss          # Link styles
│   ├── _menus.scss          # Menu styles
│   ├── _mobile-menu.scss    # Mobile menu
│   ├── _posts-navigation.scss # Post navigation
│   └── _social.scss         # Social navigation
│
├── plugins/                  # Third-party plugin styles
│   ├── _plugins.scss        # Plugins entry point
│   ├── _ecwid.scss          # Ecwid integration
│   ├── _elementor.scss      # Elementor integration
│   ├── _jet-plugins.scss    # Jet plugins
│   ├── _wpcf7.scss          # Contact Form 7
│   └── _wpml.scss           # WPML integration
│
├── site/                     # Site-specific styles
│   ├── _site.scss           # Site entry point
│   ├── primary/             # Primary content area
│   │   ├── _footer.scss     # Footer styles
│   │   ├── _header.scss     # Header styles
│   │   ├── _post-formats.scss # Post format styles
│   │   ├── _posts-and-pages.scss # Posts and pages
│   │   ├── _single-post.scss # Single post styles
│   │   ├── _sticky.scss     # Sticky posts
│   │   └── _top-panel.scss  # Top panel
│   └── secondary/           # Secondary content area
│       └── _widgets.scss    # Widget styles
│
├── typography/               # Typography styles
│   ├── _typography.scss     # Typography entry point
│   ├── _copy.scss           # Text and inline elements
│   └── _headings.scss       # Heading styles
│
└── variables-site/           # Theme variables
    ├── _variables-site.scss  # Variables entry point
    ├── _colors.scss         # Color variables
    ├── _css-variables.scss  # CSS custom properties
    ├── _structure.scss      # Layout/spacing variables
    └── _typography.scss     # Typography variables
```

---

## Entry Points

### Main Stylesheets

1. **`style.scss`**
   - Main theme stylesheet (required by WordPress)
   - Contains theme header information
   - Imports normalize and base elements

2. **`theme.scss`**
   - Main theme CSS entry point
   - Imports all theme components
   - Organized by feature sections

3. **`admin.scss`**
   - Admin area styles
   - Separate from frontend styles

---

## Architecture Principles

### 1. Modular Structure
- Each component has its own file
- Files organized by feature/component
- Clear separation of concerns

### 2. Sass Module System
- Uses `@use` and `@forward` (modern Sass)
- No `@import` (deprecated)
- Proper namespacing for variables and mixins

### 3. CSS Custom Properties
- Runtime customization via CSS variables
- Prefixed with `--kava-`
- Fallbacks to Sass variables

### 4. Modern CSS Features
- Logical properties for RTL support
- CSS Grid and Flexbox
- Modern selectors (`:is()`, `:where()`)
- `gap` property where appropriate

### 5. Performance Optimizations
- Minification for production
- Source maps for development
- Critical CSS preloading
- Async loading for non-critical CSS

---

## Variable System

### Sass Variables

Located in `variables-site/`:
- `_colors.scss` - Color definitions
- `_structure.scss` - Layout and spacing
- `_typography.scss` - Font definitions

**Naming Convention:**
- `$color__*` - Colors
- `$font__*` - Typography
- `$size__*` - Sizes
- `$button__*` - Button-specific
- `$input__*` - Input-specific

### CSS Custom Properties

Located in `variables-site/_css-variables.scss`:
- Prefixed with `--kava-`
- Organized by category (Colors, Structure, Typography)
- OKLCH color space for better color manipulation
- Runtime customizable

**Usage:**
```scss
// With Sass fallback
color: var(--kava-color-primary, colors.$color__primary);
```

---

## Mixin System

### Main Mixins (`mixins/_mixins-master.scss`)

**Layout & Positioning:**
- `center-block` - Center block element
- `overlay-position` - Full overlay positioning

**Clearfix & Reset:**
- `clearfix` - Micro clearfix
- `clearfix-after` - Clear floats after
- `reset-list` - Reset list styles

**Typography:**
- `font-size($sizeValue)` - Rem with px fallback
- `hyphens($mode)` - CSS hyphenation

**Components:**
- `btn` - Button base styles
- `font-awesome-icon` - Font Awesome icon setup

**Layout:**
- `space-between-content($child-indent-type)` - Flex with space-between
- `grid-indent($indent, $child-indent-type, $child-selector, $use-gap)` - Grid spacing

**Utilities:**
- `resizable($direction)` - Make element resizable

### Usage

```scss
@use "../mixins/mixins-master";

.element {
    @include mixins-master.center-block;
    @include mixins-master.font-size(1.25);
}
```

---

## Grid System

### Breakpoints (`grid/_breakpoints.scss`)

- `xs` - Extra small (default)
- `sm` - Small (≥576px)
- `md` - Medium (≥768px)
- `lg` - Large (≥992px)
- `xl` - Extra large (≥1200px)

### Grid Mixins (`grid/_mixins.scss`)

- `make-container($gutter)` - Container with padding
- `make-row($gutter)` - Flex row with negative margins
- `make-col($gutter)` - Column with padding
- `make-col-span($size, $columns)` - Column width
- `make-col-offset($size, $columns)` - Column offset

### Usage

```scss
@use "../grid/mixins";
@use "../grid/breakpoints";

.container {
    @include mixins.make-container;
}

.row {
    @include mixins.make-row;
}

.col {
    @include mixins.make-col;
    @include mixins.make-col-span(6, 12); // 50% width
}
```

---

## Component Organization

### Elements
Base HTML element styles (headings, paragraphs, lists, etc.)

### Forms
Form components (inputs, buttons, search, password)

### Navigation
Navigation components (menus, breadcrumbs, social links)

### Site Components
Site-specific components (header, footer, posts, widgets)

### Modules
Reusable modules (author bio, comments, alignments)

---

## Modern CSS Features

### Logical Properties
Used for better RTL support:
- `margin-inline` instead of `margin-left/right`
- `padding-inline` instead of `padding-left/right`
- `inset-inline-start` instead of `left`

### Modern Selectors
- `:is()` - Group selectors, reduce specificity
- `:where()` - Group selectors, zero specificity

### CSS Custom Properties
- Runtime customization
- Theme-wide variables
- OKLCH color space

---

## Performance Optimizations

### Build System
- Minification for production
- Source maps for development
- Environment-aware builds

### Loading Strategy
- Preload for critical CSS
- Async loading for non-critical CSS
- Resource hints for external domains
- Optimized font loading

### Caching
- Version-based cache busting
- File modification time for dynamic CSS
- Filterable version system

---

## Browser Support

### Target Browsers
- Modern browsers (last 2 versions)
- Chrome, Firefox, Safari, Edge
- Mobile browsers (iOS Safari, Chrome Mobile)
- **No IE 11 support**

### Progressive Enhancement
- Modern CSS with fallbacks
- Feature queries (`@supports`)
- Graceful degradation

---

## Best Practices

### 1. Use Mixins
Don't repeat code - use mixins for common patterns.

### 2. Use Variables
Use Sass variables or CSS custom properties instead of hardcoded values.

### 3. Logical Properties
Prefer logical properties for better RTL support.

### 4. Modern Selectors
Use `:is()` and `:where()` to reduce specificity.

### 5. Performance
- Keep nesting depth reasonable (max 3-4 levels)
- Use placeholders for `@extend`
- Minimize complex calculations

### 6. Documentation
- Comment complex code
- Document mixin parameters
- Explain non-obvious patterns

---

## File Naming Conventions

- **Partials:** Start with `_` (e.g., `_mixins.scss`)
- **Entry points:** No underscore (e.g., `theme.scss`)
- **Component files:** Descriptive names (e.g., `_single-post.scss`)

---

## Import/Use Strategy

### Modern Sass Module System
```scss
// Use @use instead of @import
@use "../variables-site/colors";
@use "../mixins/mixins-master";

// Access with namespace
color: colors.$color__primary;
@include mixins-master.center-block;
```

### Forward for Libraries
```scss
// Forward variables for use in other files
@forward "colors";
@forward "typography";
```

---

## CSS Custom Properties Strategy

### Hybrid Approach
- CSS variables for runtime customization
- Sass variables for compile-time values
- Fallbacks ensure compatibility

### Example
```scss
// CSS variable with Sass fallback
padding: var(--kava-input-indents, structure.$input__indents);
border-color: var(--kava-color-border-input, colors.$color__border-input);
```

---

## Maintenance Guidelines

### Adding New Styles
1. Determine appropriate directory
2. Create or update component file
3. Use existing mixins and variables
4. Follow naming conventions
5. Add documentation

### Modifying Existing Styles
1. Check for existing mixins/variables
2. Maintain backward compatibility
3. Update documentation if needed
4. Test in multiple browsers

### Performance Considerations
1. Minimize CSS file size
2. Use efficient selectors
3. Avoid deep nesting
4. Leverage modern CSS features

---

## Resources

- [Sass Documentation](https://sass-lang.com/documentation)
- [CSS Custom Properties](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties)
- [Logical Properties](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Logical_Properties)
- [Modern CSS Selectors](https://developer.mozilla.org/en-US/docs/Web/CSS/:is)

---

**Last Updated:** November 22, 2024

