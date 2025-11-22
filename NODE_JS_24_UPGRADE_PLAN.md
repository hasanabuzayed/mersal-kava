# Node.js 24 Upgrade Plan

**Date:** December 2024  
**Target Node.js Version:** 24.x LTS  
**Current Node.js Version:** >=14.0.0  
**Status:** 🔄 In Progress - Phase 1 Complete

---

## Overview

This document outlines the plan to upgrade the Kava v3 WordPress theme's Node.js requirements from >=14.0.0 to Node.js 24.x LTS, ensuring compatibility with all build tools and dependencies while taking advantage of performance improvements and new features.

---

## Node.js 24 Release Information

### Timeline
- **Release Date:** May 6, 2025
- **LTS Status:** October 2025 - April 2028
- **Current Status:** Active LTS (as of October 2025)
- **Support Period:** ~3 years (until April 2028)

### Key Features & Improvements

#### 1. V8 Engine Upgrade
- **Version:** V8 13.6
- **New JavaScript Features:**
  - `RegExp.escape()` - Escape special regex characters
  - `Float16Array` - Half-precision floating-point arrays
  - `Atomics.pause()` - Improved atomic operations performance
- **Impact:** Better JavaScript performance and new language features

#### 2. npm Update
- **Version:** npm 11 (bundled)
- **Improvements:**
  - Faster package installations
  - Enhanced security checks
  - Improved dependency resolution
- **Impact:** Faster build times, better security

#### 3. AsyncLocalStorage Enhancement
- **Change:** Uses `AsyncContextFrame` by default
- **Impact:** Improved performance in asynchronous context tracking

#### 4. Global URLPattern API
- **Change:** `URLPattern` API now globally available
- **Impact:** Simplified URL matching without explicit imports

#### 5. Permission Model
- **Change:** Enhanced permission model with granular resource control
- **Impact:** Better security and access control

---

## Breaking Changes & Deprecations

### Deprecated APIs (Warnings)

1. **`url.parse()`** - Deprecated
   - **Alternative:** Use WHATWG URL API (`new URL()`)
   - **Impact:** Minimal - not used in build tools

2. **`SlowBuffer`** - Deprecated
   - **Alternative:** Use `Buffer.allocUnsafeSlow()`
   - **Impact:** Minimal - not used in build scripts

3. **`tls.createSecurePair()`** - Deprecated
   - **Alternative:** Use `tls.TLSSocket`
   - **Impact:** Minimal - not used in build tools

4. **Legacy `fs` constants** - Being phased out
   - **Alternative:** Use string constants
   - **Impact:** Minimal - build tools should handle this

### Removed Features

1. **`tls.createSecurePair`** - Removed
   - **Impact:** None - not used in build scripts

2. **`fs.truncate()` with file descriptors** - No longer supported
   - **Impact:** None - not used in build scripts

3. **Internal headers in HTTP messages** - Removed
   - **Impact:** None - not used in build scripts

---

## Current State Assessment

### Current Configuration

#### package.json
```json
{
  "engines": {
    "node": ">=14.0.0",
    "npm": ">=6.0.0"
  }
}
```

#### Build Dependencies
- **Gulp:** 5.0.1 ✅ (Modern version, ES modules)
- **gulp-autoprefixer:** 10.0.0 ✅ (Latest, requires ES modules)
- **gulp-sass:** 6.0.1 ✅ (Latest, uses Dart Sass)
- **sass:** 1.94.2 ✅ (Dart Sass, latest)
- **gulp-rtlcss:** 2.0.0 ✅ (Latest)
- **gulp-notify:** 5.0.0 ✅ (Latest)
- **gulp-plumber:** 1.2.1 ✅ (Latest)
- **gulp-rename:** 2.1.0 ✅ (Latest)
- **gulp-checktextdomain:** 2.3.0 ✅ (Latest)
- **gulp-livereload:** 4.0.2 ✅ (Latest)

#### Build Configuration
- **Gulpfile:** `gulpfile.mjs` (ES modules) ✅
- **Syntax:** Modern ES6+ (import/export) ✅
- **Streams:** Gulp 5.x series/parallel ✅

### Compatibility Status

