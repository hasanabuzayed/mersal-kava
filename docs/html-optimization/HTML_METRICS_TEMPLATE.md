# HTML Optimization Metrics Collection Template

**Purpose:** Standardized metrics collection for sequential optimization framework

---

## Per-File Metrics Template

### Pre-Optimization Metrics

```json
{
  "file_path": "header.php",
  "group": "Group 1: Foundation Templates",
  "stage": "Stage 1: Foundation",
  "timestamp": "2024-11-23T10:00:00Z",
  "baseline": {
    "file_size": {
      "bytes": 2450,
      "lines": 32,
      "characters": 2450
    },
    "structure": {
      "total_elements": 15,
      "semantic_elements": 3,
      "div_elements": 8,
      "span_elements": 2,
      "generic_containers": 10,
      "nested_levels_max": 5
    },
    "accessibility": {
      "aria_attributes": 1,
      "aria_labels": 0,
      "aria_roles": 0,
      "aria_hidden": 0,
      "alt_attributes": 0,
      "skip_links": 1,
      "keyboard_navigable": true,
      "screen_reader_friendly": false
    },
    "semantics": {
      "header_elements": 1,
      "nav_elements": 0,
      "main_elements": 0,
      "article_elements": 0,
      "section_elements": 0,
      "aside_elements": 0,
      "footer_elements": 0,
      "time_elements": 0,
      "figure_elements": 0
    },
    "performance": {
      "inline_styles": 0,
      "inline_scripts": 0,
      "resource_hints": 0,
      "lazy_loading": 0,
      "image_optimization": "unknown"
    },
    "seo": {
      "meta_tags": 2,
      "structured_data": 0,
      "schema_markup": false,
      "open_graph": false,
      "twitter_cards": false,
      "canonical": false
    },
    "validation": {
      "html_errors": 2,
      "html_warnings": 1,
      "accessibility_errors": 5,
      "accessibility_warnings": 3
    },
    "scores": {
      "html_validation": 85,
      "accessibility_score": 75,
      "performance_score": 82,
      "seo_score": 65,
      "lighthouse_score": 78,
      "w3c_validation": "fail"
    }
  }
}
```

### Post-Optimization Metrics

```json
{
  "file_path": "header.php",
  "group": "Group 1: Foundation Templates",
  "stage": "Stage 1: Foundation",
  "timestamp": "2024-11-23T10:15:00Z",
  "optimized": {
    "file_size": {
      "bytes": 2100,
      "lines": 28,
      "characters": 2100,
      "reduction_percent": 14.3
    },
    "structure": {
      "total_elements": 13,
      "semantic_elements": 5,
      "div_elements": 5,
      "span_elements": 2,
      "generic_containers": 7,
      "nested_levels_max": 4,
      "improvement": "+2 semantic, -3 div"
    },
    "accessibility": {
      "aria_attributes": 4,
      "aria_labels": 2,
      "aria_roles": 1,
      "aria_hidden": 1,
      "alt_attributes": 1,
      "skip_links": 1,
      "keyboard_navigable": true,
      "screen_reader_friendly": true,
      "improvement": "+3 aria, +1 alt"
    },
    "semantics": {
      "header_elements": 1,
      "nav_elements": 1,
      "main_elements": 0,
      "article_elements": 0,
      "section_elements": 0,
      "aside_elements": 0,
      "footer_elements": 0,
      "time_elements": 0,
      "figure_elements": 0,
      "improvement": "+1 nav"
    },
    "performance": {
      "inline_styles": 0,
      "inline_scripts": 0,
      "resource_hints": 2,
      "lazy_loading": 0,
      "image_optimization": "optimized",
      "improvement": "+2 resource hints"
    },
    "seo": {
      "meta_tags": 2,
      "structured_data": 1,
      "schema_markup": true,
      "open_graph": true,
      "twitter_cards": false,
      "canonical": true,
      "improvement": "+1 schema, +1 og, +1 canonical"
    },
    "validation": {
      "html_errors": 0,
      "html_warnings": 0,
      "accessibility_errors": 0,
      "accessibility_warnings": 1,
      "improvement": "-2 errors, -1 warning"
    },
    "scores": {
      "html_validation": 100,
      "accessibility_score": 92,
      "performance_score": 88,
      "seo_score": 82,
      "lighthouse_score": 89,
      "w3c_validation": "pass",
      "improvement": "+15 a11y, +6 perf, +17 seo, +11 lighthouse"
    }
  },
  "optimizations_applied": [
    {
      "type": "semantic_html5",
      "action": "div.nav-container → nav",
      "success": true
    },
    {
      "type": "accessibility",
      "action": "Added aria-label to nav",
      "success": true
    },
    {
      "type": "accessibility",
      "action": "Added aria-hidden to decorative icon",
      "success": true
    },
    {
      "type": "performance",
      "action": "Added preconnect for fonts",
      "success": true
    },
    {
      "type": "seo",
      "action": "Added Organization schema",
      "success": true
    }
  ],
  "patterns_identified": [
    {
      "pattern_id": "nav-semantic-001",
      "pattern": "Navigation containers use <nav>",
      "frequency": 1,
      "success_rate": 1.0
    },
    {
      "pattern_id": "aria-label-nav-001",
      "pattern": "Navigation elements have aria-label",
      "frequency": 1,
      "success_rate": 1.0
    }
  ],
  "time_taken_minutes": 15,
  "notes": "Standard header optimization, no exceptions"
}
```

