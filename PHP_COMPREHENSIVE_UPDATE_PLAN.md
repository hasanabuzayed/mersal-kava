# Comprehensive PHP Modernization - Complete File Update Plan

## Overview
This document breaks down the systematic update of ALL files mentioned in PHP_FILES_INVENTORY.md to ensure Phase 1-4 compliance.

---

## Work Breakdown Structure

### Section 1: Root Level Template Files (12 files)
**Status:** ⏳ To Check
**Priority:** Medium (mostly HTML/PHP mix)

Files:
1. `404.php`
2. `archive.php`
3. `comments.php` ✅ (already updated)
4. `footer.php`
5. `header.php`
6. `index.php`
7. `page.php`
8. `search.php`
9. `searchform.php`
10. `sidebar.php`
11. `sidebar-shop.php`
12. `single.php`

**Tasks:**
- Check for `array()` syntax → `[]`
- Check for `isset() ? :` → `??`
- Add strict types if safe (minimal WordPress API interaction)

---

### Section 2: Core Theme Files (9 files)
**Status:** ✅ Mostly Complete
**Priority:** High

Files:
1. `functions.php` ✅ (Phase 4 complete)
2. `inc/extras.php` ✅ (Phase 4 complete)
3. `inc/context.php` ✅ (Phase 4 complete)
4. `inc/hooks.php` ⚠️ (Phase 2 complete, no strict types - WordPress hooks)
5. `inc/customizer.php` ⚠️ (Phase 2 complete, no strict types - WordPress API)
6. `inc/template-tags.php` ✅ (Phase 4 complete)
7. `inc/template-menu.php` ✅ (Phase 4 complete)
8. `inc/template-comment.php` ✅ (Phase 4 complete)
9. `inc/template-related-posts.php` ✅ (Phase 4 complete)

**Tasks:**
- Verify all are up to Phase 4 standards
- Document why `hooks.php` and `customizer.php` don't have strict types

---

### Section 3: Class Files (4 files)
**Status:** ✅ Phase 2 Complete
**Priority:** High

Files:
1. `inc/classes/class-widget-area.php`
2. `inc/classes/class-settings.php` ✅ (Phase 4 complete - readonly property)
3. `inc/classes/class-post-meta.php`
4. `inc/classes/class-dynamic-css-file.php`

**Tasks:**
- Add strict types if safe
- Check for readonly property candidates
- Verify array syntax

---

### Section 4: Configuration Files (5 files)
**Status:** ✅ Phase 4 Complete
**Priority:** High

Files:
1. `config/layout.php` ✅
2. `config/menus.php` ✅
3. `config/modules.php` ✅
4. `config/sidebars.php` ✅
5. `config/thumbnails.php` ✅

**Tasks:**
- All complete, verify once more

---

### Section 5: Module Files (7 files)
**Status:** ✅ Mostly Complete
**Priority:** High

Files:
1. `inc/modules/base.php` ✅ (Phase 2 complete)
2. `inc/modules/post-formats/module.php` ✅ (Phase 2 complete)
3. `inc/modules/blog-layouts/module.php` ✅ (Phase 4 complete)
4. `inc/modules/breadcrumbs/module.php` ✅ (Phase 2 complete)
5. `inc/modules/crocoblock/module.php` ✅ (Phase 2 complete)
6. `inc/modules/woo/module.php` ✅ (Phase 2 complete)
7. `inc/modules/woo-page-title/module.php` ✅ (Phase 2 complete)
8. `inc/modules/woo-breadcrumbs/module.php` ✅ (Phase 2 complete)

**Tasks:**
- Add strict types to module files if safe
- Check for readonly property candidates

---

### Section 6: WooCommerce Includes (6 files)
**Status:** ✅ Phase 2 Complete
**Priority:** Medium

Files:
1. `inc/modules/woo/includes/wc-integration.php` ✅ (Phase 3 complete)
2. `inc/modules/woo/includes/wc-cart-functions.php` ✅ (Phase 2 complete)
3. `inc/modules/woo/includes/wc-single-product-functions.php` ✅ (Phase 2 complete)
4. `inc/modules/woo/includes/wc-archive-product-functions.php` ✅ (Phase 3 complete)
5. `inc/modules/woo/includes/wc-content-product-functions.php` ✅ (Phase 1 complete)
6. `inc/modules/woo/includes/wc-customizer.php` ✅ (Phase 2 complete)

**Tasks:**
- Add strict types if safe
- Verify all array syntax

---

### Section 7: WooCommerce Breadcrumbs Class (1 file)
**Status:** ✅ Phase 2 Complete
**Priority:** Medium

Files:
1. `inc/modules/woo-breadcrumbs/classes/class-wc-breadcrumbs.php` ✅ (Phase 3 complete)

**Tasks:**
- Add strict types if safe

---

### Section 8: Module Template Files (56 files)
**Status:** ⏳ To Check
**Priority:** Low (mostly HTML/PHP mix)

**Subsections:**
- Creative Layout (10 files)
- Default Layout (9 files)
- Grid Layout (10 files)
- Masonry Layout (10 files)
- Vertical Justify Layout (10 files)
- Other Module Templates (2 files)

**Tasks:**
- Check for `array()` syntax → `[]`
- Sample check a few files from each category

---

### Section 9: Template Parts (30 files)
**Status:** ⏳ To Check
**Priority:** Low (mostly HTML/PHP mix)

**Subsections:**
- Core Template Parts (9 files)
- Layout Template Parts (3 files)
- Loop Templates (2 files)
- Single Post Templates (16 files)
- Other Template Parts (1 file)

**Tasks:**
- Check for `array()` syntax → `[]`
- Sample check representative files

---

### Section 10: Page Templates (1 file)
**Status:** ⏳ To Check
**Priority:** Low

Files:
1. `page-templates/fullwidth-content.php`

**Tasks:**
- Check for `array()` syntax → `[]`

---

### Section 11: Post Templates (9 files)
**Status:** ⏳ To Check
**Priority:** Low

Files:
1. `post-templates/single-layout-2.php` through `single-layout-10.php`

**Tasks:**
- Check for `array()` syntax → `[]`
- Sample check a few files

---

### Section 12: Admin Templates (1 file)
**Status:** ⏳ To Check
**Priority:** Low

Files:
1. `admin-templates/settings-page.php`

**Tasks:**
- Check for `array()` syntax → `[]`

---

## Execution Order

1. **High Priority:** Sections 2, 3, 4, 5, 6, 7 (Core files)
2. **Medium Priority:** Section 1 (Root templates)
3. **Low Priority:** Sections 8, 9, 10, 11, 12 (Template files - sample check)

---

## Progress Tracking

- [ ] Section 1: Root Level Template Files
- [ ] Section 2: Core Theme Files (verify)
- [ ] Section 3: Class Files
- [ ] Section 4: Configuration Files (verify)
- [ ] Section 5: Module Files
- [ ] Section 6: WooCommerce Includes
- [ ] Section 7: WooCommerce Breadcrumbs Class
- [ ] Section 8: Module Template Files (sample)
- [ ] Section 9: Template Parts (sample)
- [ ] Section 10: Page Templates
- [ ] Section 11: Post Templates (sample)
- [ ] Section 12: Admin Templates

---

## Notes

- Template files (Sections 8-12) are mostly HTML/PHP mix with minimal logic
- Focus on array syntax and null coalescing for templates
- Strict types only for files with substantial PHP logic
- Sample checking for large template directories is acceptable

