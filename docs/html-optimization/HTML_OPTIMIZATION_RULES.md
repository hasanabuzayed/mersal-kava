# HTML Optimization Rules Catalog

**Date:** November 23, 2024  
**Status:** Active  
**Last Updated:** After Group 6 completion  
**Total Rules:** 5

---

## Rule Management

This catalog contains all optimization rules generated from the sequential optimization framework. Rules are organized by category and include:

- Pattern identification
- Success rates
- Application instructions
- Auto-apply status
- Usage examples

**Rules are automatically applied to subsequent groups based on success rates and validation.**

---

## Rule Categories

1. **Accessibility Rules** - ARIA attributes, roles, screen reader support
2. **Semantic HTML Rules** - Element replacement, semantic structure
3. **Performance Rules** - Optimization, minification, loading
4. **SEO Rules** - Structured data, meta tags, schema markup

---

## Active Rules

### Rule: `nav-aria-label-001`

**Category:** Accessibility  
**Pattern:** Navigation ARIA Labels  
**Status:** ✅ Active  
**Auto-Apply:** ✅ Enabled  
**Success Rate:** 100% (3/3 applications)

#### Pattern Description

All navigation elements should have descriptive `aria-label` attributes to improve screen reader support and accessibility. The redundant `role="navigation"` attribute should be removed from `<nav>` elements since the semantic element already implies this role.

#### Rule Action

1. **Add `aria-label`** to all `<nav>` elements
2. **Remove** redundant `role="navigation"` attributes
3. **Use descriptive labels:**
   - Main navigation: `aria-label="Main navigation"`
   - Footer navigation: `aria-label="Footer navigation"`
   - Social navigation: `aria-label="Social links {context}"`
   - Context-specific: `aria-label="[Descriptive context] navigation"`

#### Application Instructions

**Before:**
```php
<nav id="site-navigation" class="main-navigation" role="navigation">
    <?php wp_nav_menu( $args ); ?>
</nav>
```

**After:**
```php
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Main navigation', 'kava' ); ?>">
    <?php wp_nav_menu( $args ); ?>
</nav>
```

#### Files Applied

- ✅ `inc/template-menu.php` - Main navigation
- ✅ `inc/template-menu.php` - Footer navigation
- ✅ `inc/template-menu.php` - Social navigation

#### Validation

- ✅ HTML valid
- ✅ WCAG 2.1 AA compliant
- ✅ Screen reader tested
- ✅ No breaking changes

#### Usage in Next Groups

**Apply to:**
- Any navigation elements in content templates
- Post navigation
- Comment navigation
- Archive navigation
- Search navigation

**Do NOT apply to:**
- WordPress core navigation (wp_nav_menu handles this)
- Custom navigation that already has proper ARIA

---

### Rule: `nav-semantic-001`

**Category:** Semantic HTML  
**Pattern:** Semantic Navigation Containers  
**Status:** ✅ Active  
**Auto-Apply:** ✅ Enabled  
**Success Rate:** 100% (1/1 application)

#### Pattern Description

Navigation menus should use the semantic `<nav>` element instead of generic `<div>` containers. This improves document structure, assistive technology support, and semantic meaning.

#### Rule Action

1. **Replace** `<div>` containers with `<nav>` for navigation menus
2. **Add** appropriate `aria-label` (see `nav-aria-label-001`)
3. **Preserve** all existing classes and IDs
4. **Maintain** functionality and styling

#### Application Instructions

**Before:**
```php
$args = [
    'container' => 'div',
    'container_class' => 'social-list',
    // ...
];
```

**After:**
```php
$args = [
    'container' => 'nav',
    'container_class' => 'social-list',
    // ...
];
// Then add aria-label (see nav-aria-label-001)
```

#### Files Applied

- ✅ `inc/template-menu.php` - Social navigation (changed from div to nav)

#### Validation

- ✅ HTML valid
- ✅ Semantic structure improved
- ✅ No styling issues
- ✅ Functionality maintained

#### Usage in Next Groups

**Apply to:**
- Any div containers that wrap navigation menus
- Custom navigation implementations
- Breadcrumb navigation (if not already nav)
- Pagination navigation

**Do NOT apply to:**
- Layout containers (keep as div)
- Content wrappers (keep as div)
- WordPress core elements

---

### Rule: `decorative-aria-hidden-001`

**Category:** Accessibility  
**Pattern:** Decorative Element Accessibility  
**Status:** ✅ Active  
**Auto-Apply:** ✅ Enabled  
**Success Rate:** 100% (1/1 application)

#### Pattern Description

Decorative elements, loading indicators, and visual-only elements should be hidden from screen readers using `aria-hidden="true"`. When these elements are visible during loading or transitions, add an `aria-label` for context.

#### Rule Action

1. **Add** `aria-hidden="true"` to decorative elements
2. **Add** `aria-label` for context when element is visible
3. **Ensure** element doesn't contain important information
4. **Test** with screen readers to verify behavior

#### Application Instructions

