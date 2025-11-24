<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kava
 */

?>

<?php do_action( 'kava_post_format_quote' ); ?>

<div class="entry-content" itemprop="articleBody">
	<?php the_content(); ?>
	<?php wp_link_pages( [
		'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Page links', 'kava' ) . '" itemscope itemtype="https://schema.org/SiteNavigationElement"><span class="page-links-title">' . esc_html__( 'Pages:', 'kava' ) . '</span>',
		'after'       => '</nav>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
	] ); ?>
</div><!-- .entry-content -->
