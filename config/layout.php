<?php
/**
 * Layout configuration.
 *
 * @package Kava
 */

add_action( 'after_setup_theme', 'kava_set_layout', 5 );
function kava_set_layout(): void {

	kava_theme()->layout = [
		'one-right-sidebar' => [
			'1/3' => [
				'content' => [ 'col-xs-12', 'col-md-8' ],
				'sidebar' => [ 'col-xs-12', 'col-md-4' ],
			],
			'1/4' => [
				'content' => [ 'col-xs-12', 'col-md-9' ],
				'sidebar' => [ 'col-xs-12', 'col-md-3' ],
			],
		],
		'one-left-sidebar' => [
			'1/3' => [
				'content' => [ 'col-xs-12', 'col-md-8', 'col-md-push-4' ],
				'sidebar' => [ 'col-xs-12', 'col-md-4', 'col-md-pull-8' ],
			],
			'1/4' => [
				'content' => [ 'col-xs-12', 'col-md-9', 'col-md-push-3' ],
				'sidebar' => [ 'col-xs-12', 'col-md-3', 'col-md-pull-9' ],
			],
		],
		'fullwidth' => [
			[
				'content' => [ 'col-xs-12' ],
			],
		],
		'single-post-fullwidth' => [
			[
				'content' => [ 'col-xs-12', 'col-lg-8', 'col-lg-push-2' ],
			],
		],
	];
}
