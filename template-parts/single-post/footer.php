<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kava
 */

?>

<footer class="entry-footer" itemscope itemtype="https://schema.org/WPFooter">
	<div class="entry-meta" aria-label="<?php esc_attr_e( 'Entry footer metadata', 'kava' ); ?>" itemprop="keywords"><?php
		kava_post_tags ( [
			'prefix'    => __( 'Tags:', 'kava' ),
			'delimiter' => ''
		] );
	?></div>
</footer><!-- .entry-footer -->