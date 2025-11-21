# PHP Files Inventory

**Date:** Generated after Phase 2 completion  
**Total Files:** 143 PHP files (excluding `/framework` directory)  
**Purpose:** Complete inventory of all PHP files for Phase 3 planning

---

## Root Level Files (12 files)

### Core WordPress Template Files
- `404.php` - 404 error page template
- `archive.php` - Archive page template
- `comments.php` - Comments template
- `footer.php` - Footer template
- `header.php` - Header template
- `index.php` - Main index template
- `page.php` - Page template
- `search.php` - Search results template
- `searchform.php` - Search form template
- `sidebar.php` - Main sidebar template
- `sidebar-shop.php` - Shop sidebar template
- `single.php` - Single post template

---

## Core Theme Files (`/inc/`) (9 files)

### Main Theme Files
- `functions.php` - ✅ **Phase 2 Complete** - Main theme functions and setup
- `inc/extras.php` - ✅ **Phase 2 Complete** - Extra utility functions
- `inc/context.php` - ✅ **Phase 2 Complete** - Context helper functions
- `inc/hooks.php` - ✅ **Phase 2 Complete** - WordPress hooks and filters
- `inc/customizer.php` - ✅ **Phase 2 Complete** - Customizer options

### Template Functions
- `inc/template-tags.php` - ✅ **Phase 2 Complete** - Template tag functions
- `inc/template-menu.php` - ✅ **Phase 2 Complete** - Menu functions
- `inc/template-comment.php` - ✅ **Phase 2 Complete** - Comment functions
- `inc/template-related-posts.php` - ✅ **Phase 2 Complete** - Related posts function

---

## Class Files (`/inc/classes/`) (4 files)

- `inc/classes/class-widget-area.php` - ✅ **Phase 2 Complete** - Widget area class
- `inc/classes/class-settings.php` - ✅ **Phase 2 Complete** - Settings class
- `inc/classes/class-post-meta.php` - ✅ **Phase 2 Complete** - Post meta class
- `inc/classes/class-dynamic-css-file.php` - ✅ **Phase 2 Complete** - Dynamic CSS file class

---

## Configuration Files (`/config/`) (5 files)

- `config/layout.php` - ✅ **Phase 2 Complete** - Layout configuration
- `config/menus.php` - ✅ **Phase 2 Complete** - Menu registration
- `config/modules.php` - ✅ **Phase 1 Complete** - Module configuration (array syntax)
- `config/sidebars.php` - ✅ **Phase 2 Complete** - Sidebar registration
- `config/thumbnails.php` - ✅ **Phase 2 Complete** - Image size registration

---

## Module Files (`/inc/modules/`) (7 module files)

### Base Module
- `inc/modules/base.php` - ✅ **Phase 2 Complete** - Abstract base module class

### Core Modules
- `inc/modules/post-formats/module.php` - ✅ **Phase 2 Complete** - Post formats module
- `inc/modules/blog-layouts/module.php` - ✅ **Phase 2 Complete** - Blog layouts module
- `inc/modules/breadcrumbs/module.php` - ✅ **Phase 2 Complete** - Breadcrumbs module
- `inc/modules/crocoblock/module.php` - ✅ **Phase 2 Complete** - Crocoblock integration module

### WooCommerce Modules
- `inc/modules/woo/module.php` - ✅ **Phase 2 Complete** - WooCommerce main module
- `inc/modules/woo-page-title/module.php` - ✅ **Phase 2 Complete** - WooCommerce page title module
- `inc/modules/woo-breadcrumbs/module.php` - ✅ **Phase 2 Complete** - WooCommerce breadcrumbs module

---

## WooCommerce Module Includes (`/inc/modules/woo/includes/`) (6 files)

- `inc/modules/woo/includes/wc-integration.php` - ✅ **Phase 2 Complete** - WooCommerce integration functions
- `inc/modules/woo/includes/wc-cart-functions.php` - ✅ **Phase 2 Complete** - Cart functions
- `inc/modules/woo/includes/wc-single-product-functions.php` - ✅ **Phase 2 Complete** - Single product functions
- `inc/modules/woo/includes/wc-archive-product-functions.php` - ✅ **Phase 2 Complete** - Archive product functions
- `inc/modules/woo/includes/wc-content-product-functions.php` - ✅ **Phase 1 Complete** - Content product functions (array syntax, null coalescing)
- `inc/modules/woo/includes/wc-customizer.php` - ✅ **Phase 2 Complete** - WooCommerce customizer options

---

## WooCommerce Breadcrumbs Class (`/inc/modules/woo-breadcrumbs/classes/`) (1 file)

- `inc/modules/woo-breadcrumbs/classes/class-wc-breadcrumbs.php` - ✅ **Phase 2 Complete** - WooCommerce breadcrumbs class

---

## Module Template Files (56 files)

### Blog Layouts Template Parts (56 files)

#### Creative Layout (10 files)
- `inc/modules/blog-layouts/template-parts/creative/content.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v2.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v3.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v4.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v5.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v6.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v7.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v8.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v9.php`
- `inc/modules/blog-layouts/template-parts/creative/content-v10.php`

#### Default Layout (9 files)
- `inc/modules/blog-layouts/template-parts/default/content.php`
- `inc/modules/blog-layouts/template-parts/default/content-v2.php`
- `inc/modules/blog-layouts/template-parts/default/content-v4.php`
- `inc/modules/blog-layouts/template-parts/default/content-v5.php`
- `inc/modules/blog-layouts/template-parts/default/content-v6.php`
- `inc/modules/blog-layouts/template-parts/default/content-v7.php`
- `inc/modules/blog-layouts/template-parts/default/content-v8.php`
- `inc/modules/blog-layouts/template-parts/default/content-v9.php`
- `inc/modules/blog-layouts/template-parts/default/content-v10.php`

