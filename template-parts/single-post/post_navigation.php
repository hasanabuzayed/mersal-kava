<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kava
 */

echo '<nav class="post-navigation-container" aria-label="' . esc_attr__( 'Post navigation', 'kava' ) . '" itemscope itemtype="https://schema.org/SiteNavigationElement">';

the_post_navigation( [
	'prev_text' => sprintf( '
		<div class="screen-reader-text">%1$s</div>
		<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
		<div class="nav-text">%1$s</div>
		<h4 class="post-title">%2$s</h4>',
		esc_html__( 'Previous', 'kava' ),
		'%title'
	),
	'next_text' => sprintf( '
		<div class="screen-reader-text">%1$s</div>
		<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
		<div class="nav-text">%1$s</div>
		<h4 class="post-title">%2$s</h4>',
		esc_html__( 'Next', 'kava' ),
		'%title'
	),
] );

echo '</nav>';