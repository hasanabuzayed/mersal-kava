# PHP Phase 4 Progress - PHP 8.1+ & 8.3 Features

## Phase 4 Tasks

1. ✅ Add `declare(strict_types=1);` to core files
2. ⏳ Add readonly properties where applicable (PHP 8.1+)
3. ⏳ Add typed class constants (PHP 8.3)
4. ⏳ Consider enums for constants (PHP 8.1+)
5. ⏳ Fix type coercion issues
6. ⏳ Extensive testing required
7. ⏳ Document changes

---

## Implementation Strategy

### Step 1: Strict Types Declaration
**Files to add `declare(strict_types=1);`:**
- ✅ `inc/extras.php` - Utility functions (safe)
- ⏳ `inc/context.php` - Context helpers (safe)
- ⏳ `inc/template-tags.php` - Template functions (safe)
- ⏳ `inc/template-menu.php` - Menu functions (safe)
- ⏳ `inc/template-comment.php` - Comment functions (safe)
- ⏳ `inc/template-related-posts.php` - Related posts (safe)
- ⚠️ `functions.php` - Main theme (WordPress hooks - be careful)
- ⚠️ `inc/hooks.php` - WordPress hooks (be careful)
- ⚠️ `inc/customizer.php` - Customizer (WordPress API - be careful)

**Note:** We'll start with utility files that don't interact directly with WordPress core APIs.

### Step 2: Readonly Properties
**Candidates:**
- `Kava_Theme_Setup::$version` - Set once in constructor, never modified
- Other properties that are set once and never changed

### Step 3: Typed Class Constants
**Candidates:**
- Any class constants that can be typed (PHP 8.3)

### Step 4: Enums
**Candidates:**
- Status constants
- Type constants
- Configuration constants

---

## Changes Made

### 1. Strict Types Declaration

#### `inc/extras.php`
- ✅ Added `declare(strict_types=1);` at the top

---

## Testing Checklist

- [ ] All files with strict types tested
- [ ] No type coercion errors
- [ ] WordPress compatibility maintained
- [ ] All hooks and filters work correctly
- [ ] Customizer still functions
- [ ] Theme activation works
- [ ] No PHP errors or warnings

---

## Notes

- **WordPress Compatibility:** Be cautious with strict types in files that interact heavily with WordPress APIs
- **Type Coercion:** WordPress functions often return mixed types, so strict types may reveal issues
- **Testing:** Extensive testing required after each change
- **Incremental:** Apply changes incrementally and test thoroughly