---

## Group Aggregate Metrics Template

```json
{
  "group": "Group 1: Foundation Templates",
  "stage": "Stage 1: Foundation",
  "timestamp": "2024-11-23T11:00:00Z",
  "files_processed": 4,
  "files": [
    "header.php",
    "footer.php",
    "template-parts/header.php",
    "template-parts/footer.php"
  ],
  "aggregate_metrics": {
    "file_size": {
      "total_before_bytes": 9800,
      "total_after_bytes": 8400,
      "avg_reduction_percent": 14.3,
      "total_reduction_bytes": 1400
    },
    "structure": {
      "avg_semantic_elements_before": 2.5,
      "avg_semantic_elements_after": 4.5,
      "avg_div_elements_before": 7.5,
      "avg_div_elements_after": 5.5,
      "semantic_improvement": "+2.0 elements per file"
    },
    "accessibility": {
      "avg_aria_attributes_before": 0.5,
      "avg_aria_attributes_after": 3.5,
      "avg_accessibility_score_before": 72.5,
      "avg_accessibility_score_after": 90.0,
      "accessibility_improvement": "+17.5 points"
    },
    "validation": {
      "total_errors_before": 8,
      "total_errors_after": 0,
      "total_warnings_before": 4,
      "total_warnings_after": 1,
      "validation_improvement": "-8 errors, -3 warnings"
    },
    "scores": {
      "avg_html_validation_before": 82.5,
      "avg_html_validation_after": 100.0,
      "avg_accessibility_before": 72.5,
      "avg_accessibility_after": 90.0,
      "avg_performance_before": 80.0,
      "avg_performance_after": 86.5,
      "avg_seo_before": 60.0,
      "avg_seo_after": 78.5,
      "avg_lighthouse_before": 76.0,
      "avg_lighthouse_after": 87.5
    }
  },
  "patterns_identified": [
    {
      "pattern_id": "nav-semantic-001",
      "pattern": "Navigation containers use <nav>",
      "frequency": 3,
      "success_rate": 1.0,
      "files": [
        "header.php",
        "template-parts/header.php",
        "template-parts/footer.php"
      ]
    },
    {
      "pattern_id": "aria-label-nav-001",
      "pattern": "Navigation elements have aria-label",
      "frequency": 3,
      "success_rate": 1.0
    },
    {
      "pattern_id": "skip-link-001",
      "pattern": "Skip links present and functional",
      "frequency": 2,
      "success_rate": 1.0
    }
  ],
  "rules_generated": [
    {
      "rule_id": "nav-semantic-001",
      "category": "semantic_html",
      "pattern": "div.nav-container, div.menu-container",
      "action": "Replace with <nav> and add aria-label",
      "success_rate": 1.0,
      "auto_apply": true
    },
    {
      "rule_id": "skip-link-001",
      "category": "accessibility",
      "pattern": "Skip to content link",
      "action": "Ensure skip-link present in header",
      "success_rate": 1.0,
      "auto_apply": true
    }
  ],
  "time_metrics": {
    "total_time_minutes": 60,
    "avg_time_per_file_minutes": 15,
    "pattern_extraction_minutes": 10,
    "rule_generation_minutes": 5
  },
  "feedback_for_next_group": {
    "applicable_patterns": [
      "nav-semantic-001",
      "aria-label-nav-001",
      "skip-link-001"
    ],
    "applicable_rules": [
      "nav-semantic-001",
      "skip-link-001"
    ],
    "best_practices": [
      "Use <nav> for all navigation containers",
      "Always add aria-label to navigation",
      "Include skip links in header templates"
    ],
    "warnings": [],
    "exceptions": []
  }
}
```

---

