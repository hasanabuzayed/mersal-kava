# Documentation Directory

This directory contains all project documentation organized by topic.

## Directory Structure

```
docs/
├── overview/              # Overview and summary documentation
│   └── MODERNIZATION.md  # Main modernization guide
│
├── php-modernization/    # PHP code modernization documentation
│   ├── PHP_MODERNIZATION_PLAN.md
│   ├── PHP_COMPREHENSIVE_UPDATE_PLAN.md
│   ├── PHP_COMPREHENSIVE_UPDATE_COMPLETE.md
│   └── PHP_PHASE_*.md    # Phase-specific progress reports
│
├── sass-migration/       # Sass migration documentation
│   ├── SASS_MIGRATION_PLAN.md
│   ├── SASS_MIGRATION_COMPLETE.md
│   └── SASS_PHASE_*.md   # Phase-specific progress reports
│
├── nodejs-upgrade/       # Node.js 24 upgrade documentation
│   ├── NODE_JS_24_UPGRADE_PLAN.md
│   ├── NODE_JS_24_UPGRADE_COMPLETE.md
│   └── NODE_JS_24_PHASE_*.md  # Phase-specific progress reports
│
├── swiper-migration/     # Swiper library migration documentation
│   ├── SWIPER_MIGRATION_PLAN.md
│   ├── SWIPER_MIGRATION_COMPLETE.md
│   └── SWIPER_*.md       # Phase-specific progress reports
│
├── wordpress-6.8/        # WordPress 6.8 compatibility documentation
│   ├── WORDPRESS_6.8_COMPATIBILITY_PLAN.md
│   ├── WP_6.8_COMPATIBILITY_SUMMARY.md
│   └── WP_6.8_*.md       # Phase-specific progress reports and audits
│
└── css-optimization/     # CSS/SCSS optimization documentation
    └── CSS_OPTIMIZATION_PLAN.md
```

## Quick Links

### Overview
- **[MODERNIZATION.md](overview/MODERNIZATION.md)** - Main modernization guide with all project summaries

### Completed Projects
- **[PHP Modernization](php-modernization/)** - ✅ Complete
- **[Sass Migration](sass-migration/)** - ✅ Complete
- **[Node.js 24 Upgrade](nodejs-upgrade/)** - ✅ Complete
- **[Swiper Migration](swiper-migration/)** - ✅ Complete
- **[WordPress 6.8 Compatibility](wordpress-6.8/)** - ✅ Code review complete

### In Progress
- **[CSS Optimization](css-optimization/)** - 📋 Planning phase

## Documentation Categories

### 1. Overview Documentation
Main guides and summaries:
- `overview/MODERNIZATION.md` - Comprehensive modernization guide

### 2. PHP Modernization
PHP code modernization project:
- Modern array syntax
- Type hints and return types
- Match expressions
- Strict types and readonly properties

### 3. Sass Migration
Sass codebase modernization:
- Module system migration (`@import` → `@use`)
- Division operations migration
- Function migration
- Color function migration

### 4. Node.js Upgrade
Node.js 24 LTS upgrade:
- Environment setup
- Build system testing
- Dependency compatibility

### 5. Swiper Migration
Swiper library upgrade (v4 → v12):
- CDN integration
- Class name updates
- JavaScript initialization
- CSS styling updates

### 6. WordPress 6.8 Compatibility
WordPress 6.8 compatibility review:
- Code review and compatibility checks
- Security updates
- Accessibility improvements
- Block editor enhancements

### 7. CSS Optimization
CSS/SCSS optimization and modernization (planning phase):
- Build system enhancement
- Modern CSS features
- Performance optimizations

## File Naming Conventions

### Plans
- `*_PLAN.md` - Initial planning documents

### Progress Reports
- `*_PROGRESS.md` - Phase-specific progress tracking
- `*_PHASE_*_PROGRESS.md` - Specific phase progress

### Completion Reports
- `*_COMPLETE.md` - Project completion summaries
- `*_COMPLETE.md` - Phase completion reports

### Audits and Assessments
- `*_AUDIT.md` - Code review and audit documents
- `*_ASSESSMENT.md` - Initial assessment documents

### Summaries
- `*_SUMMARY.md` - Executive summaries

## Finding Documentation

### By Topic
- **Build System**: See `overview/MODERNIZATION.md` → Section 1
- **PHP Code**: See `php-modernization/`
- **Sass/SCSS**: See `sass-migration/` and `css-optimization/`
- **JavaScript**: See `overview/MODERNIZATION.md` → Section 3
- **Libraries**: See `swiper-migration/`
- **WordPress**: See `wordpress-6.8/`

### By Status
- **✅ Complete**: PHP Modernization, Sass Migration, Node.js Upgrade, Swiper Migration
- **📋 Planning**: CSS Optimization

### By Type
- **Plans**: Files ending with `_PLAN.md`
- **Progress**: Files ending with `_PROGRESS.md` or `_PHASE_*.md`
- **Complete**: Files ending with `_COMPLETE.md`

## Notes

- All documentation is in Markdown format (.md)
- Cross-references may need updating after reorganization
- Main `README.md` remains in project root
- `MODERNIZATION.md` is the central hub for all modernization efforts