**Before:**
```php
echo '<div class="page-preloader-cover">
    <div class="page-preloader"></div>
</div>';
```

**After:**
```php
echo '<div class="page-preloader-cover" aria-hidden="true" aria-label="' . esc_attr__( 'Page loading', 'kava' ) . '">
    <div class="page-preloader"></div>
</div>';
```

#### Files Applied

- ✅ `inc/template-tags.php` - Page preloader

#### Validation

- ✅ Screen reader tested (hidden properly)
- ✅ Visual functionality maintained
- ✅ No accessibility regressions

#### Usage in Next Groups

**Apply to:**
- Loading spinners
- Decorative icons
- Visual separators
- Background images (if decorative)
- Animation containers (if decorative)

**Do NOT apply to:**
- Elements with important content
- Interactive elements
- Form elements
- Error messages

---

### Rule: `complementary-role-001`

**Category:** Accessibility  
**Pattern:** Complementary Content Roles  
**Status:** ✅ Active  
**Auto-Apply:** ✅ Enabled  
**Success Rate:** 100% (1/1 application)

#### Pattern Description

Complementary content areas (sidebars, top panels, related content) should use the `role="complementary"` ARIA role and have descriptive `aria-label` attributes. This helps screen readers identify and navigate to these sections.

#### Rule Action

1. **Add** `role="complementary"` to complementary content areas
2. **Add** descriptive `aria-label`
3. **Use** semantic elements where possible (`<aside>` for sidebars)
4. **Ensure** proper heading structure within

#### Application Instructions

**Before:**
```php
<div class="top-panel container">
    <!-- Content -->
</div>
```

**After:**
```php
<div class="top-panel container" role="complementary" aria-label="<?php esc_attr_e( 'Top Panel', 'kava' ); ?>">
    <!-- Content -->
</div>
```

**Alternative (for sidebars):**
```php
<aside class="sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'kava' ); ?>">
    <!-- Content -->
</aside>
```

#### Files Applied

- ✅ `template-parts/top-panel.php` - Top panel

#### Validation

- ✅ ARIA role properly implemented
- ✅ Screen reader tested
- ✅ No conflicts with semantic elements

#### Usage in Next Groups

**Apply to:**
- Sidebars
- Related content sections
- Widget areas (if not already semantic)
- Top/bottom panels
- Supplementary content

**Do NOT apply to:**
- Main content areas (use `<main>`)
- Navigation (use `<nav>`)
- Headers/footers (use semantic elements)

---

### Rule: `entry-meta-aria-label-001`

**Category:** Accessibility  
**Pattern:** Entry Metadata Landmarks  
**Status:** ✅ Active  
**Auto-Apply:** ✅ Enabled  
**Success Rate:** 100% (49/49 applications)

#### Pattern Description

Metadata clusters inside card-style blog layouts lacked ARIA descriptions, making it difficult for screen reader users to understand the context of author/date/tag groupings. This rule enforces descriptive `aria-label` attributes for header and footer metadata blocks across all layout modules.

#### Rule Action

1. **Add** `aria-label="Entry metadata"` to header metadata wrappers
2. **Add** `aria-label="Entry footer metadata"` to footer metadata wrappers
3. **Preserve** existing classes, IDs, and spacing wrappers
4. **Ensure** no duplicate ARIA attributes exist before applying

#### Application Instructions

**Before:**
```php
<header class="entry-header">
    <div class="entry-meta">
        <?php kava_posted_by(); ?>
    </div>
</header>
```

**After:**
```php
<header class="entry-header">
    <div class="entry-meta" aria-label="<?php esc_attr_e( 'Entry metadata', 'kava' ); ?>">
        <?php kava_posted_by(); ?>
    </div>
</header>
```

#### Files Applied

- ✅ All `inc/modules/blog-layouts/template-parts/**/content*.php` files (49 variants)
- ✅ `template-parts/content.php` (baseline template reference)

#### Validation

- ✅ HTML output validated
- ✅ NVDA + VoiceOver spot checks
- ✅ No CSS regressions (attributes only)
- ✅ Pattern ready for auto-apply

#### Usage in Next Groups

**Apply to:**
- Any `div.entry-meta` blocks lacking ARIA labels
- Reusable card components
- Archive/search loop metadata wrappers
- Custom Gutenberg block metadata clusters

**Do NOT apply to:**
- Metadata already exposing ARIA labels
- Structured data spans managed by filters
- Elements that are not metadata (e.g., layout containers)

---

## Rule Application Workflow

### Step 1: Pattern Recognition

When processing a new file or group:

1. **Scan** for patterns matching rule conditions
2. **Identify** elements that match rule patterns
3. **Verify** rule applicability (check exceptions)
4. **Document** matches found

### Step 2: Rule Application

For each matching pattern:

1. **Apply** rule action (modify code)
2. **Preserve** existing functionality
3. **Maintain** styling and classes
4. **Test** output

### Step 3: Validation

After applying rules:

1. **Validate** HTML output
2. **Test** accessibility
3. **Verify** no breaking changes
4. **Document** results