#### Grid Layout (10 files)
- `inc/modules/blog-layouts/template-parts/grid/content.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v2.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v3.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v4.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v5.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v6.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v7.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v8.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v9.php`
- `inc/modules/blog-layouts/template-parts/grid/content-v10.php`

#### Masonry Layout (10 files)
- `inc/modules/blog-layouts/template-parts/masonry/content.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v2.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v3.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v4.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v5.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v6.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v7.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v8.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v9.php`
- `inc/modules/blog-layouts/template-parts/masonry/content-v10.php`

#### Vertical Justify Layout (10 files)
- `inc/modules/blog-layouts/template-parts/vertical-justify/content.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v2.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v3.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v4.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v5.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v6.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v7.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v8.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v9.php`
- `inc/modules/blog-layouts/template-parts/vertical-justify/content-v10.php`

### Other Module Templates (2 files)
- `inc/modules/breadcrumbs/template-parts/breadcrumbs.php`
- `inc/modules/woo-page-title/template/page-title.php`

---

## Template Parts (`/template-parts/`) (30 files)

### Core Template Parts (9 files)
- `template-parts/404.php` - 404 error template
- `template-parts/comment.php` - Comment template
- `template-parts/content-none.php` - No content template
- `template-parts/content-page.php` - Page content template
- `template-parts/content-post.php` - Post content template
- `template-parts/content-related-post.php` - Related post template
- `template-parts/content-search.php` - Search content template
- `template-parts/content.php` - Default content template
- `template-parts/content-navigation.php` - Navigation template

### Layout Template Parts (3 files)
- `template-parts/footer.php` - Footer template part
- `template-parts/header.php` - Header template part
- `template-parts/page.php` - Page template part

### Loop Templates (2 files)
- `template-parts/posts-loop.php` - Posts loop template
- `template-parts/search-loop.php` - Search loop template

### Single Post Templates (16 files)

#### Content Templates (7 files)
- `template-parts/single-post/content.php` - Default single post content
- `template-parts/single-post/content-audio.php` - Audio post format
- `template-parts/single-post/content-gallery.php` - Gallery post format
- `template-parts/single-post/content-image.php` - Image post format
- `template-parts/single-post/content-link.php` - Link post format
- `template-parts/single-post/content-quote.php` - Quote post format
- `template-parts/single-post/content-video.php` - Video post format

#### Header Templates (10 files)
- `template-parts/single-post/headers/header-v1.php`
- `template-parts/single-post/headers/header-v2.php`
- `template-parts/single-post/headers/header-v3.php`
- `template-parts/single-post/headers/header-v4.php`
- `template-parts/single-post/headers/header-v5.php`
- `template-parts/single-post/headers/header-v6.php`
- `template-parts/single-post/headers/header-v7.php`
- `template-parts/single-post/headers/header-v8.php`
- `template-parts/single-post/headers/header-v9.php`
- `template-parts/single-post/headers/header-v10.php`

#### Other Single Post Templates (3 files)
- `template-parts/single-post/author-bio.php` - Author biography
- `template-parts/single-post/comments.php` - Comments section
- `template-parts/single-post/footer.php` - Single post footer
- `template-parts/single-post/post_navigation.php` - Post navigation

### Other Template Parts (1 file)
- `template-parts/top-panel.php` - Top panel template

---

## Page Templates (`/page-templates/`) (1 file)

- `page-templates/fullwidth-content.php` - Fullwidth page template

---

## Post Templates (`/post-templates/`) (9 files)

- `post-templates/single-layout-2.php` - Single post layout 2
- `post-templates/single-layout-3.php` - Single post layout 3
- `post-templates/single-layout-4.php` - Single post layout 4
- `post-templates/single-layout-5.php` - Single post layout 5
- `post-templates/single-layout-6.php` - Single post layout 6
- `post-templates/single-layout-7.php` - Single post layout 7
- `post-templates/single-layout-8.php` - Single post layout 8
- `post-templates/single-layout-9.php` - Single post layout 9
- `post-templates/single-layout-10.php` - Single post layout 10

---

## Admin Templates (`/admin-templates/`) (1 file)

- `admin-templates/settings-page.php` - Theme settings page

---

## Phase 2 Completion Status

### ✅ Files with Type Hints (30+ files)
All core theme files, class files, module files, WooCommerce includes, configuration files, and base classes have been updated with type hints and return types.

### 📋 Files for Phase 3 Consideration

#### Template Files (Mostly HTML/PHP mix - Low Priority)
- Root level template files (12 files)
- Template parts (30 files)
- Module template parts (56 files)
- Page templates (1 file)
- Post templates (9 files)
- Admin templates (1 file)

**Note:** These template files primarily contain HTML markup with minimal PHP logic. They may benefit from:
- Arrow functions for simple closures
- Match expressions for switch statements (if any)
- Nullsafe operator for object property access
- Named arguments (if function calls are present)

#### Files Already Modernized
- All function files have type hints ✅
- All class files have type hints ✅
- All module files have type hints ✅
- Array syntax updated ✅
- Null coalescing updated ✅

---

## Summary

- **Total PHP Files:** 143
- **Files with Functions/Classes:** ~30 files (Phase 2 complete)
- **Template Files:** ~113 files (mostly HTML/PHP mix)
- **Framework Directory:** Excluded (third-party dependency)

---

## Next Steps for Phase 3

1. **Review template files** for opportunities to use:
   - Arrow functions
   - Match expressions
   - Nullsafe operator
   - Named arguments

2. **Focus on files with PHP logic** rather than pure template files

3. **Consider Phase 4 features** for core files:
   - Strict types
   - Readonly properties
   - Typed class constants
   - Enums (if applicable)

