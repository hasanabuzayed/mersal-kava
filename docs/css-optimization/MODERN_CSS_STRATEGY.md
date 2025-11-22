# Modern CSS Strategy: Hybrid Approach

## Philosophy

**Modern CSS doesn't mean replacing everything** - it means using the right tool for the right job.

## Strategy Overview

### 1. Grid System: Keep Margin-Based ✅
**Why:** The grid system is foundational infrastructure
- Uses negative margins on `.row` + padding on `.col-*`
- This is a proven, widely-used pattern (Bootstrap, Foundation, etc.)
- Changing it would break too much
- **Modern approach:** Keep it as-is, but use logical properties where appropriate

### 2. Component-Level Layouts: Use `gap` Selectively ✅
**Where `gap` works well:**
- Galleries (flex/grid layouts without negative margins)
- Author bio sections
- Entry meta (when not using space-between)
- Any flex container that doesn't use negative margins

**Pattern:**
```scss
@supports (gap: 1px) {
  display: flex;
  gap: $spacing;
  // Modern browsers get gap
}
@supports not (gap: 1px) {
  // Fallback for older browsers
  margin-left: -$spacing;
  margin-right: -$spacing;
  > * {
    padding-left: $spacing;
    padding-right: $spacing;
  }
}
```

### 3. `space-between-content`: Hybrid Approach ✅
**Challenge:** Uses `justify-content: space-between` which distributes items
**Solution:** Use `gap` as minimum spacing, keep margins for edge alignment

```scss
@mixin space-between-content($child-indent-type: 'margin') {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  
  // Modern: gap adds minimum spacing between items
  @supports (gap: 1px) {
    gap: variables.$grid-gutter-width;
    // Keep negative margins for edge alignment
    margin-left: -(variables.$grid-gutter-width)*0.5;
    margin-right: -(variables.$grid-gutter-width)*0.5;
    // Reduce child margins since gap handles spacing
    > * {
      margin-left: variables.$grid-gutter-width*0.25; // Half the original
      margin-right: variables.$grid-gutter-width*0.25;
    }
  }
  
  // Fallback: Original margin-based approach
  @supports not (gap: 1px) {
    margin-left: -(variables.$grid-gutter-width)*0.5;
    margin-right: -(variables.$grid-gutter-width)*0.5;
    > * {
      margin-left: variables.$grid-gutter-width*0.5;
      margin-right: variables.$grid-gutter-width*0.5;
    }
  }
}
```

### 4. `grid-indent`: Use `gap` When Appropriate ✅
**For flex/grid layouts:** Use gap
**For inline-block layouts:** Keep margins

```scss
@mixin grid-indent($indent, $child-indent-type: 'padding', $child-selector: '> *') {
  // Check if parent is flex/grid
  display: flex;
  flex-wrap: wrap;
  
  @supports (gap: 1px) {
    gap: $indent * 2;
    margin-left: 0;
    margin-right: 0;
    #{$child-selector} {
      margin: 0;
      padding: 0;
    }
  }
  
  @supports not (gap: 1px) {
    margin-left: -$indent;
    margin-right: -$indent;
    #{$child-selector} {
      padding-left: $indent;
      padding-right: $indent;
    }
  }
}
```

## Implementation Plan

1. ✅ Keep grid system margin-based (foundational)
2. ✅ Use `gap` in component-level flex layouts
3. ✅ Create hybrid `space-between-content` mixin
4. ✅ Update `grid-indent` to detect layout type
5. ✅ Test all layouts thoroughly

## Benefits

- **Modern CSS where it makes sense** (component layouts)
- **Stable foundation** (grid system)
- **Progressive enhancement** (@supports queries)
- **Backward compatibility** (fallbacks)
- **Best of both worlds** (modern + reliable)