#### ✅ Already Compatible
- All Gulp plugins are modern versions
- Using ES modules (required for Node.js 24)
- No deprecated APIs in use
- Modern JavaScript syntax throughout

#### ⚠️ Potential Concerns
- Native modules may need recompilation (if any exist)
- Test all build scripts after upgrade
- Verify npm 11 compatibility with package-lock.json

---

## Upgrade Phases

### Phase 1: Pre-Upgrade Assessment

#### 1.1 Current Environment Check
- [x] Document current Node.js version in use ✅ v20.18.2
- [x] Document current npm version in use ✅ 11.6.0
- [x] Check for native dependencies ✅ @parcel/watcher (optional)
- [x] Review package-lock.json format (v3) ✅ Already using v3
- [x] Identify any CI/CD configurations ✅ None found

#### 1.2 Dependency Compatibility Check
- [x] Verify Gulp 5.0.1 compatibility with Node.js 24 ✅ Compatible
- [x] Verify all Gulp plugins compatibility ✅ All compatible
- [x] Check Sass (Dart) compatibility ✅ Compatible
- [x] Verify npm 11 package-lock.json compatibility ✅ Already using npm 11

#### 1.3 Code Review
- [x] Review gulpfile.mjs for deprecated APIs ✅ None found
- [x] Check for any Node.js-specific code ✅ None found
- [x] Review any custom build scripts ✅ Only gulpfile.mjs
- [x] Check for hardcoded Node.js version references ✅ Only in package.json

**Status:** ✅ Phase 1 Complete - See `NODE_JS_24_PHASE_1_PROGRESS.md` for details

### Phase 2: Environment Setup

#### 2.1 Local Development
- [ ] Install Node.js 24.x LTS locally
- [ ] Update npm to version 11 (bundled with Node.js 24)
- [ ] Create `.nvmrc` file with Node.js 24 version
- [ ] Test Node.js 24 installation

#### 2.2 Dependencies Update
- [ ] Delete `node_modules` directory
- [ ] Delete `package-lock.json` (to regenerate with npm 11)
- [ ] Run `npm install` with Node.js 24
- [ ] Verify all dependencies install correctly
- [ ] Check for any dependency warnings

#### 2.3 Package Configuration Update
- [ ] Update `package.json` engines field
- [ ] Update `package.json` npm version requirement
- [ ] Verify package-lock.json format (should be v3)

### Phase 3: Build System Testing

#### 3.1 Build Script Verification
- [ ] Test `npm install` command
- [ ] Test `gulp css` task
- [ ] Test `gulp css_theme` task
- [ ] Test `gulp blog_layouts_module` task
- [ ] Test `gulp woo_module` task
- [ ] Test `gulp woo_module_rtl` task
- [ ] Test `gulp admin_css` task
- [ ] Test `gulp watch` task
- [ ] Test `gulp default` task
- [ ] Test `gulp checktextdomain` task

#### 3.2 Output Verification
- [ ] Verify CSS output files compile correctly
- [ ] Check for any compilation errors
- [ ] Verify RTL CSS generation works
- [ ] Check for any console warnings
- [ ] Verify file sizes are reasonable

#### 3.3 Performance Check
- [ ] Measure build time before upgrade
- [ ] Measure build time after upgrade
- [ ] Compare performance metrics
- [ ] Document any performance improvements

### Phase 4: Integration Testing

#### 4.1 WordPress Integration
- [ ] Test theme activation with new build
- [ ] Verify CSS loads correctly
- [ ] Test responsive layouts
- [ ] Verify RTL support
- [ ] Test admin CSS

#### 4.2 Browser Testing
- [ ] Test in Chrome (latest)
- [ ] Test in Firefox (latest)
- [ ] Test in Safari (latest)
- [ ] Test in Edge (latest)
- [ ] Verify CSS vendor prefixes

#### 4.3 Feature Testing
- [ ] Test Gulp watch functionality
- [ ] Test live reload (if used)
- [ ] Test text domain checking
- [ ] Test all Gulp tasks in production mode

### Phase 5: Documentation & Cleanup

#### 5.1 Documentation Updates
- [ ] Update `MODERNIZATION.md` with Node.js 24 requirement
- [ ] Update README.md with Node.js 24 requirement
- [ ] Document any breaking changes
- [ ] Update installation instructions
- [ ] Create `.nvmrc` file

