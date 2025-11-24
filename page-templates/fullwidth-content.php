<?php
/**
 * Template Name: Full Width Content Layout
 * Template Post Type: post, page, event
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Kava
 */

get_header();

	while ( have_posts() ) : the_post();

		?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/WebPage"><?php
			if ( ! kava_theme()->do_location( 'single' ) ) {
				?><div class="entry-content" itemprop="text"><?php
					the_content();
				?></div><?php
			}
			wp_link_pages( [
				'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Page links', 'kava' ) . '" itemscope itemtype="https://schema.org/SiteNavigationElement"><span class="page-links-title">' . esc_html__( 'Pages:', 'kava' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			] );
		?></article><!-- #post-<?php the_ID(); ?> --><?php

	endwhile; // End of the loop.

get_footer();