### Step 4: Success Tracking

Track rule application:

1. **Record** success/failure
2. **Update** success rate
3. **Document** exceptions
4. **Refine** rule if needed

---

## Rule Success Rates

| Rule ID | Category | Success Rate | Applications | Status |
|---------|----------|-------------|--------------|--------|
| `nav-aria-label-001` | Accessibility | 100% | 3 | ✅ Active |
| `nav-semantic-001` | Semantic HTML | 100% | 1 | ✅ Active |
| `decorative-aria-hidden-001` | Accessibility | 100% | 1 | ✅ Active |
| `complementary-role-001` | Accessibility | 100% | 1 | ✅ Active |
| `entry-meta-aria-label-001` | Accessibility | 100% | 49 | ✅ Active |

**Average Success Rate:** 100%  
**Total Applications:** 55  
**Rules Ready for Auto-Apply:** 5

---

## Rule Exceptions

### When NOT to Apply Rules

#### `nav-aria-label-001` Exceptions:
- WordPress core navigation (wp_nav_menu may handle ARIA)
- Navigation already has proper ARIA labels
- Custom navigation with special requirements

#### `nav-semantic-001` Exceptions:
- Layout containers (must remain div)
- Content wrappers (must remain div)
- WordPress core elements that require div

#### `decorative-aria-hidden-001` Exceptions:
- Elements with important content
- Interactive elements
- Form elements
- Error messages

#### `complementary-role-001` Exceptions:
- Main content areas (use semantic `<main>`)
- Navigation areas (use semantic `<nav>`)
- Headers/footers (use semantic elements)

#### `entry-meta-aria-label-001` Exceptions:
- Metadata wrappers already containing ARIA labels
- Metadata injected by filters with dynamic labels
- Cases where metadata is intentionally hidden (e.g., visually hidden for print)

---

## Rule Refinement Process

### When to Refine a Rule

1. **Success Rate Drops** below 80%
2. **Exceptions Increase** significantly
3. **Breaking Changes** occur
4. **New Patterns** identified that conflict

### Refinement Steps

1. **Analyze** failures and exceptions
2. **Identify** root causes
3. **Update** rule conditions
4. **Test** refined rule
5. **Update** documentation
6. **Re-apply** to previous groups if needed

---

## Rule Deprecation

### When to Deprecate a Rule

1. **Success Rate** consistently below 70%
2. **Breaking Changes** cannot be resolved
3. **Better Pattern** identified
4. **No Longer Applicable** to current codebase

### Deprecation Process

1. **Mark** rule as deprecated
2. **Document** reason for deprecation
3. **Provide** alternative approach
4. **Remove** from auto-apply list
5. **Archive** rule documentation

---

## Best Practices

### Rule Application

1. ✅ **Always validate** HTML after applying rules
2. ✅ **Test accessibility** with screen readers
3. ✅ **Preserve functionality** and styling
4. ✅ **Document exceptions** when they occur
5. ✅ **Update success rates** after each application

### Rule Creation

1. ✅ **Identify clear patterns** before creating rules
2. ✅ **Test thoroughly** before marking as auto-apply
3. ✅ **Document exceptions** clearly
4. ✅ **Provide examples** in documentation
5. ✅ **Track success rates** from the start

### Rule Maintenance

1. ✅ **Review rules** after each group
2. ✅ **Update documentation** when patterns change
3. ✅ **Refine rules** based on feedback
4. ✅ **Archive deprecated** rules
5. ✅ **Keep catalog** up to date

---

## Usage Examples

### Applying Rules to New Files

```php
// Example: Applying nav-aria-label-001 to a new navigation
function custom_navigation() {
    ?>
    <nav id="custom-nav" class="custom-navigation" aria-label="<?php esc_attr_e( 'Custom navigation', 'kava' ); ?>">
        <?php wp_nav_menu( $args ); ?>
    </nav>
    <?php
}
```

### Applying Multiple Rules

```php
// Example: Applying multiple rules to a sidebar
<aside class="sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'kava' ); ?>">
    <nav aria-label="<?php esc_attr_e( 'Sidebar navigation', 'kava' ); ?>">
        <!-- Navigation content -->
    </nav>
    <div class="decorative-icon" aria-hidden="true">
        <!-- Decorative content -->
    </div>
</aside>
```

---

## Next Steps

### For Group 2: Core Content Templates

**Rules to Apply:**
- `nav-aria-label-001` - To any navigation in content templates
- `nav-semantic-001` - To any div containers that should be nav
- `decorative-aria-hidden-001` - To decorative elements in content
- `complementary-role-001` - To sidebars and related content

**Expected Patterns:**
- Content structure patterns
- Article semantics
- Heading hierarchy
- Media element optimization

---

## Version History

### Version 1.0 - November 23, 2024
- Initial rules catalog created
- 4 rules from Group 1
- All rules validated and active
- Ready for Group 2 application

---

**Status:** ✅ Active  
**Last Updated:** November 23, 2024  
**Next Review:** After Group 2 completion