## Cross-Group Pattern Analysis Template

```json
{
  "pattern_id": "nav-semantic-001",
  "pattern_name": "Navigation Semantic HTML5",
  "first_seen_in": "Group 1: Foundation Templates",
  "first_seen_file": "header.php",
  "pattern_definition": "Replace div.nav-container with <nav> element and add aria-label",
  "applications": [
    {
      "group": "Group 1",
      "files": ["header.php", "template-parts/header.php"],
      "success": 2,
      "total": 2,
      "success_rate": 1.0
    },
    {
      "group": "Group 2",
      "files": ["index.php", "template-parts/posts-loop.php"],
      "success": 2,
      "total": 2,
      "success_rate": 1.0
    },
    {
      "group": "Group 5",
      "files": ["searchform.php", "template-parts/content-navigation.php"],
      "success": 2,
      "total": 2,
      "success_rate": 1.0
    },
    {
      "group": "Group 6",
      "files": ["blog-layouts templates"],
      "success": 45,
      "total": 50,
      "success_rate": 0.9
    }
  ],
  "overall_metrics": {
    "total_applications": 51,
    "total_success": 49,
    "overall_success_rate": 0.96,
    "auto_apply_enabled": true,
    "rule_status": "standardized"
  },
  "exceptions": [
    {
      "file": "inc/modules/blog-layouts/template-parts/creative/content-v5.php",
      "reason": "Custom navigation pattern with special requirements",
      "manual_review_required": true,
      "resolution": "Applied with custom aria-label"
    }
  ],
  "rule_evolution": [
    {
      "iteration": 1,
      "group": "Group 1",
      "rule": "Replace div.nav-container with <nav>",
      "success_rate": 1.0,
      "status": "generated"
    },
    {
      "iteration": 2,
      "group": "Group 2",
      "rule": "Replace div.nav-container with <nav> and add aria-label",
      "success_rate": 1.0,
      "status": "refined"
    },
    {
      "iteration": 3,
      "group": "Group 5",
      "rule": "Replace div.nav-container with <nav> and add aria-label (auto-apply)",
      "success_rate": 1.0,
      "status": "standardized"
    },
    {
      "iteration": 4,
      "group": "Group 6",
      "rule": "Replace div.nav-container with <nav> and add aria-label (auto-apply with exception handling)",
      "success_rate": 0.9,
      "status": "finalized"
    }
  ]
}
```

---

## Stage Summary Template

```json
{
  "stage": "Stage 1: Foundation",
  "groups": ["Group 1", "Group 2"],
  "timestamp_start": "2024-11-23T10:00:00Z",
  "timestamp_end": "2024-11-23T14:00:00Z",
  "duration_minutes": 240,
  "files_processed": 9,
  "stage_metrics": {
    "file_size": {
      "total_reduction_percent": 13.2,
      "total_bytes_saved": 3200
    },
    "accessibility": {
      "avg_improvement": 16.5,
      "wcag_compliance": "AA (target: AA)"
    },
    "validation": {
      "errors_fixed": 18,
      "warnings_fixed": 12,
      "validation_rate": 1.0
    },
    "patterns": {
      "total_identified": 12,
      "high_success_patterns": 8,
      "medium_success_patterns": 3,
      "low_success_patterns": 1
    },
    "rules": {
      "total_generated": 15,
      "auto_apply_enabled": 10,
      "manual_review": 5
    }
  },
  "key_learnings": [
    "Navigation elements should always use <nav>",
    "ARIA labels essential for icon-only buttons",
    "Skip links improve accessibility significantly",
    "Resource hints improve performance measurably"
  ],
  "checkpoint_results": {
    "checkpoint_1": {
      "status": "pass",
      "validation_errors": 0,
      "accessibility_score": 90,
      "patterns_identified": 12,
      "ready_for_next": true
    }
  },
  "ready_for_next_stage": true
}
```

---

## Usage Instructions

### For Each File:
1. Collect baseline metrics using this template
2. Perform optimizations
3. Collect post-optimization metrics
4. Calculate improvements
5. Identify patterns
6. Document optimizations applied

### For Each Group:
1. Aggregate file metrics
2. Extract common patterns
3. Generate optimization rules
4. Calculate group improvements
5. Prepare feedback for next group

### For Each Stage:
1. Aggregate group metrics
2. Analyze cross-group patterns
3. Validate checkpoint criteria
4. Document stage learnings
5. Prepare for next stage

---

**See:** [HTML_SEQUENTIAL_FRAMEWORK.md](HTML_SEQUENTIAL_FRAMEWORK.md) for framework details