#### 5.2 Configuration Files
- [ ] Create `.nvmrc` file (if using nvm)
- [ ] Update `.gitignore` if needed
- [ ] Update any CI/CD configurations
- [ ] Update Docker files (if any)

#### 5.3 Final Verification
- [ ] Run full test suite (if exists)
- [ ] Perform clean install test
- [ ] Verify all documentation is accurate
- [ ] Create upgrade summary

---

## Detailed Upgrade Steps

### Step 1: Backup Current State
```bash
# Backup package files
cp package.json package.json.backup
cp package-lock.json package-lock.json.backup

# Check current versions
node --version
npm --version
```

### Step 2: Install Node.js 24
```bash
# Using nvm (recommended)
nvm install 24
nvm use 24

# Or download from nodejs.org
# https://nodejs.org/en/download/

# Verify installation
node --version  # Should show v24.x.x
npm --version   # Should show 11.x.x
```

### Step 3: Create .nvmrc File
```bash
# Create .nvmrc file
echo "24" > .nvmrc

# Verify
cat .nvmrc
```

### Step 4: Update package.json
```json
{
  "engines": {
    "node": ">=24.0.0",
    "npm": ">=11.0.0"
  }
}
```

### Step 5: Clean Install Dependencies
```bash
# Remove old dependencies
rm -rf node_modules
rm package-lock.json

# Install with Node.js 24
npm install

# Verify installation
npm list --depth=0
```

### Step 6: Test Build
```bash
# Test all Gulp tasks
gulp css
gulp css_theme
gulp blog_layouts_module
gulp woo_module
gulp woo_module_rtl
gulp admin_css

# Test watch mode
gulp watch
```

### Step 7: Verify Output
```bash
# Check compiled CSS files
ls -lh style.css theme.css
ls -lh inc/modules/*/assets/css/*.css

# Verify file sizes and timestamps
```

---

## Testing Checklist

### Build System Tests

#### Installation
- [ ] `npm install` completes successfully
- [ ] No dependency warnings or errors
- [ ] All packages install correctly
- [ ] package-lock.json generated correctly

#### Gulp Tasks
- [ ] `gulp css` - Compiles style.css
- [ ] `gulp css_theme` - Compiles theme.css
- [ ] `gulp blog_layouts_module` - Compiles blog module CSS
- [ ] `gulp woo_module` - Compiles WooCommerce module CSS
- [ ] `gulp woo_module_rtl` - Compiles RTL WooCommerce CSS
- [ ] `gulp admin_css` - Compiles admin CSS
- [ ] `gulp watch` - Watch mode works
- [ ] `gulp default` - Default task works
- [ ] `gulp checktextdomain` - Text domain check works

#### Output Verification
- [ ] CSS files compile without errors
- [ ] CSS files have correct file sizes
- [ ] RTL CSS generates correctly
- [ ] Vendor prefixes are applied
- [ ] No compilation warnings

### Integration Tests

#### WordPress
- [ ] Theme activates without errors
- [ ] CSS loads correctly in frontend
- [ ] Admin CSS loads correctly
- [ ] RTL layout works correctly
- [ ] Responsive layouts work

#### Performance
- [ ] Build time is acceptable
- [ ] Watch mode is responsive
- [ ] No memory leaks
- [ ] CPU usage is reasonable

---

## Rollback Plan

If issues occur during upgrade:

### Quick Rollback
```bash
# Restore backup files
cp package.json.backup package.json
cp package-lock.json.backup package-lock.json

# Switch back to Node.js 14
nvm use 14  # or previous version

# Reinstall dependencies
rm -rf node_modules
npm install
```

### Verification After Rollback
```bash
# Test build
gulp css
gulp css_theme

# Verify theme still works
```

---

## Expected Benefits

### Performance Improvements
- **Faster npm installs:** npm 11 offers improved performance
- **Better V8 performance:** V8 13.6 includes optimizations
- **Improved async operations:** AsyncLocalStorage enhancements

### Developer Experience
- **Modern features:** Access to latest JavaScript features
- **Better tooling:** npm 11 improvements
- **LTS support:** 3 years of support (until April 2028)

