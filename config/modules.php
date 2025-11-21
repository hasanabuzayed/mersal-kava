<?php
declare(strict_types=1);

/**
 * Modules configuration
 *
 * Allowed to rewrite in child theme.
 *
 * Format:
 * associative array.
 * keys - module name to load,
 * values - array of child modules for this module. If module has no childs - just an empty array
 */

if (!function_exists("kava_get_allowed_modules")) {
    function kava_get_allowed_modules(): array
    {
        return apply_filters("kava-theme/allowed-modules", [
            "blog-layouts" => [],
            "breadcrumbs" => [],
            //'crocoblock'      => [],
            "post-formats" => [],
            "woo" => [
                "woo-breadcrumbs" => [],
                "woo-page-title" => [],
            ],
        ]);
    }
}