### Security
- **Enhanced security:** npm 11 security improvements
- **Permission model:** Better access control
- **Regular updates:** LTS security patches

---

## Potential Issues & Solutions

### Issue 1: Native Module Compilation
**Symptom:** Errors during `npm install` related to native modules  
**Solution:**
- Most Gulp plugins are pure JavaScript
- If issues occur, check for native dependencies
- May need to rebuild: `npm rebuild`

### Issue 2: package-lock.json Format
**Symptom:** Warnings about lockfile version  
**Solution:**
- npm 11 uses lockfile v3
- Delete and regenerate: `rm package-lock.json && npm install`

### Issue 3: Build Performance
**Symptom:** Slower builds than expected  
**Solution:**
- Clear npm cache: `npm cache clean --force`
- Rebuild: `rm -rf node_modules && npm install`
- Check for unnecessary dependencies

### Issue 4: Compatibility Warnings
**Symptom:** Deprecation warnings in console  
**Solution:**
- Most warnings are informational
- Check if warnings affect functionality
- Update dependencies if needed

---

## Files to Update

### Required Updates
1. **package.json**
   - Update `engines.node` to `>=24.0.0`
   - Update `engines.npm` to `>=11.0.0`

2. **.nvmrc** (new file)
   - Create with content: `24`

3. **MODERNIZATION.md**
   - Update Node.js requirement section
   - Add Node.js 24 upgrade information

### Optional Updates
1. **README.md**
   - Update installation instructions
   - Update Node.js version requirement

2. **CI/CD Configuration** (if exists)
   - Update Node.js version in workflows
   - Update Docker images (if used)

---

## Success Criteria

### Must Have
- ✅ All Gulp tasks work correctly
- ✅ CSS files compile successfully
- ✅ No build errors or critical warnings
- ✅ Theme works correctly with compiled assets
- ✅ package.json updated with correct engine requirements

### Should Have
- ✅ Performance improvements visible
- ✅ All tests pass (if test suite exists)
- ✅ Documentation updated
- ✅ .nvmrc file created

### Nice to Have
- ✅ Performance benchmarks documented
- ✅ Upgrade guide for team members
- ✅ CI/CD updated (if applicable)

---

## Timeline Estimate

### Phase 1: Pre-Upgrade Assessment
- **Duration:** 30 minutes
- **Tasks:** Environment check, dependency review

### Phase 2: Environment Setup
- **Duration:** 30 minutes
- **Tasks:** Install Node.js 24, update package.json

### Phase 3: Build System Testing
- **Duration:** 1 hour
- **Tasks:** Test all Gulp tasks, verify outputs

### Phase 4: Integration Testing
- **Duration:** 1-2 hours
- **Tasks:** WordPress testing, browser testing

### Phase 5: Documentation & Cleanup
- **Duration:** 30 minutes
- **Tasks:** Update docs, create .nvmrc

### **Total Estimated Time:** 3-4 hours

---

## Notes

### Compatibility Notes
- All current dependencies are compatible with Node.js 24
- Gulp 5.x uses ES modules (required for Node.js 24)
- Sass (Dart) is compatible with Node.js 24
- No deprecated APIs are used in build scripts

### Migration Notes
- This is primarily a version bump with minimal code changes
- Most changes are configuration updates
- Testing is the most important phase
- Rollback is straightforward if needed

### Future Considerations
- Monitor for dependency updates
- Keep Node.js LTS version updated
- Consider automating Node.js version checks
- Update CI/CD pipelines if they exist

---

## References

- [Node.js 24 Release Notes](https://nodejs.org/en/blog/release/v24.0.0)
- [Node.js 24 LTS Announcement](https://nodejs.org/en/blog/announcements/v24-lts)
- [npm 11 Release Notes](https://github.com/npm/cli/releases)
- [Gulp 5 Documentation](https://gulpjs.com/)
- [V8 13.6 Release Notes](https://v8.dev/blog/v8-release-136)

---

## Support

For issues or questions about the Node.js 24 upgrade:
1. Check this documentation
2. Review Node.js 24 release notes
3. Check dependency compatibility
4. Test in a development environment first

---

**Last Updated:** December 2024  
**Status:** Planning Phase - Ready to Begin  
**Next Steps:** Phase 1 - Pre-Upgrade Assessment

